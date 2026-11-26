<?php

namespace Tests;

use App\Models\HotelShare;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set the CMS-managed price / max per booking for hotels (hotel_shares).
     * Needs RefreshDatabase. Hotels not listed keep whatever row they have.
     *
     * @param  array<string, array{0: float|int|null, 1: int|null, 2?: bool}>  $hotels  key => [price, max, on sale]
     */
    protected function setHotelShares(array $hotels): void
    {
        foreach ($hotels as $key => $values) {
            HotelShare::updateOrCreate(['key' => $key], [
                'price' => $values[0],
                'max_per_booking' => $values[1],
                'is_active' => $values[2] ?? true,
            ]);
        }
    }
}
