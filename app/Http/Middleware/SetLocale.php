<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from URL first, then session, then default to 'ar'
        $segments = $request->segments();
        $locale = 'ar'; // default
        
        if (count($segments) > 0 && in_array($segments[0], ['ar', 'en'])) {
            $locale = $segments[0];
        } else {
            $locale = Session::get('locale', 'ar');
        }
        
        // Validate locale
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar';
        }
        
        // Save locale to session
        Session::put('locale', $locale);
        
        // Set the application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}
