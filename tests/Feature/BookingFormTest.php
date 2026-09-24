<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\TransactionShare;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['shares.hotels' => [
            'jana' => ['name' => 'Hotel Jana', 'name_bn' => 'হোটেল জানা', 'price' => 400000, 'max' => 11240],
            'dove' => ['name' => 'Hotel Jana The Dove', 'name_bn' => 'হোটেল জানা দ্য ডোভ', 'price' => 40000, 'max' => 4100],
        ]]);
    }

    public function test_form_shows_a_card_per_hotel_with_env_prices(): void
    {
        $this->get('/form')
            ->assertOk()
            ->assertSee('data-hotel="jana"', false)
            ->assertSee('data-hotel="dove"', false)
            ->assertSee('Hotel Jana The Dove')
            ->assertSee('৳ 4,00,000')
            ->assertSee('৳ 40,000')
            ->assertSee('(max 11,240)')
            ->assertSee('(max 4,100)')
            ->assertDontSee('3,00,000');
    }

    public function test_ssl_pay_rejects_invalid_shares_before_creating_a_transaction(): void
    {
        // Every payload below must be rejected before the gateway is contacted.
        $customer = ['cus_name' => 'A', 'cus_phone' => '01700000000', 'cus_addr1' => 'Dhaka', 'cus_email' => ''];

        foreach ([
            $customer,                                                    // no shares at all (e.g. stale page)
            $customer + ['cus_shares' => []],
            $customer + ['cus_shares' => ['jana' => 99999]],              // over max
            $customer + ['cus_shares' => ['zzz' => 1], 'cus_amount' => 1],   // unknown hotel
        ] as $payload) {
            $this->post('/pay-via-ajax', ['cart_json' => json_encode($payload)])
                ->assertStatus(422)
                ->assertJson(['status' => 'FAILED']);
        }

        $this->assertSame(0, Transaction::count());
        $this->assertSame(0, TransactionShare::count());
    }

    public function test_ssl_pay_rejects_totals_at_or_above_the_gateway_limit(): void
    {
        config(['shares.sslcommerz_limit' => 500000]);
        $customer = ['cus_name' => 'A', 'cus_phone' => '01700000000', 'cus_addr1' => 'Dhaka', 'cus_email' => ''];

        // Jana 400000, Dove 125000. Every total below is 500000 or more (the last is exactly
        // 500000), so none may reach the gateway.
        config(['shares.hotels.dove.price' => 125000]);
        foreach ([['jana' => 2], ['jana' => 1, 'dove' => 3], ['jana' => 1, 'dove' => 1], ['dove' => 4]] as $shares) {
            $this->post('/pay-via-ajax', ['cart_json' => json_encode($customer + ['cus_shares' => $shares])])
                ->assertStatus(422)
                ->assertJson(['status' => 'FAILED']);
        }

        $this->assertSame(0, Transaction::count());
    }

    public function test_form_exposes_the_sslcommerz_limit_to_the_page(): void
    {
        config(['shares.sslcommerz_limit' => 500000]);

        $this->get('/form')
            ->assertOk()
            ->assertSee('const SSL_LIMIT = 500000;', false)
            ->assertSee('id="sslOption"', false);
    }

    public function test_invoice_lists_each_hotel_line_and_falls_back_for_older_payments(): void
    {
        $invoice = Invoice::create([
            'invoice_date' => '2026-09-24', 'payment_amount' => 480000, 'invoice_status' => 'Processing',
            'remarks' => 'Online Payment', 'money_receipt_number' => 'MR-1', 'public_token' => 'tok',
        ]);
        $transaction = Transaction::create([
            'name' => 'A', 'phone' => '017', 'address' => 'Dhaka', 'transaction_id' => 'TRX-1',
            'amount' => 480000, 'status' => 'Processing',
        ]);
        $render = fn () => view('content.invoice', [
            'invoice' => $invoice, 'concern' => 2, 'qrDataUri' => '', 'transaction' => $transaction->fresh(),
            'unitprice' => 480000, 'unit' => 1,
        ])->render();

        // Payment started before per-hotel lines existed: single legacy line.
        $this->assertStringContainsString('Hotel Jana Kuakata - Share', $render());

        TransactionShare::create(['transaction_id' => 'TRX-1', 'hotel' => 'jana', 'hotel_name' => 'Hotel Jana', 'unit_price' => 400000, 'quantity' => 1, 'subtotal' => 400000]);
        TransactionShare::create(['transaction_id' => 'TRX-1', 'hotel' => 'dove', 'hotel_name' => 'Hotel Jana The Dove', 'unit_price' => 40000, 'quantity' => 2, 'subtotal' => 80000]);

        $html = $render();
        $this->assertStringContainsString('Hotel Jana - Share', $html);
        $this->assertStringContainsString('Hotel Jana The Dove - Share', $html);
        $this->assertStringContainsString('80,000', $html);
        $this->assertStringNotContainsString('Kuakata - Share', $html);
    }
}
