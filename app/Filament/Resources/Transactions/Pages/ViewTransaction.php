<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Actions\InvoiceActions;
use App\Filament\Resources\Transactions\TransactionResource;
use App\Models\Transaction;
use App\Services\Payment\PayPalCaptureProcessor;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->verifyWithPayPal(),
            InvoiceActions::download(),
            ActionGroup::make([
                InvoiceActions::resendEmail(),
                InvoiceActions::revokeLink(),
                InvoiceActions::newLink(),
            ])->label('Receipt')->button()->icon(Heroicon::OutlinedEllipsisVertical),
        ];
    }

    /**
     * Ask PayPal for the real state of a payment that is still Pending. The admin
     * can't set the status by hand; only PayPal's answer changes it.
     */
    private function verifyWithPayPal(): Action
    {
        return Action::make('verifyWithPayPal')
            ->label('Verify with PayPal')
            ->icon(Heroicon::OutlinedArrowPath)
            ->color('warning')
            ->visible(fn (Transaction $record) => $record->gatewayName() === Transaction::GATEWAY_PAYPAL && $record->status === 'Pending')
            ->requiresConfirmation()
            ->modalHeading('Verify this payment with PayPal?')
            ->modalDescription('PayPal is asked for the real status. If the customer approved it, it is captured now and the receipt is issued and emailed. If PayPal declined it, it is marked Failed. Otherwise nothing changes.')
            ->action(function (Transaction $record) {
                $result = app(PayPalCaptureProcessor::class)->verify($record);
                $record->refresh();

                [$type, $title, $body] = match ($result['outcome']) {
                    'paid' => ['success', 'Payment confirmed by PayPal.', 'Invoice '.$result['invoice']->invoice_number.' issued and the receipt emailed.'],
                    'already' => ['info', 'Already recorded as paid.', null],
                    'declined' => ['warning', 'PayPal declined this payment.', 'It has been marked Failed. The customer was not charged.'],
                    'pending' => ['warning', 'PayPal is still reviewing this payment.', 'Nothing changed. Try again later.'],
                    'not_approved' => ['info', 'The customer never approved this payment on PayPal.', 'Nothing was charged. Nothing changed.'],
                    'not_found' => ['warning', 'PayPal has no record of this order.', 'It may have expired. Nothing changed.'],
                    'invalid' => ['danger', 'This payment is no longer Pending.', null],
                    default => ['danger', 'Could not get a clear answer from PayPal.', 'Nothing changed. Details are in the application log.'],
                };

                Notification::make()->{$type}()->title($title)->body($body)->persistent()->send();
            });
    }
}
