<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();

        if (!$user->hasAnyRole($roles)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'ليس لديك دور مناسب للوصول لهذه الصفحة.'], 403);
            }
            
            return redirect()->route('admin.dashboard')->with('error', 'ليس لديك دور مناسب للوصول لهذه الصفحة.');
        }

        return $next($request);
    }
}
