<?php

namespace Tests\Feature;

use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\TransactionShare;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
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
            'paypal.rate_source' => 'fixed',
            'paypal.rate_margin_percent' => 0,
            'shares.hotels' => [
                'jana' => ['name' => 'Hotel Jana', 'name_bn' => 'হোটেল জানা', 'price' => 300000, 'max' => 10],
                'dove' => ['name' => 'Hotel Jana The Dove', 'name_bn' => 'হোটেল জানা দ্য ডাভ', 'price' => 40000, 'max' => 5],
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

    private function createOrderWithRates(?array $rates, int $rateStatus = 200): void
    {
        Cache::flush();
        $this->fakePayPal();
        Http::fake(['open.er-api.com/*' => $rates === null
            ? Http::response('down', 500)
            : Http::response(['result' => 'success', 'rates' => $rates], $rateStatus)]);

        $this->postJson('/paypal/create', [
            'name' => 'Test Customer', 'phone' => '01700000000', 'address' => 'Dhaka',
            'shares' => ['jana' => 1], // 300000 BDT
        ]);
    }

    private function assertChargedUsd(string $value): void
    {
        Http::assertSent(fn ($r) => str_ends_with($r->url(), '/v2/checkout/orders')
            && $r['purchase_units'][0]['amount']['value'] === $value);
    }

    public function test_automatic_rate_sets_the_paypal_amount(): void
    {
        config(['paypal.rate_source' => 'auto']);

        $this->createOrderWithRates(['BDT' => 1, 'USD' => 0.008]); // 1 USD = 125 BDT

        $this->assertChargedUsd('2400.00'); // 300000 / 125
        $tx = Transaction::firstOrFail();
        $this->assertEquals(300000, $tx->amount);
        $this->assertEquals(2400, $tx->currency_amount);
        $this->assertEquals(125, $tx->currency_rate);
    }

    public function test_margin_is_added_to_the_amount_charged(): void
    {
        config(['paypal.rate_source' => 'auto', 'paypal.rate_margin_percent' => 2]);

        $this->createOrderWithRates(['BDT' => 1, 'USD' => 0.008]);

        $this->assertChargedUsd('2448.00'); // 2400 + 2%
        $this->assertEquals(300000, Transaction::firstOrFail()->amount); // the BDT price is untouched
    }

    public function test_env_rate_is_used_when_the_rate_feed_is_down(): void
    {
        config(['paypal.rate_source' => 'auto']);

        $this->createOrderWithRates(null);

        $this->assertChargedUsd('2441.41'); // 300000 / 122.88
    }

    public function test_implausible_automatic_rate_is_ignored(): void
    {
        config(['paypal.rate_source' => 'auto']);

        $this->createOrderWithRates(['BDT' => 1, 'USD' => 0.0001]); // "1 USD = 10000 BDT"

        $this->assertChargedUsd('2441.41');
    }

    public function test_fixed_mode_never_asks_the_rate_feed(): void
    {
        config(['paypal.rate_source' => 'fixed']);

        $this->createOrderWithRates(['BDT' => 1, 'USD' => 0.008]);

        $this->assertChargedUsd('2441.41');
        Http::assertNotSent(fn ($r) => str_contains($r->url(), 'open.er-api.com'));
    }

    public function test_paypal_is_unavailable_when_there_is_no_rate_at_all(): void
    {
        config(['paypal.rate_source' => 'auto', 'paypal.bdt_per_usd' => 0]);

        $this->createOrderWithRates(null);

        $this->assertSame(0, Transaction::count());
        Http::assertNotSent(fn ($r) => str_ends_with($r->url(), '/v2/checkout/orders'));
    }

    public function test_landing_page_previews_the_same_rate_the_order_is_charged_with(): void
    {
        config(['paypal.rate_source' => 'auto', 'paypal.rate_margin_percent' => 0]);
        Cache::flush();
        Http::fake(['open.er-api.com/*' => Http::response(['result' => 'success', 'rates' => ['BDT' => 1, 'USD' => 0.008]])]);

        $this->get('/')->assertOk()->assertSee('paypal: { rate: 125,', false); // 1 USD = 125 BDT, not the .env 122.88

        // with a margin the page previews bdt / (rate / 1.02), which is exactly what create() charges
        config(['paypal.rate_margin_percent' => 2]);
        $this->get('/')->assertSee('paypal: { rate: 122.5490196', false);
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

    private function fakeCapture(array $body, int $status): void
    {
        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123/capture' => Http::response($body, $status),
        ]);
    }

    private function paypalError(string $issue, string $name = 'UNPROCESSABLE_ENTITY'): array
    {
        return ['name' => $name, 'details' => [['issue' => $issue, 'description' => $issue]]];
    }

    public function test_declined_payment_is_marked_failed_and_customer_is_told_why(): void
    {
        Mail::fake();
        $this->fakeCapture($this->paypalError('INSTRUMENT_DECLINED'), 422);
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')
            ->assertRedirect(route('home'))
            ->assertSessionHas('fail')
            ->assertSessionHas('fail_reason', fn ($m) => str_contains($m, 'declined'));

        $tx = Transaction::firstOrFail();
        $this->assertSame('Failed', $tx->status);
        $this->assertSame('INSTRUMENT_DECLINED', $tx->error);
        $this->assertNull($tx->invoice_number);
        $this->assertSame(0, Invoice::count());
        Mail::assertNothingQueued();

        // Reloading the return page does not try to capture again.
        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('fail');
        Http::assertSentCount(2); // token + one capture
        $this->assertSame('Failed', Transaction::firstOrFail()->status);
    }

    public function test_declined_status_in_a_successful_response_is_marked_failed(): void
    {
        Mail::fake();
        $this->fakeCapture([
            'id' => 'ORDER123', 'status' => 'COMPLETED',
            'purchase_units' => [['payments' => ['captures' => [['id' => 'C1', 'status' => 'DECLINED', 'amount' => ['currency_code' => 'USD', 'value' => '122.88']]]]]],
        ], 201);
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('fail_reason');

        $this->assertSame('Failed', Transaction::firstOrFail()->status);
        $this->assertSame(0, Invoice::count());
        Mail::assertNothingQueued();
    }

    public function test_pending_review_keeps_the_transaction_pending_and_informs_the_customer(): void
    {
        Mail::fake();
        $this->fakeCapture([
            'id' => 'ORDER123', 'status' => 'COMPLETED',
            'purchase_units' => [['payments' => ['captures' => [['id' => 'C1', 'status' => 'PENDING', 'amount' => ['currency_code' => 'USD', 'value' => '122.88']]]]]],
        ], 201);
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')
            ->assertSessionHas('info', fn ($m) => str_contains($m, 'reviewing'))
            ->assertSessionHas('info_title', 'Payment Under Review')
            ->assertSessionMissing('fail');

        $this->assertSame('Pending', Transaction::firstOrFail()->status);
        $this->assertSame(0, Invoice::count());
        Mail::assertNothingQueued();
    }

    /**
     * @dataProvider unclearErrors
     */
    public function test_errors_that_are_not_a_clear_decline_leave_the_transaction_pending(array $body, int $status): void
    {
        Mail::fake();
        $this->fakeCapture($body, $status);
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')
            ->assertSessionHas('fail')
            ->assertSessionMissing('fail_reason');

        $this->assertSame('Pending', Transaction::firstOrFail()->status);
        $this->assertSame(0, Invoice::count());
    }

    public static function unclearErrors(): array
    {
        return [
            'order not approved' => [['name' => 'UNPROCESSABLE_ENTITY', 'details' => [['issue' => 'ORDER_NOT_APPROVED']]], 422],
            'already captured' => [['name' => 'UNPROCESSABLE_ENTITY', 'details' => [['issue' => 'ORDER_ALREADY_CAPTURED']]], 422],
            'merchant side problem' => [['name' => 'UNPROCESSABLE_ENTITY', 'details' => [['issue' => 'PAYEE_ACCOUNT_RESTRICTED']]], 422],
            'paypal outage' => [['name' => 'INTERNAL_SERVER_ERROR'], 500],
        ];
    }

    public function test_sandbox_mock_response_is_sent_on_capture(): void
    {
        config(['paypal.mode' => 'sandbox', 'paypal.mock_response' => 'INSTRUMENT_DECLINED']);
        $this->fakeCapture($this->paypalError('INSTRUMENT_DECLINED'), 422);
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('fail_reason');

        Http::assertSent(fn ($r) => str_ends_with($r->url(), '/capture')
            && $r->header('PayPal-Mock-Response') === ['{"mock_application_codes":"INSTRUMENT_DECLINED"}']);
    }

    /**
     * @dataProvider mockThatMustNotBeSent
     */
    public function test_mock_response_is_never_sent_in_live_mode_or_when_unset_or_malformed(string $mode, ?string $code): void
    {
        config(['paypal.mode' => $mode, 'paypal.mock_response' => $code]);
        Mail::fake();
        $this->fakePayPal();
        $this->pendingTransaction();

        $this->get('/paypal/success?token=ORDER123')->assertSessionHas('success');

        Http::assertSent(fn ($r) => str_ends_with($r->url(), '/capture') && ! $r->hasHeader('PayPal-Mock-Response'));
    }

    public static function mockThatMustNotBeSent(): array
    {
        return [
            'live mode' => ['live', 'INSTRUMENT_DECLINED'],
            'sandbox, unset' => ['sandbox', null],
            'sandbox, empty' => ['sandbox', ''],
            'sandbox, lower case' => ['sandbox', 'instrument_declined'],
            'sandbox, injection attempt' => ['sandbox', 'X","y":"z'],
        ];
    }

    public function test_cancel_does_not_change_a_failed_or_paid_transaction(): void
    {
        $this->pendingTransaction(['status' => 'Failed']);

        $this->get('/paypal/cancel?token=ORDER123')->assertSessionHas('cancel');

        $this->assertSame('Failed', Transaction::firstOrFail()->status);
    }

    public function test_home_page_shows_the_decline_reason_and_custom_info_title(): void
    {
        $this->withSession(['fail' => 'Transaction is failed', 'fail_reason' => 'Boom reason text'])
            ->get('/')->assertSee('Payment failed')->assertSee('Boom reason text');

        $this->withSession(['info' => 'Under review text', 'info_title' => 'Payment Under Review'])
            ->get('/')->assertSee('Payment Under Review')->assertDontSee('Already processed');
    }

    public function test_home_page_modals_use_their_defaults_when_no_extras_are_set(): void
    {
        // SSLCommerz (and older PayPal) flashes only set `fail` / `info`.
        $this->withSession(['fail' => 'Transaction is failed'])
            ->get('/')->assertSee('Payment failed')->assertSee('You have not been charged')->assertDontSee('Transaction is failed');

        $this->withSession(['info' => 'Transaction is already successful'])
            ->get('/')->assertSee('Already processed')->assertSee('Transaction is already successful');
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
