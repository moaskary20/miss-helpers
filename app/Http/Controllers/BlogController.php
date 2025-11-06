<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\App;

class BlogController extends Controller
{
    /**
     * عرض صفحة المدونة الرئيسية
     */
    public function index(Request $request)
    {
        // تعيين اللغة من URL
        $segmentLocale = $request->segment(1);
        if (in_array($segmentLocale, ['ar', 'en'])) {
            App::setLocale($segmentLocale);
        }
        
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
        // استخدام جدول categories بدلاً من blog_categories
        $categories = \App\Models\Category::all();
        
        return view('blog.index', compact('posts', 'categories'));
    }
    
    /**
     * عرض مقال واحد
     */
    public function show($slug, Request $request)
    {
        // تعيين اللغة من URL
        $segmentLocale = $request->segment(1);
        if (in_array($segmentLocale, ['ar', 'en'])) {
            App::setLocale($segmentLocale);
        }
        
        try {
            $post = BlogPost::with('category')
                ->where('slug', $slug)
                ->where('status', 'published')
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'المقال غير موجود أو غير منشور');
        }
            
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
    public function category($slug, Request $request)
    {
        // تعيين اللغة من URL
        $segmentLocale = $request->segment(1);
        if (in_array($segmentLocale, ['ar', 'en'])) {
            App::setLocale($segmentLocale);
        }
        
        $category = \App\Models\Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        $posts = BlogPost::with('category')
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);
            
        $categories = \App\Models\Category::all();
        
        return view('blog.index', compact('posts', 'categories', 'category'));
    }
}
