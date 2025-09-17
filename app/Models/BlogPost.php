<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'published_at',
        'category_id',
        'author_id',
        'slug',
        'meta_title',
        'meta_description',
        'tags'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'tags' => 'array'
    ];

    /**
     * العلاقة مع الفئة
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * العلاقة مع الكاتب
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * نطاق للمواضيع المنشورة
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * نطاق للمواضيع المميزة
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * الحصول على URL للموضوع
     */
    public function getUrlAttribute()
    {
        return route('blog.show', ['locale' => app()->getLocale(), 'slug' => $this->slug]);
    }

    /**
     * الحصول على صورة مصغرة
     */
    public function getThumbnailAttribute()
    {
        return $this->featured_image ?: '/images/default-blog.jpg';
    }
}
