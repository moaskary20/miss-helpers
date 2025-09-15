<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'بيانات غير صحيحة',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->email, // Use email as username
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password, // Will be hashed by setPasswordAttribute
            ]);

            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الحساب بنجاح!',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إنشاء الحساب'
            ], 500);
        }
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Log login attempt
        \Log::info('Login attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

        // Check if user exists
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            \Log::warning('Login failed: User not found', ['email' => $credentials['email']]);
            return back()->withErrors([
                'email' => 'البريد الإلكتروني غير موجود',
            ])->withInput($request->only('email'));
        }

        // Check if user is active
        if ($user->status !== 'active') {
            \Log::warning('Login failed: User inactive', ['email' => $credentials['email'], 'status' => $user->status]);
            return back()->withErrors([
                'email' => 'حسابك معلق. يرجى التواصل مع الإدارة.',
            ])->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            \Log::info('Login successful', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'role' => Auth::user()->role
            ]);
            
            // تحقق من دور المستخدم وإعادة التوجيه المناسب
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'super_admin'])) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(route('welcome'));
            }
        }

        \Log::warning('Login failed: Invalid credentials', ['email' => $credentials['email']]);
        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('welcome');
    }
}
