<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'arabic_name',
        'english_name',
        'arabic_description',
        'english_description',
    ];

    /**
     * الحصول على الترجمة الإنجليزية للمهارة
     */
    public static function getEnglishName($arabicName)
    {
        $translation = self::where('arabic_name', $arabicName)->first();
        return $translation ? $translation->english_name : $arabicName;
    }

    /**
     * الحصول على الوصف الإنجليزي للمهارة
     */
    public static function getEnglishDescription($arabicDescription)
    {
        $translation = self::where('arabic_description', $arabicDescription)->first();
        return $translation ? $translation->english_description : $arabicDescription;
    }

    /**
     * الحصول على جميع المهارات مع ترجماتها
     */
    public static function getAllSkills()
    {
        return self::all();
    }

    /**
     * الحصول على قائمة المهارات العربية
     */
    public static function getArabicSkills()
    {
        return self::pluck('arabic_name')->toArray();
    }

    /**
     * الحصول على قائمة المهارات الإنجليزية
     */
    public static function getEnglishSkills()
    {
        return self::pluck('english_name')->toArray();
    }
}