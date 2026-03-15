<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\DB;

class MoneyReceiptGenerator
{
    /**
     * Create a new class instance.
     */
    public static function generate(): string
    {
        $period = now()->format('Ym'); // e.g. 202601

        return DB::transaction(function () use ($period) {

            // Lock the row for this month (if exists)
            $row = DB::table('money_receipt_sequences')
                ->where('period', $period)
                ->lockForUpdate()
                ->first();

            if (! $row) {
                // First receipt of this month
                $next = 1;

                DB::table('money_receipt_sequences')->insert([
                    'period' => $period,
                    'last_number' => $next,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Increment receipt number
                $next = $row->last_number + 1;

                DB::table('money_receipt_sequences')
                    ->where('id', $row->id)
                    ->update([
                        'last_number' => $next,
                        'updated_at' => now(),
                    ]);
            }

            return "{$period}-{$next}";
        });
    }
}
