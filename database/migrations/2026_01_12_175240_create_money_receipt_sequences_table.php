<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Mirrors the `money_receipt_sequences` table of the shared database.
 * The table already exists there, so nothing is touched if it is present.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('money_receipt_sequences')) {
            return;
        }

        Schema::create('money_receipt_sequences', function (Blueprint $table) {
            $table->id();
            $table->string('period', 6)->unique();
            $table->unsignedBigInteger('last_number')->default(0);
            $table->timestamps();

            $table->index('period');
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
