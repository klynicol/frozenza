<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pizza_style', function (Blueprint $table) {
            $table->foreignUuid('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->foreignUuid('style_id')->constrained('styles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_style');
    }
};
