<?php

namespace App\Services\Payment;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalService
{
    /**
     * Create a PayPal order and return the decoded response.
     */
    public function createOrder(string $reference, string $currency, string $amount, string $returnUrl, string $cancelUrl): array
    {
        $response = $this->client()
            ->withHeaders(['PayPal-Request-Id' => $reference])
            ->post('/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'custom_id' => $reference,
                    'description' => 'Hotel Jana Ownership Booking',
                    'amount' => [
                        'currency_code' => $currency,
                        'value' => $amount,
                    ],
                ]],
                'payment_source' => [
                    'paypal' => [
                        'experience_context' => [
                            'brand_name' => 'Hotel Jana',
                            'user_action' => 'PAY_NOW',
                            'shipping_preference' => 'NO_SHIPPING',
                            'return_url' => $returnUrl,
                            'cancel_url' => $cancelUrl,
                        ],
                    ],
                ],
            ]);

        if ($response->failed()) {
            throw new RuntimeException('PayPal create order failed: '.$response->body());
        }

        return $response->json();
    }

    /**
     * Capture an approved order. The request id makes retries idempotent.
     */
    public function captureOrder(string $orderId, string $reference): array
    {
        $response = $this->client()
            ->withHeaders(['PayPal-Request-Id' => 'capture-'.$reference] + $this->mockHeaders())
            ->withBody('{}', 'application/json')
            ->post("/v2/checkout/orders/{$orderId}/capture");

        if ($response->failed()) {
            $issue = $response->json('details.0.issue') ?? $response->json('name');

            throw new PayPalApiException('PayPal capture failed: '.$response->body(), is_string($issue) ? $issue : null, $response->status());
        }

        return $response->json();
    }

    /**
     * Current state of an order (used by the CMS to re-check a Pending payment).
     */
    public function getOrder(string $orderId): array
    {
        $response = $this->client()->get("/v2/checkout/orders/{$orderId}");

        if ($response->failed()) {
            $issue = $response->json('details.0.issue') ?? $response->json('name');

            throw new PayPalApiException('PayPal get order failed: '.$response->body(), is_string($issue) ? $issue : null, $response->status());
        }

        return $response->json();
    }

    /**
     * URL the customer is sent to in order to approve the payment.
     */
    public function approvalUrl(array $order): ?string
    {
        foreach ($order['links'] ?? [] as $link) {
            if (in_array($link['rel'] ?? null, ['payer-action', 'approve'], true)) {
                return $link['href'];
            }
        }

        return null;
    }

    /**
     * Sandbox-only negative testing. Never sent in live mode, whatever PAYPAL_MOCK_RESPONSE says.
     *
     * @return array<string, string>
     */
    private function mockHeaders(): array
    {
        $code = (string) config('paypal.mock_response');

        if (config('paypal.mode') !== 'sandbox' || ! preg_match('/^[A-Z_]+$/', $code)) {
            return [];
        }

        return ['PayPal-Mock-Response' => json_encode(['mock_application_codes' => $code])];
    }

    private function client(): PendingRequest
    {
        return Http::baseUrl(config('paypal.base_url'))
            ->withToken($this->accessToken())
            ->acceptJson()
            ->timeout(30);
    }

    private function accessToken(): string
    {
        $response = Http::baseUrl(config('paypal.base_url'))
            ->withBasicAuth((string) config('paypal.client_id'), (string) config('paypal.client_secret'))
            ->asForm()
            ->acceptJson()
            ->timeout(30)
            ->post('/v1/oauth2/token', ['grant_type' => 'client_credentials']);

        if ($response->failed() || ! $response->json('access_token')) {
            throw new RuntimeException('PayPal authentication failed: '.$response->body());
        }

        return $response->json('access_token');
    }
}
