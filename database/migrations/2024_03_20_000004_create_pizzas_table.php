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
            $table->string('slug');
            $table->text('description');
            $table->text('ingredients')->nullable();
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->decimal('average_appearance_rating', 3, 2)->default(0);
            $table->decimal('average_texture_rating', 3, 2)->default(0);
            $table->decimal('average_flavor_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->foreignUuid('brand_id')->references('id')->on('brands')->onDelete('cascade');
            // unique constraint on slug and brand_id
            $table->unique(['slug', 'brand_id']);
            $table->foreignUuid('style_id')->nullable()->references('id')->on('styles')->onDelete('cascade');
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
