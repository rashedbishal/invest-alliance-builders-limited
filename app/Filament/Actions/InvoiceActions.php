<?php

namespace App\Filament\Actions;

use App\Models\Invoice;
use App\Models\Transaction;
use App\Services\Payment\ReceiptService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * Receipt actions shared by the Transactions and Invoices screens.
 * Each works on either a Transaction (via its invoice) or an Invoice record.
 */
class InvoiceActions
{
    /** @return array<Action> */
    public static function all(): array
    {
        return [
            self::download(),
            self::resendEmail(),
            self::revokeLink(),
            self::newLink(),
        ];
    }

    /**
     * Rendered here, behind the admin login, so the CMS doesn't depend on the
     * public `admin-download-invoice` route.
     */
    public static function download(): Action
    {
        return Action::make('downloadReceipt')
            ->label('Download receipt')
            ->icon(Heroicon::OutlinedArrowDownTray)
            ->visible(fn (Model $record) => self::invoice($record) !== null && self::transaction($record) !== null)
            ->action(function (Model $record) {
                $invoice = self::invoice($record);
                $pdf = app(ReceiptService::class)->renderPdf(self::transaction($record), $invoice);
                $name = $invoice->money_receipt_number
                    ? "receipt-{$invoice->money_receipt_number}.pdf"
                    : "invoice-{$invoice->invoice_number}.pdf";

                return response()->streamDownload(fn () => print ($pdf), $name, ['Content-Type' => 'application/pdf']);
            });
    }

    public static function resendEmail(): Action
    {
        return Action::make('resendEmail')
            ->label('Resend email')
            ->icon(Heroicon::OutlinedEnvelope)
            ->visible(fn (Model $record) => self::invoice($record) !== null && self::transaction($record)?->email)
            ->requiresConfirmation()
            ->modalHeading('Resend the receipt email?')
            ->modalDescription(fn (Model $record) => 'The payment confirmation with the receipt PDF will be sent again to '.self::transaction($record)?->email.'.')
            ->action(function (Model $record) {
                try {
                    app(ReceiptService::class)->resendToCustomer(self::transaction($record), self::invoice($record));
                } catch (Throwable $e) {
                    report($e);
                    Notification::make()->danger()->title('The email could not be sent.')->body($e->getMessage())->send();

                    return;
                }

                Notification::make()->success()->title('Receipt email queued to '.self::transaction($record)->email.'.')->send();
            });
    }

    public static function revokeLink(): Action
    {
        return Action::make('revokeLink')
            ->label('Turn off QR link')
            ->icon(Heroicon::OutlinedLinkSlash)
            ->color('danger')
            ->visible(fn (Model $record) => self::invoice($record)?->publicLinkIsActive() ?? false)
            ->requiresConfirmation()
            ->modalHeading('Turn off the public QR link?')
            ->modalDescription('The QR code printed on this receipt (and the link in emails) will stop opening the receipt. You can issue a new link later.')
            ->action(function (Model $record) {
                self::invoice($record)->update(['public_token_revoked_at' => now()]);
                $record->refresh();

                Notification::make()->success()->title('Public QR link turned off.')->send();
            });
    }

    public static function newLink(): Action
    {
        return Action::make('newLink')
            ->label('Issue new QR link')
            ->icon(Heroicon::OutlinedQrCode)
            ->visible(fn (Model $record) => self::invoice($record) !== null)
            ->requiresConfirmation()
            ->modalHeading('Issue a new public QR link?')
            ->modalDescription('A new link is created and the old one stops working, including the QR code on receipts already sent or printed. Download or resend the receipt to get the new QR code.')
            ->action(function (Model $record) {
                self::invoice($record)->update([
                    'public_token' => bin2hex(random_bytes(32)),
                    'public_token_revoked_at' => null,
                    'public_token_expires_at' => null,
                ]);
                $record->refresh();

                Notification::make()->success()->title('New public QR link issued.')->send();
            });
    }

    private static function invoice(Model $record): ?Invoice
    {
        return $record instanceof Invoice ? $record : $record->invoice;
    }

    private static function transaction(Model $record): ?Transaction
    {
        return $record instanceof Transaction ? $record : $record->transaction;
    }
}
