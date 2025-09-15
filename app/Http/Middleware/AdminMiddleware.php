<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null, $action = 'view'): Response
    {
        // Debug: Log middleware access
        \Log::info('AdminMiddleware: Checking access for ' . $request->path());
        
        // Check if user is authenticated
        if (!Auth::check()) {
            \Log::info('AdminMiddleware: User not authenticated, redirecting to login');
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        // Check if user is active
        if (!$user->isActive()) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'حسابك معلق. يرجى التواصل مع الإدارة.');
        }

        // Check if user has admin role
        if (!$user->isModerator()) {
            return redirect()->route('admin.login')->with('error', 'ليس لديك صلاحية للوصول لهذه الصفحة.');
        }

        // Check specific permission if provided
        if ($permission && !$user->hasPermission($permission, $action)) {
            return redirect()->route('admin.dashboard')->with('error', 'ليس لديك صلاحية للوصول لهذا القسم.');
        }

        // Log activity (if activities table exists)
        try {
            $user->activities()->create([
                'action' => 'view',
                'module' => $request->route()->getName() ?? 'unknown',
                'description' => 'زيارة صفحة: ' . $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        } catch (\Exception $e) {
            // Activities table doesn't exist, skip logging
        }

        return $next($request);
    }
}
