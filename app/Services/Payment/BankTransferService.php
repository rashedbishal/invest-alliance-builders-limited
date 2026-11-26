<?php

namespace App\Services\Payment;

use App\Helpers\TransactionIdHelper;
use App\Models\BankTransferRequest;
use App\Models\Transaction;
use App\Models\TransactionShare;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class BankTransferService
{
    public const REMARKS = 'Bank Transfer (Dutch-Bangla Bank)';

    public function __construct(private ReceiptService $receipts) {}

    /**
     * The money has arrived in the bank: record it exactly like an online payment
     * (transaction + share lines + invoice + money receipt) and email the receipt.
     */
    public function markPaid(BankTransferRequest $request, CarbonInterface $paidOn, ?string $bankReference): BankTransferRequest
    {
        $result = DB::transaction(function () use ($request, $paidOn, $bankReference) {
            $request = BankTransferRequest::whereKey($request->getKey())->lockForUpdate()->firstOrFail();

            if ($request->status !== BankTransferRequest::STATUS_NEW) {
                throw new RuntimeException('This bank transfer has already been marked as paid.');
            }

            $transaction = Transaction::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address(),
                'invoice_number' => null,
                'transaction_id' => TransactionIdHelper::generate(),
                'amount' => $request->total,
                'status' => 'Processing',
                'currency' => 'BDT',
                'card_type' => Transaction::BANK_CARD_TYPE,
                'bank_tran_id' => $bankReference ?: null,
                'tran_date' => $paidOn->toDateString(),
                'cn_identifier' => 2,
            ]);

            foreach ($request->lines as $line) {
                TransactionShare::create(['transaction_id' => $transaction->transaction_id] + $line);
            }

            $invoice = $this->receipts->issue($transaction, self::REMARKS);

            $request->update([
                'status' => BankTransferRequest::STATUS_PAID,
                'bank_reference' => $bankReference ?: null,
                'paid_on' => $paidOn->toDateString(),
                'transaction_id' => $transaction->transaction_id,
                'invoice_number' => $invoice->invoice_number,
                'paid_at' => now(),
            ]);

            return [$request, $transaction, $invoice];
        });

        [$request, $transaction, $invoice] = $result;

        $this->receipts->send($transaction, $invoice, 'Bank Transfer');
        $this->receipts->forgetPortalCaches();

        return $request;
    }
}
