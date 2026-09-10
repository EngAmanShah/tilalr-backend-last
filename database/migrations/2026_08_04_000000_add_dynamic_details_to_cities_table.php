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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cities');

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('country')->default('Saudi Arabia');
            $table->integer('order')->default(0);
            $table->string('lang', 10)->default('ar');
            $table->boolean('is_active')->default(true);
            $table->string('best_time')->nullable();
            $table->json('activities')->nullable();
            $table->json('landmarks')->nullable();
            $table->timestamps();

            $table->unique(['slug', 'lang']);
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cities');
        
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->string('country')->default('Saudi Arabia');
            $table->integer('order')->default(0);
            $table->string('lang', 10)->default('ar');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }
};
