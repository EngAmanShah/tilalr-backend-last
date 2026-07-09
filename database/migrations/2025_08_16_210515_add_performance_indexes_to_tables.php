<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes to projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('project_date');
            $table->index('slug');
        });

        // Add indexes to team_members table
        Schema::table('team_members', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('slug');
        });

        // Add indexes to services table
        Schema::table('services', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('slug');
        });

        // Add indexes to portfolios table
        Schema::table('portfolios', function (Blueprint $table) {
            $table->index('created_at');
        });

        // Add indexes to contact_messages table
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->dropIndexIfExists('projects', 'projects_created_at_index');
        $this->dropIndexIfExists('projects', 'projects_project_date_index');
        $this->dropIndexIfExists('projects', 'projects_slug_index');

        $this->dropIndexIfExists('team_members', 'team_members_created_at_index');
        $this->dropIndexIfExists('team_members', 'team_members_slug_index');

        $this->dropIndexIfExists('services', 'services_created_at_index');
        $this->dropIndexIfExists('services', 'services_slug_index');

        $this->dropIndexIfExists('portfolios', 'portfolios_created_at_index');

        $this->dropIndexIfExists('contact_messages', 'contact_messages_created_at_index');
    }

    private function dropIndexIfExists(string $tableName, string $indexName): void
    {
        if (!Schema::hasTable($tableName)) {
            return;
        }

        $indexExists = DB::select("SHOW INDEX FROM `{$tableName}` WHERE Key_name = ?", [$indexName]);
        if (empty($indexExists)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($indexName) {
            $table->dropIndex($indexName);
        });
    }
};
