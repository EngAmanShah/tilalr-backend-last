<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tourism_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('long_description_en')->nullable();
            $table->text('long_description_ar')->nullable();
            $table->string('location_en')->nullable();
            $table->string('location_ar')->nullable();
            $table->string('duration_en')->nullable();
            $table->string('duration_ar')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('rating', 3, 1)->default(4.5);
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->json('features_en')->nullable();
            $table->json('features_ar')->nullable();
            $table->json('includes_en')->nullable();
            $table->json('includes_ar')->nullable();
            $table->json('not_includes_en')->nullable();
            $table->json('not_includes_ar')->nullable();
            $table->json('itinerary_en')->nullable();
            $table->json('itinerary_ar')->nullable();
            $table->json('basic_info')->nullable();
            $table->json('contact_info')->nullable();
            $table->json('payment_methods')->nullable();
            $table->string('region')->nullable(); // europe, asia, africa, australia
            $table->string('trip_code')->nullable();
            $table->date('available_to')->nullable();
            $table->decimal('double_room_price', 10, 2)->nullable();
            $table->decimal('single_room_price', 10, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tourism_destinations');
    }
};
