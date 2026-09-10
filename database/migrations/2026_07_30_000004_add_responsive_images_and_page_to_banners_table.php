<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            if (!Schema::hasColumn('banners', 'background_image_pc')) {
                $table->string('background_image_pc')->nullable()->after('background_image');
            }
            if (!Schema::hasColumn('banners', 'background_image_tablet')) {
                $table->string('background_image_tablet')->nullable()->after('background_image_pc');
            }
            if (!Schema::hasColumn('banners', 'background_image_mobile')) {
                $table->string('background_image_mobile')->nullable()->after('background_image_tablet');
            }
            if (!Schema::hasColumn('banners', 'page')) {
                $table->string('page')->nullable()->after('url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn([
                'background_image_pc',
                'background_image_tablet',
                'background_image_mobile',
                'page'
            ]);
        });
    }
};
