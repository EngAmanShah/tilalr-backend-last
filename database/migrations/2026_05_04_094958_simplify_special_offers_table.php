<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // For an existing offers table, add/modify columns
        Schema::table('offers', function (Blueprint $table) {
            // Remove unused columns or make them nullable
            $table->string('title_en')->nullable()->change();
            $table->string('title_ar')->nullable()->change();
            $table->dropColumn([
                'title_zh', 'description_en', 'description_ar', 'description_zh',
                'duration', 'duration_en', 'duration_ar', 'duration_zh',
                'location_en', 'location_ar', 'location_zh', 'group_size',
                'group_size_en', 'group_size_ar', 'group_size_zh', 'discount',
                'price', 'price_en', 'price_ar', 'price_zh', 'badge',
                'badge_en', 'badge_ar', 'badge_zh'
            ]);

            // Add order_position if not exists
            if (!Schema::hasColumn('offers', 'order_position')) {
                $table->integer('order_position')->default(0);
            }
        });
    }

    public function down()
    {
        // Rollback not needed for this simple approach
    }
};
