<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('posts')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'is_active' => 'nullable|in:on,1,true',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم إنشاء القسم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('posts')->findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'is_active' => 'nullable|in:on,1,true',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->boolean('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم تحديث القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->posts()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'لا يمكن حذف القسم لوجود مواضيع مرتبطة به');
        }
        
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'تم حذف القسم بنجاح');
    }
}
