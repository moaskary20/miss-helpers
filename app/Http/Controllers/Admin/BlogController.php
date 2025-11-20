<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->only([
            'title',
            'category_id',
            'excerpt',
            'content',
            'status',
            'is_featured',
            'meta_title',
            'meta_description'
        ]);
        
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->boolean('is_featured');
        
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        // معالجة الصورة المميزة - فقط إذا تم رفع ملف جديد
        if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
            $data['featured_image'] = $request->file('featured_image')->store('blog/images', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'تم إنشاء الموضوع بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('category')->findOrFail($id);
        return view('admin.blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        return view('admin.blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->only([
            'title',
            'category_id',
            'excerpt',
            'content',
            'status',
            'is_featured',
            'meta_title',
            'meta_description'
        ]);
        
        $data['slug'] = Str::slug($request->title);
        $data['is_featured'] = $request->boolean('is_featured');
        
        if ($request->status === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        // معالجة الصورة المميزة
        if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
            // حفظ الصورة الجديدة أولاً
            $imagePath = $request->file('featured_image')->store('blog/images', 'public');
            
            // التحقق من أن الصورة تم حفظها بنجاح
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                // حذف الصورة القديمة إذا كانت موجودة (بعد التأكد من حفظ الجديدة)
                if ($post->featured_image && !str_starts_with($post->featured_image, 'http')) {
                    try {
                        Storage::disk('public')->delete($post->featured_image);
                    } catch (\Exception $e) {
                        // تجاهل الخطأ إذا لم تكن الصورة موجودة
                    }
                }
                // إضافة الصورة الجديدة إلى البيانات
                $data['featured_image'] = $imagePath;
            }
        }

        // تحديث البيانات - التأكد من تحديث featured_image إذا تم رفعها
        $post->update($data);
        
        // إعادة تحميل النموذج من قاعدة البيانات للتأكد من التحديث
        $post->refresh();

        // مسح الـ cache للموضوع
        Cache::forget("post_{$post->id}");
        Cache::forget("post_slug_{$post->slug}");

        return redirect()->route('admin.blog.index')
            ->with('success', 'تم تحديث الموضوع بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        
        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'تم حذف الموضوع بنجاح');
    }
}
