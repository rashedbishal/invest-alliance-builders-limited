<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

/**
 * There is exactly one CMS admin. Running this deletes whoever it was and
 * creates the new one, which also signs the old admin out everywhere.
 */
class ReplaceCmsAdmin extends Command
{
    protected $signature = 'cms:admin
        {--name= : Admin name}
        {--email= : Admin email (used to sign in)}
        {--force : Replace the existing admin without asking}';

    protected $description = 'Create the one and only /admin CMS account, replacing any existing one';

    public function handle(): int
    {
        $existing = Admin::first();

        if ($existing && ! $this->option('force') && ! confirm(
            "This deletes the current admin ({$existing->email}) and signs them out. Continue?",
            default: false,
        )) {
            $this->warn('Nothing changed.');

            return self::FAILURE;
        }

        $data = [
            'name' => $this->option('name') ?? text('Name', required: true),
            'email' => $this->option('email') ?? text('Email', required: true),
            'password' => password('Password (min. 12 characters)', required: true),
        ];
        $data['password_confirmation'] = password('Confirm password', required: true);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        DB::transaction(function () use ($data) {
            Admin::query()->delete();

            Admin::create([
                'name' => $data['name'],
                'email' => strtolower($data['email']),
                'password' => $data['password'],
            ]);
        });

        $this->info("Admin {$data['email']} can now sign in at ".url('/admin').'.');

        return self::SUCCESS;
    }
}
