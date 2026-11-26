<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\Transactions\Pages\ListTransactions;
use App\Filament\Resources\Transactions\Pages\ViewTransaction;
use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

class TransactionAdminTest extends AdminTestCase
{
    public function test_only_this_apps_transactions_are_listed(): void
    {
        $this->signIn();
        $mine = $this->appTransaction();
        $pendingMine = $this->appTransaction(['status' => 'Pending']);
        $portal = $this->portalTransaction();

        Livewire::test(ListTransactions::class)
            ->assertCanSeeTableRecords([$mine, $pendingMine])
            ->assertCanNotSeeTableRecords([$portal]);

        $this->get("/admin/transactions/{$portal->id}")->assertNotFound();
    }

    public function test_filters_by_status_and_gateway(): void
    {
        $this->signIn();
        $ssl = $this->appTransaction(['card_type' => 'VISA-Dutch Bangla']);
        $paypal = $this->appTransaction(['gateway_transaction_id' => 'ORDER1', 'card_type' => 'PayPal', 'status' => 'Pending']);
        $bank = $this->appTransaction(['card_type' => Transaction::BANK_CARD_TYPE]);

        Livewire::test(ListTransactions::class)
            ->filterTable('gateway', Transaction::GATEWAY_PAYPAL)
            ->assertCanSeeTableRecords([$paypal])
            ->assertCanNotSeeTableRecords([$ssl, $bank])
            ->filterTable('gateway', Transaction::GATEWAY_SSLCOMMERZ)
            ->assertCanSeeTableRecords([$ssl])
            ->assertCanNotSeeTableRecords([$paypal, $bank])
            ->filterTable('gateway', Transaction::GATEWAY_BANK)
            ->assertCanSeeTableRecords([$bank])
            ->assertCanNotSeeTableRecords([$ssl, $paypal]);

        Livewire::test(ListTransactions::class)
            ->filterTable('status', 'Pending')
            ->assertCanSeeTableRecords([$paypal])
            ->assertCanNotSeeTableRecords([$ssl, $bank]);
    }

    public function test_search_finds_by_name_and_transaction_id(): void
    {
        $this->signIn();
        $a = $this->appTransaction(['name' => 'Rahim Uddin']);
        $b = $this->appTransaction(['name' => 'Karim Ahmed']);

        Livewire::test(ListTransactions::class)
            ->searchTable('Rahim')
            ->assertCanSeeTableRecords([$a])
            ->assertCanNotSeeTableRecords([$b])
            ->searchTable($b->transaction_id)
            ->assertCanSeeTableRecords([$b])
            ->assertCanNotSeeTableRecords([$a]);
    }

    public function test_excel_and_pdf_exports_download(): void
    {
        $this->signIn();
        $this->appTransaction();
        $this->portalTransaction();

        Livewire::test(ListTransactions::class)
            ->callAction('exportExcel')
            ->assertFileDownloaded();

        Livewire::test(ListTransactions::class)
            ->callAction('exportPdf')
            ->assertFileDownloaded();
    }

    private function pendingPayPal(): Transaction
    {
        return $this->appTransaction([
            'status' => 'Pending',
            'gateway_transaction_id' => 'ORDER123',
            'currency_type' => 'USD',
            'currency_amount' => 2441.41,
            'currency_rate' => 122.88,
            'transaction_id' => 'TRX-PP1',
        ]);
    }

    private function completedOrder(string $status = 'COMPLETED'): array
    {
        return [
            'id' => 'ORDER123',
            'status' => 'COMPLETED',
            'purchase_units' => [[
                'payments' => ['captures' => [[
                    'id' => 'CAPTURE1',
                    'status' => $status,
                    'amount' => ['currency_code' => 'USD', 'value' => '2441.41'],
                    'seller_receivable_breakdown' => ['net_amount' => ['currency_code' => 'USD', 'value' => '2350.00']],
                    'create_time' => '2026-11-20T10:00:00Z',
                ]]],
            ]],
        ];
    }

