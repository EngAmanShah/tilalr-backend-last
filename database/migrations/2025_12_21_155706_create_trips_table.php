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
        if (!Schema::hasTable('trips')) {
            Schema::create('trips', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->text('content')->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->integer('duration')->nullable();
                $table->string('image')->nullable();
                $table->json('images')->nullable();
                $table->string('video')->nullable();
                $table->string('type')->nullable();
                $table->json('highlights')->nullable();
                $table->string('group_size')->nullable();
                $table->string('city_name')->nullable();
                $table->unsignedBigInteger('city_id')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->integer('order')->default(0);
                $table->string('lang', 10)->default('ar');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
