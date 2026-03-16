<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;

    public $invoice_number;

    public $concern;

    public $money_receipt_number;

    /**
     * Create a new message instance.
     */
    public function __construct($pdf, $invoice_number, $concern_id, $money_receipt_number)
    {
        $this->pdf = $pdf;
        $this->invoice_number = $invoice_number;
        $this->concern = $concern_id == '1' ? 'Opticore Solutions Limited' : 'Hotel Jana';
        $this->money_receipt_number = $money_receipt_number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@opticoresolutionsltd.com', $this->concern),
            subject: 'Confirmation of Payment for Invoice #'.$this->invoice_number,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-confirmation',
            with: [
                'invoice_number' => $this->invoice_number,
                'concern' => $this->concern,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => base64_decode($this->pdf), 'receipt-'.$this->money_receipt_number.'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
