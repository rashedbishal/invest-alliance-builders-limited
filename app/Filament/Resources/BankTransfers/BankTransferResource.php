<?php

namespace App\Filament\Resources\BankTransfers;

use App\Filament\Resources\BankTransfers\Pages\ListBankTransfers;
use App\Filament\Resources\BankTransfers\Pages\ViewBankTransfer;
use App\Filament\Support\DateRangeFilter;
use App\Models\BankTransferRequest;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class BankTransferResource extends Resource
{
    protected static ?string $model = BankTransferRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static ?string $navigationLabel = 'Bank transfers';

    protected static ?string $modelLabel = 'bank transfer';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        $count = BankTransferRequest::where('status', BankTransferRequest::STATUS_NEW)->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Waiting to be marked paid';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->label('Booked')->dateTime('d M Y, h:i A')->sortable(),
                TextColumn::make('name')->searchable()->wrap(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('email')->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total')->money('BDT', locale: 'en')->sortable(),
                TextColumn::make('status')->badge()->color(fn (string $state) => self::statusColor($state)),
                TextColumn::make('invoice_number')->label('Invoice')->searchable()->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    BankTransferRequest::STATUS_NEW => 'New (awaiting payment)',
                    BankTransferRequest::STATUS_PAID => 'Paid',
                    BankTransferRequest::STATUS_CANCELLED => 'Cancelled',
                ]),
                DateRangeFilter::make('created_at', 'Booked'),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            Section::make('Customer')->columns(2)->schema([
                TextEntry::make('name'),
                TextEntry::make('phone'),
                TextEntry::make('email'),
                TextEntry::make('address')->state(fn (BankTransferRequest $record) => $record->address()),
            ]),
            Section::make('Status')->columns(2)->schema([
                TextEntry::make('status')->badge()->color(fn (string $state) => self::statusColor($state)),
                TextEntry::make('total')->money('BDT', locale: 'en'),
                TextEntry::make('created_at')->label('Booked')->dateTime('d M Y, h:i A'),
                TextEntry::make('paid_on')->label('Money received on')->date('d M Y')->placeholder('—'),
                TextEntry::make('bank_reference')->label('Bank reference')->placeholder('—'),
                TextEntry::make('transaction_id')->label('Transaction ID')->placeholder('—'),
                TextEntry::make('invoice_number')->label('Invoice')->placeholder('—'),
                TextEntry::make('invoice.money_receipt_number')->label('Money receipt')->placeholder('—'),
                TextEntry::make('cancelled_at')->label('Cancelled')->dateTime('d M Y, h:i A')
                    ->visible(fn (BankTransferRequest $record) => $record->cancelled_at !== null),
            ]),
            Section::make('Shares')->columnSpanFull()->schema([
                RepeatableEntry::make('lines')->hiddenLabel()->columns(4)->schema([
                    TextEntry::make('hotel_name')->label('Hotel'),
                    TextEntry::make('unit_price')->money('BDT', locale: 'en'),
                    TextEntry::make('quantity'),
                    TextEntry::make('subtotal')->money('BDT', locale: 'en'),
                ]),
            ]),
        ]);
    }

    public static function statusColor(string $status): string
    {
        return match ($status) {
            BankTransferRequest::STATUS_PAID => 'success',
            BankTransferRequest::STATUS_CANCELLED => 'gray',
            default => 'warning',
        };
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
            'index' => ListBankTransfers::route('/'),
            'view' => ViewBankTransfer::route('/{record}'),
        ];
    }
}
