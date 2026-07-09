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
        Schema::table('team_members', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('team_members') && Schema::hasColumn('team_members', 'role_id')) {
            Schema::table('team_members', function (Blueprint $table) {
                try {
                    $table->dropForeign(['role_id']);
                } catch (\Throwable $e) {
                    // foreign key may already be absent
                }

                $table->dropColumn('role_id');
            });
        }
    }
};
