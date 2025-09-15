<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission, $action = 'view'): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        if (!$user->hasPermission($permission, $action)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'ليس لديك صلاحية للقيام بهذا الإجراء.'], 403);
            }
            
            return redirect()->route('admin.dashboard')->with('error', 'ليس لديك صلاحية للقيام بهذا الإجراء.');
        }

        return $next($request);
    }
}
