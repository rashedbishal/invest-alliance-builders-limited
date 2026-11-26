<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class IpnLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_ipn_hit_is_logged(): void
    {
        Log::spy();

        $this->post('/ipn', ['tran_id' => '', 'status' => 'VALID', 'card_no' => '4111XXXXXXXX1111'])
            ->assertStatus(400)
            ->assertSee('INVALID DATA');

        Log::shouldHaveReceived('info')->once()->withArgs(fn ($message, $context) => $message === 'IPN HIT!'
            && $context['status'] === 'VALID'
            && array_key_exists('ip', $context)
            && ! array_key_exists('card_no', $context));
    }
}
