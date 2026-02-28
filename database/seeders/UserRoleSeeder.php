<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::updateOrCreate([
            'code' => 'admin',
        ], [
            'name' => 'Administrator',
            'description' => 'Administrator role',
        ]);

        UserRole::updateOrCreate([
            'code' => 'pizza-ambassador'
        ], [
            'name' => 'Pizza Ambassador',
            'description' => 'Users who can submit new brands and pizzas to the database',
        ]);
    }
}
