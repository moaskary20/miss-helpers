<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaidSkill extends Model
{
    protected $fillable = [
        'maid_id',
        'skill_name',
        'description',
    ];

    // العلاقة مع الخادمة
    public function maid(): BelongsTo
    {
        return $this->belongsTo(Maid::class);
    }
}
