<?php

namespace App\Services\Invoice;

use Illuminate\Support\Facades\DB;

class InvoiceNumberGenerator
{
    /**
     * Create a new class instance.
     */
    public static function generate(string $prefix = 'INV', int $padLength = 5)
    {
        $period = now()->format('Ym');

        return DB::transaction(function () use ($prefix, $padLength, $period) {
            $row = DB::table('invoice_number_sequence')
                ->where('prefix', $prefix)
                ->where('period', $period)
                ->lockForUpdate()
                ->first();

            if (! $row) {
                // create initial row with last_number = 1
                $next = 1;
                DB::table('invoice_number_sequence')->insert([
                    'prefix' => $prefix,
                    'period' => $period,
                    'last_number' => $next,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $next = $row->last_number + 1;
                DB::table('invoice_number_sequence')
                    ->where('id', $row->id)
                    ->update([
                        'last_number' => $next,
                        'updated_at' => now(),
                    ]);
            }

            $suffix = str_pad((string) $next, $padLength, '0', STR_PAD_LEFT);

            return "{$prefix}-{$period}-{$suffix}";
        });
    }
}
