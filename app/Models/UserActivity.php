<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'details',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'details' => 'array'
    ];

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get action display name
     */
    public function getActionDisplayNameAttribute()
    {
        $actions = [
            'login' => 'تسجيل دخول',
            'logout' => 'تسجيل خروج',
            'create' => 'إنشاء',
            'update' => 'تحديث',
            'delete' => 'حذف',
            'view' => 'عرض',
            'export' => 'تصدير',
            'import' => 'استيراد',
            'status_change' => 'تغيير الحالة',
            'permission_change' => 'تغيير الصلاحيات'
        ];
        
        return $actions[$this->action] ?? $this->action;
    }

    /**
     * Get action color class
     */
    public function getActionColorAttribute()
    {
        $colors = [
            'login' => 'success',
            'logout' => 'secondary',
            'create' => 'primary',
            'update' => 'warning',
            'delete' => 'danger',
            'view' => 'info',
            'export' => 'dark',
            'import' => 'dark',
            'status_change' => 'warning',
            'permission_change' => 'danger'
        ];
        
        return $colors[$this->action] ?? 'secondary';
    }

    /**
     * Get time ago
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Scope for recent activities
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for specific module
     */
    public function scopeModule($query, $module)
    {
        return $query->where('module', $module);
    }

    /**
     * Scope for specific action
     */
    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }
}
