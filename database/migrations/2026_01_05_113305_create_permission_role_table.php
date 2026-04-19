<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->id();
                // create columns only; foreign keys are added in a later migration to avoid duplicate-constraint errors
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');
                $table->timestamps();
                $table->unique(['permission_id', 'role_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
