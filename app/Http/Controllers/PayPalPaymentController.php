<?php

namespace App\Http\Controllers;

use App\Helpers\TransactionIdHelper;
use App\Models\Transaction;
use App\Models\TransactionShare;
use App\Services\Booking\ShareCatalog;
use App\Services\Payment\PayPalCaptureProcessor;
use App\Services\Payment\PayPalRate;
use App\Services\Payment\PayPalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class PayPalPaymentController extends Controller
{
    private const DECLINED_MESSAGE = 'Your PayPal payment was declined and you have not been charged. Please try again with another payment method or contact PayPal.';

    private const PENDING_MESSAGE = 'PayPal is reviewing your payment. We will confirm it as soon as PayPal completes the review - please contact us if you do not hear from us.';

    public function __construct(
        private PayPalService $paypal,
        private ShareCatalog $catalog,
        private PayPalRate $rate,
        private PayPalCaptureProcessor $captures,
    ) {}

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
            'terms_accepted' => ['accepted'],
        ], [
            'terms_accepted.accepted' => 'Please read and agree to the Terms & Conditions, Privacy Policy and Return & Refund Policy.',
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

        $result = $this->captures->captureReturningCustomer($orderId);

        switch ($result['outcome']) {
            case 'paid':
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
}
