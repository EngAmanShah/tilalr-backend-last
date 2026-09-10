<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ContactInfoSeeder::class,
            TrainingSeeder::class,
            CreateSuperAdminSeeder::class,
            RolePermissionSeeder::class,
            // PermissionSeeder::class, // ← COMMENT THIS OUT
            TourismOfferSeeder::class,
            TourismDestinationsSeeder::class,
        ]);
    }
}
