<?php

// Display-only price conversion: the visitor's country (from their IP) picks a
// currency and BDT prices are shown converted next to the BDT amount. Payments
// are never affected.

$apiKey = env('EXCHANGERATE_API_KEY');

return [

    // Set CURRENCY_CONVERSION=false to switch the feature off completely.
    'enabled' => (bool) env('CURRENCY_CONVERSION', true),

    'base' => 'BDT',

    // exchangerate-api.com: with a key the v6 endpoint, without one the free open endpoint
    // (updated once a day, no key needed).
    'rates_url' => $apiKey
        ? 'https://v6.exchangerate-api.com/v6/'.$apiKey.'/latest/BDT'
        : 'https://open.er-api.com/v6/latest/BDT',
    'rates_ttl' => 12 * 60 * 60, // seconds a fetched rate is considered fresh

    // Returns the visitor's country_code. {ip} is replaced with the (url-encoded) address.
    'geo_url' => 'https://ipwho.is/{ip}?fields=success,country_code',

    'timeout' => 4, // seconds for each outgoing API call

];
