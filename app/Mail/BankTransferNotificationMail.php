<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BankTransferNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<int, array{hotel: string, hotel_name: string, unit_price: float, quantity: int, subtotal: float}>  $lines
     */
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
        public string $addressLine1,
        public ?string $addressLine2,
        public array $lines,
        public float $total,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bank Transfer Enquiry (Dutch-Bangla Bank) — '.$this->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bank-transfer-notification',
            with: [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'addressLine1' => $this->addressLine1,
                'addressLine2' => $this->addressLine2,
                'lines' => $this->lines,
                'total' => $this->total,
            ],
        );
    }
}
