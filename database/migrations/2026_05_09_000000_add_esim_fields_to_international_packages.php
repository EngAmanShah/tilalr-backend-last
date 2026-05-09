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
        Schema::table('international_packages', function (Blueprint $table) {
            // eSIM-specific fields
            $table->string('data_amount')->nullable()->after('duration_zh'); // e.g., "1GB", "3GB"
            $table->string('plan_type')->nullable()->after('data_amount'); // "limited_data", "unlimited_data"
            $table->json('networks')->nullable()->after('plan_type'); // Array of network names
            $table->integer('supported_countries_count')->nullable()->after('networks'); // Number of countries
            $table->json('supported_countries')->nullable()->after('supported_countries_count'); // Array of countries
            $table->boolean('hotspot_tethering')->default(false)->after('supported_countries'); // Hotspot allowed
            $table->boolean('rechargeability')->default(true)->after('hotspot_tethering'); // Can recharge
            $table->string('starting_price')->nullable()->after('rechargeability');
            $table->string('package_code')->nullable()->unique()->after('starting_price'); // e.g., "GCC-3GB-30Days"
            $table->string('region_en')->nullable()->after('package_code');
            $table->string('region_ar')->nullable()->after('region_en');
            $table->string('region_zh')->nullable()->after('region_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('international_packages', function (Blueprint $table) {
            $table->dropColumn([
                'data_amount',
                'plan_type',
                'networks',
                'supported_countries_count',
                'supported_countries',
                'hotspot_tethering',
                'rechargeability',
                'starting_price',
                'package_code',
                'region_en',
                'region_ar',
                'region_zh',
            ]);
        });
    }
};
