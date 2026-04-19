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
        // Add country/city to international hotels
        Schema::table('international_hotels', function (Blueprint $table) {
            $table->string('country_en')->nullable()->after('name_ar');
            $table->string('country_ar')->nullable()->after('country_en');
            $table->string('city_en')->nullable()->after('country_ar');
            $table->string('city_ar')->nullable()->after('city_en');
        });

        // Add country/city to international packages
        Schema::table('international_packages', function (Blueprint $table) {
            $table->string('country_en')->nullable()->after('title_ar');
            $table->string('country_ar')->nullable()->after('country_en');
            $table->string('city_en')->nullable()->after('country_ar');
            $table->string('city_ar')->nullable()->after('city_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('international_hotels', function (Blueprint $table) {
            $table->dropColumn(['country_en', 'country_ar', 'city_en', 'city_ar']);
        });

        Schema::table('international_packages', function (Blueprint $table) {
            $table->dropColumn(['country_en', 'country_ar', 'city_en', 'city_ar']);
        });
    }
};
