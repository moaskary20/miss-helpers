<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maid;

class ServiceController extends Controller
{
    /**
     * عرض صفحة الخدمات
     */
    public function index(Request $request)
    {
        $packageType = $request->get('package', 'all');
        
        // جلب الخادمات حسب نوع الباقة
        $query = Maid::query();
        
        if ($packageType !== 'all') {
            $query->where('package_type', $packageType);
        }
        
        $maids = $query->with(['skills', 'workExperiences'])->get();
        
        return view('service.index', compact('maids', 'packageType'));
    }
}
