<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nutrition_facts_id')->constrained('nutrition_facts')->onDelete('cascade');
            $table->integer('total_fat');
            $table->integer('saturated_fat')->nullable();
            $table->integer('trans_fat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fats');
    }
}; 