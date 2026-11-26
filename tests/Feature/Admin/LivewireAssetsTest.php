<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

/**
 * Hostinger serves every *.js URL as a static file and never passes it to
 * Laravel, so Livewire's route-served script 404s in production and the admin
 * login silently reloads. The script must therefore be published to
 * public/vendor/livewire (and committed) and kept in step with the package.
 */
class LivewireAssetsTest extends TestCase
{
    public function test_livewire_script_is_published_and_up_to_date(): void
    {
        $published = public_path('vendor/livewire/manifest.json');

        $this->assertFileExists($published, 'Run: php artisan vendor:publish --tag=livewire:assets --force');
        $this->assertFileExists(public_path('vendor/livewire/livewire.min.js'));
        $this->assertJsonFileEqualsJsonFile(
            base_path('vendor/livewire/livewire/dist/manifest.json'),
            $published,
            'Published Livewire assets are out of date. Run: php artisan vendor:publish --tag=livewire:assets --force',
        );
    }

    public function test_admin_login_loads_livewire_from_a_static_file(): void
    {
        config(['app.debug' => false]);

        $html = $this->get('/admin/login')
            ->assertOk()
            ->assertSee(url('vendor/livewire/livewire.min.js'), false)
            ->getContent();

        // Not the route-served script (/livewire-<hash>/livewire.min.js), which Hostinger 404s.
        $this->assertDoesNotMatchRegularExpression('#/livewire-[a-f0-9]+/livewire(\.min)?\.js#', $html);
    }
}
