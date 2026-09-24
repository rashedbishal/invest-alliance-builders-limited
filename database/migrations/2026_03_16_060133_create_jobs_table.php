<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Mirrors the `jobs` table of the shared database.
 * The table already exists there, so nothing is touched if it is present.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('jobs')) {
            return;
        }

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue');
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');

            $table->index(['queue', 'reserved_at', 'available_at']);
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
