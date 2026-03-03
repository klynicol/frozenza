<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pizza;
use App\Models\NutritionFact;

class LowCalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:low-cal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the 3 lowest calorie frozen pizzas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
    }
}
