<?php

namespace Tests\Feature\Admin;

use App\Filament\Widgets\PaymentOverview;
use App\Models\Admin;
use App\Models\User;
use Filament\Auth\Pages\Login;
use Livewire\Livewire;

class AdminAccessTest extends AdminTestCase
{
    public function test_guests_are_sent_to_the_admin_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/transactions')->assertRedirect('/admin/login');
    }

    public function test_a_signed_in_web_user_is_not_an_admin(): void
    {
        // The `web` guard / `users` table belongs to the portal app; it must never grant access.
        $this->actingAs(new User(['name' => 'Portal admin', 'email' => 'p@example.com']), 'web');

        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_admin_can_sign_in_and_see_the_dashboard(): void
    {
        Livewire::test(Login::class)
            ->fillForm(['email' => 'admin@example.com', 'password' => 'correct-horse-battery'])
            ->call('authenticate')
            ->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($this->admin, 'admin');
        $this->assertGuest('web');

        $this->get('/admin')->assertOk();
    }

    public function test_wrong_password_is_rejected(): void
    {
        Livewire::test(Login::class)
            ->fillForm(['email' => 'admin@example.com', 'password' => 'wrong-password'])
            ->call('authenticate')
            ->assertHasFormErrors(['email']);

        $this->assertGuest('admin');
    }

    public function test_every_admin_page_loads(): void
    {
        $this->signIn();
        $tx = $this->appTransaction();

        $this->get('/admin')->assertOk();
        $this->get('/admin/transactions')->assertOk();
        $this->get("/admin/transactions/{$tx->id}")->assertOk()->assertSee($tx->transaction_id);
        $this->get('/admin/invoices')->assertOk();
        $this->get('/admin/bank-transfers')->assertOk();
    }

    public function test_there_is_no_registration_or_password_reset(): void
    {
        $this->get('/admin/register')->assertNotFound();
        $this->get('/admin/password-reset/request')->assertNotFound();
    }

    public function test_deleting_the_admin_signs_them_out(): void
    {
        $this->signIn();
        $this->get('/admin')->assertOk();

        Admin::query()->delete();
        $this->app['auth']->forgetGuards();

        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_dashboard_totals_count_only_this_apps_confirmed_payments(): void
    {
        $this->signIn();
        $this->invoiceFor($this->appTransaction());                                   // SSLCommerz 300,000
        $this->invoiceFor($this->appTransaction(['gateway_transaction_id' => 'O1'])); // PayPal 300,000
        $this->invoiceFor($this->portalTransaction());                                // portal: not counted
        $this->appTransaction(['status' => 'Pending']);                               // not paid

        Livewire::test(PaymentOverview::class)
            ->assertSee('BDT 600,000.00')
            ->assertSee('2 payments in')
            ->assertDontSee('BDT 605,000.00');
    }
}
