<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('nationality');
            $table->string('passport_number');
            $table->string('visa_type');
            $table->date('travel_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('application_type')->default('saudi_visa');
            $table->string('locale')->default('ar');
            $table->enum('status', ['pending', 'processing', 'completed', 'rejected'])->default('pending');

            // File paths
            $table->string('passport_copy_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('other_documents_path')->nullable();

            $table->timestamps();

            // Indexes for better performance
            $table->index('email');
            $table->index('status');
            $table->index('application_type');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visa_applications');
    }
};
