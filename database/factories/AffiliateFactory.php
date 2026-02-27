<?php

namespace Database\Factories;

use App\Models\Affiliate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Affiliate>
 */
class AffiliateFactory extends Factory
{
    protected $model = Affiliate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'url_base' => 'https://www.example.com/',
            'default_commission_rate' => fake()->randomFloat(2, 1, 10),
            'default_description' => fake()->sentence(),
            'is_active' => true,
            'display_order' => 0,
        ];
    }
}
