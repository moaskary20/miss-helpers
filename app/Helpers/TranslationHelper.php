<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class TranslationHelper
{
    /**
     * Get translated text with fallback
     */
    public static function trans($key, $default = null, $replace = [])
    {
        $translation = __($key, $replace);
        
        // If translation is the same as key, return default or key
        if ($translation === $key) {
            return $default ?: $key;
        }
        
        return $translation;
    }
    
    /**
     * Get current language
     */
    public static function getCurrentLanguage()
    {
        return App::getLocale();
    }
    
    /**
     * Check if current language is Arabic
     */
    public static function isArabic()
    {
        return App::getLocale() === 'ar';
    }
    
    /**
     * Check if current language is English
     */
    public static function isEnglish()
    {
        return App::getLocale() === 'en';
    }
    
    /**
     * Get opposite language
     */
    public static function getOppositeLanguage()
    {
        return App::getLocale() === 'ar' ? 'en' : 'ar';
    }
    
    /**
     * Get language name
     */
    public static function getLanguageName($locale = null)
    {
        $locale = $locale ?: App::getLocale();
        
        return $locale === 'ar' ? 'العربية' : 'English';
    }
    
    /**
     * Get HTML direction
     */
    public static function getDirection()
    {
        return App::getLocale() === 'ar' ? 'rtl' : 'ltr';
    }
    
    /**
     * Get HTML lang attribute
     */
    public static function getLangAttribute()
    {
        return App::getLocale();
    }
}
