<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = ServiceRequest::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.service-requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service-requests.create');
    }

    /**
     * Store a newly created resource in storage.
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
        $data['is_active'] = $request->has('is_active');

        ServiceRequest::create($data);

        return redirect()->route('admin.service-requests.index')
            ->with('success', 'تم إضافة الطلب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        return view('admin.service-requests.show', compact('serviceRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        return view('admin.service-requests.edit', compact('serviceRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        
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
        $data['is_active'] = $request->has('is_active');

        $serviceRequest->update($data);

        return redirect()->route('admin.service-requests.index')
            ->with('success', 'تم تحديث الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->delete();

        return redirect()->route('admin.service-requests.index')
            ->with('success', 'تم حذف الطلب بنجاح');
    }
}
