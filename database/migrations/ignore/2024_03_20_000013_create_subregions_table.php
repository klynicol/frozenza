<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subregions', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name', 100);
            $table->text('translations')->nullable();
            $table->mediumInteger('region_id')->unsigned();
            $table->timestamps();
            $table->tinyInteger('flag')->default(1);
            $table->string('wikiDataId', 255)->nullable();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subregions');
    }
}; 