<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_position')->default(0);
            $table->timestamps();

            // Indexes
            $table->index('is_active');
            $table->index('order_position');
        });
    }

    public function down()
    {
        Schema::dropIfExists('special_offers');
    }
};
