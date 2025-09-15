<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     */
    public function switch(Request $request)
    {
        $locale = $request->input('locale', 'ar');
        
        // Validate locale
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar';
        }
        
        // Set locale in session
        Session::put('locale', $locale);
        
        // Set locale for current request
        App::setLocale($locale);
        
        // Redirect back to the previous page
        return redirect()->back();
    }
    
    /**
     * Get current language
     */
    public function getCurrentLanguage()
    {
        return Session::get('locale', 'ar');
    }
    
    /**
     * Get available languages
     */
    public function getAvailableLanguages()
    {
        return [
            'ar' => 'العربية',
            'en' => 'English'
        ];
    }
}
