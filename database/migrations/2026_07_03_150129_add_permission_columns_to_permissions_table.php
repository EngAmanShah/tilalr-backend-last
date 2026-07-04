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
        Schema::table('permissions', function (Blueprint $table) {
            if (Schema::hasColumn('permissions', 'name')) {
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('permissions', 'guard_name')) {
                $table->dropColumn('guard_name');
            }
        });
    }
};
