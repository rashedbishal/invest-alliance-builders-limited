<?php

namespace Tests\Unit;

use App\Services\Booking\ShareCatalog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class ShareCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['shares.hotels' => [
            'jana' => ['name' => 'Hotel Jana', 'name_bn' => 'জানা'],
            'dove' => ['name' => 'Hotel Jana The Dove', 'name_bn' => 'ডাভ'],
            'off' => ['name' => 'Switched off', 'name_bn' => 'x'],
            'unpriced' => ['name' => 'No price yet', 'name_bn' => 'x'],
            'norow' => ['name' => 'No CMS row', 'name_bn' => 'x'],
        ]]);

        $this->setHotelShares([
            'jana' => [400000, 100],
            'dove' => [40000, 50],
            'off' => [1000, 10, false],
            'unpriced' => [null, null],
            'orphan' => [1000, 10], // a CMS row for a hotel not in config is ignored
        ]);
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
            'switched off hotel' => [['off' => 1]],
            'hotel without a price' => [['unpriced' => 1]],
            'hotel without a CMS row' => [['norow' => 1]],
            'CMS row for a hotel not in config' => [['orphan' => 1]],
            'over max' => [['dove' => 51]],
            'negative' => [['jana' => -1]],
            'fractional' => [['jana' => '1.5']],
            'text' => [['jana' => 'abc']],
            'array' => [['jana' => [1]]],
        ];
    }
}
