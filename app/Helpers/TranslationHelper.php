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
        
        // Work Experience translations
        if ($value === 'خادمة منزلية') {
            return __('messages.housemaid');
        }
        if ($value === 'دوام كامل') {
            return __('messages.full_time');
        }
        if ($value === 'دوام جزئي') {
            return __('messages.part_time');
        }
        
        // Duration translations
        if ($value === 'سنتان') {
            return __('messages.two_years');
        }
        if ($value === '3 سنوات') {
            return __('messages.three_years');
        }
        
        // Review translations
        if ($value === 'خدمة ممتازة') {
            return __('messages.excellent_service');
        }
        if ($value === 'عمل جيد جداً') {
            return __('messages.very_good_work');
        }
        if ($value === 'أداء رائع') {
            return __('messages.excellent_performance');
        }
        
        return $value;
    }
    
    /**
     * Translate work experience data
     */
    public static function translateWorkExperience($experience)
    {
        $translated = $experience;
        
        // Translate position
        if (isset($experience->position)) {
            $translated->position = self::translateMaidValue($experience->position);
        }
        
        // Translate work type
        if (isset($experience->work_type)) {
            $translated->work_type = self::translateMaidValue($experience->work_type);
        }
        
        // Translate duration
        if (isset($experience->duration)) {
            $translated->duration = self::translateMaidValue($experience->duration);
        }
        
        // Translate company name and description if needed
        if (self::isEnglish()) {
            // For English, we might want to keep some Arabic names but translate common terms
            if (isset($experience->company_name)) {
                $companyName = $experience->company_name;
                // Translate common company types
                if ($companyName === 'فندق الإمارات') {
                    $translated->company_name = 'Emirates Hotel';
                } elseif ($companyName === 'عائلة السعد') {
                    $translated->company_name = 'Al-Saad Family';
                } else {
                    $translated->company_name = $companyName;
                }
            }
            
            // Translate description
            if (isset($experience->description)) {
                $description = $experience->description;
                // Simple translation for common descriptions
                if (strpos($description, 'عملت كخادمة منزلية في فندق الإمارات') !== false) {
                    $translated->description = 'I worked as a housemaid at Emirates Hotel for two years, where I cleaned rooms and provided services to guests.';
                } elseif (strpos($description, 'عملت كخادمة منزلية في منزل عائلة السعد') !== false) {
                    $translated->description = 'I worked as a housemaid in Al-Saad family\'s home in Kuwait for 3 years, where I performed cleaning, cooking, and childcare duties.';
                } else {
                    $translated->description = $description;
                }
            }
        }
        
        return $translated;
    }
    
    /**
     * Translate review data
     */
    public static function translateReview($review)
    {
        $translated = $review;
        
        // Translate title
        if (isset($review->title)) {
            $translated->title = self::translateMaidValue($review->title);
        }
        
        // Translate comment/description if needed
        if (self::isEnglish()) {
            if (isset($review->comment)) {
                $comment = $review->comment;
                // Simple translation for common comments
                if (strpos($comment, 'الخادمة تعمل بشكل ممتاز وتنظف المنزل بجدية') !== false) {
                    $translated->comment = 'The maid works excellently and cleans the house diligently. I highly recommend her.';
                } elseif (strpos($comment, 'متفانية في العمل ومحترفة') !== false) {
                    $translated->comment = 'Dedicated to work and professional. Happy with the service.';
                } elseif (strpos($comment, 'خادمة محترفة ومتفانية. تنظف بجودة عالية') !== false) {
                    $translated->comment = 'Professional and dedicated maid. Cleans with high quality and pays attention to details.';
                } else {
                    $translated->comment = $comment;
                }
            }
        }
        
        return $translated;
    }
}
