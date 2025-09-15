<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Try to find user by email or username
        $user = User::where('email', $request->login)
                   ->orWhere('username', $request->login)
                   ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Check if user is active
            if (!$user->isActive()) {
                return redirect()->back()->with('error', 'حسابك معلق. يرجى التواصل مع الإدارة.');
            }

            // Check if user has admin access
            if (!$user->isModerator()) {
                return redirect()->back()->with('error', 'ليس لديك صلاحية للوصول للوحة الإدارة.');
            }

            // Login user
            Auth::login($user, $request->has('remember'));

            // Update last login
            $user->updateLastLogin($request->ip());

            // Log login activity (if activities table exists)
            try {
                $user->activities()->create([
                    'action' => 'login',
                    'module' => 'auth',
                    'description' => 'تسجيل دخول للوحة الإدارة',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            } catch (\Exception $e) {
                // Activities table doesn't exist, skip logging
            }

            // Debug: Log the redirect
            \Log::info('Admin login successful, redirecting to dashboard');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'البيانات غير صحيحة. يرجى المحاولة مرة أخرى.');
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Log logout activity (if activities table exists)
            try {
                $user->activities()->create([
                    'action' => 'logout',
                    'module' => 'auth',
                    'description' => 'تسجيل خروج من لوحة الإدارة',
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            } catch (\Exception $e) {
                // Activities table doesn't exist, skip logging
            }
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'تم تسجيل الخروج بنجاح.');
    }

    /**
     * Show profile page
     */
    public function profile()
    {
        return view('auth.profile');
    }

    /**
     * Update profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string|min:6',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check current password if provided
        if ($request->current_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'كلمة المرور الحالية غير صحيحة.');
            }
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar) {
                \Storage::delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        // Update password if provided
        if ($request->password) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        // Log activity (if activities table exists)
        try {
            $user->activities()->create([
                'action' => 'update',
                'module' => 'profile',
                'description' => 'تحديث الملف الشخصي',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        } catch (\Exception $e) {
            // Activities table doesn't exist, skip logging
        }

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }
}
