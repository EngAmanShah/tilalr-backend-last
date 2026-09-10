<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('sentence_en')->nullable()->change();
            $table->string('sentence_ar')->nullable()->change();
            $table->string('button_text_en')->nullable()->change();
            $table->string('button_text_ar')->nullable()->change();
            $table->string('url')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('sentence_en')->nullable(false)->change();
            $table->string('sentence_ar')->nullable(false)->change();
            $table->string('button_text_en')->nullable(false)->change();
            $table->string('button_text_ar')->nullable(false)->change();
            $table->string('url')->nullable(false)->change();
        });
    }
};
