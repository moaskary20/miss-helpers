<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * عرض صفحة الاتصال بنا
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * حفظ طلب خدمة من النموذج العام
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'service_type' => 'required|in:خادمه منزليه,جليسه اطفال,طباخه,مقدمه رعاية,سائق',
            'nationality' => 'required|in:سيرلنكا,كينيا,اقيوبيا,اندونسيا,الفلبين,اوعندا,مينمار',
            'emirate' => 'required|in:راس الخيمة,ام القوين,الشارقه,عجمان,ابوظبي,دبي,العين',
            'notes' => 'nullable|string',
            'status' => 'required|in:تحت المراجعه,تم التنفيذ',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        ServiceRequest::create($data);

        return redirect()->route('contact.index')
            ->with('success', 'تم إرسال طلبك بنجاح! سنتواصل معك قريباً.');
    }
}
