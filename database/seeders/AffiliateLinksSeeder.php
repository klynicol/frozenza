<?php

namespace Database\Seeders;

use App\Models\Pizza;
use App\Models\AffiliateLink;
use Illuminate\Database\Seeder;

class AffiliateLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing pizzas
        $pizzas = Pizza::all();
        
        if ($pizzas->isEmpty()) {
            $this->command->info('No pizzas found. Please run the pizza seeders first.');
            return;
        }
        
        $this->command->info('Creating affiliate links for ' . $pizzas->count() . ' pizzas...');
        
        // Define common vendors
        $vendors = [
            'Amazon' => [
                'url_base' => 'https://www.amazon.com/dp/',
                'description' => 'Free delivery with Prime',
                'commission_rate' => 4.5,
            ],
            'Walmart' => [
                'url_base' => 'https://www.walmart.com/ip/',
                'description' => 'Pickup or delivery',
                'commission_rate' => 3.0,
            ],
            'Target' => [
                'url_base' => 'https://www.target.com/p/',
                'description' => 'Free shipping on $35+',
                'commission_rate' => 3.5,
            ],
            'Instacart' => [
                'url_base' => 'https://www.instacart.com/store/items/',
                'description' => 'Same-day delivery',
                'commission_rate' => 5.0,
            ],
            'Kroger' => [
                'url_base' => 'https://www.kroger.com/p/',
                'description' => 'Weekly deals available',
                'commission_rate' => 2.5,
            ],
        ];
        
        // Clear existing affiliate links
        AffiliateLink::truncate();
        
        // For each pizza, create 2-4 random affiliate links
        foreach ($pizzas as $pizza) {
            // Shuffle vendors to randomize selection
            $shuffledVendors = array_keys($vendors);
            shuffle($shuffledVendors);
            
            // Select 2-4 random vendors
            $vendorCount = rand(2, 4);
            $selectedVendors = array_slice($shuffledVendors, 0, $vendorCount);
            
            foreach ($selectedVendors as $index => $vendorName) {
                $vendor = $vendors[$vendorName];
                
                AffiliateLink::create([
                    'pizza_id' => $pizza->id,
                    'vendor_name' => $vendorName,
                    'url' => $vendor['url_base'] . strtolower(str_replace(' ', '-', $pizza->name)) . '-' . substr(md5($pizza->id . $vendorName), 0, 8),
                    'commission_rate' => $vendor['commission_rate'],
                    'description' => $vendor['description'],
                    'is_active' => true,
                    'display_order' => $index,
                ]);
            }
        }
        
        $this->command->info('Created ' . AffiliateLink::count() . ' affiliate links.');
    }
}
