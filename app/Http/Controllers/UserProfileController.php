<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Maid;
use App\Models\ServiceRequest;

class UserProfileController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * عرض صفحة البروفيل
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.login');
        }
        
        // جلب الخادمات المرتبطة بالعميل من خلال طلبات الخدمة
        $userMaids = collect();
        
        // البحث عن طلبات الخدمة المرتبطة بالمستخدم
        if ($user->phone) {
            $userServiceRequests = ServiceRequest::where('user_id', $user->id)
                ->orWhere('phone', $user->phone)
                ->with('maid')
                ->get();
                
            $userMaids = $userServiceRequests
                ->pluck('maid')
                ->unique('id')
                ->filter();
        }
            
        // جلب آراء العميل
        $userReviews = $user->reviews()->with('maid')->get();
        
        return view('user.profile', compact('user', 'userMaids', 'userReviews'));
    }

    /**
     * تحديث معلومات البروفيل
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'تم تحديث معلومات البروفيل بنجاح');
    }

    /**
     * تحديث كلمة المرور
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        // التحقق من كلمة المرور الحالية
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة'])
                ->withInput();
        }

        // تحديث كلمة المرور
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'تم تحديث كلمة المرور بنجاح');
    }

    /**
     * إضافة رأي جديد
     */
    public function storeReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maid_id' => 'required|exists:maids,id',
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        
        // التحقق من أن العميل تعامل مع هذه الخادمة
        $hasServiceRequest = ServiceRequest::where('user_id', $user->id)
            ->where('maid_id', $request->maid_id)
            ->exists();
            
        if (!$hasServiceRequest) {
            return redirect()->back()
                ->withErrors(['maid_id' => 'لم تتعامل مع هذه الخادمة من قبل'])
                ->withInput();
        }
        
        $review = $user->reviews()->create([
            'maid_id' => $request->maid_id,
            'title' => $request->title,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'تم إرسال رأيك بنجاح، سيتم مراجعته قريباً');
    }

    /**
     * عرض صفحة تعديل الرأي
     */
    public function editReview($id)
    {
        $user = Auth::user();
        $review = $user->reviews()->findOrFail($id);
        
        return view('user.review-edit', compact('review'));
    }

    /**
     * تحديث الرأي
     */
    public function updateReview(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $review = $user->reviews()->findOrFail($id);
        
        $review->update([
            'title' => $request->title,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // إعادة تعيين الحالة للانتظار
        ]);

        return redirect()->route('user.profile')->with('success', 'تم تحديث رأيك بنجاح');
    }

    /**
     * حذف الرأي
     */
    public function deleteReview($id)
    {
        $user = Auth::user();
        $review = $user->reviews()->findOrFail($id);
        
        $review->delete();

        return redirect()->back()->with('success', 'تم حذف رأيك بنجاح');
    }
}
