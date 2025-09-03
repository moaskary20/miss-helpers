<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * عرض صفحة المدونة الرئيسية
     */
    public function index(Request $request)
    {
        $query = BlogPost::with('category')->where('status', 'published');
        
        // فلترة حسب الفئة
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        // البحث
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }
        
        $posts = $query->latest('published_at')->paginate(9);
        $categories = BlogCategory::where('is_active', true)->get();
        
        return view('blog.index', compact('posts', 'categories'));
    }
    
    /**
     * عرض مقال واحد
     */
    public function show($slug)
    {
        $post = BlogPost::with('category', 'author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        $relatedPosts = BlogPost::with('category')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();
            
        return view('blog.show', compact('post', 'relatedPosts'));
    }
    
    /**
     * عرض مقالات حسب الفئة
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        $posts = BlogPost::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);
            
        $categories = BlogCategory::where('is_active', true)->get();
        
        return view('blog.index', compact('posts', 'categories', 'category'));
    }
}
