<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['currency.enabled' => true, 'currency.rates_ttl' => 43200]);
        Cache::flush();
    }

    private function fakeApis(string $country = 'US', array $rates = ['BDT' => 1, 'USD' => 0.008, 'GBP' => 0.006]): void
    {
        Http::fake([
            'open.er-api.com/*' => Http::response(['result' => 'success', 'rates' => $rates]),
            'ipwho.is/*' => Http::response(['success' => true, 'country_code' => $country]),
        ]);
    }

    public function test_visitor_gets_the_currency_of_their_country_with_the_bdt_rate(): void
    {
        $this->fakeApis('GB');

        $this->getJson('/currency', ['X-Forwarded-For' => '81.2.69.142'])
            ->assertOk()
            ->assertExactJson(['currency' => 'GBP', 'rate' => 0.006]);
    }

    public function test_bangladesh_local_and_unknown_visitors_see_bdt_only(): void
    {
        $this->fakeApis('BD');
        $this->getJson('/currency', ['X-Forwarded-For' => '103.4.144.10'])->assertExactJson(['currency' => null]);

        // private/local address: never looked up
        Http::fake();
        $this->getJson('/currency', ['X-Forwarded-For' => '127.0.0.1'])->assertExactJson(['currency' => null]);
        Http::assertNothingSent();

        // a country whose currency has no rate
        Cache::flush();
        $this->fakeApis('JP');
        $this->getJson('/currency', ['X-Forwarded-For' => '126.0.0.1'])->assertExactJson(['currency' => null]);
    }

    public function test_cloudflare_country_header_avoids_the_geolocation_call(): void
    {
        $this->fakeApis();

        $this->getJson('/currency', ['CF-IPCountry' => 'GB', 'X-Forwarded-For' => '81.2.69.142'])
            ->assertExactJson(['currency' => 'GBP', 'rate' => 0.006]);

        Http::assertNotSent(fn ($r) => str_contains($r->url(), 'ipwho.is'));
    }

    public function test_results_are_cached_so_apis_are_called_once(): void
    {
        $this->fakeApis();

        $this->getJson('/currency', ['X-Forwarded-For' => '8.8.8.8'])->assertJson(['currency' => 'USD']);
        $this->getJson('/currency', ['X-Forwarded-For' => '8.8.8.8'])->assertJson(['currency' => 'USD']);
        $this->getJson('/currency', ['X-Forwarded-For' => '1.1.1.1'])->assertJson(['currency' => 'USD']);

        Http::assertSentCount(3); // 1 rates + 2 different IPs
    }

    public function test_last_known_rates_are_used_when_the_rate_api_fails(): void
    {
        $this->fakeApis();
        $this->getJson('/currency', ['CF-IPCountry' => 'US'])->assertJson(['currency' => 'USD', 'rate' => 0.008]);

        // rates become stale and the API is down
        Cache::put('currency:rates', ['fetched_at' => time() - 100000, 'rates' => ['USD' => 0.008]], now()->addDay());
        Http::fake(['open.er-api.com/*' => Http::response('down', 500)]);

        $this->getJson('/currency', ['CF-IPCountry' => 'US'])->assertJson(['currency' => 'USD', 'rate' => 0.008]);
    }

    public function test_page_still_works_when_both_apis_fail(): void
    {
        Http::fake(['*' => Http::response('boom', 500)]);

        $this->getJson('/currency', ['X-Forwarded-For' => '8.8.8.8'])->assertOk()->assertExactJson(['currency' => null]);
    }

    public function test_currency_query_previews_a_currency_and_ignores_garbage(): void
    {
        $this->fakeApis();

        $this->getJson('/currency?currency=usd')->assertJson(['currency' => 'USD']);
        $this->getJson('/currency?currency=BDT')->assertExactJson(['currency' => null]);
        $this->getJson('/currency?currency=<script>')->assertExactJson(['currency' => null]);
    }

    public function test_feature_can_be_switched_off(): void
    {
        config(['currency.enabled' => false]);
        Http::fake();

        $this->getJson('/currency?currency=USD')->assertExactJson(['currency' => null]);
        Http::assertNothingSent();
    }

    public function test_form_page_has_the_price_hooks_and_does_not_call_any_api_itself(): void
    {
        Http::fake();
        config(['shares.hotels' => ['jana' => ['name' => 'Hotel Jana', 'name_bn' => 'x', 'price' => 400000, 'max' => 10]]]);

        $this->get('/form')
            ->assertOk()
            ->assertSee('class="money', false)
            ->assertSee('data-bdt="400000"', false)
            ->assertSee('id="totalAmount"', false)
            ->assertSee('id="localNote"', false)
            ->assertSee(route('currency.show'), false);

        Http::assertNothingSent(); // the page renders without waiting on any external service
    }
}
