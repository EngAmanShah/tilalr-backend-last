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
        if (Schema::hasTable('permissions')) {
            Schema::table('permissions', function (Blueprint $table) {
                if (!Schema::hasColumn('permissions', 'display_name')) {
                    $table->string('display_name')->nullable()->after('name');
                }
                if (!Schema::hasColumn('permissions', 'group')) {
                    $table->string('group')->nullable()->after('display_name');
                }
                if (!Schema::hasColumn('permissions', 'description')) {
                    $table->text('description')->nullable()->after('group');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('permissions')) {
            Schema::table('permissions', function (Blueprint $table) {
                if (Schema::hasColumn('permissions', 'display_name')) {
                    $table->dropColumn('display_name');
                }
                if (Schema::hasColumn('permissions', 'group')) {
                    $table->dropColumn('group');
                }
                if (Schema::hasColumn('permissions', 'description')) {
                    $table->dropColumn('description');
                }
            });
        }
    }
};
