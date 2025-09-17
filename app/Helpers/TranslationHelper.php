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
    
    /**
     * Translate maid values
     */
    public static function translateMaidValue($value, $type = null)
    {
        if (empty($value)) {
            return __('messages.not_specified');
        }
        
        // Package types
        if ($value === 'الباقة التقليدية') {
            return __('messages.traditional_package');
        }
        if ($value === 'الباقة المرنة') {
            return __('messages.flexible_package');
        }
        
        // Job titles
        if ($value === 'عاملة منزلية') {
            return __('messages.housemaid');
        }
        if ($value === 'مربية أطفال') {
            return __('messages.nanny');
        }
        if ($value === 'رعاية كبار السن') {
            return __('messages.elderly_care');
        }
        if ($value === 'طباخة') {
            return __('messages.cook');
        }
        if ($value === 'سائقة') {
            return __('messages.driver');
        }
        
        // Contract types
        if ($value === 'عقد سنتين') {
            return __('messages.two_year_contract');
        }
        if ($value === 'عقد شهري') {
            return __('messages.monthly_contract');
        }
        
        // Status
        if ($value === 'متاحة') {
            return __('messages.available');
        }
        if ($value === 'غير متاحة') {
            return __('messages.unavailable');
        }
        
        // Nationalities
        if ($value === 'ميانمار') {
            return __('messages.myanmar');
        }
        if ($value === 'الفلبين') {
            return __('messages.philippines');
        }
        if ($value === 'إثيوبيا') {
            return __('messages.ethiopia');
        }
        if ($value === 'سريلانكا') {
            return __('messages.sri_lanka');
        }
        if ($value === 'أوغندا') {
            return __('messages.uganda');
        }
        if ($value === 'كينيا') {
            return __('messages.kenya');
        }
        if ($value === 'مدغشقر') {
            return __('messages.madagascar');
        }
        if ($value === 'إندونيسيا') {
            return __('messages.indonesia');
        }
        
        // Marital Status
        if ($value === 'متزوج/متزوجة') {
            return __('messages.married');
        }
        if ($value === 'أعزب/عزباء') {
            return __('messages.single');
        }
        if ($value === 'مطلق/مطلقة') {
            return __('messages.divorced');
        }
        if ($value === 'أرمل/أرملة') {
            return __('messages.widowed');
        }
        
        // If no translation found, return original value
        // Blog sample titles mapping
        if ($value === 'أفضل طرق تهدئة الأطفال') {
            return __('messages.blog_title_calming_kids');
        }
        if ($value === 'تنظيم المنزل بخطوات بسيطة') {
            return __('messages.blog_title_home_organizing');
        }
        return $value;
    }
}
