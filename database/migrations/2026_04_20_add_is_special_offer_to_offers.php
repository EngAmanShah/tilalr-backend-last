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
        Schema::table('offers', function (Blueprint $table) {
            if (!Schema::hasColumn('offers', 'is_special_offer')) {
                $table->boolean('is_special_offer')->default(false)->after('is_active')->comment('Mark offers to appear in homepage special offers slider');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            if (Schema::hasColumn('offers', 'is_special_offer')) {
                $table->dropColumn('is_special_offer');
            }
        });
    }
};
