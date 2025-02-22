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
        Schema::create('pizza_tags', function (Blueprint $table) {
            $table->foreignUuid('pizza_id')->references('id')->on('pizzas')->onDelete('cascade');
            $table->foreignUuid('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->primary(['pizza_id', 'tag_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizza_tags');
    }
};
