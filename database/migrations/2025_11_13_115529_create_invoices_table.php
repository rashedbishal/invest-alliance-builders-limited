<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Mirrors the `invoices` table of the shared database.
 * The table already exists there, so nothing is touched if it is present.
 *
 * In the shared database `order_number` also carries a foreign key to
 * `orders.order_number`. This project has no `orders` table and never sets
 * `order_number`, so only the column and its index are created here.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('invoices')) {
            return;
        }

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('money_receipt_number', 50)->nullable();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->decimal('due_amount', 12, 2)->nullable();
            $table->decimal('payment_amount', 12, 2)->nullable();
            $table->string('invoice_status');
            $table->string('order_number')->nullable();
            $table->text('remarks')->nullable();
            $table->string('public_token', 80)->nullable()->unique();
            $table->timestamp('public_token_expires_at')->nullable();
            $table->timestamp('public_token_revoked_at')->nullable();
            $table->timestamps();

            $table->index('order_number');
            $table->index('invoice_number');
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
