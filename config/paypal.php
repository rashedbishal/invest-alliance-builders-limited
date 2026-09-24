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
    // "auto" uses the daily exchange rate (the same feed as the price display), falling back to
    // bdt_per_usd below if it is unavailable or looks wrong; "fixed" always uses bdt_per_usd.
    'rate_source' => env('PAYPAL_RATE_SOURCE', 'auto'),
    'bdt_per_usd' => (float) env('PAYPAL_BDT_PER_USD', 0),

    // Extra percentage added to the amount charged on PayPal, e.g. 2 = charge 2% more, to cover
    // the loss when the received USD is converted back to BDT. 0 = none.
    'rate_margin_percent' => (float) env('PAYPAL_RATE_MARGIN_PERCENT', 0),

    // Sandbox testing only: makes the capture call fail on purpose, e.g. INSTRUMENT_DECLINED
    // (see PayPal's "negative testing" mock_application_codes). Ignored unless mode is sandbox.
    'mock_response' => env('PAYPAL_MOCK_RESPONSE'),
];
