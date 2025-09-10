<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class PizzaAmbassadorRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create pizza-ambassador role if it doesn't exist
        UserRole::firstOrCreate(
            ['code' => 'pizza-ambassador'],
            [
                'name' => 'Pizza Ambassador',
                'description' => 'Users who can submit new brands and pizzas to the database',
            ]
        );

        $this->command->info('Pizza Ambassador role created successfully!');
    }
}
