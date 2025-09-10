<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'maid_id',
        'name',
        'phone',
        'service_type',
        'nationality',
        'emirate',
        'notes',
        'status',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // قائمة أنواع الخدمات
    public static function getServiceTypes()
    {
        return [
            'خادمه منزليه' => 'خادمه منزليه',
            'جليسه اطفال' => 'جليسه اطفال',
            'طباخه' => 'طباخه',
            'مقدمه رعاية' => 'مقدمه رعاية',
            'سائق' => 'سائق'
        ];
    }

    // قائمة الجنسيات
    public static function getNationalities()
    {
        return [
            'سيرلنكا' => 'سيرلنكا',
            'كينيا' => 'كينيا',
            'اقيوبيا' => 'اقيوبيا',
            'اندونسيا' => 'اندونسيا',
            'الفلبين' => 'الفلبين',
            'اوعندا' => 'اوعندا',
            'مينمار' => 'مينمار'
        ];
    }

    // قائمة الإمارات
    public static function getEmirates()
    {
        return [
            'راس الخيمة' => 'راس الخيمة',
            'ام القوين' => 'ام القوين',
            'الشارقه' => 'الشارقه',
            'عجمان' => 'عجمان',
            'ابوظبي' => 'ابوظبي',
            'دبي' => 'دبي',
            'العين' => 'العين'
        ];
    }

    // قائمة حالات الطلب
    public static function getStatuses()
    {
        return [
            'تحت المراجعه' => 'تحت المراجعه',
            'تم التنفيذ' => 'تم التنفيذ'
        ];
    }

    // الحصول على لون الحالة
    public function getStatusColorAttribute()
    {
        return $this->status === 'تم التنفيذ' ? 'success' : 'warning';
    }

    // الحصول على نص الحالة
    public function getStatusTextAttribute()
    {
        return $this->status;
    }

    /**
     * Get the user that owns the service request
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the maid associated with the service request
     */
    public function maid()
    {
        return $this->belongsTo(Maid::class);
    }
}
