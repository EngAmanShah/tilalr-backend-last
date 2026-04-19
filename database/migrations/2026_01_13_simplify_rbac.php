<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Disable foreign key constraints temporarily
        Schema::disableForeignKeyConstraints();

        // Add allowed_modules to roles table
        if (Schema::hasTable('roles') && !Schema::hasColumn('roles', 'allowed_modules')) {
            Schema::table('roles', function (Blueprint $table) {
                // Create column as nullable first
                $table->json('allowed_modules')->nullable()->after('sort_order')->comment('List of modules this role can access');
            });

            // Populate with default empty array
            DB::table('roles')->whereNull('allowed_modules')->update(['allowed_modules' => '[]']);
            
            // Modify to NOT NULL with default
            DB::statement("ALTER TABLE `roles` MODIFY `allowed_modules` JSON NOT NULL DEFAULT '[]' COMMENT 'List of modules this role can access'");
        }

        // Drop permission-related junction tables
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('role_user');

        // Drop permissions and related tables
        Schema::dropIfExists('permissions');

        // Drop unnecessary models
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('hero_sections');
        Schema::dropIfExists('contact_infos');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('about_sections');

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        // This is a destructive migration - rollback will not recreate tables
        // You would need to re-run your original migrations if needed
    }
};
