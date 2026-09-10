<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasResourcePermissions
{
    /**
     * Get the resource permission key
     * Override by declaring protected static ?string $permissionKey = 'custom_key'; in Resource
     */
    public static function getPermissionKey(): string
    {
        if (property_exists(static::class, 'permissionKey') && static::$permissionKey) {
            return static::$permissionKey;
        }

        $className = class_basename(static::class);
        $modelName = str_replace('Resource', '', $className);
        return Str::plural(Str::snake($modelName));
    }

    protected static function isSuperAdmin($user): bool
    {
        if (!$user) return false;
        
        // ONLY users with the super_admin role get full permission bypass
        return (bool) ($user->hasRole('super_admin') || $user->hasRole('Super Admin'));
    }

    /**
     * Check if current user can view the resource list
     */
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        
        if (static::isSuperAdmin($user)) return true;
        
        $key = static::getPermissionKey();
        return $user->hasPermission("{$key}.view_any")
            || $user->hasPermission("{$key}.view")
            || $user->hasPermission("view_{$key}")
            || $user->hasPermission("manage_{$key}");
    }

    /**
     * Check if current user can view a specific record
     */
    public static function canView(Model $record): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        
        if (static::isSuperAdmin($user)) return true;
        
        $key = static::getPermissionKey();
        return $user->hasPermission("{$key}.view")
            || $user->hasPermission("{$key}.view_any")
            || $user->hasPermission("view_{$key}")
            || $user->hasPermission("manage_{$key}");
    }

    /**
     * Check if current user can create new records
     */
    public static function canCreate(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        
        if (static::isSuperAdmin($user)) return true;
        
        $key = static::getPermissionKey();
        return $user->hasPermission("{$key}.create")
            || $user->hasPermission("create_{$key}")
            || $user->hasPermission("manage_{$key}");
    }

    /**
     * Check if current user can edit a record
     */
    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        
        if (static::isSuperAdmin($user)) return true;
        
        $key = static::getPermissionKey();
        return $user->hasPermission("{$key}.update")
            || $user->hasPermission("{$key}.edit")
            || $user->hasPermission("edit_{$key}")
            || $user->hasPermission("manage_{$key}");
    }

    /**
     * Check if current user can delete a record
     */
    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        
        if (static::isSuperAdmin($user)) return true;
        
        $key = static::getPermissionKey();
        return $user->hasPermission("{$key}.delete")
            || $user->hasPermission("delete_{$key}")
            || $user->hasPermission("manage_{$key}");
    }

    /**
     * Check if user can access this resource at all
     */
    public static function canAccess(): bool
    {
        return static::canViewAny();
    }

    /**
     * Check if navigation item should be registered in sidebar.
     * Evaluates both user permissions and developer getNavigationMap() configuration.
     */
    public static function shouldRegisterNavigation(): bool
    {
        if (!static::canViewAny()) {
            return false;
        }

        if (method_exists(static::class, 'getNavigationGroup')) {
            $group = static::getNavigationGroup();
            if (is_string($group) && $group !== '') {
                $navMap = \App\Providers\Filament\AdminPanelProvider::getNavigationMap();
                
                $activeGroupNames = [];
                $addString = function ($val) use (&$activeGroupNames) {
                    if (is_string($val) && $val !== '') {
                        $activeGroupNames[] = mb_strtolower($val);
                    }
                };

                foreach ($navMap as $key => $item) {
                    $addString($key);
                    $translatedNav = __("admin.nav.{$key}");
                    if (is_string($translatedNav)) {
                        $addString($translatedNav);
                    }
                    if (isset($item['label']) && is_string($item['label'])) {
                        $addString($item['label']);
                    }
                    if (isset($item['tab_name']) && is_string($item['tab_name'])) {
                        $addString($item['tab_name']);
                    }
                    if (isset($item['groups']) && is_array($item['groups'])) {
                        foreach ($item['groups'] as $g) {
                            if (is_string($g)) {
                                $addString($g);
                                $transG = __($g);
                                if (is_string($transG)) {
                                    $addString($transG);
                                }
                            }
                        }
                    }
                }

                $groupLower = mb_strtolower($group);
                if (!in_array($groupLower, array_unique($activeGroupNames))) {
                    return false;
                }
            }
        }

        return true;
    }
}

