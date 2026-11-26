<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Dutch-Bangla Bank transfer bookings. The customer pays offline, so nothing
 * touches `transactions` until an admin marks the booking paid in the CMS.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_transfer_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20);
            $table->string('email', 50);
            $table->string('address_1', 150);
            $table->string('address_2', 100)->nullable();
            $table->json('lines');
            $table->decimal('total', 12, 2);
            $table->string('status', 20)->default('New')->index();
            $table->string('bank_reference')->nullable();
            $table->date('paid_on')->nullable();
            $table->string('transaction_id')->nullable()->index();
            $table->string('invoice_number')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_transfer_requests');
    }
};
