<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Mirrors the `transactions` table of the shared database (SSLCommerz payments).
 * The table already exists there, so nothing is touched if it is present.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('transactions')) {
            return;
        }

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('transaction_id')->unique();
            $table->string('gateway_transaction_id')->nullable()->unique();
            $table->string('val_id')->nullable()->unique();
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('card_type')->nullable();
            $table->decimal('store_amount', 12, 2)->nullable();
            $table->string('card_no')->nullable();
            $table->string('bank_tran_id')->nullable()->unique();
            $table->string('status')->nullable();
            $table->string('tran_date')->nullable();
            $table->string('error')->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('card_issuer')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_sub_brand')->nullable();
            $table->string('card_issuer_country')->nullable();
            $table->string('card_issuer_country_code', 5)->nullable();
            $table->string('store_id')->nullable();
            $table->string('verify_sign')->nullable();
            $table->string('verify_sign_sha2')->nullable();
            $table->string('currency_type', 10)->nullable();
            $table->decimal('currency_amount', 12, 2)->nullable();
            $table->decimal('currency_rate', 12, 4)->nullable();
            $table->decimal('base_fair', 12, 2)->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('risk_level')->nullable();
            $table->string('risk_title')->nullable();
            $table->string('cl_identifier')->nullable();
            $table->string('cn_identifier')->nullable();
            $table->timestamps();

            $table->index(['cn_identifier', 'updated_at']);
            $table->index(['status', 'updated_at']);
        });
    }

    /**
     * Intentionally a no-op: this table belongs to the shared database.
     */
    public function down(): void
    {
        //
    }
};
