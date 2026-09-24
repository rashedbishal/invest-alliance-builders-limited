<?php

namespace App\Http\Controllers;

use App\Helpers\QRProcessor;
use App\Helpers\TransactionIdHelper;
use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use App\Models\Invoice;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\TransactionShare;
use App\Services\Booking\ShareCatalog;
use App\Services\Payment\MoneyReceiptGenerator;
use App\Services\Payment\PayPalApiException;
use App\Services\Payment\PayPalRate;
use App\Services\Payment\PayPalService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;
use Throwable;

class PayPalPaymentController extends Controller
{
    /**
     * PayPal capture errors that mean "this payment will not go through", so the
     * transaction is closed as Failed. Anything else (network trouble, ORDER_NOT_APPROVED,
     * ORDER_ALREADY_CAPTURED, merchant-side problems) leaves it Pending: the money may
     * really have moved, so it needs a look instead of being written off.
     */
    private const DECLINED_ISSUES = [
        'INSTRUMENT_DECLINED',
        'TRANSACTION_REFUSED',
        'PAYER_ACCOUNT_RESTRICTED',
        'PAYER_ACCOUNT_LOCKED_OR_CLOSED',
        'PAYER_CANNOT_PAY',
        'TRANSACTION_LIMIT_EXCEEDED',
        'MAX_NUMBER_OF_PAYMENT_ATTEMPTS_EXCEEDED',
    ];

    private const DECLINED_MESSAGE = 'Your PayPal payment was declined and you have not been charged. Please try again with another payment method or contact PayPal.';

    private const PENDING_MESSAGE = 'PayPal is reviewing your payment. We will confirm it as soon as PayPal completes the review - please contact us if you do not hear from us.';

    public function __construct(private PayPalService $paypal, private ShareCatalog $catalog, private PayPalRate $rate)
    {
    }

