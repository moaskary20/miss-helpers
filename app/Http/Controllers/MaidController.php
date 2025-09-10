<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use Illuminate\Http\Request;

class MaidController extends Controller
{
    /**
     * عرض جميع الخادمات مع إمكانية الفلترة
     */
    public function index(Request $request)
    {
        $query = Maid::query();

        // فلترة حسب الجنسية
        if ($request->filled('nationality')) {
            $query->where('nationality', $request->nationality);
        }

        // فلترة حسب نوع الخدمة
        if ($request->filled('service')) {
            $query->where('service_type', $request->service);
        }

        // فلترة حسب سنوات الخبرة
        if ($request->filled('experience')) {
            switch ($request->experience) {
                case '1-3':
                    $query->whereBetween('experience_years', [1, 3]);
                    break;
                case '4-6':
                    $query->whereBetween('experience_years', [4, 6]);
                    break;
                case '7-10':
                    $query->whereBetween('experience_years', [7, 10]);
                    break;
                case '10+':
                    $query->where('experience_years', '>', 10);
                    break;
            }
        }

        // فلترة حسب نوع الباقة
        if ($request->filled('package_type')) {
            $query->where('package_type', $request->package_type);
        }

        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ترتيب حسب الأحدث
        $maids = $query->latest()->paginate(12);

        return view('maid.all', compact('maids'));
    }

    /**
     * عرض الملف الشخصي للخادمة
     */
    public function show($id)
    {
        $maid = Maid::findOrFail($id);
        
        // زيادة عدد المشاهدات
        $maid->increment('views_count');
        
        return view('maid.profile', compact('maid'));
    }

    /**
     * البحث في الخادمات
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $maids = Maid::where('name', 'like', "%{$query}%")
            ->orWhere('nationality', 'like', "%{$query}%")
            ->orWhere('skills', 'like', "%{$query}%")
            ->latest()
            ->paginate(12);
            
        return view('maid.all', compact('maids', 'query'));
    }

    /**
     * عرض الخادمات حسب الفئة
     */
    public function byCategory($category)
    {
        $maids = Maid::where('service_type', $category)
            ->latest()
            ->paginate(12);
            
        return view('maid.all', compact('maids', 'category'));
    }

    /**
     * عرض الخادمات حسب الجنسية
     */
    public function byNationality($nationality)
    {
        $maids = Maid::where('nationality', $nationality)
            ->latest()
            ->paginate(12);
            
        return view('maid.all', compact('maids', 'nationality'));
    }
}
