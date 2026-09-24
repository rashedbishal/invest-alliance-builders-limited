<?php

// Bookable hotel shares. Prices are in BDT; `max` is the most shares one
// booking may contain for that hotel. Values come from .env.

return [

    // SSLCommerz accepts less than this per transaction (BDT). A booking total
    // equal to or above it can only be paid through PayPal.
    'sslcommerz_limit' => (float) env('SSLCOMMERZ_MAX_AMOUNT', 500000),

    'hotels' => [
        'jana' => [
            'name' => 'Hotel Jana',
            'name_bn' => 'হোটেল জানা',
            'price' => (float) env('HOTEL_JANA_PRICE', 0),
            'max' => (int) env('HOTEL_JANA_MAX_COUNT', 0),
        ],
        'dove' => [
            'name' => 'Hotel Jana The Dove',
            'name_bn' => 'হোটেল জানা দ্য ডোভ',
            'price' => (float) env('HOTEL_JANA_THE_DOVE_PRICE', 0),
            'max' => (int) env('HOTEL_JANA_THE_DOVE_MAX_COUNT', 0),
        ],
    ],

];
