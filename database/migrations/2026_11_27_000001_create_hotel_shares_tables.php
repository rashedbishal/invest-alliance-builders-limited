<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Share price / per-booking max for each hotel, edited in the CMS (they used to
 * come from HOTEL_JANA_* in .env). Rows start without a price, so a hotel is not
 * bookable until the admin enters its price and max. Hotel names and the set of
 * hotels stay in config/shares.php because the landing page has content for each.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_shares', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50)->unique();
            $table->decimal('price', 12, 2)->nullable();
            $table->unsignedInteger('max_per_booking')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('hotel_share_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_share_id')->constrained()->cascadeOnDelete();
            $table->json('diff');
            $table->string('changed_by')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        foreach (['jana', 'dove'] as $key) {
            DB::table('hotel_shares')->insert(['key' => $key, 'created_at' => now(), 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_share_changes');
        Schema::dropIfExists('hotel_shares');
    }
};
