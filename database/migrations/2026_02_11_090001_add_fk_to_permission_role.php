<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Add foreign key constraints to pivot tables.
     */
    public function up(): void
    {
        // Add FKs to permission_role (skip if constraint already exists)
        if (Schema::hasTable('permission_role') && Schema::hasTable('permissions') && Schema::hasTable('roles')) {
            $dbName = DB::getDatabaseName();
            $existsPermissionFk = (bool) DB::selectOne("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ?", [$dbName, 'permission_role', 'permission_role_permission_id_foreign']);
            $existsRoleFk = (bool) DB::selectOne("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ?", [$dbName, 'permission_role', 'permission_role_role_id_foreign']);

            Schema::table('permission_role', function (Blueprint $table) use ($existsPermissionFk, $existsRoleFk) {
                if (!$existsPermissionFk) {
                    $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
                }
                if (!$existsRoleFk) {
                    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                }
            });
        }

        // Add FKs to role_user (skip if constraint already exists)
        if (Schema::hasTable('role_user') && Schema::hasTable('roles') && Schema::hasTable('users')) {
            $dbName = DB::getDatabaseName();
            $existsRoleUserRoleFk = (bool) DB::selectOne("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ?", [$dbName, 'role_user', 'role_user_role_id_foreign']);
            $existsRoleUserUserFk = (bool) DB::selectOne("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ?", [$dbName, 'role_user', 'role_user_user_id_foreign']);

            Schema::table('role_user', function (Blueprint $table) use ($existsRoleUserRoleFk, $existsRoleUserUserFk) {
                if (!$existsRoleUserRoleFk) {
                    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                }
                if (!$existsRoleUserUserFk) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                }
            });
        }
    }

    public function down(): void
    {
        // Drop FKs from permission_role
        if (Schema::hasTable('permission_role')) {
            Schema::table('permission_role', function (Blueprint $table) {
                try {
                    $table->dropForeign('permission_role_permission_id_foreign');
                    $table->dropForeign('permission_role_role_id_foreign');
                } catch (\Exception $e) {
                    // FKs don't exist
                }
            });
        }

        // Drop FKs from role_user
        if (Schema::hasTable('role_user')) {
            Schema::table('role_user', function (Blueprint $table) {
                try {
                    $table->dropForeign('role_user_role_id_foreign');
                    $table->dropForeign('role_user_user_id_foreign');
                } catch (\Exception $e) {
                    // FKs don't exist
                }
            });
        }
    }
};
