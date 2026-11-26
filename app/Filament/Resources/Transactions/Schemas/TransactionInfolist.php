<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Filament\Resources\Transactions\Tables\TransactionsTable;
use App\Models\Transaction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            Section::make('Customer')->columns(2)->schema([
                TextEntry::make('name'),
                TextEntry::make('phone'),
                TextEntry::make('email')->placeholder('—'),
                TextEntry::make('address')->placeholder('—'),
            ]),

            Section::make('Payment')->columns(2)->schema([
                TextEntry::make('transaction_id')->label('Transaction ID')->copyable(),
                TextEntry::make('gateway')
                    ->state(fn (Transaction $record) => $record->gatewayName())
                    ->badge()
                    ->color(fn (string $state) => TransactionsTable::gatewayColor($state)),
                TextEntry::make('status')->badge()->color(fn (?string $state) => TransactionsTable::statusColor($state)),
                TextEntry::make('amount')->money('BDT', locale: 'en'),
                TextEntry::make('currency_amount')
                    ->label('Charged by PayPal')
                    ->state(fn (Transaction $record) => $record->currency_amount !== null
                        ? number_format((float) $record->currency_amount, 2).' '.$record->currency_type
                        : null)
                    ->visible(fn (Transaction $record) => $record->gatewayName() === Transaction::GATEWAY_PAYPAL),
                TextEntry::make('currency_rate')
                    ->label('Rate (BDT per unit)')
                    ->visible(fn (Transaction $record) => $record->gatewayName() === Transaction::GATEWAY_PAYPAL),
                TextEntry::make('store_amount')->label('Net received')->money('BDT', locale: 'en')->placeholder('—'),
                TextEntry::make('card_type')->label('Method')->placeholder('—'),
                TextEntry::make('card_no')->label('Card / account')->placeholder('—'),
                TextEntry::make('gateway_transaction_id')->label('PayPal order ID')->placeholder('—')->copyable()
                    ->visible(fn (Transaction $record) => $record->gatewayName() === Transaction::GATEWAY_PAYPAL),
                TextEntry::make('val_id')->label('Validation / capture ID')->placeholder('—'),
                TextEntry::make('bank_tran_id')->label('Bank transaction ID')->placeholder('—'),
                TextEntry::make('tran_date')->label('Gateway date')->placeholder('—'),
                TextEntry::make('error')->placeholder('—')->color('danger'),
                TextEntry::make('created_at')->label('Started')->dateTime('d M Y, h:i A'),
                TextEntry::make('updated_at')->label('Last updated')->dateTime('d M Y, h:i A'),
            ]),

            Section::make('Shares')->columnSpanFull()->schema([
                RepeatableEntry::make('shares')->hiddenLabel()->columns(4)->schema([
                    TextEntry::make('hotel_name')->label('Hotel'),
                    TextEntry::make('unit_price')->money('BDT', locale: 'en'),
                    TextEntry::make('quantity'),
                    TextEntry::make('subtotal')->money('BDT', locale: 'en'),
                ]),
            ]),

            Section::make('Invoice & receipt')->columns(2)->columnSpanFull()
                ->visible(fn (Transaction $record) => $record->invoice !== null)
                ->schema([
                    TextEntry::make('invoice.invoice_number')->label('Invoice number'),
                    TextEntry::make('invoice.money_receipt_number')->label('Money receipt number')->placeholder('—'),
                    TextEntry::make('invoice.payment_date')->label('Payment date')->date('d M Y')->placeholder('—'),
                    TextEntry::make('invoice.remarks')->label('Remarks')->placeholder('—'),
                    TextEntry::make('qr_link')
                        ->label('Public QR link')
                        ->state(fn (Transaction $record) => $record->invoice?->publicLinkIsActive() ? 'Active' : 'Turned off')
                        ->badge()
                        ->color(fn (string $state) => $state === 'Active' ? 'success' : 'danger'),
                ]),
        ]);
    }
}
