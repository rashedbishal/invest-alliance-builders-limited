<?php

namespace Tests\Feature;

use App\Mail\PaymentConfirmationMail;
use App\Mail\PaymentReceiveConfirmationMail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PaymentEmailLinksTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => 'https://invest.example.org']);
        URL::forceRootUrl('https://invest.example.org');
        URL::forceScheme('https'); // like the queue worker, which builds URLs from APP_URL
    }

    public static function mails(): array
    {
        return [
            'customer receipt' => [fn () => new PaymentConfirmationMail(base64_encode('pdf'), 'INV-1', 2, 'MR-1')],
            'internal notice' => [fn () => new PaymentReceiveConfirmationMail(base64_encode('pdf'), 'INV-1', 2, 'MR-1', 'Customer', 1000, '2026-11-26', 'SSLCommerz')],
        ];
    }

    /** @dataProvider mails */
    public function test_logo_and_link_use_the_site_url_and_an_existing_image(callable $make): void
    {
        $html = $make()->render();

        $this->assertStringNotContainsString('localhost', $html);
        $this->assertStringContainsString('href="https://invest.example.org"', $html);
        $this->assertStringContainsString('src="https://invest.example.org/images/jana-back.png"', $html);
        $this->assertFileExists(public_path('images/jana-back.png'));
        $this->assertFileExists(public_path('images/opticore.png'));
    }
}
