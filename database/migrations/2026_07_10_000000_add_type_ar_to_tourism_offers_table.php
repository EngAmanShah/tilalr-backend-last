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
        Schema::table('tourism_offers', function (Blueprint $table) {
            if (!Schema::hasColumn('tourism_offers', 'type_ar')) {
                $table->string('type_ar')->nullable()->after('type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourism_offers', function (Blueprint $table) {
            $table->dropColumn('type_ar');
        });
    }
};
