<?php

namespace Database\Seeders;

use App\Models\Pizza;
use App\Models\Review;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakeUserSeeder extends Seeder
{
    /**
     * Names as stored in the DB (name field). Mostly Google-style real names; some random registration-style entries.
     */
    private function names(): array
    {
        return [
            'Antonia Rau' => [
                'reviews' => [
                    [
                        'brand_slug' => 'porta',
                        'pizza_slug' => 'uncured-pepperoni',
                        'appearance_rating' => 5,
                        'texture_rating' => 5,
                        'flavor_rating' => 5,
                        'review' => "Picked this up after seeing it recommended. Right away I love when pepperonis 
                        curl into that little boat shape looks so good. Bottom had a really nice crispy undercarriage. 
                        The dough is light and airy; teeth sink in but it's still crispy and fluffy inside. 
                        Pepperoni is spicy, flavorful, and salty and works so well with the cheese. 
                        They don't overload the sauce, which I appreciate. Cheese was melty and gooey with a little 
                        crisp on top. Tried the crust and was honestly blown away! It's fluffy and soft with a nice crisp on the outside. 
                        Really good one.",
                        'purchase_location' => 'Whole Foods, Austin TX',
                        'purchase_date' => '2025-02-14',
                    ],
                ],
            ],
            'Chase Cruickshank',
            'Bianka Kunze',
            'Marco Santos',
            'Yuki Tanaka',
            'Olivia Martinez',
            'Ravi Sharma',
            'Sophie Bernard',
            'James Wilson',
            'Fatima Al-Hassan',
            'Dmitri Volkov',
            'Elena Petrov',
            'Chen Wei',
            'Aisha Okafor',
            'Lucas Müller',
            'Zara Khan',
            'Noah Jensen',
            'Priya Subramanian',
            'Leo Fernandez',
            'Maya Cohen',
            'Hassan Ibrahim',
            'Isabella Rossi',
            'Omar Hassan',
            'Nina Kowalski',
            'Alex Thompson',
            'Sana Jamil',
            'Viktor Novak',
            'Layla Amari',
            // Random stuff people type on standard registration
            'lucas',
            'PIZZALOVER',
            'john d',
            'xX_SnackMaster_Xx',
            'Mom',
            'nugz_jones',
            'HalfpizzaHalfman',
            'J.money',
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('39thievesarequickerthan40winks');

        $increment = 1;
        foreach ($this->names() as $name => $value) {
            $reviews = is_array($value) ? ($value['reviews'] ?? []) : [];

            $email = (string) $increment . '@fakeemail.com';
            $increment++;

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => $password,
                    'email_verified_at' => now(),
                ]
            );

            foreach ($reviews as $reviewData) {
                $pizzaSlug = $reviewData['pizza_slug'] ?? null;
                $date = $reviewData['purchase_date'] ?? null;
                $brandSlug = $reviewData['brand_slug'] ?? null;
                unset($reviewData['pizza_slug'], $reviewData['purchase_date'], $reviewData['brand_slug']);
                if ($pizzaSlug) {
                    $brand = Brand::where('slug', $brandSlug)->firstOrFail();
                    $pizza = Pizza::where('slug', $pizzaSlug)->where('brand_id', $brand->id)->firstOrFail();
                    $reviewData['pizza_id'] = $pizza->id;
                    $reviewData['user_id'] = $user->id;
                    Review::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'pizza_id' => $pizza->id,
                        ],
                        $reviewData
                    );
                }
            }
        }
    }
}
