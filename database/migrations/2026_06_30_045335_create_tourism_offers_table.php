<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tourism_offers', function (Blueprint $table) {
            $table->id();

            // Titles
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();

            // Descriptions
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->longText('long_description_en')->nullable();
            $table->longText('long_description_ar')->nullable();

            // Slug and Images
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();

            // Pricing
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('rating', 3, 2)->default(0);

            // Duration and Location
            $table->string('duration_en')->nullable();
            $table->string('duration_ar')->nullable();
            $table->string('location_en')->nullable();
            $table->string('location_ar')->nullable();
            $table->string('group_size_en')->nullable();
            $table->string('group_size_ar')->nullable();

            // Features and Details (JSON)
            $table->json('features_en')->nullable();
            $table->json('features_ar')->nullable();
            $table->json('includes_en')->nullable();
            $table->json('includes_ar')->nullable();
            $table->json('not_includes_en')->nullable();
            $table->json('not_includes_ar')->nullable();
            $table->json('itinerary_en')->nullable();
            $table->json('itinerary_ar')->nullable();

            // Additional Info
            $table->json('basic_info')->nullable();
            $table->json('contact_info')->nullable();
            $table->json('payment_methods')->nullable();

            // Meta
            $table->string('type')->default('international');
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();

            // Meta Tags
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->text('meta_keywords_ar')->nullable();

            // Status
            $table->boolean('active')->default(true);
            $table->boolean('popular')->default(false);
            $table->boolean('limited')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tourism_offers');
    }
};
