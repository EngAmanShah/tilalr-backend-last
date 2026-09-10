<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('background_image')->nullable();
            $table->string('sentence_en')->nullable();
            $table->string('sentence_ar')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_text_ar')->nullable();
            $table->string('url')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Seed two default banners
        DB::table('banners')->insert([
            [
                'background_image' => 'banners/banner1.jpg',
                'sentence_en' => 'Explore our popular tour packages around the Kingdom',
                'sentence_ar' => 'استكشف باقاتنا السياحية الشهيرة في جميع أنحاء المملكة',
                'button_text_en' => 'View Offers',
                'button_text_ar' => 'عرض العروض',
                'url' => '/tousimoffers',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'background_image' => 'banners/banner2.jpg',
                'sentence_en' => 'Apply for your tourist visa or Schengen visa easily',
                'sentence_ar' => 'قدم على تأشيرتك السياحية أو الشنغن بكل سهولة',
                'button_text_en' => 'Apply Now',
                'button_text_ar' => 'قدّم الآن',
                'url' => '/visa',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
