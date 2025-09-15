<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class ChatRoom extends Model
{
    protected $fillable = [
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'session_id',
        'status',
        'type',
        'initial_message',
        'assigned_admin',
        'is_read',
        'last_activity'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'last_activity' => 'datetime'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function getLastMessageAttribute()
    {
        return $this->messages()->latest()->first();
    }

    public function getUnreadMessagesCountAttribute()
    {
        return $this->messages()->where('is_read', false)->count();
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'active' => 'نشط',
            'closed' => 'مغلق',
            'pending' => 'في الانتظار'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    public function getTypeTextAttribute()
    {
        $types = [
            'live_chat' => 'شات مباشر',
            'leave_message' => 'ترك رسالة'
        ];
        
        return $types[$this->type] ?? $this->type;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'active' => 'success',
            'closed' => 'secondary',
            'pending' => 'warning'
        ];
        
        return $colors[$this->status] ?? 'secondary';
    }

    public function getTypeColorAttribute()
    {
        $colors = [
            'live_chat' => 'primary',
            'leave_message' => 'info'
        ];
        
        return $colors[$this->type] ?? 'secondary';
    }

    public function updateLastActivity()
    {
        $this->update(['last_activity' => now()]);
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               $this->last_activity && 
               $this->last_activity->diffInMinutes(now()) < 30;
    }
}
