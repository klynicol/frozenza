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
        Sitemap::create(Url::create('https://pizzakraken.com'))
            ->writeToFile(public_path('sitemap.xml'));
    }
}
