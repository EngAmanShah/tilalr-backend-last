<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            // Check and add missing Arabic columns
            if (!Schema::hasColumn('offers', 'description_ar')) {
                $table->text('description_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'location_ar')) {
                $table->string('location_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'duration_ar')) {
                $table->string('duration_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'group_size_ar')) {
                $table->string('group_size_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'badge_ar')) {
                $table->string('badge_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'features_ar')) {
                $table->json('features_ar')->nullable();
            }

            if (!Schema::hasColumn('offers', 'highlights_ar')) {
                $table->json('highlights_ar')->nullable();
            }

            // Check and add Chinese columns if needed
            if (!Schema::hasColumn('offers', 'title_zh')) {
                $table->string('title_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'description_zh')) {
                $table->text('description_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'location_zh')) {
                $table->string('location_zh')->nullable();
            }

            if (!Schema::hasColumn('offers', 'duration_zh')) {
                $table->string('duration_zh')->nullable();
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
        Schema::table('offers', function (Blueprint $table) {
            $columns = [
                'description_ar', 'location_ar', 'duration_ar', 'group_size_ar',
                'badge_ar', 'features_ar', 'highlights_ar',
                'title_zh', 'description_zh', 'location_zh', 'duration_zh',
                'group_size_zh', 'badge_zh', 'features_zh', 'highlights_zh'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('offers', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
