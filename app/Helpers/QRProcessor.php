<?php

namespace App\Helpers;

use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class QRProcessor
{
    public static function generate(string $url)
    {
        $renderer = new GDLibRenderer(150);

        $writer = new Writer($renderer);

        // Binary PNG
        $pngBinary = $writer->writeString($url);

        // Data URI for <img>
        return 'data:image/png;base64,'.base64_encode($pngBinary);
    }
}
