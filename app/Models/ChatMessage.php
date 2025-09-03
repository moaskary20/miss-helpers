<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ChatMessage extends Model
{
    protected $fillable = [
        'chat_room_id',
        'sender_type',
        'sender_name',
        'message',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    public function chatRoom(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function getSenderTypeTextAttribute()
    {
        $types = [
            'visitor' => 'الزائر',
            'admin' => 'المدير'
        ];
        
        return $types[$this->sender_type] ?? $this->sender_type;
    }

    public function getSenderTypeColorAttribute()
    {
        $colors = [
            'visitor' => 'info',
            'admin' => 'primary'
        ];
        
        return $colors[$this->sender_type] ?? 'secondary';
    }

    public function isFromVisitor()
    {
        return $this->sender_type === 'visitor';
    }

    public function isFromAdmin()
    {
        return $this->sender_type === 'admin';
    }

    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
