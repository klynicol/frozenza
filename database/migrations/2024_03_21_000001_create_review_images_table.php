<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_images', function (Blueprint $table) {
            $table->foreignUuid('review_id')->references('id')->on('reviews')->onDelete('cascade');
            $table->foreignUuid('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->primary(['review_id', 'image_id']);
            $table->integer('order')->default(0);
            $table->string('type')->default('other');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_images');
    }
};
