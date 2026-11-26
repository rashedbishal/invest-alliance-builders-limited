<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\Invoices\Pages\ListInvoices;
use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Invoice;
use Filament\Actions\Testing\TestAction;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

class InvoiceAdminTest extends AdminTestCase
{
    public function test_only_this_apps_invoices_are_listed(): void
    {
        $this->signIn();
        $mine = $this->invoiceFor($this->appTransaction());
        $portal = $this->invoiceFor($this->portalTransaction());
        $orphan = Invoice::create(['invoice_date' => now()->toDateString(), 'invoice_status' => 'Pending']);

        Livewire::test(ListInvoices::class)
            ->assertCanSeeTableRecords([$mine])
            ->assertCanNotSeeTableRecords([$portal, $orphan]);
    }

    public function test_resend_email_goes_to_the_customer_only(): void
    {
        Mail::fake();
        $this->signIn();
        $invoice = $this->invoiceFor($this->appTransaction());

        Livewire::test(ListInvoices::class)
            ->callAction(TestAction::make('resendEmail')->table($invoice))
            ->assertNotified();

        Mail::assertQueued(PaymentConfirmationMail::class, fn ($m) => $m->hasTo('customer@example.com') && $m->invoice_number === $invoice->invoice_number);
        Mail::assertNotQueued(PaymentReceiveConfirmationMail::class);
    }

    public function test_qr_link_can_be_turned_off_and_reissued(): void
    {
        $this->signIn();
        $invoice = $this->invoiceFor($this->appTransaction());
        $oldToken = $invoice->public_token;

        Livewire::test(ListInvoices::class)->callAction(TestAction::make('revokeLink')->table($invoice));

        $invoice->refresh();
        $this->assertNotNull($invoice->public_token_revoked_at);
        $this->get(route('invoice-access', ['token' => $oldToken]))->assertRedirect(route('home'));

        Livewire::test(ListInvoices::class)->callAction(TestAction::make('newLink')->table($invoice));

        $invoice->refresh();
        $this->assertNull($invoice->public_token_revoked_at);
        $this->assertNotSame($oldToken, $invoice->public_token);
        $this->assertTrue($invoice->publicLinkIsActive());
    }

    public function test_download_streams_the_receipt_pdf(): void
    {
        $this->signIn();
        $invoice = $this->invoiceFor($this->appTransaction());

        Livewire::test(ListInvoices::class)
            ->callAction(TestAction::make('downloadReceipt')->table($invoice))
            ->assertFileDownloaded("receipt-{$invoice->money_receipt_number}.pdf");
    }
}
