<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Affiliate;
use App\Seeders\AffiliateSeeder;
use App\Models\AffiliateLink;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->foreignUuid('affiliate_id')->nullable()->after('pizza_id')->constrained('affiliates')->onDelete('cascade');
        });

        foreach (AffiliateLink::all() as $link) {
            $affiliate = Affiliate::where('name', $link->vendor_name)->first();
            if ($affiliate) {
                $link->affiliate_id = $affiliate->id;
                $link->save();
            }
        }

        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->dropColumn('vendor_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->dropForeign(['affiliate_id']);
        });

        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->string('vendor_name')->after('pizza_id');
        });

        foreach (AffiliateLink::all() as $link) {
            $link->vendor_name = $link->affiliate?->name;
            $link->save();
        }

        Schema::table('affiliate_links', function (Blueprint $table) {
            $table->dropColumn('affiliate_id');
        });
    }
};
