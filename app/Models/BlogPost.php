<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'published_at',
        'category_id',
        'slug',
        'meta_title',
        'meta_description',
        'is_featured',
        'views_count'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean'
    ];

    /**
     * العلاقة مع الفئة
     */
    public function category()
    {
        // محاولة استخدام جدول categories أولاً
        if (Schema::hasTable('categories')) {
            return $this->belongsTo(\App\Models\Category::class, 'category_id');
        }
        // إذا لم يوجد، استخدم blog_categories
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * العلاقة مع الكاتب (اختياري - إذا كان الجدول يحتوي على author_id)
     * ملاحظة: هذا الجدول لا يحتوي على author_id حالياً
     */
    public function author()
    {
        // إذا كان الجدول يحتوي على author_id، استخدم العلاقة
        if (Schema::hasColumn($this->getTable(), 'author_id')) {
            return $this->belongsTo(User::class, 'author_id');
        }
        // إذا لم يكن موجوداً، أرجع علاقة فارغة باستخدام whereRaw لضمان عدم وجود نتائج
        return $this->belongsTo(User::class, 'id', 'id')
            ->whereRaw('1 = 0');
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
