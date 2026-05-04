<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visa_countries', function (Blueprint $table) {
            // Check if old columns exist and rename them
            if (Schema::hasColumn('visa_countries', 'name')) {
                $table->renameColumn('name', 'name_en');
            } else {
                $table->string('name_en')->after('id');
            }

            // Add Arabic and Chinese columns if they don't exist
            if (!Schema::hasColumn('visa_countries', 'name_ar')) {
                $table->string('name_ar')->nullable()->after('name_en');
            }
            if (!Schema::hasColumn('visa_countries', 'name_zh')) {
                $table->string('name_zh')->nullable()->after('name_ar');
            }

            // Visa type columns
            if (Schema::hasColumn('visa_countries', 'visa_type')) {
                $table->renameColumn('visa_type', 'visa_type_en');
            } else {
                $table->string('visa_type_en')->nullable()->after('name_zh');
            }
            if (!Schema::hasColumn('visa_countries', 'visa_type_ar')) {
                $table->string('visa_type_ar')->nullable()->after('visa_type_en');
            }
            if (!Schema::hasColumn('visa_countries', 'visa_type_zh')) {
                $table->string('visa_type_zh')->nullable()->after('visa_type_ar');
            }

            // Processing time columns
            if (Schema::hasColumn('visa_countries', 'processing_time')) {
                $table->renameColumn('processing_time', 'processing_time_en');
            } else {
                $table->string('processing_time_en')->nullable()->after('visa_type_zh');
            }
            if (!Schema::hasColumn('visa_countries', 'processing_time_ar')) {
                $table->string('processing_time_ar')->nullable()->after('processing_time_en');
            }
            if (!Schema::hasColumn('visa_countries', 'processing_time_zh')) {
                $table->string('processing_time_zh')->nullable()->after('processing_time_ar');
            }

            // Description columns
            if (Schema::hasColumn('visa_countries', 'description')) {
                $table->renameColumn('description', 'description_en');
            } else {
                $table->text('description_en')->nullable()->after('processing_time_zh');
            }
            if (!Schema::hasColumn('visa_countries', 'description_ar')) {
                $table->text('description_ar')->nullable()->after('description_en');
            }
            if (!Schema::hasColumn('visa_countries', 'description_zh')) {
                $table->text('description_zh')->nullable()->after('description_ar');
            }

            // Ensure documents and notes are JSON columns
            if (Schema::hasColumn('visa_countries', 'documents')) {
                $table->json('documents')->nullable()->change();
            } else {
                $table->json('documents')->nullable()->after('description_zh');
            }

            if (Schema::hasColumn('visa_countries', 'notes')) {
                $table->json('notes')->nullable()->change();
            } else {
                $table->json('notes')->nullable()->after('documents');
            }
        });
    }

    public function down(): void
    {
        Schema::table('visa_countries', function (Blueprint $table) {
            // Drop the added columns
            $table->dropColumn([
                'name_ar',
                'name_zh',
                'visa_type_ar',
                'visa_type_zh',
                'processing_time_ar',
                'processing_time_zh',
                'description_ar',
                'description_zh'
            ]);

            // Rename back if needed
            if (Schema::hasColumn('visa_countries', 'name_en')) {
                $table->renameColumn('name_en', 'name');
            }
            if (Schema::hasColumn('visa_countries', 'visa_type_en')) {
                $table->renameColumn('visa_type_en', 'visa_type');
            }
            if (Schema::hasColumn('visa_countries', 'processing_time_en')) {
                $table->renameColumn('processing_time_en', 'processing_time');
            }
            if (Schema::hasColumn('visa_countries', 'description_en')) {
                $table->renameColumn('description_en', 'description');
            }
        });
    }
};
