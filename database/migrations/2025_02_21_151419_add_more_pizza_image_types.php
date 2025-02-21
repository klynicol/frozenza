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
        // need to add the new image types to the pizza_images table
        Schema::table('pizza_images', function (Blueprint $table) {
            $table->enum('type', ['main', 'back', 'other', 'nutrition', 'ingredients', 'cooked'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pizza_images', function (Blueprint $table) {
            $table->enum('type', ['main', 'back', 'other'])->change();
        });
    }
};
