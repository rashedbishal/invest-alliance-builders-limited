<?php

namespace App\Services\Payment;

use RuntimeException;

/**
 * PayPal answered a request with an error. `issue` is PayPal's machine-readable
 * reason (e.g. INSTRUMENT_DECLINED) when the response carried one.
 */
class PayPalApiException extends RuntimeException
{
    public function __construct(string $message, public readonly ?string $issue = null, public readonly int $status = 0)
    {
        parent::__construct($message);
    }
}
