<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MaidController extends Controller
{
    /**
     * عرض جميع الخادمات مع إمكانية الفلترة المتقدمة
     */
    public function index(Request $request)
    {
        // تعيين اللغة من URL
        $segmentLocale = $request->segment(1);
        if (in_array($segmentLocale, ['ar', 'en'])) {
            App::setLocale($segmentLocale);
        }
        $query = Maid::query();

        // فلترة حسب الجنسية
        if ($request->filled('nationality')) {
            $query->where('nationality', $request->nationality);
        }

        // فلترة حسب نوع الخدمة
        if ($request->filled('service')) {
            $query->where('job_title', $request->service);
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

        // فلترة حسب العمر
        if ($request->filled('age_min')) {
            $query->where('age', '>=', $request->age_min);
        }
        
        if ($request->filled('age_max')) {
            $query->where('age', '<=', $request->age_max);
        }

        // فلترة حسب الراتب الشهري
        if ($request->filled('salary_min')) {
            $query->where('monthly_salary', '>=', $request->salary_min);
        }
        
        if ($request->filled('salary_max')) {
            $query->where('monthly_salary', '<=', $request->salary_max);
        }

        // فلترة حسب الديانة
        if ($request->filled('religion')) {
            $query->where('religion', $request->religion);
        }

        // فلترة حسب الحالة الاجتماعية
        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        // فلترة حسب اللغة
        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        // البحث النصي في الاسم والمهارات
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('skills', 'like', "%{$searchTerm}%")
                  ->orWhere('nationality', 'like', "%{$searchTerm}%")
                  ->orWhere('job_title', 'like', "%{$searchTerm}%");
            });
        }

        // ترتيب النتائج
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'age_asc':
                $query->orderBy('age', 'asc');
                break;
            case 'age_desc':
                $query->orderBy('age', 'desc');
                break;
            case 'experience_asc':
                $query->orderBy('experience_years', 'asc');
                break;
            case 'experience_desc':
                $query->orderBy('experience_years', 'desc');
                break;
            case 'salary_asc':
                $query->orderBy('monthly_salary', 'asc');
                break;
            case 'salary_desc':
                $query->orderBy('monthly_salary', 'desc');
                break;
            case 'views':
                $query->orderBy('views_count', 'desc');
                break;
            default:
                $query->latest();
        }

        // جلب النتائج مع العلاقات
        $maids = $query->with(['skills', 'workExperiences'])
                      ->paginate(12)
                      ->appends($request->query());

        // إحصائيات البحث
        $totalMaids = Maid::count();
        $filteredCount = $maids->total();
        
        // خيارات البحث المتاحة
        $searchOptions = [
            'nationalities' => Maid::distinct()->pluck('nationality')->filter()->sort()->values(),
            'jobTitles' => Maid::distinct()->pluck('job_title')->filter()->sort()->values(),
            'packageTypes' => Maid::distinct()->pluck('package_type')->filter()->sort()->values(),
            'religions' => Maid::distinct()->pluck('religion')->filter()->sort()->values(),
            'maritalStatuses' => Maid::distinct()->pluck('marital_status')->filter()->sort()->values(),
            'languages' => Maid::distinct()->pluck('language')->filter()->sort()->values(),
        ];

        return view('maid.all', compact('maids', 'searchOptions', 'totalMaids', 'filteredCount'));
    }

    /**
     * عرض الملف الشخصي للخادمة
     */
    public function show($id, Request $request)
    {
        // تعيين اللغة من URL
        $segmentLocale = $request->segment(1);
        if (in_array($segmentLocale, ['ar', 'en'])) {
            App::setLocale($segmentLocale);
        }
        
        $maid = Maid::with(['skills', 'workExperiences', 'reviews'])->findOrFail($id);
        
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
