<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            // Check and add columns if they don't exist
            if (!Schema::hasColumn('offers', 'title_en')) {
                $table->string('title_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'title_ar')) {
                $table->string('title_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'description_en')) {
                $table->text('description_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'description_ar')) {
                $table->text('description_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'duration_en')) {
                $table->string('duration_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'duration_ar')) {
                $table->string('duration_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'location_en')) {
                $table->string('location_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'location_ar')) {
                $table->string('location_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'group_size_en')) {
                $table->string('group_size_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'group_size_ar')) {
                $table->string('group_size_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'badge_en')) {
                $table->string('badge_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'badge_ar')) {
                $table->string('badge_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'features_en')) {
                $table->json('features_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'features_ar')) {
                $table->json('features_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'highlights_en')) {
                $table->json('highlights_en')->nullable();
            }

            if (!Schema::hasColumn('offers', 'highlights_ar')) {
                $table->json('highlights_ar')->nullable();
            }

            // Chinese columns
            if (!Schema::hasColumn('offers', 'title_zh')) {
                $table->string('title_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'description_zh')) {
                $table->text('description_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'duration_zh')) {
                $table->string('duration_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'location_zh')) {
                $table->string('location_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'group_size_zh')) {
                $table->string('group_size_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'badge_zh')) {
                $table->string('badge_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'features_zh')) {
                $table->json('features_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'highlights_zh')) {
                $table->json('highlights_zh')->nullable();
            }
        });
    }

    public function down(): void
    {
        // We won't drop columns in down to prevent data loss
        // But you can implement if needed
    }
};
