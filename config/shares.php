<?php

// The hotels that exist on the site (the landing page has a section for each).
// Price per share (BDT) and the max shares per booking are NOT here: they are
// edited in the admin CMS (hotel_shares table). The old HOTEL_JANA_* .env keys
// are no longer read.

return [

    // SSLCommerz accepts less than this per transaction (BDT). A booking total
    // equal to or above it can only be paid through PayPal.
    'sslcommerz_limit' => (float) env('SSLCOMMERZ_MAX_AMOUNT', 500000),

    'hotels' => [
        'jana' => [
            'name' => 'Hotel Jana',
            'name_bn' => 'হোটেল জানা',
        ],
        'dove' => [
            'name' => 'Hotel Jana The Dove',
            'name_bn' => 'হোটেল জানা দ্য ডাভ',
        ],
    ],

];
