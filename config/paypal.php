<?php

// PayPal (REST Orders v2) configuration

$mode = env('PAYPAL_MODE', 'sandbox') === 'live' ? 'live' : 'sandbox';

return [
    'mode' => $mode,
    'client_id' => env('PAYPAL_CLIENT_ID'),
    'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    'base_url' => $mode === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com',

    // PayPal does not support BDT, so the BDT booking total is converted to
    // this currency using the rate below (BDT per 1 unit of `currency`).
    'currency' => env('PAYPAL_CURRENCY', 'USD'),
    'bdt_per_usd' => (float) env('PAYPAL_BDT_PER_USD', 0),
];
