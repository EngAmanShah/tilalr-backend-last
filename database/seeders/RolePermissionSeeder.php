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
                    'view_international_destinations', 'create_international_destinations', 'edit_international_destinations', 'delete_international_destinations',
                    'view_international_flights', 'create_international_flights', 'edit_international_flights', 'delete_international_flights',
                    'view_international_hotels', 'create_international_hotels', 'edit_international_hotels', 'delete_international_hotels',
                    'view_international_packages', 'create_international_packages', 'edit_international_packages', 'delete_international_packages',
                    'view_island_destinations', 'create_island_destinations', 'edit_island_destinations', 'delete_island_destinations',
                    'view_contacts', 'manage_contacts',
                    'view_reservations', 'manage_reservations',
                    'view_bookings', 'manage_bookings',
                ]
            ],
            [
                'name' => 'consultant',
                'title_en' => 'Consultant',
                'title_ar' => 'استشاري',
                'display_name' => 'Consultant',
                'description' => 'Access to island destinations, offers, services, trips, contacts, reservations and bookings',
                'permissions' => [
                    'view_island_destinations', 'create_island_destinations', 'edit_island_destinations', 'delete_island_destinations',
                    'view_offers', 'create_offers', 'edit_offers', 'delete_offers',
                    'view_special_offers', 'create_special_offers', 'edit_special_offers', 'delete_special_offers',
                    'view_services', 'create_services', 'edit_services', 'delete_services',
                    'view_trips', 'create_trips', 'edit_trips', 'delete_trips',
                    'view_contacts', 'manage_contacts',
                    'view_reservations', 'manage_reservations',
                    'view_bookings', 'manage_bookings',
                ]
            ],
            [
                'name' => 'administration',
                'title_en' => 'Administration',
                'title_ar' => 'إدارة',
                'display_name' => 'Administration',
                'description' => 'Access only to communications management',
                'permissions' => [
                    'view_contacts', 'manage_contacts',
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

