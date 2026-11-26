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

        $this->setHotelShares(['jana' => [400000, 11240], 'dove' => [40000, 4100]]);
    }

    public function test_home_shows_a_card_per_hotel_with_cms_prices(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('data-product="jana"', false)
            ->assertSee('data-product="dove"', false)
            ->assertSee('Hotel Jana The Dove')
            ->assertSee('data-bdt="400000"', false)
            ->assertSee('data-bdt="40000"', false)
            ->assertSee('Up to 11,240')
            ->assertSee('Up to 4,100')
            ->assertDontSee('300,000');
    }

    public function test_old_form_url_redirects_to_the_booking_section(): void
    {
        $this->get('/form')->assertStatus(301)->assertRedirect('/#invest');
    }

    public function test_ssl_pay_rejects_invalid_shares_before_creating_a_transaction(): void
    {
        // Every payload below must be rejected before the gateway is contacted.
        $customer = ['cus_name' => 'A', 'cus_phone' => '01700000000', 'cus_addr1' => 'Dhaka', 'cus_email' => '', 'terms_accepted' => true];

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

    public function test_ssl_pay_requires_agreement_to_the_terms(): void
    {
        $customer = ['cus_name' => 'A', 'cus_phone' => '01700000000', 'cus_addr1' => 'Dhaka', 'cus_email' => '', 'cus_shares' => ['dove' => 1]];

        foreach ([
            $customer,                                   // never sent
            $customer + ['terms_accepted' => false],
            $customer + ['terms_accepted' => 'true'],    // must be a real boolean
        ] as $payload) {
            $this->post('/pay-via-ajax', ['cart_json' => json_encode($payload)])
                ->assertStatus(422)
                ->assertJson(['status' => 'FAILED']);
        }

        $this->assertSame(0, Transaction::count());
        $this->assertSame(0, TransactionShare::count());
    }

    public function test_home_links_the_shared_legal_pages_in_the_footer_and_checkout(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('href="https://alliancebuildersltd.org/terms-of-service"', false)
            ->assertSee('href="https://alliancebuildersltd.org/privacy-policy"', false)
            ->assertSee('href="https://alliancebuildersltd.org/refund-policy"', false)
            ->assertSee('footer__legal', false)
            ->assertSee('name="terms_accepted"', false);
    }

    public function test_ssl_pay_rejects_totals_at_or_above_the_gateway_limit(): void
    {
        config(['shares.sslcommerz_limit' => 500000]);
        $customer = ['cus_name' => 'A', 'cus_phone' => '01700000000', 'cus_addr1' => 'Dhaka', 'cus_email' => '', 'terms_accepted' => true];

        // Jana 400000, Dove 125000. Every total below is 500000 or more (the last is exactly
        // 500000), so none may reach the gateway.
        $this->setHotelShares(['dove' => [125000, 4100]]);
        foreach ([['jana' => 2], ['jana' => 1, 'dove' => 3], ['jana' => 1, 'dove' => 1], ['dove' => 4]] as $shares) {
            $this->post('/pay-via-ajax', ['cart_json' => json_encode($customer + ['cus_shares' => $shares])])
                ->assertStatus(422)
                ->assertJson(['status' => 'FAILED']);
        }

        $this->assertSame(0, Transaction::count());
    }

    public function test_home_exposes_the_sslcommerz_limit_to_the_page(): void
    {
        config(['shares.sslcommerz_limit' => 500000]);

        $this->get('/')
            ->assertOk()
            ->assertSee('sslLimit: 500000,', false)
            ->assertSee('data-pay="sslcommerz"', false);
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

    public function test_a_hotel_without_a_price_or_switched_off_cannot_be_booked(): void
    {
        $this->setHotelShares(['jana' => [null, null], 'dove' => [40000, 4100, false]]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('data-product="jana"', false)
            ->assertDontSee('data-product="dove"', false)
            ->assertSee('Share booking is currently closed.');

        $this->postJson('/paypal/create', [
            'name' => 'Test Customer', 'phone' => '01700000000', 'address' => 'Dhaka', 'shares' => ['dove' => 1], 'terms_accepted' => true,
        ])->assertStatus(422)->assertJson(['message' => 'Selected hotel is not available.']);
    }

    public function test_price_changes_in_the_cms_apply_to_the_next_booking(): void
    {
        $this->setHotelShares(['jana' => [450000, 11240]]);

        $this->get('/')->assertOk()->assertSee('data-bdt="450000"', false)->assertDontSee('data-bdt="400000"', false);
    }
}
