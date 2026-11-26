<?php

namespace App\Filament\Resources\Invoices;

use App\Filament\Actions\InvoiceActions;
use App\Filament\Resources\Invoices\Pages\ListInvoices;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Filament\Support\DateRangeFilter;
use App\Models\Invoice;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Read-only list of this app's invoices/receipts. There is no record page:
 * Invoice's route key is the encrypted invoice number (RouteCrypto), so
 * everything here is done with table actions instead.
 */
class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Invoices & receipts';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->fromThisApp()->with('transaction');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('payment_date')->label('Paid on')->date('d M Y')->sortable(),
                TextColumn::make('invoice_number')->label('Invoice')->searchable()->copyable(),
                TextColumn::make('money_receipt_number')->label('Money receipt')->searchable()->placeholder('—'),
                TextColumn::make('transaction.name')->label('Customer')->searchable()->wrap(),
                TextColumn::make('transaction.phone')->label('Phone')->searchable(),
                TextColumn::make('payment_amount')->label('Amount')->money('BDT', locale: 'en')->sortable(),
                TextColumn::make('remarks')->label('Method')->placeholder('—'),
                TextColumn::make('qr_link')
                    ->label('QR link')
                    ->state(fn (Invoice $record) => $record->publicLinkIsActive() ? 'Active' : 'Off')
                    ->badge()
                    ->color(fn (string $state) => $state === 'Active' ? 'success' : 'danger'),
            ])
            ->filters([
                DateRangeFilter::make('payment_date', 'Paid'),
            ])
            ->recordActions([
                InvoiceActions::download(),
                ActionGroup::make([
                    Action::make('transaction')
                        ->label('View transaction')
                        ->icon(Heroicon::OutlinedBanknotes)
                        ->visible(fn (Invoice $record) => $record->transaction !== null)
                        ->url(fn (Invoice $record) => TransactionResource::getUrl('view', ['record' => $record->transaction])),
                    InvoiceActions::resendEmail(),
                    InvoiceActions::revokeLink(),
                    InvoiceActions::newLink(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInvoices::route('/'),
        ];
    }
}
