<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add Chinese language columns to all translatable tables
     */
    public function up(): void
    {
        // International Destinations
        Schema::table('international_destinations', function (Blueprint $table) {
            $table->string('name_zh')->nullable()->after('name_ar');
            $table->string('country_zh')->nullable()->after('country_ar');
            $table->string('city_zh')->nullable()->after('city_ar');
            $table->text('description_zh')->nullable()->after('description_ar');
        });

        // International Flights
        Schema::table('international_flights', function (Blueprint $table) {
            $table->string('airline_zh')->nullable()->after('airline_ar');
            $table->string('route_zh')->nullable()->after('route_ar');
            $table->string('stops_zh')->nullable()->after('stops_ar');
        });

        // International Hotels
        Schema::table('international_hotels', function (Blueprint $table) {
            $table->string('name_zh')->nullable()->after('name_ar');
            $table->string('country_zh')->nullable()->after('country_ar');
            $table->string('city_zh')->nullable()->after('city_ar');
            $table->string('location_zh')->nullable()->after('location_ar');
            $table->text('description_zh')->nullable()->after('description_ar');
            $table->json('amenities_zh')->nullable()->after('amenities_ar');
        });

        // International Packages
        Schema::table('international_packages', function (Blueprint $table) {
            $table->string('type_zh')->nullable()->after('type_ar');
            $table->string('title_zh')->nullable()->after('title_ar');
            $table->string('country_zh')->nullable()->after('country_ar');
            $table->string('city_zh')->nullable()->after('city_ar');
            $table->text('description_zh')->nullable()->after('description_ar');
            $table->string('duration_zh')->nullable()->after('duration_ar');
            $table->json('features_zh')->nullable()->after('features_ar');
            $table->text('highlight_zh')->nullable()->after('highlight_ar');
        });

        // Island Destinations
        Schema::table('island_destinations', function (Blueprint $table) {
            $table->string('title_zh')->nullable()->after('title_ar');
            $table->text('description_zh')->nullable()->after('description_ar');
            $table->text('highlights_zh')->nullable()->after('highlights_ar');
            $table->text('includes_zh')->nullable()->after('includes_ar');
            $table->text('itinerary_zh')->nullable()->after('itinerary_ar');
            $table->string('location_zh')->nullable()->after('location_ar');
            $table->string('duration_zh')->nullable()->after('duration_ar');
            $table->string('groupSize_zh')->nullable()->after('groupSize_ar');
            $table->json('features_zh')->nullable()->after('features_ar');
            $table->string('type_zh')->nullable()->after('type_ar');
        });

        // Offers
        Schema::table('offers', function (Blueprint $table) {
            $table->string('title_zh')->nullable()->after('title_ar');
            $table->text('description_zh')->nullable()->after('description_ar');
            $table->string('duration_zh')->nullable()->after('duration_ar');
            $table->string('location_zh')->nullable()->after('location_ar');
            $table->string('group_size_zh')->nullable()->after('group_size_ar');
            $table->string('badge_zh')->nullable()->after('badge_ar');
            $table->json('features_zh')->nullable()->after('features_ar');
            $table->json('highlights_zh')->nullable()->after('highlights_ar');
            $table->decimal('price_zh', 10, 2)->nullable()->after('price_ar');
        });

        // Trips - add Chinese to translation arrays
        Schema::table('trips', function (Blueprint $table) {
            $table->string('title_zh')->nullable()->after('title');
            $table->text('description_zh')->nullable()->after('description');
            $table->text('content_zh')->nullable()->after('content');
            $table->json('highlights_zh')->nullable()->after('highlights');
            $table->string('group_size_zh')->nullable()->after('group_size');
            $table->string('city_name_zh')->nullable()->after('city_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('international_destinations', function (Blueprint $table) {
            $table->dropColumn(['name_zh', 'country_zh', 'city_zh', 'description_zh']);
        });

        Schema::table('international_flights', function (Blueprint $table) {
            $table->dropColumn(['airline_zh', 'route_zh', 'stops_zh']);
        });

        Schema::table('international_hotels', function (Blueprint $table) {
            $table->dropColumn(['name_zh', 'country_zh', 'city_zh', 'location_zh', 'description_zh', 'amenities_zh']);
        });

        Schema::table('international_packages', function (Blueprint $table) {
            $table->dropColumn(['type_zh', 'title_zh', 'country_zh', 'city_zh', 'description_zh', 'duration_zh', 'features_zh', 'highlight_zh']);
        });

        Schema::table('island_destinations', function (Blueprint $table) {
            $table->dropColumn(['title_zh', 'description_zh', 'highlights_zh', 'includes_zh', 'itinerary_zh', 'location_zh', 'duration_zh', 'groupSize_zh', 'features_zh', 'type_zh']);
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn(['title_zh', 'description_zh', 'duration_zh', 'location_zh', 'group_size_zh', 'badge_zh', 'features_zh', 'highlights_zh', 'price_zh']);
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn(['title_zh', 'description_zh', 'content_zh', 'highlights_zh', 'group_size_zh', 'city_name_zh']);
        });
    }
};
