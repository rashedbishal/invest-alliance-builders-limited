<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Price and per-booking max of one hotel's shares, edited in the CMS. Every
 * change to these values is logged in hotel_share_changes.
 */
class HotelShare extends Model
{
    public const TRACKED = ['price', 'max_per_booking', 'is_active'];

    protected $fillable = ['key', 'price', 'max_per_booking', 'is_active'];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'max_per_booking' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::updated(function (HotelShare $share) {
            $changes = [];

            foreach (self::TRACKED as $field) {
                if ($share->wasChanged($field)) {
                    $changes[$field] = ['old' => $share->getOriginal($field), 'new' => $share->getAttribute($field)];
                }
            }

            if ($changes !== []) {
                $admin = auth('admin')->user();

                $share->history()->create([
                    'diff' => $changes,
                    'changed_by' => $admin ? "{$admin->name} <{$admin->email}>" : 'System',
                    'created_at' => now(),
                ]);
            }
        });
    }

    public function history(): HasMany
    {
        return $this->hasMany(HotelShareChange::class)->latest('id');
    }

    /** Name from config/shares.php (the hotel list itself is fixed there). */
    public function name(): string
    {
        return (string) config("shares.hotels.{$this->key}.name", $this->key);
    }

    public function isBookable(): bool
    {
        return $this->is_active && $this->price > 0 && $this->max_per_booking > 0;
    }
}
