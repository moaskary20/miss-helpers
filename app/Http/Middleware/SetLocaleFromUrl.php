<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleFromUrl
{
    public function handle(Request $request, Closure $next)
    {
        $segmentLocale = $request->segment(1);
        if (in_array($segmentLocale, ['ar', 'en'])) {
            App::setLocale($segmentLocale);
        }
        return $next($request);
    }
}


