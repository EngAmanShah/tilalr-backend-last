<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Change this line - it should be RolePermissionSeeder, not PermissionSeeder
class RolePermissionSeeder extends Seeder  // ← Make sure this is RolePermissionSeeder
{
    public function run()
    {
        // Check if permissions table exists
        if (!Schema::hasTable('permissions')) {
            $this->command->warn('Permissions table does not exist. Skipping...');
            return;
        }

        // Get column names
        $columns = Schema::getColumnListing('permissions');
        $this->command->info('Available columns: ' . implode(', ', $columns));

        // Determine which column to use for permission name
        $nameColumn = null;
        if (in_array('name', $columns)) {
            $nameColumn = 'name';
        } elseif (in_array('title_en', $columns)) {
            $nameColumn = 'title_en';
        } elseif (in_array('slug', $columns)) {
            $nameColumn = 'slug';
        } else {
            $this->command->error('No suitable column found for permission name!');
            $this->command->info('Available columns: ' . implode(', ', $columns));
            return;
        }

        $this->command->info("Using column '{$nameColumn}' for permission names");

        // Define permissions
        $permissions = [
            'view_bookings',
            'create_bookings',
            'edit_bookings',
            'delete_bookings',
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'view_settings',
            'edit_settings',
        ];

        // Check if guard_name column exists
        $hasGuardName = in_array('guard_name', $columns);
        $hasTimestamps = in_array('created_at', $columns);

        // Insert permissions if they don't exist
        foreach ($permissions as $permission) {
            try {
                $existing = DB::table('permissions')
                    ->where($nameColumn, $permission)
                    ->first();

                if (!$existing) {
                    $data = [
                        $nameColumn => $permission,
                    ];

                    if ($hasGuardName) {
                        $data['guard_name'] = 'web';
                    }

                    if ($hasTimestamps) {
                        $data['created_at'] = now();
                        $data['updated_at'] = now();
                    }

                    DB::table('permissions')->insert($data);
                    $this->command->info("Created permission: {$permission}");
                } else {
                    $this->command->line("Permission already exists: {$permission}");
                }
            } catch (\Exception $e) {
                $this->command->error("Error creating permission {$permission}: " . $e->getMessage());
            }
        }

        $this->command->info('RolePermissionSeeder completed successfully!');
    }
}
