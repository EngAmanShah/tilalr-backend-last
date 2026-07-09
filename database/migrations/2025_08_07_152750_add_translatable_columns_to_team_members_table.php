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
            $table->json('name')->nullable()->change();
            $table->json('role')->nullable()->change();
            $table->json('bio')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('team_members')) {
            Schema::table('team_members', function (Blueprint $table) {
                if (Schema::hasColumn('team_members', 'name')) {
                    $table->string('name')->change();
                }
                if (Schema::hasColumn('team_members', 'role')) {
                    $table->string('role')->change();
                }
                if (Schema::hasColumn('team_members', 'bio')) {
                    $table->text('bio')->change();
                }
            });
        }
    }
};
