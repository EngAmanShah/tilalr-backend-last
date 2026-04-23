<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // IMPORTANT: Run PermissionSeeder first to create all base permissions (113 total)
        // This ensures super_admin will get all of them
        $this->call(PermissionSeeder::class);

        // Define roles and their specific permissions
        // (These will be assigned in addition to what Filament auto-creates via resource policies)
        $rolesConfig = [
            [
                'name' => 'executive_manager',
                'title_en' => 'Executive Manager',
                'title_ar' => 'مدير تنفيذي',
                'display_name' => 'Executive Manager',
                'allowed_modules' => ["all"],
                'description' => 'Full access to all international and island destinations, flights, hotels, packages, contacts, reservations and bookings',
                'permissions' => [
                    'international_destinations.view_any', 'international_destinations.create', 'international_destinations.update', 'international_destinations.delete',
                    'international_flights.view_any', 'international_flights.create', 'international_flights.update', 'international_flights.delete',
                    'international_hotels.view_any', 'international_hotels.create', 'international_hotels.update', 'international_hotels.delete',
                    'international_packages.view_any', 'international_packages.create', 'international_packages.update', 'international_packages.delete',
                    'island_destinations.view_any', 'island_destinations.create', 'island_destinations.update', 'island_destinations.delete',
                    'contacts.view_any', 'contacts.create', 'contacts.update', 'contacts.delete',
                    'reservations.view_any', 'reservations.create', 'reservations.update', 'reservations.delete',
                    'bookings.view_any', 'bookings.create', 'bookings.update', 'bookings.delete',
                ]
            ],
            [
                'name' => 'consultant',
                'title_en' => 'Consultant',
                'title_ar' => 'استشاري',
                'display_name' => 'Consultant',
                'description' => 'Access to island destinations, offers, services, trips, contacts, reservations and bookings',
                'permissions' => [
                    'island_destinations.view_any', 'island_destinations.create', 'island_destinations.update', 'island_destinations.delete',
                    'offers.view_any', 'offers.create', 'offers.update', 'offers.delete',
                    'special_offers.view_any', 'special_offers.create', 'special_offers.update', 'special_offers.delete',
                    'services.view_any', 'services.create', 'services.update', 'services.delete',
                    'trips.view_any', 'trips.create', 'trips.update', 'trips.delete',
                    'contacts.view_any', 'contacts.create', 'contacts.update', 'contacts.delete',
                    'reservations.view_any', 'reservations.create', 'reservations.update', 'reservations.delete',
                    'bookings.view_any', 'bookings.create', 'bookings.update', 'bookings.delete',
                ]
            ],
            [
                'name' => 'content_manager',
                'title_en' => 'Content Manager',
                'title_ar' => 'مدير المحتوى',
                'display_name' => 'Content Manager',
                'description' => 'Access to content, offers, special offers, trips, services and settings',
                'permissions' => [
                    'offers.view_any', 'offers.create', 'offers.update', 'offers.delete',
                    'special_offers.view_any', 'special_offers.create', 'special_offers.update', 'special_offers.delete',
                    'services.view_any', 'services.create', 'services.update', 'services.delete',
                    'trips.view_any', 'trips.create', 'trips.update', 'trips.delete',
                    'settings.view_any', 'settings.create', 'settings.update', 'settings.delete',
                    'cities.view_any', 'cities.create', 'cities.update', 'cities.delete',
                ]
            ],
            [
                'name' => 'administration',
                'title_en' => 'Administration',
                'title_ar' => 'إدارة',
                'display_name' => 'Administration',
                'description' => 'Access only to communications management',
                'permissions' => [
                    'contacts.view_any', 'contacts.create', 'contacts.update', 'contacts.delete',
                ]
            ],
            [
                'name' => 'super_admin',
                'title_en' => 'Super Admin',
                'title_ar' => 'مسؤول فائق',
                'display_name' => 'Super Admin',
                'description' => 'Full access to all resources and settings',
                'permissions' => 'all' // Special marker - will get ALL permissions
            ],
        ];

        // Create roles with permissions
        foreach ($rolesConfig as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);

            $role = Role::firstOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );

            // Detach all current permissions first
            $role->permissions()->detach();

            // Attach permissions to role
            if ($permissions === 'all') {
                // Super Admin gets EVERY permission that was created by PermissionSeeder
                $allPermissions = Permission::all();
                $role->permissions()->attach($allPermissions);
                echo "✅ Super Admin: Assigned ALL " . $allPermissions->count() . " permissions\n";
            } else {
                // Other roles: only attach if the permission names exist in database
                // (These might be legacy permission names)
                if (!empty($permissions)) {
                    $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
                    if (!empty($permissionIds)) {
                        $role->permissions()->attach($permissionIds);
                        echo "✅ {$roleData['display_name']}: Assigned " . count($permissionIds) . " permissions\n";
                    } else {
                        echo "⚠️  {$roleData['display_name']}: No matching permissions found (expected - using Filament auto-permissions)\n";
                    }
                }
            }
        }

        // Verify super_admin got all permissions
        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole) {
            $totalPermissions = $superAdminRole->permissions()->count();
            echo "\n📋 Super Admin Role Summary:\n";
            echo "   Total permissions: $totalPermissions\n";
            echo "   Role: Super Admin\n";
            
            if ($totalPermissions > 0) {
                echo "   ✅ SUCCESS: Super Admin has permissions assigned!\n";
            } else {
                echo "   ❌ ERROR: Super Admin has no permissions!\n";
            }
        }
    }
}

