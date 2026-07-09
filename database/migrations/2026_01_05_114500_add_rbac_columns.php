<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove AFTER clauses
            if (!Schema::hasColumn('users', 'permissions')) {
                $table->json('permissions')->nullable();
            }
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')->nullable()->constrained()->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        // Only attempt to drop columns if they exist
        if (Schema::hasTable('users')) {
            $hasPermissions = Schema::hasColumn('users', 'permissions');
            $hasRoleId = Schema::hasColumn('users', 'role_id');

            // Find any foreign key constraint name for role_id
            $fkName = null;
            if ($hasRoleId) {
                $fks = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'users' AND COLUMN_NAME = 'role_id' AND REFERENCED_TABLE_NAME IS NOT NULL");
                if (!empty($fks)) {
                    $fkName = $fks[0]->CONSTRAINT_NAME;
                }
            }

            Schema::table('users', function (Blueprint $table) use ($hasPermissions, $hasRoleId, $fkName) {
                if ($fkName) {
                    // drop foreign key by name
                    $table->dropForeign($fkName);
                }

                if ($hasPermissions && Schema::hasColumn('users', 'permissions')) {
                    $table->dropColumn('permissions');
                }

                if ($hasRoleId && Schema::hasColumn('users', 'role_id')) {
                    $table->dropColumn('role_id');
                }
            });
        }
    }
};
