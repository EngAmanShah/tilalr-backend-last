<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add total_amount column if it doesn't exist
            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->nullable()->after('price');
            }

            // Add transaction_id column if it doesn't exist
            if (!Schema::hasColumn('bookings', 'transaction_id')) {
                $table->string('transaction_id')->nullable()->after('payment_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'total_amount')) {
                $table->dropColumn('total_amount');
            }
            if (Schema::hasColumn('bookings', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }
        });
    }
};
