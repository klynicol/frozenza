<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('ingredients');
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->foreignUuid('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreignUuid('style_id')->references('id')->on('styles')->onDelete('cascade');
            $table->foreignUuid('image_id')->nullable()->references('id')->on('images')->onDelete('cascade');
            $table->string('website')->nullable();
            $table->string('allergens')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
}; 