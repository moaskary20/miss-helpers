<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserActivity;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:super_admin,admin,moderator,editor',
            'status' => 'required|in:active,inactive,suspended',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['password_confirmation', 'avatar']);
        $data['password'] = $request->password;
        $data['email_verified_at'] = now();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $user = User::create($data);

        // Log activity
        auth()->user()->activities()->create([
            'action' => 'create',
            'module' => 'users',
            'description' => "إنشاء مستخدم جديد: {$user->name}",
            'details' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    /**
     * Display the specified user
     */
    public function show(string $id)
    {
        $user = User::with(['activities' => function($query) {
            $query->orderBy('created_at', 'desc')->take(20);
        }])->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:super_admin,admin,moderator,editor',
            'status' => 'required|in:active,inactive,suspended',
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['password', 'password_confirmation', 'avatar']);

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        $user->update($data);

        // Log activity
        auth()->user()->activities()->create([
            'action' => 'update',
            'module' => 'users',
            'description' => "تحديث بيانات المستخدم: {$user->name}",
            'details' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'changes' => $request->only(['name', 'username', 'email', 'phone', 'role', 'status'])
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'لا يمكنك حذف حسابك الخاص.');
        }

        // Prevent deleting super admin if you're not super admin
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return redirect()->back()->with('error', 'لا يمكنك حذف المدير العام.');
        }

        $userName = $user->name;

        // Delete avatar
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $user->delete();

        // Log activity
        auth()->user()->activities()->create([
            'action' => 'delete',
            'module' => 'users',
            'description' => "حذف المستخدم: {$userName}",
            'details' => [
                'user_id' => $id,
                'user_name' => $userName,
                'user_role' => $user->role
            ],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }

    /**
     * Change user status
     */
    public function changeStatus(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,inactive,suspended',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'الحالة غير صحيحة.'], 400);
        }

        // Prevent changing your own status
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'لا يمكنك تغيير حالة حسابك الخاص.'], 400);
        }

        $oldStatus = $user->status;
        $user->update(['status' => $request->status]);

        // Log activity
        auth()->user()->activities()->create([
            'action' => 'status_change',
            'module' => 'users',
            'description' => "تغيير حالة المستخدم {$user->name} من {$oldStatus} إلى {$request->status}",
            'details' => [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'old_status' => $oldStatus,
                'new_status' => $request->status
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return response()->json(['success' => 'تم تغيير الحالة بنجاح.']);
    }

    /**
     * Show user activities
     */
    public function activities(string $id)
    {
        $user = User::findOrFail($id);
        $activities = $user->activities()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.activities', compact('user', 'activities'));
    }

    /**
     * Get users statistics
     */
    public function getStats()
    {
        $stats = [
            'total' => User::count(),
            'active' => User::where('status', 'active')->count(),
            'inactive' => User::where('status', 'inactive')->count(),
            'suspended' => User::where('status', 'suspended')->count(),
            'super_admin' => User::where('role', 'super_admin')->count(),
            'admin' => User::where('role', 'admin')->count(),
            'moderator' => User::where('role', 'moderator')->count(),
            'editor' => User::where('role', 'editor')->count(),
        ];

        return response()->json($stats);
    }
}
