<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schengen_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->enum('applicant_type', ['saudi', 'resident'])->default('saudi');
            $table->date('travel_date')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_family')->default(false);
            $table->json('travelers')->nullable(); // Store additional travelers
            $table->json('documents')->nullable(); // Store file paths
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected', 'completed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schengen_applications');
    }
};
