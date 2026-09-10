<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class RoleDisplayWidget extends Widget
{
    protected static string $view = 'filament.widgets.role-display-widget';

    protected static ?int $sort = -3;

    public function getRoleInfo()
    {
        $user = auth()->user();
        if (!$user) {
            return null;
        }

        $role = $user->roles()->first();
        $roleName = $role?->display_name;
        if ($role && \Illuminate\Support\Facades\Lang::has("roles.{$role->name}")) {
            $roleName = __("roles.{$role->name}");
        }

        return [
            'role_name' => $roleName ?? __('admin.no_role_assigned'),
            'user_name' => $user->name,
            'permissions_count' => $role?->permissions()->count() ?? 0,
        ];
    }
}
