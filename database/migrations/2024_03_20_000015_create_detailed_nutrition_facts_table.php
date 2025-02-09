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
            $table->unsignedSmallInteger('serving_size')->nullable();
            $table->string('serving_unit', 50)->nullable();
            $table->unsignedSmallInteger('calories');
            $table->unsignedSmallInteger('total_fat');
            $table->unsignedTinyInteger('saturated_fat')->nullable();
            $table->unsignedTinyInteger('trans_fat')->nullable();
            $table->unsignedSmallInteger('cholesterol')->nullable();
            $table->unsignedSmallInteger('sodium')->nullable();
            $table->unsignedSmallInteger('total_carbohydrate');
            $table->unsignedTinyInteger('dietary_fiber')->nullable();
            $table->unsignedTinyInteger('total_sugars')->nullable();
            $table->unsignedTinyInteger('added_sugars')->nullable();
            $table->unsignedSmallInteger('protein');
            $table->unsignedTinyInteger('vitamin_d')->nullable();
            $table->unsignedTinyInteger('calcium')->nullable();
            $table->unsignedTinyInteger('iron')->nullable();
            $table->unsignedTinyInteger('potassium')->nullable();
            $table->unsignedTinyInteger('monounsaturated_fat')->nullable();
            $table->unsignedTinyInteger('polyunsaturated_fat')->nullable();
            $table->unsignedTinyInteger('vitamin_a')->nullable();
            $table->unsignedTinyInteger('vitamin_c')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nutrition_facts');
    }
}; 