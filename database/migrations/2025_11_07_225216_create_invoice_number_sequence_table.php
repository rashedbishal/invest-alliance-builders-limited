<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Mirrors the `invoice_number_sequence` table of the shared database.
 * The table already exists there, so nothing is touched if it is present.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('invoice_number_sequence')) {
            return;
        }

        Schema::create('invoice_number_sequence', function (Blueprint $table) {
            $table->id();
            $table->string('prefix', 20);
            $table->string('period', 6);
            $table->unsignedBigInteger('last_number')->default(0);
            $table->timestamps();

            $table->unique(['prefix', 'period']);
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
