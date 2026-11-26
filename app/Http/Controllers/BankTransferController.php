<?php

namespace App\Http\Controllers;

use App\Mail\BankTransferNotificationMail;
use App\Services\Booking\ShareCatalog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

class BankTransferController extends Controller
{
    public function __construct(private ShareCatalog $catalog) {}

    /**
     * A customer choosing Dutch-Bangla Bank transfer pays manually and calls in for
     * their money receipt, so there's no payment to process here — just an internal
     * heads-up email with their details and the order they intend to pay for.
     */
    public function notify(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:50'],
            'address_1' => ['required', 'string', 'min:3', 'max:150'],
            'address_2' => ['nullable', 'string', 'max:100'],
            'shares' => ['required', 'array'],
            'terms_accepted' => ['accepted'],
        ], [
            'terms_accepted.accepted' => 'Please read and agree to the Terms & Conditions, Privacy Policy and Return & Refund Policy.',
        ]);

        try {
            $quote = $this->catalog->quote($data['shares']);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        Mail::to(config('mail.from.address'))->queue(new BankTransferNotificationMail(
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['address_1'],
            $data['address_2'] ?? null,
            $quote['lines'],
            $quote['total'],
        ));

        return response()->json(['ok' => true]);
    }
}
