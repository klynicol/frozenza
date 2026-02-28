<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\NutritionFact;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // export backup of nutrition_facts table
        if (Schema::hasTable('nutrition_facts')) {
            NutritionFact::saveBackup();
        }

        Schema::dropIfExists('nutrition_facts');

        Schema::create('nutrition_facts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->unsignedSmallInteger('serving_per_container');
            $table->string('serving_fraction', 64);
            $table->unsignedSmallInteger('serving_weight'); //grams
            $table->unsignedSmallInteger('calories');
            $table->unsignedSmallInteger('caloris_from_fat');
            $table->decimal('total_fat', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('saturated_fat', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('trans_fat', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('cholesterol', 16, 4)->comment('milligrams')->nullable(); // milligrams
            $table->decimal('sodium', 16, 4)->comment('milligrams')->nullable(); // milligrams
            $table->decimal('total_carbohydrate', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('dietary_fiber', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('total_sugars', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('added_sugars', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('protein', 16, 4)->comment('grams')->nullable(); // grams
            // vitamins and minerals
            $table->decimal('vitamin_d', 16, 4)->comment('micrograms')->nullable(); // micrograms
            $table->decimal('calcium', 16, 4)->comment('milligrams')->nullable(); // milligrams
            $table->decimal('iron', 16, 4)->comment('milligrams')->nullable(); // milligrams
            $table->decimal('potassium', 16, 4)->comment('milligrams')->nullable(); // milligrams
            $table->decimal('monounsaturated_fat', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('polyunsaturated_fat', 16, 4)->comment('grams')->nullable(); // grams
            $table->decimal('vitamin_a', 16, 4)->comment('micrograms')->nullable(); // micrograms
            $table->decimal('vitamin_c', 16, 4)->comment('milligrams')->nullable(); // milligrams
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_facts');
    }
};
