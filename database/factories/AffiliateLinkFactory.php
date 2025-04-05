<?php

namespace Database\Factories;

use App\Models\Pizza;
use App\Models\AffiliateLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AffiliateLink>
 */
class AffiliateLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vendors = [
            'Amazon' => ['url' => 'https://www.amazon.com/dp/', 'description' => 'Fast Prime Delivery'],
            'Walmart' => ['url' => 'https://www.walmart.com/ip/', 'description' => 'In-store pickup available'],
            'Target' => ['url' => 'https://www.target.com/p/', 'description' => 'Free shipping on orders over $35'],
            'Kroger' => ['url' => 'https://www.kroger.com/p/', 'description' => 'Grocery delivery'],
            'Instacart' => ['url' => 'https://www.instacart.com/store/items/', 'description' => 'Same-day delivery'],
            'Whole Foods' => ['url' => 'https://products.wholefoodsmarket.com/', 'description' => 'Premium selection'],
        ];
        
        $vendorName = $this->faker->randomElement(array_keys($vendors));
        $vendorInfo = $vendors[$vendorName];
        
        return [
            'pizza_id' => Pizza::factory(),
            'vendor_name' => $vendorName,
            'url' => $vendorInfo['url'] . $this->faker->regexify('[A-Z0-9]{10}'),
            'commission_rate' => $this->faker->randomFloat(2, 1, 10),
            'description' => $vendorInfo['description'],
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'display_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
