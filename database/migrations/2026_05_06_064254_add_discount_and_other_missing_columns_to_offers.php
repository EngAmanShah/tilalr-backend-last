<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            // Add discount column if it doesn't exist
            if (!Schema::hasColumn('offers', 'discount')) {
                $table->decimal('discount', 5, 2)->nullable()->default(0);
            }

            // Add price column if it doesn't exist (from migration 2026_01_10_000001_add_price_to_offers_table)
            if (!Schema::hasColumn('offers', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }

            // Add is_special_offer column if it doesn't exist
            if (!Schema::hasColumn('offers', 'is_special_offer')) {
                $table->boolean('is_special_offer')->default(false);
            }

            // Add slug column if it doesn't exist
            if (!Schema::hasColumn('offers', 'slug')) {
                $table->string('slug')->unique()->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $columns = ['discount', 'price', 'is_special_offer', 'slug'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('offers', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
