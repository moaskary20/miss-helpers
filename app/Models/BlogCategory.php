<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'featured_image',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * العلاقة مع المواضيع
     */
    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    /**
     * نطاق للفئات النشطة
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * الحصول على URL للفئة
     */
    public function getUrlAttribute()
    {
        return route('blog.category', $this->slug);
    }

    /**
     * الحصول على عدد المواضيع في الفئة
     */
    public function getPostsCountAttribute()
    {
        return $this->posts()->count();
    }
}
