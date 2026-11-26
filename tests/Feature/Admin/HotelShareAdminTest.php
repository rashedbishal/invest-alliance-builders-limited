<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\HotelShares\HotelShareResource;
use App\Filament\Resources\HotelShares\Pages\ListHotelShares;
use App\Models\HotelShare;
use App\Models\HotelShareChange;
use App\Services\Booking\ShareCatalog;
use Filament\Actions\Testing\TestAction;
use Livewire\Livewire;

class HotelShareAdminTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // The test setup's own price writes are logged as "System"; start each test clean.
        HotelShareChange::query()->delete();
    }

    public function test_changes_made_outside_the_cms_are_logged_as_system(): void
    {
        HotelShare::where('key', 'jana')->sole()->update(['price' => 310000]);

        $this->assertSame('System', HotelShareChange::sole()->changed_by);
    }

    public function test_migration_creates_both_hotels_without_prices(): void
    {
        HotelShare::query()->update(['price' => null, 'max_per_booking' => null]); // undo the test setup

        $this->assertSame(['dove', 'jana'], HotelShare::orderBy('key')->pluck('key')->all());
        $this->assertSame([], (new ShareCatalog)->hotels());
        $this->assertSame('2', HotelShareResource::getNavigationBadge());
    }

    public function test_admin_sets_price_and_max_and_customers_see_it(): void
    {
        $this->signIn();
        $jana = HotelShare::where('key', 'jana')->sole();

        Livewire::test(ListHotelShares::class)
            ->assertCanSeeTableRecords(HotelShare::all())
            ->callAction(TestAction::make('edit')->table($jana), data: [
                'price' => 425000,
                'max_per_booking' => 11240,
                'is_active' => true,
            ])
            ->assertHasNoFormErrors();

        $jana->refresh();
        $this->assertEquals(425000, $jana->price);
        $this->assertSame(11240, $jana->max_per_booking);
        $this->assertEquals(425000, (new ShareCatalog)->hotels()['jana']['price']);

        $this->get('/')->assertSee('data-bdt="425000"', false);
    }

    public function test_every_change_is_logged_with_old_and_new_values(): void
    {
        $this->signIn();
        $jana = HotelShare::where('key', 'jana')->sole(); // 300000 / 10 from the test setup

        Livewire::test(ListHotelShares::class)
            ->callAction(TestAction::make('edit')->table($jana), data: ['price' => 350000, 'max_per_booking' => 10, 'is_active' => false]);

        $log = $jana->history()->sole();
        $this->assertSame('Admin <admin@example.com>', $log->changed_by);
        $this->assertEquals(['old' => 300000, 'new' => 350000], $log->diff['price']);
        $this->assertSame(['old' => true, 'new' => false], $log->diff['is_active']);
        $this->assertArrayNotHasKey('max_per_booking', $log->diff); // unchanged fields are not logged

        $this->assertSame(
            ['Price: BDT 300,000.00 → BDT 350,000.00', 'On sale: yes → no'],
            HotelShareResource::describeChanges($log->diff),
        );

        Livewire::test(ListHotelShares::class)
            ->mountAction(TestAction::make('history')->table($jana))
            ->assertMountedActionModalSee(['Hotel Jana: change history', 'Admin <admin@example.com>', 'Price: BDT 300,000.00 → BDT 350,000.00', 'On sale: yes → no']);
    }

    public function test_saving_without_changes_logs_nothing(): void
    {
        $this->signIn();
        $jana = HotelShare::where('key', 'jana')->sole();

        Livewire::test(ListHotelShares::class)
            ->callAction(TestAction::make('edit')->table($jana), data: ['price' => 300000, 'max_per_booking' => 10, 'is_active' => true]);

        $this->assertSame(0, $jana->history()->count());
    }

    public function test_switching_a_hotel_off_removes_it_from_booking(): void
    {
        $this->signIn();
        $dove = HotelShare::where('key', 'dove')->sole();

        Livewire::test(ListHotelShares::class)
            ->callAction(TestAction::make('edit')->table($dove), data: ['price' => 40000, 'max_per_booking' => 5, 'is_active' => false]);

        $this->assertArrayNotHasKey('dove', (new ShareCatalog)->hotels());
        $this->assertSame('1', HotelShareResource::getNavigationBadge());
    }

    public function test_price_and_max_must_be_positive(): void
    {
        $this->signIn();
        $jana = HotelShare::where('key', 'jana')->sole();

        Livewire::test(ListHotelShares::class)
            ->callAction(TestAction::make('edit')->table($jana), data: ['price' => 0, 'max_per_booking' => 1.5, 'is_active' => true])
            ->assertHasFormErrors(['price', 'max_per_booking']);

        Livewire::test(ListHotelShares::class)
            ->callAction(TestAction::make('edit')->table($jana), data: ['price' => null, 'max_per_booking' => null, 'is_active' => true])
            ->assertHasFormErrors(['price' => 'required', 'max_per_booking' => 'required']);

        $this->assertEquals(300000, $jana->fresh()->price);
    }

    public function test_hotels_cannot_be_created_or_deleted(): void
    {
        $this->signIn();

        $this->assertFalse(HotelShareResource::canCreate());
        $this->assertFalse(HotelShareResource::canDelete(HotelShare::first()));
        $this->get('/admin/hotel-shares')->assertOk()->assertSee('Hotel Jana The Dove');
    }
}
