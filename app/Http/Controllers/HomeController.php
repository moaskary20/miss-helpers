<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use App\Models\Post;
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
            // جلب أحدث 4 مواضيع من المدونة
            $latestPosts = Post::with('category')
                ->where('status', 'published')
                ->latest()
                ->take(4)
                ->get();
        } catch (\Exception $e) {
            $latestPosts = collect();
        }
        
        try {
            // جلب آراء العملاء
            $customerReviews = CustomerReview::where('status', 'active')
                ->latest()
                ->take(6)
                ->get();
        } catch (\Exception $e) {
            $customerReviews = collect();
        }
        
        return view('home', compact('latestMaids', 'customerReviews') + ['posts' => $latestPosts]);
    }
}
