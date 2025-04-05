<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class OneTimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:one-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Anything';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $role = \App\Models\UserRole::updateOrCreate([
        //     'code' => 'admin',
        //     'name' => 'Administrator',
        //     'description' => 'Administrator role',
        // ]);

        // $user = \App\Models\User::find('a7ddde51-e96d-4d42-83a9-c2598cada218');
        // $this->info($user->id);
        // $user->roles()->attach($role);

        $pizzas = \App\Models\Pizza::select('id', 'name', 'brand_id')->with('brand:id,name')->orderBy('name')->get();
        dd($pizzas[0]->brand);
    }
}
