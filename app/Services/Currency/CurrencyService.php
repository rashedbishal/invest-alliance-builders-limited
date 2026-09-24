<?php

namespace App\Services\Currency;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use NumberFormatter;
use Throwable;

/**
 * Works out which currency to show a visitor and at what rate (per 1 BDT).
 * Purely informational: nothing here is used to charge anyone.
 */
class CurrencyService
{
    /**
     * @return array{currency: string, rate: float}|null null = show BDT only
     */
    public function forRequest(Request $request): ?array
    {
        if (! config('currency.enabled')) {
            return null;
        }

        // ?currency=USD previews a currency (handy for testing and harmless: display only)
        $currency = strtoupper((string) $request->query('currency', ''));

        if (! preg_match('/^[A-Z]{3}$/', $currency)) {
            $country = $this->countryFromCloudflare($request) ?? $this->countryFromIp($this->clientIp($request));
            $currency = $country ? $this->currencyForCountry($country) : null;
        }

        if (! $currency || $currency === config('currency.base')) {
            return null;
        }

        $rate = $this->rates()[$currency] ?? null;

        return $rate && $rate > 0 ? ['currency' => $currency, 'rate' => (float) $rate] : null;
    }

    /**
     * The visitor's public IP. Header values can be forged, which only lets someone
     * preview another currency for themselves.
     */
    public function clientIp(Request $request): ?string
    {
        $candidates = [
            $request->header('CF-Connecting-IP'),
            trim(explode(',', (string) $request->header('X-Forwarded-For'))[0]),
            $request->server('REMOTE_ADDR'),
        ];

        foreach ($candidates as $ip) {
            if ($ip && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;
            }
        }

        return null; // local/private addresses cannot be located
    }

    public function currencyForCountry(string $country): ?string
    {
        if (! class_exists(NumberFormatter::class) || ! preg_match('/^[A-Z]{2}$/', $country)) {
            return null;
        }

        $code = (new NumberFormatter('en_'.$country, NumberFormatter::CURRENCY))->getTextAttribute(NumberFormatter::CURRENCY_CODE);

        return is_string($code) && preg_match('/^[A-Z]{3}$/', $code) && $code !== 'XXX' ? $code : null;
    }

    /** Cloudflare, when the site is behind it, already tells us the country. */
    private function countryFromCloudflare(Request $request): ?string
    {
        $country = strtoupper((string) $request->header('CF-IPCountry'));

        return preg_match('/^[A-Z]{2}$/', $country) && ! in_array($country, ['XX', 'T1'], true) ? $country : null;
    }

    private function countryFromIp(?string $ip): ?string
    {
        if (! $ip) {
            return null;
        }

        $key = 'currency:geo:'.md5($ip);
        $cached = Cache::get($key);

        if ($cached !== null) {
            return $cached === '' ? null : $cached; // '' = an earlier lookup failed; don't hammer the API
        }

        $country = null;

        try {
            $response = Http::timeout((int) config('currency.timeout'))->acceptJson()
                ->get(str_replace('{ip}', rawurlencode($ip), config('currency.geo_url')));

            if ($response->successful() && $response->json('success') !== false) {
                $country = strtoupper((string) $response->json('country_code'));
            }
        } catch (Throwable $e) {
            Log::warning('IP geolocation failed: '.$e->getMessage());
        }

        $valid = preg_match('/^[A-Z]{2}$/', (string) $country) === 1;

        Cache::put($key, $valid ? $country : '', $valid ? now()->addDays(7) : now()->addMinutes(30));

        return $valid ? $country : null;
    }

    /**
     * Rates per 1 BDT, cached. If a refresh fails the last known rates keep being used.
     *
     * @return array<string, float>
     */
    private function rates(): array
    {
        $cached = Cache::get('currency:rates');

        if ($cached && (time() - $cached['fetched_at']) < (int) config('currency.rates_ttl')) {
            return $cached['rates'];
        }

        if (! Cache::has('currency:rates:backoff')) {
            $rates = $this->fetchRates();

            if ($rates) {
                Cache::put('currency:rates', ['fetched_at' => time(), 'rates' => $rates], now()->addDays(30));

                return $rates;
            }

            Cache::put('currency:rates:backoff', true, now()->addMinutes(10));
        }

        return $cached['rates'] ?? [];
    }

    /** @return array<string, float>|null */
    private function fetchRates(): ?array
    {
        try {
            $response = Http::timeout((int) config('currency.timeout'))->acceptJson()->get(config('currency.rates_url'));
            $rates = $response->json('rates') ?? $response->json('conversion_rates');

            if ($response->successful() && $response->json('result') !== 'error' && is_array($rates) && $rates !== []) {
                return array_map('floatval', $rates);
            }

            Log::warning('Exchange rate refresh failed: HTTP '.$response->status());
        } catch (Throwable $e) {
            Log::warning('Exchange rate refresh failed: '.$e->getMessage());
        }

        return null;
    }
}
