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
        if (Schema::hasTable('trips') && Schema::hasTable('cities')) {
            if (Schema::hasColumn('trips', 'city_id')) {
                Schema::table('trips', function (Blueprint $table) {
                    try {
                        $table->foreign('city_id')
                            ->references('id')
                            ->on('cities')
                            ->onDelete('set null');
                    } catch (\Exception $e) {
                        // Foreign key might already exist, continue
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('trips')) {
            Schema::table('trips', function (Blueprint $table) {
                try {
                    $table->dropForeign('trips_city_id_foreign');
                } catch (\Exception $e) {
                    // Foreign key doesn't exist, continue
                }
            });
        }
    }
};
