<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evisa_applications', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('country_slug');
            $table->string('passport_type');
            $table->string('visa_type');
            $table->string('interview_city');
            $table->date('date_of_birth');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected', 'completed'])->default('pending');
            $table->json('documents')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evisa_applications');
    }
};
