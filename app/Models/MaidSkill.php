<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaidSkill extends Model
{
    protected $table = 'maid_skills';
    
    protected $fillable = [
        'maid_id',
        'skill_name',
        'english_name',
        'description',
        'english_description',
    ];

    // العلاقة مع الخادمة
    public function maid(): BelongsTo
    {
        return $this->belongsTo(Maid::class);
    }

    /**
     * الحصول على اسم المهارة باللغة المناسبة
     */
    public function getTranslatedSkillNameAttribute()
    {
        $locale = app()->getLocale();
        
        if ($locale === 'en' && $this->english_name) {
            return $this->english_name;
        }
        
        return $this->skill_name;
    }

    /**
     * الحصول على وصف المهارة باللغة المناسبة
     */
    public function getTranslatedDescriptionAttribute()
    {
        $locale = app()->getLocale();
        
        if ($locale === 'en' && $this->english_description) {
            return $this->english_description;
        }
        
        return $this->description;
    }
}