    /**
     * Create a PayPal order and a Pending transaction, then hand back the
     * PayPal approval URL for the browser to redirect to.
     */
    public function create(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', 'max:50'],
            'shares' => ['required', 'array'],
        ]);

        // Priced from the server-side hotel prices; the browser never sends an amount.
        try {
            $quote = $this->catalog->quote($data['shares']);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        $currency = (string) config('paypal.currency');
        $bdtAmount = $quote['total'];

        if ($this->rate->bdtPerUnit() <= 0 || ! config('paypal.client_id') || ! config('paypal.client_secret')) {
            Log::error('PayPal is not configured (PAYPAL_CLIENT_ID / PAYPAL_CLIENT_SECRET / PAYPAL_BDT_PER_USD).');

            return response()->json(['message' => 'PayPal is not available right now.'], 500);
        }

        // BDT total -> PayPal currency (automatic rate plus the optional safety margin)
        $chargeAmount = $this->rate->charge($bdtAmount);

        if ($chargeAmount <= 0) {
            return response()->json(['message' => 'PayPal is not available right now.'], 500);
        }

        $tranId = TransactionIdHelper::generate();

        try {
            $order = $this->paypal->createOrder(
                $tranId,
                $currency,
                number_format($chargeAmount, 2, '.', ''),
                route('paypal.success'),
                route('paypal.cancel'),
            );
            $approvalUrl = $this->paypal->approvalUrl($order);

            if (empty($order['id']) || ! $approvalUrl) {
                throw new \RuntimeException('PayPal order response had no id/approval link: '.json_encode($order));
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return response()->json(['message' => 'Could not start the PayPal payment. Please try again.'], 502);
        }

        // `amount` is kept in BDT (like the SSLCommerz rows) so existing reports stay
        // correct; the USD actually charged lives in currency_type/currency_amount.
        Transaction::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'address' => $data['address'],
            'invoice_number' => null,
            'transaction_id' => $tranId,
            'gateway_transaction_id' => $order['id'],
            'amount' => $bdtAmount,
            'status' => 'Pending',
            'currency' => 'BDT',
            'currency_type' => $currency,
            'currency_amount' => $chargeAmount,
            'currency_rate' => round($bdtAmount / $chargeAmount, 4),
        ]);

        foreach ($quote['lines'] as $line) {
            TransactionShare::create(['transaction_id' => $tranId] + $line);
        }

        return response()->json(['approve_url' => $approvalUrl]);
    }

    /**
     * PayPal sends the customer back here after they approve the payment.
     */
    public function success(Request $request): RedirectResponse
    {
        $orderId = (string) $request->query('token');

        if ($orderId === '') {
            return redirect()->route('home')->with('fail', 'Transaction is invalid');
        }

        $result = DB::transaction(function () use ($orderId) {
            $transaction = Transaction::where('gateway_transaction_id', $orderId)->lockForUpdate()->first();

            if (! $transaction) {
                return ['outcome' => 'invalid'];
            }

            if (in_array($transaction->status, ['Processing', 'Complete'], true)) {
                return ['outcome' => 'already'];
            }

            if ($transaction->status !== 'Pending') {
                return ['outcome' => 'invalid'];
            }

            try {
                $order = $this->paypal->captureOrder($orderId, $transaction->transaction_id);
            } catch (Throwable $e) {
                Log::error($e->getMessage());

                if ($e instanceof PayPalApiException && in_array($e->issue, self::DECLINED_ISSUES, true)) {
                    $transaction->update(['status' => 'Failed', 'error' => $e->issue]);

                    return ['outcome' => 'declined'];
                }

                return ['outcome' => 'fail'];
            }

            $capture = $order['purchase_units'][0]['payments']['captures'][0] ?? null;
            $captureStatus = $capture['status'] ?? null;

            if (in_array($captureStatus, ['DECLINED', 'FAILED'], true)) {
                Log::warning('PayPal capture '.$captureStatus.': '.json_encode($order));
                $transaction->update(['status' => 'Failed', 'error' => $captureStatus]);

                return ['outcome' => 'declined'];
            }

            if ($captureStatus === 'PENDING') {
                Log::warning('PayPal capture pending review for '.$transaction->transaction_id.': '.json_encode($order));

                return ['outcome' => 'pending'];
            }

            if (($order['status'] ?? null) !== 'COMPLETED' || ! $capture || ($capture['status'] ?? null) !== 'COMPLETED') {
                Log::warning('PayPal capture not completed: '.json_encode($order));

                return ['outcome' => 'fail'];
            }

            $expected = number_format((float) $transaction->currency_amount, 2, '.', '');
            if (($capture['amount']['value'] ?? null) !== $expected
                || ($capture['amount']['currency_code'] ?? null) !== $transaction->currency_type) {
                Log::error("PayPal amount mismatch for {$transaction->transaction_id}: ".json_encode($capture));

                return ['outcome' => 'fail'];
            }

            $rate = (float) $transaction->currency_rate;
            $net = $capture['seller_receivable_breakdown']['net_amount']['value'] ?? null;

            $transaction->update([
                'status' => 'Processing',
                'val_id' => $capture['id'],
                'card_type' => 'PayPal',
                'store_amount' => $net !== null ? round((float) $net * $rate, 2) : null,
                'tran_date' => $capture['create_time'] ?? now()->toDateTimeString(),
                'cn_identifier' => 2,
            ]);

            $invoice = Invoice::create([
                'invoice_date' => now()->format('Y-m-d'),
                'payment_amount' => $transaction->amount,
                'invoice_status' => 'Processing',
                'remarks' => 'Online Payment (PayPal)',
                'public_token' => bin2hex(random_bytes(32)),
                'public_token_expires_at' => now()->addYears(1),
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

            return ['outcome' => 'paid', 'transaction' => $transaction, 'invoice' => $invoice];
        });

        switch ($result['outcome']) {
            case 'paid':
                $this->sendReceipt($result['transaction'], $result['invoice']);

                Cache::forget('jana-monthly-payment-count');
                Cache::forget('daily-jana-payment');
                Cache::forget('weekly-jana-payment');
                Cache::forget('monthly-jana-payment');
                Cache::forget('monthly-total-payment');

                return redirect()->route('home')->with('success', 'Transaction is successful');
            case 'already':
                return redirect()->route('home')->with('info', 'Transaction is already successful');
            case 'declined':
                return redirect()->route('home')->with('fail', 'Transaction is failed')->with('fail_reason', self::DECLINED_MESSAGE);
            case 'pending':
                return redirect()->route('home')->with('info', self::PENDING_MESSAGE)->with('info_title', 'Payment Under Review');
            default:
                return redirect()->route('home')->with('fail', 'Transaction is failed');
        }
    }

    /**
     * The customer closed/cancelled the PayPal approval page.
     */
    public function cancel(Request $request): RedirectResponse
    {
        $transaction = Transaction::where('gateway_transaction_id', (string) $request->query('token'))->first();

        if ($transaction && $transaction->status === 'Pending') {
            $transaction->update(['status' => 'Cancelled']);
        }

        return redirect()->route('home')->with('cancel', 'Transaction is cancelled');
    }

    /**
     * Build the receipt PDF and queue the emails. A mail/PDF problem must never
     * undo a payment that has already been captured, so failures are only logged.
     */
    private function sendReceipt(Transaction $transaction, Invoice $invoice): void
    {
        try {
            $qrDataUri = QRProcessor::generate(route('invoice-access', ['token' => $invoice->public_token]));
            $summary = $transaction->shareSummary();

            $pdf = Pdf::loadView('content.invoice', [
                'invoice' => $invoice,
                'concern' => $transaction->cn_identifier,
                'qrDataUri' => $qrDataUri,
                'transaction' => $transaction,
                'unitprice' => $summary['unit_price'],
                'unit' => $summary['units'],
            ])->output();

            if ($transaction->email) {
                Mail::to($transaction->email)
                    ->queue(new PaymentConfirmationMail(base64_encode($pdf), $invoice->invoice_number, $transaction->cn_identifier, $invoice->money_receipt_number));
            }

            Mail::to(config('portal.email_address.managing_director'))
                ->cc(config('portal.email_address.accounts'))
                ->bcc(config('portal.email_address.osl'))
                ->queue(new PaymentReceiveConfirmationMail(base64_encode($pdf), $invoice->invoice_number, $transaction->cn_identifier, $invoice->money_receipt_number, $transaction->name, $transaction->amount, $transaction->tran_date, 'PayPal'));
        } catch (Throwable $e) {
            Log::error("PayPal receipt/email failed for {$transaction->transaction_id}: ".$e->getMessage());
        }
    }
}
