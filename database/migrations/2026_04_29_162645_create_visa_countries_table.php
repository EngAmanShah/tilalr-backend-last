<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('flag_emoji')->nullable();
            $table->string('flag_path')->nullable();
            $table->string('visa_type');
            $table->string('processing_time');
            $table->decimal('cost_per_person', 10, 2);
            $table->text('description');
            $table->json('documents')->nullable();
            $table->json('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_countries');
    }
};
