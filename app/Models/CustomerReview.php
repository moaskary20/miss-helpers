<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_image',
        'rating',
        'job_title',
        'service_received',
        'description',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function getRatingStarsAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }

    public function getRatingTextAttribute()
    {
        $ratings = [
            1 => 'ضعيف جداً',
            2 => 'ضعيف',
            3 => 'مقبول',
            4 => 'جيد',
            5 => 'ممتاز'
        ];
        
        return $ratings[$this->rating] ?? 'غير محدد';
    }
}
