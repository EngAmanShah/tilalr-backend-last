<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AssignSuperAdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'superadmin@tilalr.com')->first();
        $role = Role::where('name', 'super_admin')->first();

        if (!$user) {
            echo "User not found!\n";
            return;
        }

        if (!$role) {
            echo "super_admin role not found!\n";
            return;
        }

        $user->roles()->sync([$role->id]);
        echo "Assigned super_admin role to {$user->email}\n";
    }
}
