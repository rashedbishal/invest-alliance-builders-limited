<?php

namespace App\Models;

use App\Services\Invoice\InvoiceNumberGenerator;
use App\Support\RouteCrypto;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'invoice_date',
        'money_receipt_number',
        'due_date',
        'payment_date',
        'due_amount',
        'payment_amount',
        'remarks',
        'invoice_status',
        'public_token',
        'public_token_revoked_at',
        'public_token_expires_at',
    ];

    protected $casts = [
        'payment_amount' => 'float',
        'due_amount' => 'float',
        'public_token_expires_at' => 'datetime',
        'public_token_revoked_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'invoice_number';
    }

    public function getRouteKey()
    {
        return RouteCrypto::encryptParams((string) $this->invoice_number);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $invoice_number = RouteCrypto::decryptParams((string) $value);

        return $this->where($this->getRouteKeyName(), $invoice_number)->firstOrFail();
    }

    protected static function booted(): void
    {
        static::creating(function (Invoice $invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = InvoiceNumberGenerator::generate('INV', 5);
            }
        });
    }
}
