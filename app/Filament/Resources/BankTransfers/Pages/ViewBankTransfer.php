<?php

namespace App\Filament\Resources\BankTransfers\Pages;

use App\Filament\Resources\BankTransfers\BankTransferResource;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Models\BankTransferRequest;
use App\Services\Payment\BankTransferService;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use RuntimeException;

class ViewBankTransfer extends ViewRecord
{
    protected static string $resource = BankTransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('markPaid')
                ->label('Mark paid')
                ->icon(Heroicon::OutlinedCheckBadge)
                ->color('success')
                ->visible(fn (BankTransferRequest $record) => $record->status === BankTransferRequest::STATUS_NEW)
                ->modalHeading('Mark this bank transfer as paid?')
                ->modalDescription(fn (BankTransferRequest $record) => 'Only do this once BDT '.number_format($record->total, 2)
                    .' has arrived in the Dutch-Bangla Bank account. A transaction, invoice and money receipt are created, and the receipt is emailed to '
                    .$record->email.' and the internal addresses. This cannot be undone.')
                ->modalSubmitActionLabel('Mark paid and send receipt')
                ->schema([
                    DatePicker::make('paid_on')
                        ->label('Money received on')
                        ->required()
                        ->default(now())
                        ->maxDate(now())
                        ->native(false),
                    TextInput::make('bank_reference')
                        ->label('Bank reference (optional)')
                        ->maxLength(255)
                        ->rule(Rule::unique('transactions', 'bank_tran_id')),
                ])
                ->action(function (BankTransferRequest $record, array $data) {
                    try {
                        app(BankTransferService::class)->markPaid($record, Carbon::parse($data['paid_on']), $data['bank_reference'] ?? null);
                    } catch (RuntimeException $e) {
                        Notification::make()->danger()->title($e->getMessage())->send();

                        return;
                    }

                    $record->refresh();

                    Notification::make()->success()
                        ->title('Marked paid. Invoice '.$record->invoice_number.' issued and the receipt emailed.')
                        ->send();
                }),
            Action::make('transaction')
                ->label('View transaction')
                ->icon(Heroicon::OutlinedBanknotes)
                ->color('gray')
                ->visible(fn (BankTransferRequest $record) => $record->transaction !== null)
                ->url(fn (BankTransferRequest $record) => TransactionResource::getUrl('view', ['record' => $record->transaction])),
        ];
    }
}
