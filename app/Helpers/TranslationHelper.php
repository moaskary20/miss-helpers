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
        if ($value === 'خادمة منزلية') {
            return __('messages.housemaid');
        }
        if ($value === 'مدبرة منزل') {
            return __('messages.housemaid');
        }
        if ($value === 'جليسة أطفال') {
            return __('messages.nanny');
        }
        if ($value === 'مربية') {
            return __('messages.nanny');
        }
        if ($value === 'مساعدة منزلية') {
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
        
        // Additional Blog Content translations
        if ($value === 'وصفات سهلة لعشاء سريع') {
            return __('messages.blog_title_easy_dinner_recipes');
        }
        if ($value === 'وصفات سهلة وسريعة لعشاء لذيذ') {
            return __('messages.blog_excerpt_easy_dinner_recipes');
        }
        if ($value === 'طرق فعالة لتهدئة الأطفال') {
            return __('messages.blog_excerpt_calming_children');
        }
        if ($value === 'خطوات بسيطة لتنظيم المنزل') {
            return __('messages.blog_excerpt_home_organizing');
        }
        if ($value === 'مقال تجريبي لاختبار واجهة السلايدر.') {
            return __('messages.blog_excerpt_test_article');
        }
        if ($value === 'الطبخ') {
            return __('messages.blog_category_cooking');
        }
        if ($value === 'نصائح المنزل') {
            return __('messages.blog_category_home_tips');
        }
        if ($value === 'أطعمة صحية للعائلة') {
            return __('messages.blog_title_healthy_foods');
        }
        if ($value === 'أنشطة تعليمية للأطفال') {
            return __('messages.blog_title_educational_activities');
        }
        if ($value === 'روتين تنظيف أسبوعي') {
            return __('messages.blog_title_weekly_cleaning');
        }
        if ($value === 'رعاية الأطفال') {
            return __('messages.blog_category_childcare');
        }
        
        // Customer Reviews translations
        if ($value === 'أحمد محمد') {
            return __('messages.customer_name_ahmed');
        }
        if ($value === 'خدمة ممتازة! الخادمة كانت محترفة جداً ونظيفة. أنصح بالتعامل معهم.') {
            return __('messages.review_text_excellent_service');
        }
        if ($value === 'الرياض، المملكة العربية السعودية') {
            return __('messages.location_riyadh_saudi');
        }
        if ($value === 'عميل راضي') {
            return __('messages.satisfied_customer_default');
        }
        if ($value === 'فاطمة من الرياض') {
            return __('messages.customer_name_fatima');
        }
        if ($value === 'أحمد من دبي') {
            return __('messages.customer_name_ahmed_dubai');
        }
        if ($value === 'موقع محترم وخدمة العملاء متعاونين جداً. ساعدوني في اختيار خادمة تناسب احتياجات عائلتي، وتم إنهاء الأوراق في وقت قياسي. أشكرهم على المهنية والالتزام.') {
            return __('messages.review_text_professional_service');
        }
        if ($value === 'تجربة رائعة مع Miss Helpers. فريق محترف وسريع في الاستجابة. تم العثور على خادمة ممتازة في وقت قصير. أنصح الجميع بالتجربة.') {
            return __('messages.review_text_great_experience');
        }
        
        // Skills translations
        if ($value === 'تنظيف المنزل الشامل') {
            return __('messages.comprehensive_house_cleaning');
        }
        if ($value === 'كوي الملابس') {
            return __('messages.ironing_clothes');
        }
        if ($value === 'تنظيف السجاد') {
            return __('messages.carpet_cleaning');
        }
        if ($value === 'رعاية المسنين') {
            return __('messages.elderly_care');
        }
        if ($value === 'طبخ الأكلات العربية') {
            return __('messages.cooking_arabic_food');
        }
        if ($value === 'طبخ الأكلات الآسيوية') {
            return __('messages.cooking_asian_food');
        }
        if ($value === 'رعاية الأطفال') {
            return __('messages.childcare');
        }
        if ($value === 'غسل الملابس') {
            return __('messages.laundry');
        }
        if ($value === 'تنظيف الزجاج') {
            return __('messages.glass_cleaning');
        }
        if ($value === 'تنظيم المنزل') {
            return __('messages.home_organization');
        }
        if ($value === 'الحديقة والبستنة') {
            return __('messages.gardening');
        }
        if ($value === 'إدارة المنزل') {
            return __('messages.home_management');
        }
        
        // New Skills translations
        if ($value === 'تنظيف') {
            return __('messages.cleaning');
        }
        if ($value === 'غسيل') {
            return __('messages.washing');
        }
        if ($value === 'كوي') {
            return __('messages.ironing');
        }
        if ($value === 'طبخ') {
            return __('messages.cooking');
        }
        if ($value === 'رعاية اطفال') {
            return __('messages.child_care');
        }
        if ($value === 'رعاية كبار السن') {
            return __('messages.elderly_care_new');
        }
        if ($value === 'سائقة') {
            return __('messages.driving');
        }
        
        // Skill names translations
        if ($value === 'التنظيف') {
            return __('messages.cleaning');
        }
        if ($value === 'الطبخ') {
            return __('messages.cooking');
        }
        if ($value === 'الغسيل والكي') {
            return __('messages.washing_ironing');
        }
        if ($value === 'التسوق') {
            return __('messages.shopping');
        }
        
        // Skill descriptions translations
        if ($value === 'مهارة في تنظيف المنزل الشامل') {
            return __('messages.skill_comprehensive_house_cleaning');
        }
        if ($value === 'تتقن الطبخ العربي والآسيوي') {
            return __('messages.skill_cooking_arabic_asian');
        }
        if ($value === 'خبرة في تنظيف المنازل والفنادق') {
            return __('messages.skill_cleaning_homes_hotels');
        }
        if ($value === 'تجربة في رعاية الأطفال من مختلف الأعمار') {
            return __('messages.skill_childcare_all_ages');
        }
        if ($value === 'تتقن كي جميع أنواع الملابس') {
            return __('messages.skill_ironing_all_clothes');
        }
        if ($value === 'خبرة في استخدام الغسالات المختلفة') {
            return __('messages.skill_washing_machines');
        }
        if ($value === 'تتقن تنظيف جميع أجزاء المنزل') {
            return __('messages.skill_cleaning_all_parts');
        }
        if ($value === 'تتقن بعض الأطباق العربية') {
            return __('messages.skill_some_arabic_dishes');
        }
        if ($value === 'خبرة في رعاية الأطفال حديثي الولادة وحتى سن المدرسة') {
            return __('messages.skill_childcare_newborn_to_school');
        }
        if ($value === 'تساعد الأطفال في واجباتهم المدرسية') {
            return __('messages.skill_help_homework');
        }
        if ($value === 'تتقن جميع الأطباق الخليجية') {
            return __('messages.skill_all_gulf_dishes');
        }
        if ($value === 'خبرة في تحضير الأطباق العربية التقليدية') {
            return __('messages.skill_traditional_arabic_dishes');
        }
        if ($value === 'خبرة في رعاية كبار السن') {
            return __('messages.skill_elderly_care');
        }
        if ($value === 'تتعامل مع حالات مختلفة من ذوي الاحتياجات الخاصة') {
            return __('messages.skill_special_needs_care');
        }
        if ($value === 'تتقن كي الملابس') {
            return __('messages.skill_ironing_clothes');
        }
        if ($value === 'تجربة في رعاية الأطفال الصغار') {
            return __('messages.skill_caring_young_children');
        }
        if ($value === 'تتقن إدارة جميع جوانب المنزل') {
            return __('messages.skill_managing_all_home_aspects');
        }
        if ($value === 'تتقن الطبخ الإندونيسي وبعض الأطباق العربية') {
            return __('messages.skill_indonesian_arabic_cooking');
        }
        if ($value === 'مهارة في طبخ الأكلات العربية') {
            return __('messages.skill_cooking_arabic_dishes');
        }
        if ($value === 'مهارة في طبخ الأكلات الآسيوية') {
            return __('messages.skill_cooking_asian_dishes');
        }
        if ($value === 'مهارة في رعاية الأطفال') {
            return __('messages.skill_childcare');
        }
        if ($value === 'مهارة في تنظيم المنزل') {
            return __('messages.skill_home_organization');
        }
        if ($value === 'مهارة في الحديقة والبستنة') {
            return __('messages.skill_gardening');
        }
        if ($value === 'مهارة في إدارة المنزل') {
            return __('messages.skill_home_management');
        }
        if ($value === 'مهارة في كوي الملابس') {
            return __('messages.skill_ironing_clothes');
        }
        if ($value === 'مهارة في تنظيف السجاد') {
            return __('messages.skill_carpet_cleaning');
        }
        if ($value === 'مهارة في تنظيف الزجاج') {
            return __('messages.skill_glass_cleaning');
        }
        if ($value === 'مهارة في رعاية المسنين') {
            return __('messages.skill_elderly_care');
        }
        
        // Additional skill names translations
        if ($value === 'التنظيف') {
            return __('messages.cleaning');
        }
        if ($value === 'الطبخ') {
            return __('messages.cooking');
        }
        if ($value === 'رعاية الأطفال') {
            return __('messages.childcare');
        }
        if ($value === 'الغسيل والكي') {
            return __('messages.washing_ironing');
        }
        if ($value === 'التسوق') {
            return __('messages.shopping');
        }
        if ($value === 'تنظيف المنزل الشامل') {
            return __('messages.comprehensive_house_cleaning');
        }
        if ($value === 'طبخ الأكلات العربية') {
            return __('messages.cooking_arabic_food');
        }
        if ($value === 'غسل الملابس') {
            return __('messages.laundry');
        }
        if ($value === 'طبخ الأكلات الآسيوية') {
            return __('messages.cooking_asian_food');
        }
        if ($value === 'تنظيم المنزل') {
            return __('messages.home_organization');
        }
        if ($value === 'الحديقة والبستنة') {
            return __('messages.gardening');
        }
        if ($value === 'إدارة المنزل') {
            return __('messages.home_management');
        }
        if ($value === 'كوي الملابس') {
            return __('messages.ironing_clothes');
        }
        if ($value === 'تنظيف السجاد') {
            return __('messages.carpet_cleaning');
        }
        if ($value === 'تنظيف الزجاج') {
            return __('messages.glass_cleaning');
        }
        if ($value === 'رعاية المسنين') {
            return __('messages.elderly_care');
        }
        
        // Additional skill descriptions translations
        if ($value === 'تنظيف شامل للمنزل') {
            return __('messages.skill_description_comprehensive_cleaning');
        }
        if ($value === 'طبخ الأطباق العربية والأجنبية') {
            return __('messages.skill_description_cooking_arabic_foreign');
        }
        if ($value === 'رعاية وتربية الأطفال') {
            return __('messages.skill_description_childcare_rearing');
        }
        if ($value === 'غسيل وكي الملابس') {
            return __('messages.skill_description_washing_ironing');
        }
        if ($value === 'تسوق احتياجات المنزل') {
            return __('messages.skill_description_home_shopping');
        }
        if ($value === 'مهارة في غسل الملابس') {
            return __('messages.skill_washing_clothes');
        }
        if ($value === 'تنظيف شامل للمنزل') {
            return __('messages.skill_comprehensive_home_cleaning');
        }
        if ($value === 'طبخ الأطباق العربية والأجنبية') {
            return __('messages.skill_cooking_arabic_foreign');
        }
        if ($value === 'رعاية وتربية الأطفال') {
            return __('messages.skill_childcare_rearing');
        }
        if ($value === 'غسيل وكي الملابس') {
            return __('messages.skill_washing_ironing_clothes');
        }
        if ($value === 'تسوق احتياجات المنزل') {
            return __('messages.skill_home_shopping');
        }
        
        // Country translations
        if ($value === 'الكويت') {
            return __('messages.kuwait');
        }
        if ($value === 'الإمارات العربية المتحدة') {
            return __('messages.uae');
        }
        if ($value === 'قطر') {
            return __('messages.qatar');
        }
        if ($value === 'المملكة العربية السعودية') {
            return __('messages.saudi_arabia');
        }
        if ($value === 'السعودية') {
            return __('messages.saudi_arabia');
        }
        
        // Nationality translations
        if ($value === 'مصرية') {
            return __('messages.egyptian');
        }
        if ($value === 'الفلبين') {
            return __('messages.philippines');
        }
        if ($value === 'ميانمار') {
            return __('messages.myanmar');
        }
        if ($value === 'اثيوبيا') {
            return __('messages.ethiopia');
        }
        if ($value === 'سريلانكا') {
            return __('messages.sri_lanka');
        }
        if ($value === 'اوغندا') {
            return __('messages.uganda');
        }
        if ($value === 'كينيا') {
            return __('messages.kenya');
        }
        if ($value === 'مدغشقر') {
            return __('messages.madagascar');
        }
        if ($value === 'اندونيسيا') {
            return __('messages.indonesia');
        }
        
        // Duration translations
        if ($value === 'سنة واحدة') {
            return __('messages.one_year');
        }
        if ($value === 'سنتان') {
            return __('messages.two_years');
        }
        if ($value === '3 سنوات') {
            return __('messages.three_years');
        }
        if ($value === '4 سنوات') {
            return __('messages.four_years');
        }
        if ($value === '5 سنوات') {
            return __('messages.five_years');
        }
        if ($value === '6 سنوات') {
            return __('messages.six_years');
        }
        if ($value === '7 سنوات') {
            return __('messages.seven_years');
        }
        if ($value === '8 سنوات') {
            return __('messages.eight_years');
        }
        if ($value === '5 سنوات') {
            return __('messages.five_years');
        }
        
        // Marital Status translations
        if ($value === 'عزباء') {
            return __('messages.single');
        }
        if ($value === 'متزوجة') {
            return __('messages.married');
        }
        if ($value === 'مطلقة') {
            return __('messages.divorced');
        }
        if ($value === 'أرملة') {
            return __('messages.widowed');
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
        
        // Translate country
        if (isset($experience->country)) {
            $translated->country = self::translateMaidValue($experience->country);
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
