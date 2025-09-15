<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maid extends Model
{
    protected $fillable = [
        'name',
        'video_path',
        'image_path',
        'religion',
        'language',
        'birth_date',
        'age',
        'education',
        'height',
        'weight',
        'package_type',
        'job_title',
        'contract_type',
        'contract_fees',
        'monthly_salary',
        'nationality',
        'service_type',
        'experience_years',
        'status',
        'rating',
        'views_count',
        'reviews_count',
        'marital_status',
        'children_count',
        'work_type',
        'languages',
        'previous_experience',
        'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'contract_fees' => 'decimal:2',
        'monthly_salary' => 'decimal:2',
    ];

    // العلاقة مع المهارات
    public function skills(): HasMany
    {
        return $this->hasMany(MaidSkill::class);
    }

    // العلاقة مع الخبرات العملية
    public function workExperiences(): HasMany
    {
        return $this->hasMany(WorkExperience::class);
    }
}
