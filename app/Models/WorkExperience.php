<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkExperience extends Model
{
    protected $fillable = [
        'maid_id',
        'company_name',
        'position',
        'country',
        'work_type',
        'duration',
        'start_date',
        'end_date',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // العلاقة مع الخادمة
    public function maid(): BelongsTo
    {
        return $this->belongsTo(Maid::class);
    }
}
