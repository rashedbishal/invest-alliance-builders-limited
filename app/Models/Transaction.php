<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'invoice_number',
        'transaction_id',
        'tran_id',
        'gateway_transaction_id',
        'val_id',
        'amount',
        'card_type',
        'store_amount',
        'card_no',
        'bank_tran_id',
        'status',
        'tran_date',
        'error',
        'currency',
        'card_issuer',
        'card_brand',
        'card_sub_brand',
        'card_issuer_country',
        'card_issuer_country_code',
        'store_id',
        'verify_sign',
        'verify_sign_sha2',
        'currency_type',
        'currency_amount',
        'currency_rate',
        'base_fair',
        'subscription_id',
        'risk_level',
        'risk_title',
        'cl_identifier',
        'cn_identifier',
    ];

    public function shares(): HasMany
    {
        return $this->hasMany(TransactionShare::class, 'transaction_id', 'transaction_id');
    }

    /**
     * Total share count and average unit price for the Submission row. Payments
     * started before per-hotel lines existed have none, so they count as one share.
     *
     * @return array{units: int, unit_price: float}
     */
    public function shareSummary(): array
    {
        $units = (int) $this->shares()->sum('quantity');

        if ($units < 1) {
            return ['units' => 1, 'unit_price' => (float) $this->amount];
        }

        return ['units' => $units, 'unit_price' => round((float) $this->amount / $units, 2)];
    }
}
