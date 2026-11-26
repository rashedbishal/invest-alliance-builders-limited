<?php

namespace App\Services\Payment;

use App\Helpers\QRProcessor;
use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * What happens once money is confirmed for a transaction: invoice + submission +
 * money receipt, then the receipt PDF and emails. Used by the PayPal flow and the
 * admin CMS (PayPal re-check, bank transfers). The SSLCommerz controller keeps its
 * own copy of this logic and is intentionally not wired to this class.
 */
class ReceiptService
{
    /**
     * Issue the invoice for a transaction that has just been marked paid.
     * Call inside the caller's DB transaction, after the transaction row is updated.
     */
    public function issue(Transaction $transaction, string $remarks): Invoice
    {
        $invoice = Invoice::create([
            'invoice_date' => now()->format('Y-m-d'),
            'payment_amount' => $transaction->amount,
            'invoice_status' => 'Processing',
            'remarks' => $remarks,
            'public_token' => bin2hex(random_bytes(32)),
            'public_token_expires_at' => null,
            'public_token_revoked_at' => null,
        ]);

        $transaction->update(['invoice_number' => $invoice->invoice_number]);

        $summary = $transaction->shareSummary();

        Submission::create([
            'name' => $transaction->name,
            'email' => $transaction->email,
            'phone' => $transaction->phone,
            'address' => $transaction->address,
            'unit_price' => $summary['unit_price'],
            'unit' => $summary['units'],
            'total_price' => $transaction->amount,
            'invoice_number' => $invoice->invoice_number,
        ]);

        $invoice->update([
            'payment_date' => now()->format('Y-m-d'),
            'invoice_status' => $transaction->status,
            'money_receipt_number' => MoneyReceiptGenerator::generate(),
        ]);

        return $invoice;
    }

    public function renderPdf(Transaction $transaction, Invoice $invoice): string
    {
        $qrDataUri = QRProcessor::generate(route('invoice-access', ['token' => $invoice->public_token]));
        $summary = $transaction->shareSummary();

        return Pdf::loadView('content.invoice', [
            'invoice' => $invoice,
            'concern' => $transaction->cn_identifier,
            'qrDataUri' => $qrDataUri,
            'transaction' => $transaction,
            'unitprice' => $summary['unit_price'],
            'unit' => $summary['units'],
        ])->output();
    }

    /**
     * Build the receipt PDF and queue the emails. A mail/PDF problem must never
     * undo a payment that has already been recorded, so failures are only logged.
     */
    public function send(Transaction $transaction, Invoice $invoice, string $paymentMethod): void
    {
        try {
            $pdf = $this->renderPdf($transaction, $invoice);

            if ($transaction->email) {
                Mail::to($transaction->email)
                    ->queue(new PaymentConfirmationMail(base64_encode($pdf), $invoice->invoice_number, $transaction->cn_identifier, $invoice->money_receipt_number));
            }

            Mail::to(config('portal.email_address.managing_director'))
                ->cc(config('portal.email_address.accounts'))
                ->bcc(config('portal.email_address.osl'))
                ->queue(new PaymentReceiveConfirmationMail(base64_encode($pdf), $invoice->invoice_number, $transaction->cn_identifier, $invoice->money_receipt_number, $transaction->name, $transaction->amount, $transaction->tran_date, $paymentMethod));
        } catch (Throwable $e) {
            Log::error("{$paymentMethod} receipt/email failed for {$transaction->transaction_id}: ".$e->getMessage());
        }
    }

    /**
     * Customer copy only (CMS "Resend email"). Unlike send(), errors are thrown so
     * the admin sees that it did not go out.
     */
    public function resendToCustomer(Transaction $transaction, Invoice $invoice): void
    {
        $pdf = $this->renderPdf($transaction, $invoice);

        Mail::to($transaction->email)
            ->queue(new PaymentConfirmationMail(base64_encode($pdf), $invoice->invoice_number, $transaction->cn_identifier, $invoice->money_receipt_number));
    }

    /**
     * Dashboard caches of the portal app (same database / cache store).
     */
    public function forgetPortalCaches(): void
    {
        Cache::forget('jana-monthly-payment-count');
        Cache::forget('daily-jana-payment');
        Cache::forget('weekly-jana-payment');
        Cache::forget('monthly-jana-payment');
        Cache::forget('monthly-total-payment');
    }
}
