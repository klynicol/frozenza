<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pizza_tag', function (Blueprint $table) {
            $table->foreignUuid('pizza_id')->constrained('pizzas')->onDelete('cascade');
            $table->foreignUuid('tag_id')->constrained('tags')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pizza_tag');
    }
}; 