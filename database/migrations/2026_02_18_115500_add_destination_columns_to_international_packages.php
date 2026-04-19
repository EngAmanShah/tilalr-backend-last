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
        Schema::table('international_packages', function (Blueprint $table) {
            $table->string('destination_en')->nullable()->after('title_ar');
            $table->string('destination_ar')->nullable()->after('destination_en');
            $table->string('destination_zh')->nullable()->after('destination_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('international_packages', function (Blueprint $table) {
            $table->dropColumn(['destination_en', 'destination_ar', 'destination_zh']);
        });
    }
};
