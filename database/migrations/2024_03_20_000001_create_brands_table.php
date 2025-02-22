<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('website')->nullable();
            $table->foreignUuid('image_id')->nullable()->constrained('images')->nullOnDelete();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_about_content')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->text('unique_selling_points')->nullable();
            $table->json('social_media_handles')->nullable();
            $table->text('brand_story')->nullable();
            $table->string('founded_year', 4)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
}; 