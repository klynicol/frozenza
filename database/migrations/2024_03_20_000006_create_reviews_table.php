<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('overall_rating', 2, 1);
            $table->decimal('appearance_rating', 2, 1);
            $table->decimal('texture_rating', 2, 1);
            $table->decimal('flavor_rating', 2, 1);
            $table->dateTime('average_rating_date')->nullable()->comment('Date when this review was used to calculate the average rating');
            $table->text('review')->nullable();
            $table->string('purchase_location')->nullable();
            $table->timestamps();

            $table->foreignUuid('pizza_id')->references('id')->on('pizzas')->onDelete('cascade');
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
}; 