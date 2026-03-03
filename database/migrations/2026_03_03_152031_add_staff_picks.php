<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StaffPick;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * This table will store lists of pizzas that are recommended by the staff.
         * or calculated from automated algorithms.
         *
         * The table will have the following columns:
         * - id: uuid
         * - name: string
         * - description: text
         * - created_at: timestamp
         * - updated_at: timestamp
         */
        Schema::create('staff_picks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        // add a nullable foreign key to the pizzas table (existing pizzas have no staff pick)
        Schema::table('pizzas', function (Blueprint $table) {
            $table->foreignUuid('staff_pick_id')->nullable()->references('id')->on('staff_picks')->onDelete('cascade');
        });

        StaffPick::create([
            'slug' => 'lowest-calorie-frozen-pizza',
            'name' => 'Lowest Calorie Frozen Pizza',
            'description' => 'The 3 lowest calorie frozen pizzas',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropForeign(['staff_pick_id']);
            $table->dropColumn('staff_pick_id');
        });

        Schema::dropIfExists('staff_picks');
    }
};
