<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'module'
    ];

    /**
     * Get role permissions for this permission
     */
    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class, 'permission_name', 'name');
    }

    /**
     * Get module display name
     */
    public function getModuleDisplayNameAttribute()
    {
        $modules = [
            'maids' => 'الخادمات',
            'blog' => 'المدونة',
            'categories' => 'الأقسام',
            'customer_reviews' => 'آراء العملاء',
            'service_requests' => 'الطلبات',
            'chat' => 'الشات',
            'users' => 'المستخدمين',
            'system' => 'النظام'
        ];
        
        return $modules[$this->module] ?? $this->module;
    }
}
