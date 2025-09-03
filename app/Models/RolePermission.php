<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
        'role',
        'permission_name',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete'
    ];

    protected $casts = [
        'can_view' => 'boolean',
        'can_create' => 'boolean',
        'can_edit' => 'boolean',
        'can_delete' => 'boolean'
    ];

    /**
     * Get the permission
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_name', 'name');
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayNameAttribute()
    {
        $roles = [
            'super_admin' => 'مدير عام',
            'admin' => 'مدير',
            'moderator' => 'مشرف',
            'editor' => 'محرر'
        ];
        
        return $roles[$this->role] ?? $this->role;
    }

    /**
     * Check if role has any permissions for this permission
     */
    public function hasAnyPermission()
    {
        return $this->can_view || $this->can_create || $this->can_edit || $this->can_delete;
    }
}
