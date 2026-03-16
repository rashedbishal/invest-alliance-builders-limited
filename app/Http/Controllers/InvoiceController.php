<?php

namespace App\Http\Controllers;

use App\Helpers\QRProcessor;
use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use App\Support\RouteCrypto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function downloadInvoice($invoice, $concern)
    {
        $downloadUrl = route('invoice-access', [
            'token' => $invoice->public_token,
        ]);

        $qrDataUri = QRProcessor::generate($downloadUrl);

        if (in_array($invoice->invoice_status, ['Processing', 'COMPLETE', 'VALID'])) {
            $fileName = "receipt-{$invoice->money_receipt_number}.pdf";
        } else {
            $fileName = "invoice-{$invoice->invoice_number}.pdf";
        }

        $submission = Submission::where('invoice_number', $invoice->invoice_number)->first();
        $transaction = Transaction::where('invoice_number', $invoice->invoice_number)->first();

        $pdf = PDF::loadView('content.invoice', ['invoice' => $invoice, 'concern' => RouteCrypto::decryptParams((string) $concern), 'qrDataUri' => $qrDataUri, 'transaction'=> $transaction, 'unitprice' => $submission->unit_price, 'unit'=> $submission->unit])->output();
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream($fileName);

    }

    public function accessViaQr(Request $request, string $token)
    {
        $invoice = Invoice::where('public_token', $token)
            ->firstOrFail();

        $revoked = ! is_null($invoice->public_token_revoked_at);
        $expired = ! is_null($invoice->public_token_expires_at)
            && $invoice->public_token_expires_at->lte(now());

        $concern = RouteCrypto::encryptParams("2");

        $downloadUrl = route('admin-download-invoice', [
            'invoice' => $invoice,
            'concern' => $concern,
        ]);

        if ($revoked || $expired) {
            session(['url.intended' => $downloadUrl]);
            session(['oauth.intended' => $downloadUrl]);

            return redirect()->route('/')
                ->withErrors(['This public link expired. Please contact with us.']);
        }

        return $this->downloadInvoice($invoice, $concern);
    }
}
