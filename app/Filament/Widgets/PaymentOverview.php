<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BankTransfers\BankTransferResource;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Models\BankTransferRequest;
use App\Models\Invoice;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

/**
 * Money figures come from invoices (payment_date / payment_amount), which only
 * exist once a payment is confirmed, so Pending/Failed attempts never count.
 */
class PaymentOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $month = [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()];

        $paidThisMonth = Invoice::fromThisApp()->whereBetween('payment_date', $month);
        $paidAllTime = Invoice::fromThisApp()->whereNotNull('payment_date');

        $stats = [
            Stat::make('Received this month', self::bdt((clone $paidThisMonth)->sum('payment_amount')))
                ->description((clone $paidThisMonth)->count().' payments in '.now()->format('F Y'))
                ->color('success'),
            Stat::make('Received all time', self::bdt((clone $paidAllTime)->sum('payment_amount')))
                ->description((clone $paidAllTime)->count().' payments'),
            Stat::make('Pending payments', Transaction::fromThisApp()->where('status', 'Pending')->count())
                ->description('Started but not confirmed')
                ->color('warning')
                ->url(TransactionResource::getUrl('index', ['filters' => ['status' => ['value' => 'Pending']]])),
            Stat::make('Bank transfers to confirm', BankTransferRequest::where('status', BankTransferRequest::STATUS_NEW)->count())
                ->description('Waiting to be marked paid')
                ->color('primary')
                ->url(BankTransferResource::getUrl('index')),
        ];

        foreach ([Transaction::GATEWAY_SSLCOMMERZ, Transaction::GATEWAY_PAYPAL, Transaction::GATEWAY_BANK] as $gateway) {
            $query = (clone $paidThisMonth)->whereHas('transaction', fn (Builder $q) => $q->gateway($gateway));

            $stats[] = Stat::make("{$gateway} this month", self::bdt((clone $query)->sum('payment_amount')))
                ->description((clone $query)->count().' payments');
        }

        return $stats;
    }

    private static function bdt(float|int|string|null $amount): string
    {
        return 'BDT '.number_format((float) $amount, 2);
    }
}
