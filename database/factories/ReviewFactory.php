<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Pizza;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'pizza_id' => Pizza::factory(),
            'user_id' => User::factory(),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'review' => $this->faker->paragraph(),
            'purchase_location' => $this->faker->company(),
            'purchase_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 