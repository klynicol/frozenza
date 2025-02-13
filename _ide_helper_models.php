<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string|null $featured_image
 * @property array<array-key, mixed>|null $tags
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user_id
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogPost whereUserId($value)
 * @mixin \Eloquent
 */
	class BlogPost extends \Eloquent implements \Spatie\Sitemap\Contracts\Sitemapable {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $website
 * @property string|null $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereWebsite($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Image|null $image
 */
	class Brand extends \Eloquent implements \Spatie\Sitemap\Contracts\Sitemapable {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @mixin \Eloquent
 */
	class Category extends \Eloquent implements \Spatie\Sitemap\Contracts\Sitemapable {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Country|null $country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @mixin \Eloquent
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @property-read \App\Models\Region|null $region
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\State> $states
 * @property-read int|null $states_count
 * @property-read \App\Models\Subregion|null $subregion
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country query()
 * @mixin \Eloquent
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $disk
 * @property string $path
 * @property string $name
 * @property string $extension
 * @property int $size
 * @property string $mime_type
 * @property int $width
 * @property int $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Image whereWidth($value)
 * @mixin \Eloquent
 */
	class Image extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $from_user_id
 * @property string $to_user_id
 * @property-read \App\Models\User $fromUser
 * @property-read \App\Models\User $toUser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $pizza_id
 * @property string $serving_per_container
 * @property string $serving_size
 * @property int $calories
 * @property string $total_fat
 * @property string|null $saturated_fat
 * @property string|null $trans_fat
 * @property string|null $cholesterol
 * @property string|null $sodium
 * @property string $total_carbohydrate
 * @property string|null $dietary_fiber
 * @property string|null $total_sugars
 * @property string|null $added_sugars
 * @property string $protein
 * @property string|null $vitamin_d
 * @property string|null $calcium
 * @property string|null $iron
 * @property string|null $potassium
 * @property string|null $monounsaturated_fat
 * @property string|null $polyunsaturated_fat
 * @property string|null $vitamin_a
 * @property string|null $vitamin_c
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pizza $pizza
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereAddedSugars($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCalcium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCalories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCholesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereDietaryFiber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereIron($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereMonounsaturatedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact wherePizzaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact wherePolyunsaturatedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact wherePotassium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereProtein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereSaturatedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingPerContainer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereSodium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTotalCarbohydrate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTotalFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTotalSugars($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTransFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereVitaminA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereVitaminC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereVitaminD($value)
 * @mixin \Eloquent
 */
	class NutritionFact extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property array<array-key, mixed> $ingredients
 * @property float $average_rating
 * @property int $total_reviews
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $brand_id
 * @property string $style_id
 * @property string $image_id
 * @property string|null $website
 * @property string|null $allergens
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Style> $style
 * @property-read int|null $style_count
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAllergens($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAverageRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereStyleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereTotalReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereWebsite($value)
 * @mixin \Eloquent
 * @property-read \App\Models\NutritionFact|null $nutritionFact
 */
	class Pizza extends \Eloquent implements \Spatie\Sitemap\Contracts\Sitemapable {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country> $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subregion> $subregions
 * @property-read int|null $subregions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @mixin \Eloquent
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property float $rating
 * @property string $review
 * @property string $purchase_location
 * @property \Illuminate\Support\Carbon $purchase_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $pizza_id
 * @property string $user_id
 * @property-read \App\Models\Pizza $pizza
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review wherePizzaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review wherePurchaseLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUserId($value)
 * @mixin \Eloquent
 */
	class Review extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @property-read \App\Models\Country|null $country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|State query()
 * @mixin \Eloquent
 */
	class State extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Style extends \Eloquent implements \Spatie\Sitemap\Contracts\Sitemapable {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country> $countries
 * @property-read int|null $countries_count
 * @property-read \App\Models\Region|null $region
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subregion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subregion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subregion query()
 * @mixin \Eloquent
 */
	class Subregion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

