<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Remove the old rating column
            $table->dropColumn('rating');
            
            // Add new rating metrics
            $table->decimal('appearance_rating', 2, 1)->nullable();
            $table->decimal('texture_rating', 2, 1)->nullable();
            $table->decimal('flavor_rating', 2, 1)->nullable();
            $table->date('average_rating_date')->nullable()->comment('Date when this review was used to calculate the average rating');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Remove the new rating metrics
            $table->dropColumn(['appearance_rating', 'texture_rating', 'flavor_rating', 'average_rating_date']);
            
            // Add back the old rating column
            $table->decimal('rating', 2, 1);
        });
    }
}; 