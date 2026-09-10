<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Check if columns exist before adding
            if (!Schema::hasColumn('permissions', 'name')) {
                $table->string('name')->unique()->after('id');
            }

            if (!Schema::hasColumn('permissions', 'guard_name')) {
                $table->string('guard_name')->default('web')->after('name');
            }
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('permissions')) {
            if (Schema::hasColumn('permissions', 'name')) {
                // For SQLite, drop unique constraint before column
                if (config('database.default') !== 'sqlite') {
                    Schema::table('permissions', function (Blueprint $table) {
                        try {
                            $table->dropUnique('permissions_name_unique');
                        } catch (\Exception $e) {
                            // Constraint doesn't exist
                        }
                    });
                }

                Schema::table('permissions', function (Blueprint $table) {
                    $table->dropColumn('name');
                });
            }

            if (Schema::hasColumn('permissions', 'guard_name')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->dropColumn('guard_name');
                });
            }
        }
    }
};
