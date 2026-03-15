<?php

namespace App\Imports;

use App\Models\Brand;
use App\Handlers\ImageHandler;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class BrandsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null

    array:10 [
        0 => "brand_name"
        1 => "website_url"
        2 => "parent_company"
        3 => "founded_year"
        4 => "headquarter_address"
        5 => "description"
        6 => "brand_story"
        7 => "logo_image"
        8 => "unique_selling_points"
        9 => "store_locator_url"
    ] //
    */
    public function model(array $row)
    {
        // if this is the header row, skip it
        if ($row[0] === 'brand_name') {
            return null;
        }

        $slug = Str::slug($row[0]);

        $brand = Brand::where('slug', $slug)->first();

        if(!$brand?->image_id && $row[7]) {
            $image = ImageHandler::createFromUrl($row[7], 'public', 'images/logos/frozen', $slug);
            if($image) {
                $brand->image_id = $image->id;
                $brand->save();
            }
        }

        return Brand::updateOrCreate([
            'slug' => $slug
        ], [
            'name' => $brand?->name ?? $row[0],
            'website' => $brand?->website ?? $row[1],
            'parent_company' => $brand?->parent_company ?? $row[2],
            'founded_year' => $brand?->founded_year ?? $row[3],
            'headquarter_address' => $brand?->headquarter_address ?? $row[4],
            'description' => $brand?->description ?? $row[5],
            'brand_story' => $brand?->brand_story ?? $row[6],
            'unique_selling_points' => $brand?->unique_selling_points ?? $row[8],
            'store_locator_url' => $brand?->store_locator_url ?? $row[9],
        ]);
    }
}
