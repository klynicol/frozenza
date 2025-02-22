<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing application...');

        $this->call('migrate:fresh');
        $this->call('db:seed', ['--class' => 'DatabaseSeeder']);
        $this->call('db:seed', ['--class' => 'LuigesSeeder']);
        $this->call('db:seed', ['--class' => 'AmericanFlatbreadSeeder']);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@frozenza.com',
            'password' => Hash::make(config('kraken.super_admin_password')),
        ]);

        $this->info('Application initialized successfully.');
    }
}
