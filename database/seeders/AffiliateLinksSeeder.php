<?php

namespace Database\Seeders;

use App\Models\Affiliate;
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
        $pizzas = Pizza::all();

        if ($pizzas->isEmpty()) {
            $this->command->info('No pizzas found. Please run the pizza seeders first.');
            return;
        }

        $affiliates = Affiliate::all();
        $this->command->info('Creating affiliate links for ' . $pizzas->count() . ' pizzas...');

        AffiliateLink::truncate();

        foreach ($pizzas as $pizza) {
            $count = min(4, max(2, $affiliates->count()));
            $selected = $affiliates->random($count);

            foreach ($selected->values() as $index => $affiliate) {
                $url = $affiliate->url_base
                    ? $affiliate->url_base . strtolower(str_replace(' ', '-', $pizza->name)) . '-' . substr(md5($pizza->id . $affiliate->id), 0, 8)
                    : 'https://example.com/pizza/' . $pizza->slug;

                AffiliateLink::create([
                    'pizza_id' => $pizza->id,
                    'affiliate_id' => $affiliate->id,
                    'url' => $url,
                    'commission_rate' => $affiliate->default_commission_rate,
                    'description' => $affiliate->default_description,
                    'is_active' => true,
                    'display_order' => $index,
                ]);
            }
        }

        $this->command->info('Created ' . AffiliateLink::count() . ' affiliate links.');
    }
}
