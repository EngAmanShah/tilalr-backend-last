<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Seed some default partner logos
        DB::table('partners')->insert([
            [
                'name' => 'Saudia Airlines',
                'logo' => 'partners/saudia.png',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flynas',
                'logo' => 'partners/flynas.png',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Saudi Tourism Authority',
                'logo' => 'partners/sta.png',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moyasar',
                'logo' => 'partners/moyasar.png',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mada',
                'logo' => 'partners/mada.png',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
