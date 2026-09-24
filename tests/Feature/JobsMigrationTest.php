<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class JobsMigrationTest extends TestCase
{
    use RefreshDatabase;

    private function migration(): object
    {
        return require database_path('migrations/2026_03_16_060133_create_jobs_table.php');
    }

    public function test_migrations_create_the_jobs_table_on_a_fresh_database(): void
    {
        $this->assertTrue(Schema::hasTable('jobs'));
    }

    public function test_running_it_again_leaves_an_existing_jobs_table_alone(): void
    {
        DB::table('jobs')->insert(['queue' => 'default', 'payload' => 'keep', 'attempts' => 0, 'available_at' => 1, 'created_at' => 1]);

        $this->migration()->up(); // would throw "table already exists" without the guard

        $this->assertSame(1, DB::table('jobs')->count());
    }

    public function test_rolling_back_never_drops_the_shared_jobs_table(): void
    {
        $this->migration()->down();

        $this->assertTrue(Schema::hasTable('jobs'));
    }
}
