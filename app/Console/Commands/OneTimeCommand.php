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
        $pizza = Models\Pizza::first();

        $this->info($pizza->brand->name);
    }
}
