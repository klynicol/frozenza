<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Validation\Rule;

class BrandValidationRules
{
    /**
     * Base rules shared by admin store and update (with minor differences).
     * Use storeRules(), updateRules(), or submissionRules() instead.
     */
    protected static function baseRules(bool $forUpdate = false): array
    {
        $maxYear = (string) (date('Y') + 1);
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'store_locator_url' => ['nullable', 'url', 'max:255'],
            'founded_year' => ['nullable', 'integer', 'min:1800', 'max:' . $maxYear],
            'brand_story' => ['required', 'string'],
            'unique_selling_points' => ['nullable', 'array'],
            'unique_selling_points.*' => ['string', 'max:255'],
            'social_media_handles' => ['nullable', 'array'],
            'social_media_handles.*' => ['string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_about_content' => ['nullable', 'string', 'max:2000'],
            'seo_keywords' => ['nullable', 'array'],
            'seo_keywords.*' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];

        return $rules;
    }

    /**
     * Validation rules for admin brand create (store).
     *
     * @return array<string, array<int, mixed>>
     */
    public static function store(): array
    {
        $rules = static::baseRules(false);
        $rules['name'][] = Rule::unique('brands', 'name');
        $rules['slug'][] = Rule::unique('brands', 'slug');

        return $rules;
    }

    /**
     * Validation rules for admin brand update.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function update(Brand $brand): array
    {
        $rules = static::baseRules(true);
        $rules['name'][] = Rule::unique('brands', 'name')->ignore($brand->id);
        $rules['slug'][] = Rule::unique('brands', 'slug')->ignore($brand->id);

        return $rules;
    }
}
