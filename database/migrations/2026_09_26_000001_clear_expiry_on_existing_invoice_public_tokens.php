<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Public QR invoice links no longer expire (see InvoiceController::accessViaQr).
 * New invoices already get a null public_token_expires_at; this backfills that
 * for invoices created before the change. Scoped to rows with a public_token so
 * it never touches invoices belonging to the other app sharing this table.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('invoices')
            ->whereNotNull('public_token')
            ->whereNotNull('public_token_expires_at')
            ->update(['public_token_expires_at' => null]);
    }

    /**
     * Intentionally a no-op: the original expiry timestamps are not recoverable.
     */
    public function down(): void
    {
        //
    }
};
