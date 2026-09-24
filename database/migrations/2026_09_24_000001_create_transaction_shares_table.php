<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Per-hotel share lines of a booking. Kept in its own table (keyed by the
 * `transactions.transaction_id` string) so the shared `transactions` table is
 * left untouched.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_shares', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->index();
            $table->string('hotel', 50);
            $table->string('hotel_name');
            $table->decimal('unit_price', 12, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_shares');
    }
};
