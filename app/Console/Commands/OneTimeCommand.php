<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models;

class OneTimeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:one-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Anything';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\BlogPost::create([
            'title' => "FDA Recalls Connie's Frozen Pizzas Over Safety Concerns",
            'meta_description' => "FDA recalls 1,728 Connie's Thin Crust Cheese Frozen Pizzas due to possible plastic contamination. Products distributed in IL, MN, and WI.",
            'slug' => 'connies-pizza-recall',
            'published_at' => now(),
            'feature_image' => 'storage/blogs/connies-pizza-recall-front.png',
        ]);
    }
}
