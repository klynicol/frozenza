<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create();
        $baseUrl = rtrim(config('app.url'), '/');

        $sitemap->add(Url::create("{$baseUrl}/"));
        $sitemap->add(Url::create("{$baseUrl}/pizzas"));

        // Add BlogPost URLs
        $blogPosts = \App\Models\BlogPost::published()->get();
        foreach ($blogPosts as $post) {
            $sitemap->add($post->toSitemapTag());
        }

        // Add Pizza URLs
        $pizzas = \App\Models\Pizza::all();
        foreach ($pizzas as $pizza) {
            $sitemap->add($pizza->toSitemapTag());
        }

        // Add Brand URLs
        $brands = \App\Models\Brand::all();
        foreach ($brands as $brand) {
            $sitemap->add($brand->toSitemapTag());
        }

        // contact us page
        $sitemap->add(Url::create("{$baseUrl}/contact"));

        // brands page
        $sitemap->add(Url::create("{$baseUrl}/brands"));

        // blogs page
        $sitemap->add(Url::create("{$baseUrl}/blogs"));

        // top rated pizzas page
        $sitemap->add(Url::create("{$baseUrl}/top-rated"));

        // lowest calorie frozen pizza (SEO page)
        $sitemap->add(Url::create("{$baseUrl}/lowest-calorie-frozen-pizza"));

        // Save the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
