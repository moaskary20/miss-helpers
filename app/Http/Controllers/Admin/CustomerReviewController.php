<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = CustomerReview::orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.customer-reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer-reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'customer_location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $data = $request->all();
        $data['status'] = $request->status ?? 'active';

        if ($request->hasFile('customer_photo')) {
            $data['customer_photo'] = $request->file('customer_photo')->store('reviews/images', 'public');
        }

        CustomerReview::create($data);

        return redirect()->route('admin.customer-reviews.index')
            ->with('success', 'تم إضافة رأي العميل بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = CustomerReview::findOrFail($id);
        return view('admin.customer-reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = CustomerReview::findOrFail($id);
        return view('admin.customer-reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = CustomerReview::findOrFail($id);
        
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'customer_location' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $data = $request->all();
        $data['status'] = $request->status ?? 'active';

        if ($request->hasFile('customer_photo')) {
            if ($review->customer_photo) {
                Storage::disk('public')->delete($review->customer_photo);
            }
            $data['customer_photo'] = $request->file('customer_photo')->store('reviews/images', 'public');
        }

        $review->update($data);

        return redirect()->route('admin.customer-reviews.index')
            ->with('success', 'تم تحديث رأي العميل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = CustomerReview::findOrFail($id);
        
        if ($review->customer_photo) {
            Storage::disk('public')->delete($review->customer_photo);
        }
        
        $review->delete();

        return redirect()->route('admin.customer-reviews.index')
            ->with('success', 'تم حذف رأي العميل بنجاح');
    }
}
