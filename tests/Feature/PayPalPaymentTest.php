<?php

namespace Tests\Feature;

use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\TransactionShare;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PayPalPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'paypal.client_id' => 'client',
            'paypal.client_secret' => 'secret',
            'paypal.currency' => 'USD',
            'paypal.bdt_per_usd' => 122.88,
            'shares.hotels' => [
                'jana' => ['name' => 'Hotel Jana', 'name_bn' => 'হোটেল জানা', 'price' => 300000, 'max' => 10],
                'dove' => ['name' => 'Hotel Jana The Dove', 'name_bn' => 'হোটেল জানা দ্য ডোভ', 'price' => 40000, 'max' => 5],
            ],
        ]);
    }

    private function pendingTransaction(array $overrides = []): Transaction
    {
        return Transaction::create($overrides + [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '01700000000',
            'address' => 'Dhaka',
            'transaction_id' => 'TRX-ABC123',
            'gateway_transaction_id' => 'ORDER123',
            'amount' => 300000,
            'status' => 'Pending',
            'currency' => 'BDT',
            'currency_type' => 'USD',
            'currency_amount' => 122.88,
            'currency_rate' => 2441.4063,
        ]);
    }

    private function fakePayPal(string $captureValue = '122.88', string $captureStatus = 'COMPLETED'): void
    {
        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123/capture' => Http::response([
                'id' => 'ORDER123',
                'status' => 'COMPLETED',
                'purchase_units' => [[
                    'payments' => ['captures' => [[
                        'id' => 'CAPTURE999',
                        'status' => $captureStatus,
                        'amount' => ['currency_code' => 'USD', 'value' => $captureValue],
                        'seller_receivable_breakdown' => ['net_amount' => ['currency_code' => 'USD', 'value' => '118.00']],
                        'create_time' => '2026-09-23T10:00:00Z',
                    ]]],
                ]],
            ]),
            '*/v2/checkout/orders' => Http::response([
                'id' => 'ORDER123',
                'status' => 'PAYER_ACTION_REQUIRED',
                'links' => [['rel' => 'payer-action', 'href' => 'https://paypal.test/approve?token=ORDER123']],
            ]),
        ]);
    }

    public function test_create_prices_order_from_selected_shares(): void
    {
        $this->fakePayPal();

        $this->postJson('/paypal/create', [
            'name' => 'Test Customer', 'phone' => '01700000000', 'address' => 'Dhaka', 'email' => '',
            'shares' => ['jana' => 1],
        ])->assertOk()->assertJson(['approve_url' => 'https://paypal.test/approve?token=ORDER123']);

        $tx = Transaction::firstOrFail();
        $this->assertSame('Pending', $tx->status);
        $this->assertSame('ORDER123', $tx->gateway_transaction_id);
        $this->assertEquals(300000, $tx->amount);
        $this->assertSame('BDT', $tx->currency);
        $this->assertSame('USD', $tx->currency_type);
        $this->assertEquals(2441.41, $tx->currency_amount); // 300000 / 122.88
        $this->assertNull($tx->email);

        // Amount sent to PayPal is derived from the server-side prices, never from the browser.
        Http::assertSent(fn ($r) => str_ends_with($r->url(), '/v2/checkout/orders')
            && $r['purchase_units'][0]['amount'] === ['currency_code' => 'USD', 'value' => '2441.41']);
    }

    public function test_create_supports_both_hotels_and_ignores_client_amount(): void
    {
        $this->fakePayPal();

        $this->postJson('/paypal/create', [
            'name' => 'Test Customer', 'phone' => '01700000000', 'address' => 'Dhaka',
            'shares' => ['jana' => 1, 'dove' => 2],
            'amount' => 1, 'cus_amount' => 1,
        ])->assertOk();

        $tx = Transaction::firstOrFail();
        $this->assertEquals(380000, $tx->amount); // 300000 + 2 x 40000
        $this->assertEquals(3092.45, $tx->currency_amount); // 380000 / 122.88

        $this->assertSame(
            ['jana' => 1, 'dove' => 2],
            $tx->shares()->orderBy('id')->pluck('quantity', 'hotel')->all()
        );

        Http::assertSent(fn ($r) => str_ends_with($r->url(), '/v2/checkout/orders')
            && $r['purchase_units'][0]['amount']['value'] === '3092.45');
    }

    public function test_create_rejects_invalid_share_selection(): void
    {
        $this->fakePayPal();
        $base = ['name' => 'Test Customer', 'phone' => '01700000000', 'address' => 'Dhaka'];

        $this->postJson('/paypal/create', $base)->assertStatus(422);
        $this->postJson('/paypal/create', $base + ['shares' => []])->assertStatus(422);
        $this->postJson('/paypal/create', $base + ['shares' => ['jana' => 11]])->assertStatus(422);
        $this->postJson('/paypal/create', $base + ['shares' => ['dove' => 0]])->assertStatus(422);
        $this->postJson('/paypal/create', $base + ['shares' => ['jana' => -1]])->assertStatus(422);
        $this->postJson('/paypal/create', $base + ['shares' => ['jana' => '1.5']])->assertStatus(422);
        $this->postJson('/paypal/create', $base + ['shares' => ['nope' => 1]])->assertStatus(422);

        $this->assertSame(0, Transaction::count());
        Http::assertNothingSent();
    }

    public function test_create_validates_input(): void
    {
        $this->fakePayPal();

        $this->postJson('/paypal/create', ['name' => '', 'phone' => '', 'address' => ''])
            ->assertStatus(422);

        $this->assertSame(0, Transaction::count());
    }

    public function test_success_captures_and_issues_invoice_once(): void
    {
        Mail::fake();
        $this->fakePayPal();
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123&PayerID=P1')
            ->assertRedirect(route('home'))
            ->assertSessionHas('success');

        $tx = Transaction::firstOrFail();
        $this->assertSame('Processing', $tx->status);
        $this->assertSame('CAPTURE999', $tx->val_id);
        $this->assertSame('PayPal', $tx->card_type);
        $this->assertNotNull($tx->invoice_number);

        $invoice = Invoice::firstOrFail();
        $this->assertSame($tx->invoice_number, $invoice->invoice_number);
        $this->assertSame('Processing', $invoice->invoice_status);
        $this->assertSame(300000.0, $invoice->payment_amount);
        $this->assertNotNull($invoice->money_receipt_number);
        $this->assertSame(1, Submission::where('invoice_number', $invoice->invoice_number)->count());

        Mail::assertQueued(PaymentConfirmationMail::class);
        Mail::assertQueued(PaymentReceiveConfirmationMail::class);

        // Refreshing the return page must not capture or invoice twice.
        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('info');
        $this->assertSame(1, Invoice::count());
        Http::assertSentCount(2); // token + capture, once
    }

    public function test_success_records_share_totals_on_submission(): void
    {
        Mail::fake();
        $this->fakePayPal(captureValue: '3092.45');
        $this->pendingTransaction([
            'amount' => 380000,
            'currency_amount' => 3092.45,
        ]);
        foreach ([['jana', 'Hotel Jana', 300000, 1], ['dove', 'Hotel Jana The Dove', 40000, 2]] as [$hotel, $name, $price, $qty]) {
            TransactionShare::create([
                'transaction_id' => 'TRX-ABC123', 'hotel' => $hotel, 'hotel_name' => $name,
                'unit_price' => $price, 'quantity' => $qty, 'subtotal' => $price * $qty,
            ]);
        }

        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('success');

        $submission = Submission::firstOrFail();
        $this->assertSame(3, $submission->unit);
        $this->assertEquals(126666.67, $submission->unit_price);
        $this->assertEquals(380000, $submission->total_price);
    }

    public function test_amount_mismatch_is_rejected(): void
    {
        Mail::fake();
        $this->fakePayPal(captureValue: '1.00');
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('fail');

        $this->assertSame('Pending', Transaction::firstOrFail()->status);
        $this->assertSame(0, Invoice::count());
    }

    public function test_unknown_token_fails(): void
    {
        $this->get('/paypal/success?token=NOPE')->assertSessionHas('fail');
        $this->get('/paypal/success')->assertSessionHas('fail');
    }

    public function test_cancel_marks_pending_transaction_cancelled(): void
    {
        $this->pendingTransaction();

        $this->get('/paypal/cancel?token=ORDER123')
            ->assertRedirect(route('home'))
            ->assertSessionHas('cancel');

        $this->assertSame('Cancelled', Transaction::firstOrFail()->status);
    }
}
