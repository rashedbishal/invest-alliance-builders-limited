<?php

// PayPal (REST Orders v2) configuration

$mode = env('PAYPAL_MODE', 'sandbox') === 'live' ? 'live' : 'sandbox';

return [
    'mode' => $mode,
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    'base_url' => $mode === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com',

    // Amount actually charged on PayPal (PayPal does not support BDT).
    'currency' => env('PAYPAL_CURRENCY', 'USD'),
    'amount' => env('PAYPAL_AMOUNT'),

    // Price of the booking in BDT. This is what the invoice and receipt show.
    'bdt_amount' => 300000,
];
