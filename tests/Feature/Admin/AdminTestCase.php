<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\TransactionShare;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class AdminTestCase extends TestCase
{
    use RefreshDatabase;

    protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'mail.from.address' => 'osl@example.com',
            'portal.email_address.managing_director' => 'md@example.com',
            'portal.email_address.accounts' => 'accounts@example.com',
            'portal.email_address.osl' => 'osl@example.com',
            'paypal.client_id' => 'client',
            'paypal.client_secret' => 'secret',
        ]);

        $this->setHotelShares(['jana' => [300000, 10], 'dove' => [40000, 5]]);

        $this->admin = Admin::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => 'correct-horse-battery']);
    }

    protected function signIn(): static
    {
        return $this->actingAs($this->admin, 'admin');
    }

    /** A row written by this app (it has share lines). */
    protected function appTransaction(array $overrides = [], int $quantity = 1): Transaction
    {
        $tx = Transaction::create($overrides + [
            'name' => 'App Customer',
            'email' => 'customer@example.com',
            'phone' => '01700000000',
            'address' => 'Dhaka',
            'transaction_id' => 'TRX-'.strtoupper(uniqid()),
            'amount' => 300000 * $quantity,
            'status' => 'Processing',
            'currency' => 'BDT',
            'cn_identifier' => 2,
        ]);

        TransactionShare::create([
            'transaction_id' => $tx->transaction_id,
            'hotel' => 'jana',
            'hotel_name' => 'Hotel Jana',
            'unit_price' => 300000,
            'quantity' => $quantity,
            'subtotal' => 300000 * $quantity,
        ]);

        return $tx;
    }

    /** A row written by the other (portal) app on the shared table: no share lines. */
    protected function portalTransaction(array $overrides = []): Transaction
    {
        return Transaction::create($overrides + [
            'name' => 'Portal Client',
            'phone' => '01800000000',
            'transaction_id' => 'TRX-PORTAL'.strtoupper(uniqid()),
            'amount' => 5000,
            'status' => 'Processing',
            'currency' => 'BDT',
            'cn_identifier' => 2,
            'cl_identifier' => 7,
        ]);
    }

    protected function invoiceFor(Transaction $tx, array $overrides = []): Invoice
    {
        $invoice = Invoice::create($overrides + [
            'invoice_date' => now()->toDateString(),
            'payment_date' => now()->toDateString(),
            'payment_amount' => $tx->amount,
            'invoice_status' => 'Processing',
            'money_receipt_number' => 'MR-'.strtoupper(uniqid()),
            'remarks' => 'Online Payment',
            'public_token' => bin2hex(random_bytes(32)),
        ]);

        $tx->update(['invoice_number' => $invoice->invoice_number]);

        return $invoice;
    }
}
