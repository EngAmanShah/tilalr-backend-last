<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name', // 'executive_manager', 'consultant', 'administration'
        'display_name', // 'Executive Manager'
        'description',
        'title_en', // legacy
        'title_ar', // legacy
        'description_en', // legacy
        'description_ar', // legacy
        'is_active',
        'sort_order',
        'allowed_modules',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'allowed_modules' => 'json',
    ];

    /**
<<<<<<< HEAD
     * Relationship: Role has many users
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')
            ->withTimestamps();
    }

    /**
<<<<<<< Updated upstream
     * Relationship: Role has many permissions
=======
     * Relationship: Role belongs to many permissions
>>>>>>> Stashed changes
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role')
            ->withTimestamps();
    }

    /**
     * Check if role has a specific permission
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

    /**
     * Check if role has any of the given permissions
     */
    public function hasAnyPermission(array $permissions): bool
    {
        return $this->permissions()->whereIn('name', $permissions)->exists();
    }
}
