<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support MODIFY, so we need to use a different approach
        if (Schema::hasTable('users')) {
            // For SQLite, we need to recreate the table or use raw SQL
            // Option 1: Just check if the column exists and skip if it does
            if (Schema::hasColumn('users', 'email')) {
                // Since we can't modify in SQLite, we'll just add a new nullable email field
                // and keep the old one, or we can use raw SQL to handle it
                Schema::table('users', function (Blueprint $table) {
                    // Try to add a new column instead of modifying
                    if (!Schema::hasColumn('users', 'email_nullable')) {
                        $table->string('email_nullable')->nullable();
                    }
                });

                // Copy data from email to email_nullable
                if (Schema::hasColumn('users', 'email_nullable')) {
                    DB::table('users')->update([
                        'email_nullable' => DB::raw('email')
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'email_nullable')) {
                    $table->dropColumn('email_nullable');
                }
            });
        }
    }
};
