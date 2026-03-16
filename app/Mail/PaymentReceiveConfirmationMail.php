<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceiveConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;

    public $invoice_number;

    public $concern;

    public $name;

    public $amount;

    public $tran_date;

    public $method;

    public $money_receipt_number;

    /**
     * Create a new message instance.
     */
    public function __construct($pdf, $invoice_number, $concern, $money_receipt_number, $name, $amount, $tran_date, $method)
    {
        $this->pdf = $pdf;
        $this->invoice_number = $invoice_number;
        $this->concern = $concern == '1' ? 'Opticore Solutions Limited' : 'Hotel Jana';
        $this->money_receipt_number = $money_receipt_number;
        $this->name = $name;
        $this->amount = $amount;
        $this->tran_date = $tran_date;
        $this->method = $method;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if (str_starts_with($this->invoice_number, 'TRX-')) {
            return new Envelope(
                from: new Address('noreply@opticoresolutionsltd.com', $this->concern),
                subject: 'Payment Received for Transaction Id #'.$this->invoice_number,
            );
        } else {
            return new Envelope(
                from: new Address('noreply@opticoresolutionsltd.com', $this->concern),
                subject: 'Payment Received for Invoice #'.$this->invoice_number,
            );
        }
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if (str_starts_with($this->invoice_number, 'TRX-')) {
            return new Content(
                view: 'emails.qr-payment-receive-confirmation',
                with: [
                    'transaction_id' => $this->invoice_number,
                    'concern' => $this->concern,
                    'name' => $this->name,
                    'amount' => $this->amount,
                    'date' => $this->tran_date,
                    'method' => $this->method,
                ],
            );
        } else {
            return new Content(
                view: 'emails.payment-receive-confirmation',
                with: [
                    'invoice_number' => $this->invoice_number,
                    'concern' => $this->concern,
                    'name' => $this->name,
                    'amount' => $this->amount,
                    'date' => $this->tran_date,
                    'method' => $this->method,
                ],
            );
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if (str_starts_with($this->invoice_number, 'TRX-')) {
            return [
                Attachment::fromData(fn () => base64_decode($this->pdf), 'receipt-'.$this->money_receipt_number.'.pdf')
                    ->withMime('application/pdf'),
            ];
        } else {
            return [
                Attachment::fromData(fn () => base64_decode($this->pdf), 'invoice-'.$this->invoice_number.'.pdf')
                    ->withMime('application/pdf'),
            ];
        }

    }
}
