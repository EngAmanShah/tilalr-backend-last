<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Recreate permissions and permission_role tables.
     * These are dropped by 2026_01_13_simplify_rbac.php but needed by seeders.
     */
    public function up(): void
    {
        // Recreate permissions table first
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('display_name');
                $table->string('group')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        // Recreate permission_role table without FK
        if (!Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');
                $table->timestamps();
                $table->unique(['permission_id', 'role_id']);
            });
        }

        // Recreate role_user table without FK
        if (!Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('role_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();
                $table->unique(['role_id', 'user_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permissions');
    }
};
