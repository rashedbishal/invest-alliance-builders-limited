<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One hotel line of a booking (hotel, unit price, share count) belonging to a
 * transaction. Written when the payment is initiated, from server-side prices.
 */
class TransactionShare extends Model
{
    protected $fillable = [
        'transaction_id',
        'hotel',
        'hotel_name',
        'unit_price',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'unit_price' => 'float',
        'quantity' => 'integer',
        'subtotal' => 'float',
    ];
}
