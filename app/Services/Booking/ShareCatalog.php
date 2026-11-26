<?php

namespace App\Services\Booking;

use App\Models\HotelShare;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class ShareCatalog
{
    /** @var array<string, array>|null */
    private ?array $hotels = null;

    /**
     * Hotels that can currently be booked, keyed by hotel key. Which hotels exist
     * (and their names) comes from config/shares.php; price, max per booking and
     * on/off come from the CMS (hotel_shares). A hotel without a price and max,
     * or switched off, is not bookable.
     *
     * @return array<string, array{key: string, name: string, name_bn: string, price: float, max: int}>
     */
    public function hotels(): array
    {
        if ($this->hotels !== null) {
            return $this->hotels;
        }

        try {
            $settings = HotelShare::query()->get()->keyBy('key');
        } catch (QueryException $e) {
            // During a deploy the new code is live a few seconds before the migration
            // creates hotel_shares: show "not available" rather than an error page.
            report($e);

            return [];
        }
        $hotels = [];

        foreach ((array) config('shares.hotels') as $key => $hotel) {
            $setting = $settings->get($key);

            if (! $setting?->isBookable()) {
                continue;
            }

            $hotels[$key] = [
                'key' => (string) $key,
                'name' => (string) $hotel['name'],
                'name_bn' => (string) ($hotel['name_bn'] ?? $hotel['name']),
                'price' => (float) $setting->price,
                'max' => (int) $setting->max_per_booking,
            ];
        }

        return $this->hotels = $hotels;
    }

    /**
     * Price a selection of shares ({hotel key: share count}) using the server-side
     * prices only. Anything the browser says about prices or totals is ignored.
     *
     * @param  array<string, mixed>  $selection
     * @return array{lines: list<array{hotel: string, hotel_name: string, unit_price: float, quantity: int, subtotal: float}>, total: float, units: int}
     *
     * @throws InvalidArgumentException when the selection is empty or invalid
     */
    public function quote(array $selection): array
    {
        $hotels = $this->hotels();
        $lines = [];

        foreach ($selection as $key => $quantity) {
            $hotel = $hotels[$key] ?? null;

            if (! $hotel) {
                throw new InvalidArgumentException('Selected hotel is not available.');
            }

            $count = is_int($quantity) ? $quantity : filter_var($quantity, FILTER_VALIDATE_INT);

            if ($count === false || $count < 0) {
                throw new InvalidArgumentException("Enter a valid share count for {$hotel['name']}.");
            }

            if ($count === 0) {
                continue;
            }

            if ($count > $hotel['max']) {
                throw new InvalidArgumentException("You can book at most {$hotel['max']} shares of {$hotel['name']}.");
            }

            $lines[] = [
                'hotel' => $hotel['key'],
                'hotel_name' => $hotel['name'],
                'unit_price' => $hotel['price'],
                'quantity' => $count,
                'subtotal' => round($hotel['price'] * $count, 2),
            ];
        }

        if ($lines === []) {
            throw new InvalidArgumentException('Select at least one hotel share.');
        }

        return [
            'lines' => $lines,
            'total' => round(array_sum(array_column($lines, 'subtotal')), 2),
            'units' => array_sum(array_column($lines, 'quantity')),
        ];
    }
}
