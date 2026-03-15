<?php

namespace App\Support;

use Illuminate\Contracts\Encryption\DecryptException;

class RouteCrypto
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function encryptParams(string $value): string
    {
        $encrypted = encrypt($value);

        return rtrim(strtr($encrypted, '+/', '-_'), '=');
    }

    public static function decryptParams(string $value): string
    {
        $value = strtr($value, '-_', '+/');
        $pad = strlen($value) % 4;
        if ($pad) {
            $value .= str_repeat('=', 4 - $pad);
        }

        try {
            return decrypt($value);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
}
