<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Filament\Support\DateRangeFilter;
use App\Models\Transaction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('Date')->dateTime('d M Y, h:i A')->sortable(),
                TextColumn::make('transaction_id')->label('Transaction ID')->searchable()->copyable(),
                TextColumn::make('name')->searchable()->wrap(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('email')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('amount')->label('Amount')->money('BDT', locale: 'en')->sortable(),
                TextColumn::make('gateway')
                    ->state(fn (Transaction $record) => $record->gatewayName())
                    ->badge()
                    ->color(fn (string $state) => self::gatewayColor($state)),
                TextColumn::make('status')->badge()->color(fn (?string $state) => self::statusColor($state)),
                TextColumn::make('invoice_number')->label('Invoice')->searchable()->placeholder('—'),
                TextColumn::make('gateway_transaction_id')->label('PayPal order')->searchable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'Processing' => 'Processing (paid)',
                    'Pending' => 'Pending',
                    'Failed' => 'Failed',
                    'Cancelled' => 'Cancelled',
                ]),
                SelectFilter::make('gateway')
                    ->options([
                        Transaction::GATEWAY_SSLCOMMERZ => Transaction::GATEWAY_SSLCOMMERZ,
                        Transaction::GATEWAY_PAYPAL => Transaction::GATEWAY_PAYPAL,
                        Transaction::GATEWAY_BANK => Transaction::GATEWAY_BANK,
                    ])
                    ->query(fn (Builder $query, array $data) => filled($data['value']) ? $query->gateway($data['value']) : $query),
                DateRangeFilter::make('created_at', 'Date'),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }

    public static function statusColor(?string $status): string
    {
        return match ($status) {
            'Processing', 'Complete', 'VALID' => 'success',
            'Pending' => 'warning',
            'Failed' => 'danger',
            default => 'gray',
        };
    }

    public static function gatewayColor(string $gateway): string
    {
        return match ($gateway) {
            Transaction::GATEWAY_PAYPAL => 'info',
            Transaction::GATEWAY_BANK => 'primary',
            default => 'gray',
        };
    }
}
