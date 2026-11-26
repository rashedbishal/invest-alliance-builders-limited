<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\BankTransfers\Pages\ListBankTransfers;
use App\Filament\Resources\BankTransfers\Pages\ViewBankTransfer;
use App\Filament\Resources\Transactions\Pages\ListTransactions;
use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\BankTransferRequest;
use App\Models\Submission;
use App\Models\Transaction;
use App\Services\Payment\BankTransferService;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use RuntimeException;

class BankTransferAdminTest extends AdminTestCase
{
    private function booking(): BankTransferRequest
    {
        Mail::fake();

        $this->postJson('/bank-transfer/notify', [
            'name' => 'Bank Customer',
            'phone' => '+8801700000000',
            'email' => 'bank@example.com',
            'address_1' => 'House 1, Road 2',
            'address_2' => 'Dhaka',
            'shares' => ['jana' => 1, 'dove' => 2],
            'terms_accepted' => '1',
        ])->assertOk();

        return BankTransferRequest::sole();
    }

    public function test_booking_is_listed_as_new(): void
    {
        $booking = $this->booking();
        $this->signIn();

        $this->assertSame(BankTransferRequest::STATUS_NEW, $booking->status);
        $this->assertEquals(380000, $booking->total);

        Livewire::test(ListBankTransfers::class)->assertCanSeeTableRecords([$booking]);
    }

    public function test_mark_paid_issues_the_receipt_like_an_online_payment(): void
    {
        $booking = $this->booking();
        $this->signIn();

        Livewire::test(ViewBankTransfer::class, ['record' => $booking->id])
            ->callAction('markPaid', data: ['paid_on' => now()->toDateString(), 'bank_reference' => 'DBBL-REF-1'])
            ->assertHasNoFormErrors()
            ->assertActionHidden('markPaid');

        $booking->refresh();
        $this->assertSame(BankTransferRequest::STATUS_PAID, $booking->status);

        $tx = Transaction::where('transaction_id', $booking->transaction_id)->sole();
        $this->assertSame('Processing', $tx->status);
        $this->assertSame(Transaction::GATEWAY_BANK, $tx->gatewayName());
        $this->assertSame('DBBL-REF-1', $tx->bank_tran_id);
        $this->assertEquals(380000, $tx->amount);
        $this->assertSame(2, (int) $tx->cn_identifier);
        $this->assertSame(['jana' => 1, 'dove' => 2], $tx->shares->pluck('quantity', 'hotel')->all());

        $this->assertSame($booking->invoice_number, $tx->invoice_number);
        $this->assertSame('Bank Transfer (Dutch-Bangla Bank)', $tx->invoice->remarks);
        $this->assertNotNull($tx->invoice->money_receipt_number);
        $this->assertSame(3, Submission::where('invoice_number', $tx->invoice_number)->value('unit'));

        Mail::assertQueued(PaymentConfirmationMail::class, fn ($m) => $m->hasTo('bank@example.com'));
        Mail::assertQueued(PaymentReceiveConfirmationMail::class);

        Livewire::test(ListTransactions::class)->assertCanSeeTableRecords([$tx]);
    }

    public function test_a_booking_cannot_be_paid_twice(): void
    {
        $booking = $this->booking();
        app(BankTransferService::class)->markPaid($booking, now(), null);

        $this->expectException(RuntimeException::class);
        app(BankTransferService::class)->markPaid($booking, now(), null);
    }

    public function test_bank_reference_must_be_unique(): void
    {
        $this->appTransaction(['bank_tran_id' => 'DUP-1']);
        $booking = $this->booking();
        $this->signIn();

        Livewire::test(ViewBankTransfer::class, ['record' => $booking->id])
            ->callAction('markPaid', data: ['paid_on' => now()->toDateString(), 'bank_reference' => 'DUP-1'])
            ->assertHasFormErrors(['bank_reference']);

        $this->assertSame(BankTransferRequest::STATUS_NEW, $booking->fresh()->status);
    }

    public function test_a_new_booking_can_be_cancelled(): void
    {
        $booking = $this->booking();
        $this->signIn();

        Livewire::test(ViewBankTransfer::class, ['record' => $booking->id])
            ->callAction('cancel')
            ->assertNotified('Booking cancelled.')
            ->assertActionHidden('cancel')
            ->assertActionHidden('markPaid');

        $booking->refresh();
        $this->assertSame(BankTransferRequest::STATUS_CANCELLED, $booking->status);
        $this->assertNotNull($booking->cancelled_at);
        $this->assertSame(0, Transaction::count());
        Mail::assertNotQueued(PaymentConfirmationMail::class);

        Livewire::test(ListBankTransfers::class)
            ->filterTable('status', BankTransferRequest::STATUS_CANCELLED)
            ->assertCanSeeTableRecords([$booking]);
    }

    public function test_a_cancelled_booking_cannot_be_marked_paid(): void
    {
        $booking = $this->booking();
        $booking->update(['status' => BankTransferRequest::STATUS_CANCELLED]);

        $this->expectExceptionMessage('This bank transfer was cancelled, so it cannot be marked paid.');
        app(BankTransferService::class)->markPaid($booking, now(), null);
    }

    public function test_a_paid_booking_cannot_be_cancelled(): void
    {
        $booking = $this->booking();
        app(BankTransferService::class)->markPaid($booking, now(), null);
        $this->signIn();

        Livewire::test(ViewBankTransfer::class, ['record' => $booking->id])
            ->assertActionHidden('cancel');

        $this->assertSame(BankTransferRequest::STATUS_PAID, $booking->fresh()->status);
    }
}
