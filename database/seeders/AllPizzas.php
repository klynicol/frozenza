<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllPizzas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AmericanFlatbreadSeeder::class,
            BellatoriaSeeder::class,
            BrewPubSeeder::class,
            ConniesSeeder::class,
            DogtownSeeder::class,
            HeggiesSeeder::class,
            LuigesSeeder::class,
            PepsSeeder::class,
            PizzaCornerSeeder::class,
            PortaSeeder::class,
        ]);
    }
}
