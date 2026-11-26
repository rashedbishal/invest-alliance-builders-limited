<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class CmsAdminCommandTest extends AdminTestCase
{
    public function test_it_replaces_the_existing_admin_with_a_new_one(): void
    {
        $this->artisan('cms:admin', ['--name' => 'New Admin', '--email' => 'New@Example.com'])
            ->expectsConfirmation('This deletes the current admin (admin@example.com) and signs them out. Continue?', 'yes')
            ->expectsQuestion('Password (min. 12 characters)', 'a-long-enough-password')
            ->expectsQuestion('Confirm password', 'a-long-enough-password')
            ->assertSuccessful();

        $this->assertSame(1, Admin::count());
        $admin = Admin::sole();
        $this->assertSame('new@example.com', $admin->email);
        $this->assertTrue(Hash::check('a-long-enough-password', $admin->password));
    }

    public function test_it_creates_the_first_admin_without_asking_to_replace(): void
    {
        Admin::query()->delete();

        $this->artisan('cms:admin')
            ->expectsQuestion('Name', 'First')
            ->expectsQuestion('Email', 'first@example.com')
            ->expectsQuestion('Password (min. 12 characters)', 'a-long-enough-password')
            ->expectsQuestion('Confirm password', 'a-long-enough-password')
            ->assertSuccessful();

        $this->assertSame('first@example.com', Admin::sole()->email);
    }

    public function test_declining_keeps_the_current_admin(): void
    {
        $this->artisan('cms:admin', ['--name' => 'X', '--email' => 'x@example.com'])
            ->expectsConfirmation('This deletes the current admin (admin@example.com) and signs them out. Continue?', 'no')
            ->assertFailed();

        $this->assertSame('admin@example.com', Admin::sole()->email);
    }

    public function test_invalid_input_keeps_the_current_admin(): void
    {
        $this->artisan('cms:admin', ['--name' => 'X', '--email' => 'not-an-email', '--force' => true])
            ->expectsQuestion('Password (min. 12 characters)', 'short')
            ->expectsQuestion('Confirm password', 'different')
            ->assertFailed();

        $this->assertSame('admin@example.com', Admin::sole()->email);
    }
}
