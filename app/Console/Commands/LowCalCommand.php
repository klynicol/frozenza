<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pizza;
use App\Models\NutritionFact;
use App\Models\StaffPick;
use App\Models\Flag;

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
        $allFacts = NutritionFact::with('pizza')->get();

        $results = collect();

        foreach ($allFacts as $fact) {
            if($fact->serving_weight <= 0) {
                Flag::firstOrCreate([
                    'table_name' => 'pizzas',
                    'f_value_1' => 'needs_editing',
                    'f_value_2' => 'serving_weight',
                    'flagable_id' => $fact->pizza_id,
                ]);
                continue;
            }

            $results->push([
                'pizza_id' => $fact->pizza_id,
                'calories_per_gram' => $fact->calories / $fact->serving_weight,
            ]);
        }

        $results = $results->sortBy('calories_per_gram')->take(3);

        $staffPick = StaffPick::where('slug', 'lowest-calorie-frozen-pizza')->first();
        $currentPicks = $staffPick->pizzas();

        foreach ($currentPicks as $pick) {
            if(!$results->contains('pizza_id', $pick->id)) {
                $pick->staff_pick_id = null;
                $pick->save();
            }
        }

        foreach ($results as $result) {
            $pizza = Pizza::find($result['pizza_id']);
            $pizza->staff_pick_id = $staffPick->id;
            $pizza->save();
        }

        return Command::SUCCESS;
    }
}
