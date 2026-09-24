<?php

namespace Tests\Unit;

use App\Services\Booking\ShareCatalog;
use InvalidArgumentException;
use Tests\TestCase;

class ShareCatalogTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['shares.hotels' => [
            'jana' => ['name' => 'Hotel Jana', 'name_bn' => 'জানা', 'price' => 400000, 'max' => 100],
            'dove' => ['name' => 'Hotel Jana The Dove', 'name_bn' => 'ডোভ', 'price' => 40000, 'max' => 50],
            'off' => ['name' => 'Not configured', 'name_bn' => 'x', 'price' => 0, 'max' => 0],
        ]]);
    }

    public function test_hotels_lists_only_configured_hotels(): void
    {
        $this->assertSame(['jana', 'dove'], array_keys((new ShareCatalog)->hotels()));
    }

    public function test_quote_prices_a_single_hotel(): void
    {
        $quote = (new ShareCatalog)->quote(['jana' => '2']);

        $this->assertSame(800000.0, $quote['total']);
        $this->assertSame(2, $quote['units']);
        $this->assertSame('jana', $quote['lines'][0]['hotel']);
        $this->assertSame(400000.0, $quote['lines'][0]['unit_price']);
    }

    public function test_quote_prices_both_hotels_and_skips_zero_counts(): void
    {
        $quote = (new ShareCatalog)->quote(['jana' => 1, 'dove' => 3]);
        $this->assertSame(520000.0, $quote['total']);
        $this->assertSame(4, $quote['units']);
        $this->assertCount(2, $quote['lines']);

        $quote = (new ShareCatalog)->quote(['jana' => 0, 'dove' => 1]);
        $this->assertCount(1, $quote['lines']);
    }

    /**
     * @dataProvider invalidSelections
     */
    public function test_quote_rejects_invalid_selections(array $selection): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new ShareCatalog)->quote($selection);
    }

    public static function invalidSelections(): array
    {
        return [
            'empty' => [[]],
            'all zero' => [['jana' => 0]],
            'unknown hotel' => [['nope' => 1]],
            'unconfigured hotel' => [['off' => 1]],
            'over max' => [['dove' => 51]],
            'negative' => [['jana' => -1]],
            'fractional' => [['jana' => '1.5']],
            'text' => [['jana' => 'abc']],
            'array' => [['jana' => [1]]],
        ];
    }
}
