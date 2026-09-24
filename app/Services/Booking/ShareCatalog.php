<?php

namespace App\Services\Booking;

use InvalidArgumentException;

class ShareCatalog
{
    /**
     * Hotels that can currently be booked, keyed by hotel key.
     *
     * @return array<string, array{key: string, name: string, name_bn: string, price: float, max: int}>
     */
    public function hotels(): array
    {
        $hotels = [];

        foreach ((array) config('shares.hotels') as $key => $hotel) {
            $price = (float) ($hotel['price'] ?? 0);
            $max = (int) ($hotel['max'] ?? 0);

            if ($price <= 0 || $max <= 0) {
                continue;
            }

            $hotels[$key] = [
                'key' => (string) $key,
                'name' => (string) $hotel['name'],
                'name_bn' => (string) ($hotel['name_bn'] ?? $hotel['name']),
                'price' => $price,
                'max' => $max,
            ];
        }

        return $hotels;
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
