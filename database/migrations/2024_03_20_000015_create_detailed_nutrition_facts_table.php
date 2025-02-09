<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nutrition_facts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->string('serving_per_container', 255);
            $table->string('serving_size', 255);
            $table->unsignedSmallInteger('calories');
            $table->string('total_fat', 10);
            $table->string('saturated_fat', 10)->nullable();
            $table->string('trans_fat', 10)->nullable();
            $table->string('cholesterol', 10)->nullable();
            $table->string('sodium', 10)->nullable();
            $table->string('total_carbohydrate', 10);
            $table->string('dietary_fiber', 10)->nullable();
            $table->string('total_sugars', 10)->nullable();
            $table->string('added_sugars', 10)->nullable();
            $table->string('protein', 10);
            $table->string('vitamin_d', 10)->nullable();
            $table->string('calcium', 10)->nullable();
            $table->string('iron', 10)->nullable();
            $table->string('potassium', 10)->nullable();
            $table->string('monounsaturated_fat', 10)->nullable();
            $table->string('polyunsaturated_fat', 10)->nullable();
            $table->string('vitamin_a', 10)->nullable();
            $table->string('vitamin_c', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nutrition_facts');
    }
}; 