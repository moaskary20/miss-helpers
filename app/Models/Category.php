<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getActivePostsCountAttribute()
    {
        return $this->posts()->where('status', 'published')->count();
    }
}
