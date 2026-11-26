<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankTransferRequest extends Model
{
    public const STATUS_NEW = 'New';

    public const STATUS_PAID = 'Paid';

    protected $fillable = [
        'name', 'phone', 'email', 'address_1', 'address_2', 'lines', 'total',
        'status', 'bank_reference', 'paid_on', 'transaction_id', 'invoice_number', 'paid_at',
    ];

    protected $attributes = [
        'status' => self::STATUS_NEW,
    ];

    protected function casts(): array
    {
        return [
            'lines' => 'array',
            'total' => 'float',
            'paid_on' => 'date',
            'paid_at' => 'datetime',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_number', 'invoice_number');
    }

    public function address(): string
    {
        return collect([$this->address_1, $this->address_2])->filter()->implode(', ');
    }
}
