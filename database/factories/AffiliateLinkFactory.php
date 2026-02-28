<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\AffiliateLink;
use App\Models\Pizza;
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
        $affiliate = Affiliate::query()->inRandomOrder()->first() ?? Affiliate::factory()->create();

        return [
            'pizza_id' => Pizza::factory(),
            'affiliate_id' => $affiliate->id,
            'url' => ($affiliate->url_base ?? 'https://example.com/') . $this->faker->regexify('[A-Z0-9]{10}'),
            'commission_rate' => $this->faker->randomFloat(2, 1, 10),
            'description' => $affiliate->default_description ?? $this->faker->sentence(),
            'is_active' => $this->faker->boolean(90),
            'display_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
