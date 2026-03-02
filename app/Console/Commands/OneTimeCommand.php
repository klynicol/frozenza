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
        $pizza = \App\Models\Pizza::where('id', '03028799-c1ef-454c-8c1d-65845ee44b30')->with('tags')->first();
        $this->info($pizza);
    }
}
