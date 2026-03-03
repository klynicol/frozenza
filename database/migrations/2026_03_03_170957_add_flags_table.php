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
        /**
         * When I work on databases there's almost always a need to flag
         * things as "processes" or "needs attention". This is outside of the regular
         * data and is usually things that come up during the development process
         * at random. They are variable but will apply to a specific table
         *
         * This table will store these flags.
         */
        Schema::create('flags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('flagable_id');
            $table->string('table_name', 64);
            $table->string('f_value_1', 255);
            $table->string('f_value_2', 255)->nullable();
            $table->timestamps();

            // Find flags by table + value (e.g. "pizzas with flag X")
            $table->index(['table_name', 'f_value_1']);
            // Load all flags for a row (e.g. $pizza->flags)
            $table->index(['table_name', 'flagable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flags');
    }
};
