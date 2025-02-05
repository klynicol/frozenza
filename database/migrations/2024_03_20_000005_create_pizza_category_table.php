<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_pizza', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignUuid('pizza_id')->references('id')->on('pizzas')->onDelete('cascade');
            $table->foreignUuid('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_pizza');
    }
}; 