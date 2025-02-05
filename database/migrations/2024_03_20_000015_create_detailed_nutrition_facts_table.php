<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detailed_nutrition_facts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->integer('serving_size')->nullable();
            $table->string('serving_unit', 50)->nullable();
            $table->integer('calories');
            $table->integer('total_fat');
            $table->integer('saturated_fat')->nullable();
            $table->integer('trans_fat')->nullable();
            $table->integer('cholesterol')->nullable();
            $table->integer('sodium')->nullable();
            $table->integer('total_carbohydrate');
            $table->integer('dietary_fiber')->nullable();
            $table->integer('total_sugars')->nullable();
            $table->integer('added_sugars')->nullable();
            $table->integer('protein');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detailed_nutrition_facts');
    }
}; 