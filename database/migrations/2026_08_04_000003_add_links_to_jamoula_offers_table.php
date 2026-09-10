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
        Schema::table('jamoula_offers', function (Blueprint $table) {
            if (!Schema::hasColumn('jamoula_offers', 'tourism_offer_id')) {
                $table->foreignId('tourism_offer_id')->nullable()->constrained('tourism_offers')->onDelete('cascade');
            }
            if (!Schema::hasColumn('jamoula_offers', 'tourism_destination_id')) {
                $table->foreignId('tourism_destination_id')->nullable()->constrained('tourism_destinations')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jamoula_offers', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            if (Schema::hasColumn('jamoula_offers', 'tourism_offer_id')) {
                $table->dropForeign(['tourism_offer_id']);
                $table->dropColumn('tourism_offer_id');
            }
            if (Schema::hasColumn('jamoula_offers', 'tourism_destination_id')) {
                $table->dropForeign(['tourism_destination_id']);
                $table->dropColumn('tourism_destination_id');
            }
            Schema::enableForeignKeyConstraints();
        });
    }
};
