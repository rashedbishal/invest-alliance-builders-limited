<?php

namespace App\Services\Payment;

use App\Services\Currency\CurrencyService;
use Illuminate\Support\Facades\Log;

/**
 * The single place that decides how a BDT total becomes the amount charged on PayPal,
 * so the order that is created and the figure shown on the page always agree.
 */
class PayPalRate
{
    public function __construct(private CurrencyService $currencies)
    {
    }

    /**
     * BDT per 1 unit of the PayPal currency. Automatic by default, with the .env value as the
     * fallback when the rate feed is down or returns something implausible (over 30% away from
     * the .env value, which would point to bad data rather than a real move). 0 = unavailable.
     */
    public function bdtPerUnit(): float
    {
        $currency = (string) config('paypal.currency');
        $fixed = (float) config('paypal.bdt_per_usd');

        if (config('paypal.rate_source') !== 'auto') {
            return $fixed;
        }

        $auto = $this->currencies->bdtPerUnit($currency);

        if (! $auto) {
            Log::warning("PayPal: no automatic {$currency} rate available, using PAYPAL_BDT_PER_USD.");

            return $fixed;
        }

        if ($fixed > 0 && abs($auto - $fixed) / $fixed > 0.30) {
            Log::warning("PayPal: automatic rate {$auto} is over 30% away from PAYPAL_BDT_PER_USD ({$fixed}); using the fixed value.");

            return $fixed;
        }

        return $auto;
    }

    /** Amount to charge on PayPal for a BDT total, margin included. 0 = PayPal unavailable. */
    public function charge(float $bdt): float
    {
        $rate = $this->chargeRate();

        return $rate > 0 ? round($bdt / $rate, 2) : 0.0;
    }

    /**
     * BDT per PayPal unit with the safety margin folded in, i.e. bdt / chargeRate() is the
     * amount charged. The landing page uses this to preview the PayPal charge.
     */
    public function chargeRate(): float
    {
        $rate = $this->bdtPerUnit();

        return $rate > 0 ? $rate / (1 + max(0, (float) config('paypal.rate_margin_percent')) / 100) : 0.0;
    }
}
