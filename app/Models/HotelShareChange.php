<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelShareChange extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = ['diff', 'changed_by', 'created_at'];

    protected function casts(): array
    {
        return ['diff' => 'array', 'created_at' => 'datetime'];
    }

    public function hotelShare(): BelongsTo
    {
        return $this->belongsTo(HotelShare::class);
    }
}
