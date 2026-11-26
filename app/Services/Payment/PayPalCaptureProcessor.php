<?php

namespace App\Services\Payment;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Turns a PayPal order into a recorded payment. Shared by the customer's return
 * from PayPal (PayPalPaymentController::success) and the CMS "Verify with PayPal"
 * action, so both follow exactly the same rules.
 *
 * Every method returns ['outcome' => ...] with one of:
 *   paid, already, invalid, declined, pending, fail, not_approved, not_found
 */
class PayPalCaptureProcessor
{
    /**
     * PayPal capture errors that mean "this payment will not go through", so the
     * transaction is closed as Failed. Anything else (network trouble, ORDER_NOT_APPROVED,
     * ORDER_ALREADY_CAPTURED, merchant-side problems) leaves it Pending: the money may
     * really have moved, so it needs a look instead of being written off.
     */
    public const DECLINED_ISSUES = [
        'INSTRUMENT_DECLINED',
        'TRANSACTION_REFUSED',
        'PAYER_ACCOUNT_RESTRICTED',
        'PAYER_ACCOUNT_LOCKED_OR_CLOSED',
        'PAYER_CANNOT_PAY',
        'TRANSACTION_LIMIT_EXCEEDED',
        'MAX_NUMBER_OF_PAYMENT_ATTEMPTS_EXCEEDED',
    ];

    public function __construct(private PayPalService $paypal, private ReceiptService $receipts) {}

    /**
     * The customer came back from PayPal after approving: capture the order.
     */
    public function captureReturningCustomer(string $orderId): array
    {
        $result = DB::transaction(function () use ($orderId) {
            $transaction = Transaction::where('gateway_transaction_id', $orderId)->lockForUpdate()->first();

            if (! $transaction) {
                return ['outcome' => 'invalid'];
            }

            if ($blocked = $this->notPending($transaction)) {
                return $blocked;
            }

            return $this->capture($transaction);
        });

        return $this->finish($result);
    }

    /**
     * CMS: ask PayPal what really happened to a payment that is still Pending.
     * Captures it if it was approved but never captured; records it if it was
     * captured; marks it Failed only if PayPal says it was declined/voided.
     */
    public function verify(Transaction $transaction): array
    {
        $result = DB::transaction(function () use ($transaction) {
            $transaction = Transaction::whereKey($transaction->getKey())->lockForUpdate()->first();

            if (! $transaction || ! $transaction->gateway_transaction_id) {
                return ['outcome' => 'invalid'];
            }

            if ($blocked = $this->notPending($transaction)) {
                return $blocked;
            }

            try {
                $order = $this->paypal->getOrder($transaction->gateway_transaction_id);
            } catch (Throwable $e) {
                Log::error($e->getMessage());

                if ($e instanceof PayPalApiException && $e->issue === 'RESOURCE_NOT_FOUND') {
                    return ['outcome' => 'not_found'];
                }

                return ['outcome' => 'fail'];
            }

            return match ($order['status'] ?? null) {
                'APPROVED' => $this->capture($transaction),
                'COMPLETED' => $this->record($transaction, $order),
                'CREATED', 'SAVED', 'PAYER_ACTION_REQUIRED' => ['outcome' => 'not_approved'],
                'VOIDED' => $this->markFailed($transaction, 'VOIDED'),
                default => ['outcome' => 'fail'],
            };
        });

        return $this->finish($result);
    }

    private function notPending(Transaction $transaction): ?array
    {
        if (in_array($transaction->status, ['Processing', 'Complete'], true)) {
            return ['outcome' => 'already'];
        }

        if ($transaction->status !== 'Pending') {
            return ['outcome' => 'invalid'];
        }

        return null;
    }

    private function capture(Transaction $transaction): array
    {
        try {
            $order = $this->paypal->captureOrder($transaction->gateway_transaction_id, $transaction->transaction_id);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            if ($e instanceof PayPalApiException && in_array($e->issue, self::DECLINED_ISSUES, true)) {
                return $this->markFailed($transaction, $e->issue);
            }

            return ['outcome' => 'fail'];
        }

        return $this->record($transaction, $order);
    }

    /**
     * Record a captured order: validate it, mark the transaction paid and issue the invoice.
     */
    private function record(Transaction $transaction, array $order): array
    {
        $capture = $order['purchase_units'][0]['payments']['captures'][0] ?? null;
        $captureStatus = $capture['status'] ?? null;

        if (in_array($captureStatus, ['DECLINED', 'FAILED'], true)) {
            Log::warning('PayPal capture '.$captureStatus.': '.json_encode($order));

            return $this->markFailed($transaction, $captureStatus);
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

        $invoice = $this->receipts->issue($transaction, 'Online Payment (PayPal)');

        return ['outcome' => 'paid', 'transaction' => $transaction, 'invoice' => $invoice];
    }

    private function markFailed(Transaction $transaction, string $reason): array
    {
        $transaction->update(['status' => 'Failed', 'error' => $reason]);

        return ['outcome' => 'declined'];
    }

    /**
     * After the DB transaction has committed: email the receipt.
     */
    private function finish(array $result): array
    {
        if ($result['outcome'] === 'paid') {
            $this->receipts->send($result['transaction'], $result['invoice'], 'PayPal');
            $this->receipts->forgetPortalCaches();
        }

        return $result;
    }
}
