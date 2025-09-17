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
        $packageType = $request->get('package');
        
        // إذا تم اختيار باقة، توجيه إلى صفحة الخادمات مع الفلتر
        if ($packageType) {
            return redirect()->route('maids.all', [
                'locale' => app()->getLocale(),
                'package_type' => $packageType
            ]);
        }
        
        return view('service.index');
    }
}
