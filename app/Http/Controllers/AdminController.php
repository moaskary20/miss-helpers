<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maid;
use App\Models\MaidSkill;
use App\Models\SkillTranslation;
use App\Models\WorkExperience;
use App\Models\Post;
use App\Models\Category;
use App\Models\CustomerReview;
use App\Models\ServiceRequest;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * عرض لوحة الإدارة الرئيسية
     */
    public function dashboard()
    {
        // Debug: Log dashboard access
        \Log::info('Admin dashboard accessed by user: ' . auth()->user()->email);
        
        $maidsCount = Maid::count();
        $recentMaids = Maid::latest()->take(5)->get();
        
        // إحصائيات المدونة
        $postsCount = Post::count();
        $publishedPostsCount = Post::where('status', 'published')->count();
        $categoriesCount = Category::count();
        $recentPosts = Post::with('category')->latest()->take(5)->get();
        
        // إحصائيات آراء العملاء
        $reviewsCount = CustomerReview::count();
        $activeReviewsCount = CustomerReview::where('status', 'active')->count();
        $averageRating = CustomerReview::avg('rating');
        $recentReviews = CustomerReview::latest()->take(5)->get();
        
        // إحصائيات الطلبات
        $requestsCount = ServiceRequest::count();
        $pendingRequestsCount = ServiceRequest::where('status', 'تحت المراجعه')->count();
        $completedRequestsCount = ServiceRequest::where('status', 'تم التنفيذ')->count();
        $recentRequests = ServiceRequest::latest()->take(5)->get();
        
        // إحصائيات الشات
        $chatRoomsCount = ChatRoom::count();
        $activeChatRoomsCount = ChatRoom::where('status', 'active')->count();
        
        // Check if unread_messages_count column exists
        try {
            $unreadMessagesCount = ChatRoom::sum('unread_messages_count');
        } catch (\Exception $e) {
            $unreadMessagesCount = 0; // Default value if column doesn't exist
        }
        
        $recentChatRooms = ChatRoom::with(['messages' => function($query) {
            $query->latest();
        }])->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'maidsCount', 
            'recentMaids', 
            'postsCount', 
            'publishedPostsCount', 
            'categoriesCount', 
            'recentPosts',
            'reviewsCount',
            'activeReviewsCount',
            'averageRating',
            'recentReviews',
            'requestsCount',
            'pendingRequestsCount',
            'completedRequestsCount',
            'recentRequests',
            'chatRoomsCount',
            'activeChatRoomsCount',
            'unreadMessagesCount',
            'recentChatRooms'
        ));
    }

    /**
     * عرض قائمة الخادمات في لوحة الإدارة
     */
    public function maidsIndex()
    {
        $maids = Maid::with(['skills', 'workExperiences'])->latest()->paginate(10);
        return view('admin.maids.index', compact('maids'));
    }

    /**
     * عرض صفحة إضافة خادمة جديدة
     */
    public function maidsCreate()
    {
        return view('admin.maids.create');
    }

    /**
     * حفظ خادمة جديدة
     */
    public function maidsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:61440', // 60MB max
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'religion' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'required|integer|min:18|max:65',
            'education' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'children_count' => 'required|integer|min:0|max:10',
            'experience_years' => 'nullable|numeric|min:0|max:50',
            'height' => 'nullable|numeric|min:100|max:250',
            'weight' => 'nullable|numeric|min:30|max:150',
            'package_type' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'contract_fees' => 'nullable|numeric|min:0',
            'monthly_salary' => 'nullable|numeric|min:0',
            'skills' => 'required|array|min:1',
            'skills.*.skill_name' => 'required|string|max:255',
            'skills.*.description' => 'nullable|string',
            'work_experiences' => 'required|array|min:1',
            'work_experiences.*.position' => 'required|string|max:255',
            'work_experiences.*.country' => 'required|string|max:255',
            'work_experiences.*.duration' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // التحقق من أن تاريخ النهاية بعد تاريخ البداية
        if ($request->has('work_experiences')) {
            foreach ($request->work_experiences as $index => $workData) {
                if (!empty($workData['start_date']) && !empty($workData['end_date'])) {
                    if (strtotime($workData['end_date']) <= strtotime($workData['start_date'])) {
                        return redirect()->back()
                            ->withErrors(['work_experiences.' . $index . '.end_date' => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية'])
                            ->withInput();
                    }
                }
            }
        }

        // جمع البيانات المطلوبة فقط
        $data = [];
        
        // الحقول المطلوبة
        $requiredFields = [
            'name',
            'nationality',
            'religion',
            'language',
            'birth_date',
            'age',
            'education',
            'marital_status',
            'children_count',
            'package_type',
            'job_title',
            'contract_type'
        ];
        
        // الحقول الاختيارية
        $optionalFields = [
            'experience_years',
            'height',
            'weight',
            'contract_fees',
            'monthly_salary',
            'service_type',
            'status',
            'work_type',
            'languages',
            'previous_experience'
        ];
        
        // جمع الحقول المطلوبة
        foreach ($requiredFields as $field) {
            if ($request->has($field) && $request->input($field) !== null) {
                $data[$field] = $request->input($field);
            }
        }
        
        // جمع الحقول الاختيارية (فقط إذا كانت موجودة وليست فارغة)
        foreach ($optionalFields as $field) {
            if ($request->has($field) && $request->input($field) !== null && $request->input($field) !== '') {
                $data[$field] = $request->input($field);
            }
        }
        
        // تعيين القيم الافتراضية للحقول المطلوبة إذا كانت مفقودة
        if (!isset($data['status'])) {
            $data['status'] = 'متاحة';
        }
        if (!isset($data['children_count'])) {
            $data['children_count'] = 0;
        }

        // رفع الفيديو
        if ($request->hasFile('video')) {
            try {
                $videoPath = $request->file('video')->store('maids/videos', 'public');
                $data['video_path'] = $videoPath;
            } catch (\Exception $e) {
                \Log::error('Error uploading video: ' . $e->getMessage());
            }
        }

        // رفع الصورة
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('maids/images', 'public');
                $data['image_path'] = $imagePath;
            } catch (\Exception $e) {
                \Log::error('Error uploading image: ' . $e->getMessage());
            }
        }

        // إنشاء الخادمة
        try {
            \Log::info('Creating maid with data: ' . json_encode($data));
            $maid = Maid::create($data);
            \Log::info('Maid created successfully with ID: ' . $maid->id);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database error creating maid: ' . $e->getMessage());
            \Log::error('SQL: ' . $e->getSql());
            \Log::error('Bindings: ' . json_encode($e->getBindings()));
            \Log::error('Data: ' . json_encode($data));
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ في قاعدة البيانات: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            \Log::error('Error creating maid: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Data: ' . json_encode($data));
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء إنشاء الخادمة: ' . $e->getMessage()]);
        }

        // إضافة المهارات مع الترجمة التلقائية
        if ($request->has('skills')) {
            try {
                foreach ($request->skills as $skillData) {
                    if (!empty($skillData['skill_name'])) {
                        // الحصول على الترجمة الإنجليزية
                        $translation = SkillTranslation::where('arabic_name', $skillData['skill_name'])->first();
                        
                        $skillData['english_name'] = $translation ? $translation->english_name : $skillData['skill_name'];
                        
                        // إضافة الترجمة الإنجليزية للوصف إذا كان موجود
                        if (isset($skillData['description']) && !empty($skillData['description'])) {
                            $translationDesc = SkillTranslation::where('arabic_description', $skillData['description'])->first();
                            $skillData['english_description'] = $translationDesc ? $translationDesc->english_description : $skillData['description'];
                        }
                        
                        $maid->skills()->create($skillData);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Error creating skills: ' . $e->getMessage());
                // لا نوقف العملية، فقط نسجل الخطأ
            }
        }

        // إضافة خبرات العمل
        if ($request->has('work_experiences')) {
            try {
                foreach ($request->work_experiences as $index => $workData) {
                    // التحقق من وجود البيانات المطلوبة (position, country, duration)
                    if (!empty($workData['position']) && !empty($workData['country']) && !empty($workData['duration'])) {
                        // التأكد من وجود البيانات المطلوبة
                        $workData['start_date'] = $workData['start_date'] ?? now()->format('Y-m-d');
                        $workData['end_date'] = $workData['end_date'] ?? null;
                        $workData['description'] = $workData['description'] ?? null;
                        $workData['company_name'] = $workData['company_name'] ?? null;
                        $workData['work_type'] = $workData['work_type'] ?? null;
                        
                        $maid->workExperiences()->create($workData);
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Error creating work experiences: ' . $e->getMessage());
                // لا نوقف العملية، فقط نسجل الخطأ
            }
        }

        return redirect()->route('admin.maids.index')
            ->with('success', 'تم إضافة الخادمة بنجاح');
    }

    /**
     * عرض تفاصيل خادمة
     */
    public function maidsShow($id)
    {
        $maid = Maid::with(['skills', 'workExperiences'])->findOrFail($id);
        return view('admin.maids.show', compact('maid'));
    }

    /**
     * عرض صفحة تعديل خادمة
     */
    public function maidsEdit($id)
    {
        $maid = Maid::with(['skills', 'workExperiences'])->findOrFail($id);
        return view('admin.maids.edit', compact('maid'));
    }

    /**
     * تحديث بيانات خادمة
     */
    public function maidsUpdate(Request $request, $id)
    {
        $maid = Maid::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:61440', // 60MB max
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'religion' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'age' => 'required|integer|min:18|max:65',
            'education' => 'required|string|max:255',
            'marital_status' => 'required|string|max:255',
            'children_count' => 'required|integer|min:0|max:10',
            'experience_years' => 'nullable|numeric|min:0|max:50',
            'height' => 'nullable|numeric|min:100|max:250',
            'weight' => 'nullable|numeric|min:30|max:150',
            'package_type' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'contract_fees' => 'nullable|numeric|min:0',
            'monthly_salary' => 'nullable|numeric|min:0',
            'skills' => 'required|array|min:1',
            'skills.*.skill_name' => 'required|string|max:255',
            'skills.*.description' => 'nullable|string',
            'work_experiences' => 'required|array|min:1',
            'work_experiences.*.position' => 'required|string|max:255',
            'work_experiences.*.country' => 'required|string|max:255',
            'work_experiences.*.duration' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // التحقق من أن تاريخ النهاية بعد تاريخ البداية
        if ($request->has('work_experiences')) {
            foreach ($request->work_experiences as $index => $workData) {
                if (!empty($workData['start_date']) && !empty($workData['end_date'])) {
                    if (strtotime($workData['end_date']) <= strtotime($workData['start_date'])) {
                        return redirect()->back()
                            ->withErrors(['work_experiences.' . $index . '.end_date' => 'تاريخ النهاية يجب أن يكون بعد تاريخ البداية'])
                            ->withInput();
                    }
                }
            }
        }

        $data = $request->all();

        // إزالة المهارات وخبرات العمل من البيانات قبل تحديث الخادمة
        unset($data['skills']);
        unset($data['work_experiences']);

        // رفع فيديو جديد
        if ($request->hasFile('video')) {
            // حذف الفيديو القديم
            if ($maid->video_path) {
                Storage::disk('public')->delete($maid->video_path);
            }
            $videoPath = $request->file('video')->store('maids/videos', 'public');
            $data['video_path'] = $videoPath;
        }

        // رفع صورة جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($maid->image_path) {
                Storage::disk('public')->delete($maid->image_path);
            }
            $imagePath = $request->file('image')->store('maids/images', 'public');
            $data['image_path'] = $imagePath;
        }

        // تحديث بيانات الخادمة
        $maid->update($data);

        // تحديث المهارات مع الترجمة التلقائية
        $maid->skills()->delete();
        if ($request->has('skills')) {
            foreach ($request->skills as $skillData) {
                if (!empty($skillData['skill_name'])) {
                    // الحصول على الترجمة الإنجليزية
                    $translation = SkillTranslation::where('arabic_name', $skillData['skill_name'])->first();
                    
                    $skillData['english_name'] = $translation ? $translation->english_name : $skillData['skill_name'];
                    
                    // إضافة الترجمة الإنجليزية للوصف إذا كان موجود
                    if (isset($skillData['description']) && !empty($skillData['description'])) {
                        $translationDesc = SkillTranslation::where('arabic_description', $skillData['description'])->first();
                        $skillData['english_description'] = $translationDesc ? $translationDesc->english_description : $skillData['description'];
                    }
                    
                    $maid->skills()->create($skillData);
                }
            }
        }

        // تحديث خبرات العمل
        $maid->workExperiences()->delete();
        if ($request->has('work_experiences')) {
            foreach ($request->work_experiences as $index => $workData) {
                
                // التحقق من وجود البيانات المطلوبة (position, country, duration)
                if (!empty($workData['position']) && !empty($workData['country']) && !empty($workData['duration'])) {
                    // التأكد من وجود البيانات المطلوبة
                    $workData['start_date'] = $workData['start_date'] ?? now()->format('Y-m-d');
                    $workData['end_date'] = $workData['end_date'] ?? null;
                    $workData['description'] = $workData['description'] ?? null;
                    $workData['company_name'] = $workData['company_name'] ?? null;
                    $workData['work_type'] = $workData['work_type'] ?? null;
                    
                    $maid->workExperiences()->create($workData);
                }
            }
        }

        return redirect()->route('admin.maids.index')
            ->with('success', 'تم تحديث بيانات الخادمة بنجاح');
    }

    /**
     * حذف خادمة
     */
    public function maidsDestroy($id)
    {
        $maid = Maid::findOrFail($id);

        // حذف الملفات
        if ($maid->video_path) {
            Storage::disk('public')->delete($maid->video_path);
        }
        if ($maid->image_path) {
            Storage::disk('public')->delete($maid->image_path);
        }

        // حذف الخادمة (سيتم حذف المهارات وخبرات العمل تلقائياً بسبب cascade)
        $maid->delete();

        return redirect()->route('admin.maids.index')
            ->with('success', 'تم حذف الخادمة بنجاح');
    }
}