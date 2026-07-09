<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'booking_type')) {
                $table->string('booking_type')->default('destination')->after('user_id');
            }
            if (!Schema::hasColumn('bookings', 'guests')) {
                $table->integer('guests')->default(1)->after('booking_type');
            }
            if (!Schema::hasColumn('bookings', 'special_requests')) {
                $table->text('special_requests')->nullable()->after('notes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop columns only if they exist to avoid SQL errors during rollback
            if (Schema::hasColumn('bookings', 'booking_type')) {
                $table->dropColumn('booking_type');
            }

            if (Schema::hasColumn('bookings', 'guests')) {
                $table->dropColumn('guests');
            }

            if (Schema::hasColumn('bookings', 'special_requests')) {
                $table->dropColumn('special_requests');
            }
        });
    }
};
