<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carbohydrates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nutrition_facts_id')->constrained('nutrition_facts')->onDelete('cascade');
            $table->integer('total_carbohydrate');
            $table->integer('dietary_fiber')->nullable();
            $table->integer('total_sugars')->nullable();
            $table->integer('added_sugars')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carbohydrates');
    }
}; 