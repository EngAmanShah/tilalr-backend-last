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
        Schema::create('private_jet_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('client_type'); // Businessman, Hajj, Football Team, Government Entity, Medical Evacuation, Other
            $table->string('mobile_number');
            $table->string('email');
            $table->integer('number_of_people');
            $table->string('destination');
            $table->string('departure_airport');
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->longText('special_requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_jet_requests');
    }
};