    public function test_verify_records_a_payment_paypal_already_captured(): void
    {
        Mail::fake();
        $this->signIn();
        $tx = $this->pendingPayPal();

        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123' => Http::response($this->completedOrder()),
        ]);

        Livewire::test(ViewTransaction::class, ['record' => $tx->id])
            ->assertActionVisible('verifyWithPayPal')
            ->callAction('verifyWithPayPal')
            ->assertNotified('Payment confirmed by PayPal.');

        $tx->refresh();
        $this->assertSame('Processing', $tx->status);
        $this->assertSame('CAPTURE1', $tx->val_id);
        $this->assertNotNull($tx->invoice_number);
        $this->assertNotNull($tx->invoice->money_receipt_number);
        Http::assertNotSent(fn ($r) => str_ends_with($r->url(), '/capture'));
        Mail::assertQueued(PaymentConfirmationMail::class, fn ($m) => $m->hasTo('customer@example.com'));
        Mail::assertQueued(PaymentReceiveConfirmationMail::class);
    }

    public function test_verify_captures_an_approved_but_uncaptured_order(): void
    {
        Mail::fake();
        $this->signIn();
        $tx = $this->pendingPayPal();

        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123/capture' => Http::response($this->completedOrder()),
            '*/v2/checkout/orders/ORDER123' => Http::response(['id' => 'ORDER123', 'status' => 'APPROVED']),
        ]);

        Livewire::test(ViewTransaction::class, ['record' => $tx->id])->callAction('verifyWithPayPal');

        $this->assertSame('Processing', $tx->fresh()->status);
        Http::assertSent(fn ($r) => str_ends_with($r->url(), '/v2/checkout/orders/ORDER123/capture'));
    }

    public function test_verify_leaves_an_unapproved_order_pending(): void
    {
        Mail::fake();
        $this->signIn();
        $tx = $this->pendingPayPal();

        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123' => Http::response(['id' => 'ORDER123', 'status' => 'PAYER_ACTION_REQUIRED']),
        ]);

        Livewire::test(ViewTransaction::class, ['record' => $tx->id])
            ->callAction('verifyWithPayPal')
            ->assertNotified('The customer never approved this payment on PayPal.');

        $this->assertSame('Pending', $tx->fresh()->status);
        Mail::assertNothingQueued();
    }

    public function test_verify_marks_a_declined_capture_failed(): void
    {
        Mail::fake();
        $this->signIn();
        $tx = $this->pendingPayPal();

        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123' => Http::response($this->completedOrder('DECLINED')),
        ]);

        Livewire::test(ViewTransaction::class, ['record' => $tx->id])->callAction('verifyWithPayPal');

        $tx->refresh();
        $this->assertSame('Failed', $tx->status);
        $this->assertSame('DECLINED', $tx->error);
        $this->assertNull($tx->invoice_number);
    }

    public function test_verify_changes_nothing_when_paypal_cannot_be_reached(): void
    {
        $this->signIn();
        $tx = $this->pendingPayPal();

        Http::fake([
            '*/v1/oauth2/token' => Http::response(['access_token' => 'tok']),
            '*/v2/checkout/orders/ORDER123' => Http::response(['name' => 'INTERNAL_SERVER_ERROR'], 500),
        ]);

        Livewire::test(ViewTransaction::class, ['record' => $tx->id])
            ->callAction('verifyWithPayPal')
            ->assertNotified('Could not get a clear answer from PayPal.');

        $this->assertSame('Pending', $tx->fresh()->status);
    }

    public function test_verify_is_only_offered_for_pending_paypal_payments(): void
    {
        $this->signIn();
        $ssl = $this->appTransaction(['status' => 'Pending']);
        $paidPayPal = $this->appTransaction(['gateway_transaction_id' => 'ORDER9']);

        Livewire::test(ViewTransaction::class, ['record' => $ssl->id])->assertActionHidden('verifyWithPayPal');
        Livewire::test(ViewTransaction::class, ['record' => $paidPayPal->id])->assertActionHidden('verifyWithPayPal');
    }
}
