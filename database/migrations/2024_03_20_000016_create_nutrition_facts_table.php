<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nutrition_facts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->integer('calories');
            $table->integer('protein');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nutrition_facts');
    }
}; 