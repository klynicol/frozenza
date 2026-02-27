<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Affiliate;

class AffiliateSeeder extends Seeder
{
    public function run(): void
    {
        $affiliates = [
            'Amazon' => [
                'name' => 'Amazon',
                'url_base' => 'https://www.amazon.com/dp/',
                'default_commission_rate' => 4.5,
                'default_description' => 'Free delivery with Prime',
            ],
            'Walmart' => [
                'name' => 'Walmart',
                'url_base' => 'https://www.walmart.com/ip/',
                'default_commission_rate' => 3.0,
                'default_description' => 'Pickup or delivery',
            ],
            'Target' => [
                'name' => 'Target',
                'url_base' => 'https://www.target.com/p/',
                'default_commission_rate' => 3.5,
                'default_description' => 'Free shipping on $35+',
            ],
            'Instacart' => [
                'name' => 'Instacart',
                'url_base' => 'https://www.instacart.com/store/items/',
                'default_commission_rate' => 5.0,
                'default_description' => 'Same-day delivery',
            ],
            'Kroger' => [
                'name' => 'Kroger',
                'url_base' => 'https://www.kroger.com/p/',
                'default_commission_rate' => 2.5,
                'default_description' => 'Weekly deals available',
            ],
        ];


        foreach ($affiliates as $affiliate) {
            Affiliate::updateOrCreate([
                'name' => $affiliate['name'],
            ], $affiliate);
        }
    }
}
