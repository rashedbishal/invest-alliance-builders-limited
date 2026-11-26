<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use App\Support\RouteCrypto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceDownloadTest extends TestCase
{
    use RefreshDatabase;

    private function paidInvoice(): Invoice
    {
        $invoice = Invoice::create([
            'invoice_date' => now()->toDateString(),
            'payment_date' => now()->toDateString(),
            'payment_amount' => 300000,
            'invoice_status' => 'Processing',
            'money_receipt_number' => 'MR-1',
            'public_token' => bin2hex(random_bytes(32)),
        ]);

        Transaction::create([
            'name' => 'Customer', 'phone' => '01700000000', 'transaction_id' => 'TRX-DL1',
            'amount' => 300000, 'status' => 'Processing', 'currency' => 'BDT', 'cn_identifier' => 2,
            'invoice_number' => $invoice->invoice_number,
        ]);

        Submission::create([
            'name' => 'Customer', 'unit_price' => 300000, 'unit' => 1, 'total_price' => 300000,
            'invoice_number' => $invoice->invoice_number,
        ]);

        return $invoice;
    }

    public function test_the_encrypted_download_route_resolves_the_invoice(): void
    {
        $invoice = $this->paidInvoice();

        $this->get(route('admin-download-invoice', ['invoice' => $invoice, 'concern' => RouteCrypto::encryptParams('2')]))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }

    public function test_a_tampered_invoice_param_is_not_found(): void
    {
        $this->paidInvoice();

        $this->get('/invoice/not-a-real-token/'.RouteCrypto::encryptParams('2').'/download')
            ->assertNotFound();
    }

    public function test_the_qr_link_still_opens_the_receipt(): void
    {
        $invoice = $this->paidInvoice();

        $this->get(route('invoice-access', ['token' => $invoice->public_token]))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }
}
