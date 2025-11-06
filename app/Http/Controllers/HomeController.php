<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use App\Models\BlogPost;
use App\Models\CustomerReview;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * عرض الصفحة الرئيسية
     */
    public function index()
    {
        try {
            // جلب أحدث 3 خادمات
            $latestMaids = Maid::latest()->take(3)->get();
        } catch (\Exception $e) {
            $latestMaids = collect();
        }
        
        try {
            // جلب أحدث 4 مواضيع من المدونة المنشورة فقط
            $latestPosts = BlogPost::with('category')
                ->where('status', 'published')
                ->latest('published_at')
                ->take(4)
                ->get();
        } catch (\Exception $e) {
            $latestPosts = collect();
        }
        
        try {
            // جلب آراء العملاء النشطة مرتبة حسب الترتيب ثم التاريخ
            $customerReviews = CustomerReview::where('status', 'active')
                ->orderBy('sort_order', 'asc')
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $customerReviews = collect();
        }
        
        return view('home', compact('latestMaids', 'customerReviews') + ['posts' => $latestPosts]);
    }
}
