<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->json('seo_faq_questions')->nullable();
            $table->text('seo_about_content')->nullable();
            $table->json('seo_keywords')->nullable();
            $table->text('cooking_instructions')->nullable();
            $table->text('unique_selling_points')->nullable();
            $table->json('social_media_handles')->nullable();
            $table->text('brand_story')->nullable();
            $table->string('founded_year')->nullable();
            $table->string('headquarters_location')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title',
                'seo_description',
                'seo_faq_questions',
                'seo_about_content',
                'seo_keywords',
                'cooking_instructions',
                'unique_selling_points',
                'social_media_handles',
                'brand_story',
                'founded_year',
                'headquarters_location'
            ]);
        });
    }
}; 