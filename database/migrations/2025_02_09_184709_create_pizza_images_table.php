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
        Schema::create('pizza_images', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignUuid('pizza_id')->references('id')->on('pizzas')->onDelete('cascade');
            $table->foreignUuid('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->enum('type', ['main', 'back', 'other'])->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_images');
    }
};
