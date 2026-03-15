<?php

namespace App\Helpers;

use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionIdHelper
{
    public static function generate($length = 13)
    {
        do {
            $transaction_id = 'TRX-'.strtoupper(Str::random($length));
        } while (Transaction::where('transaction_id', $transaction_id)->exists());

        return $transaction_id;
    }
}