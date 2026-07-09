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
        if (!Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                // make phone nullable to avoid breaking existing rows, add unique index
                $table->string('phone')->nullable()->unique()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only attempt to drop the unique index and column if the column exists
        if (Schema::hasColumn('users', 'phone')) {
            // Check if the unique index exists in the database
            $indexes = DB::select("SHOW INDEX FROM `users` WHERE Key_name = 'users_phone_unique'");

            Schema::table('users', function (Blueprint $table) use ($indexes) {
                if (!empty($indexes)) {
                    $table->dropUnique('users_phone_unique');
                }

                $table->dropColumn('phone');
            });
        }
    }
};
