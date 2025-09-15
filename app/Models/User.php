<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'avatar',
        'role',
        'status',
        'permissions',
        'password',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'permissions' => 'array',
    ];

    /**
     * Get the user's avatar URL
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return Storage::url($this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the specified roles
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    /**
     * Check if user is moderator
     */
    public function isModerator()
    {
        return in_array($this->role, ['super_admin', 'admin', 'moderator']);
    }

    /**
     * Check if user is active
     */
    public function isActive()
    {
        return $this->status === 'active';
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
     * Get status display name
     */
    public function getStatusDisplayNameAttribute()
    {
        $statuses = [
            'active' => 'نشط',
            'inactive' => 'غير نشط',
            'suspended' => 'معلق'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * Get status color class
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'active' => 'success',
            'inactive' => 'secondary',
            'suspended' => 'danger'
        ];
        
        return $colors[$this->status] ?? 'secondary';
    }

    /**
     * Get role color class
     */
    public function getRoleColorAttribute()
    {
        $colors = [
            'super_admin' => 'danger',
            'admin' => 'primary',
            'moderator' => 'warning',
            'editor' => 'info'
        ];
        
        return $colors[$this->role] ?? 'secondary';
    }

    /**
     * Update last login information
     */
    public function updateLastLogin($ip = null)
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => $ip
        ]);
    }

    /**
     * Check if user has permission
     */
    public function hasPermission($permission, $action = 'view')
    {
        // Super admin has all permissions
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Check custom permissions if set
        if ($this->permissions && isset($this->permissions[$permission])) {
            return $this->permissions[$permission] === true || 
                   (is_array($this->permissions[$permission]) && 
                    in_array($action, $this->permissions[$permission]));
        }

        // Check role-based permissions
        $rolePermission = \App\Models\RolePermission::where('role', $this->role)
            ->where('permission_name', $permission)
            ->first();

        if ($rolePermission) {
            switch ($action) {
                case 'view':
                    return $rolePermission->can_view;
                case 'create':
                    return $rolePermission->can_create;
                case 'edit':
                    return $rolePermission->can_edit;
                case 'delete':
                    return $rolePermission->can_delete;
                default:
                    return false;
            }
        }

        return false;
    }

    /**
     * Get user activities
     */
    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    /**
     * Get user reviews
     */
    public function reviews()
    {
        return $this->hasMany(CustomerReview::class);
    }

    /**
     * Set password with hashing (only if not already hashed)
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value) && !Hash::needsRehash($value)) {
            // Password is already hashed, use as is
            $this->attributes['password'] = $value;
        } elseif (!empty($value)) {
            // Password is plain text, hash it
            $this->attributes['password'] = Hash::make($value);
        }
    }
}
