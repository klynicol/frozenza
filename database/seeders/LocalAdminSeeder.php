<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class LocalAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        /**
         * This seeder is used to create a local admin user for testing purposes
         */
        $user = User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Local Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->roles()->attach(UserRole::where('code', 'admin')->first());
    }
}
