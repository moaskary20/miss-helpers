<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
    protected $fillable = [
        'user_id',
        'maid_id',
        'title',
        'rating',
        'comment',
        'status'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    /**
     * Get the user that owns the review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the maid that this review is for
     */
    public function maid()
    {
        return $this->belongsTo(Maid::class);
    }

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
