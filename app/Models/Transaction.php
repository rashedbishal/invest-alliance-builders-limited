<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public const GATEWAY_SSLCOMMERZ = 'SSLCommerz';

    public const GATEWAY_PAYPAL = 'PayPal';

    public const GATEWAY_BANK = 'Bank Transfer';

    /** card_type written on rows created from a paid Dutch-Bangla Bank transfer. */
    public const BANK_CARD_TYPE = 'Bank Transfer (DBBL)';

    public const PAID_STATUSES = ['Processing', 'Complete', 'VALID'];

    public function shares(): HasMany
    {
        return $this->hasMany(TransactionShare::class, 'transaction_id', 'transaction_id');
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_number', 'invoice_number');
    }

    /**
     * Rows created by this app. `transactions` is shared with the portal app,
     * which never writes `transaction_shares`, so having share lines is the marker.
     */
    public function scopeFromThisApp(Builder $query): Builder
    {
        return $query->whereHas('shares');
    }

    public function scopeGateway(Builder $query, string $gateway): Builder
    {
        return match ($gateway) {
            self::GATEWAY_PAYPAL => $query->whereNotNull('gateway_transaction_id'),
            self::GATEWAY_BANK => $query->where('card_type', self::BANK_CARD_TYPE),
            default => $query->whereNull('gateway_transaction_id')
                ->where(fn (Builder $q) => $q->whereNull('card_type')->orWhere('card_type', '!=', self::BANK_CARD_TYPE)),
        };
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->whereIn('status', self::PAID_STATUSES);
    }

    public function gatewayName(): string
    {
        return match (true) {
            $this->gateway_transaction_id !== null => self::GATEWAY_PAYPAL,
            $this->card_type === self::BANK_CARD_TYPE => self::GATEWAY_BANK,
            default => self::GATEWAY_SSLCOMMERZ,
        };
    }

    public function isPaid(): bool
    {
        return in_array($this->status, self::PAID_STATUSES, true);
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
