<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_type',
        'locale',
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'schema_markup',
        'is_active'
    ];

    protected $casts = [
        'schema_markup' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get SEO settings for a specific page and locale
     */
    public static function getForPage($pageType, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        
        return self::where('page_type', $pageType)
                  ->where('locale', $locale)
                  ->where('is_active', true)
                  ->first();
    }

    /**
     * Get default SEO settings if not found
     */
    public static function getDefaultForPage($pageType, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        
        $defaults = [
            'home' => [
                'ar' => [
                    'title' => 'Miss Helpers - أفضل موقع لتوظيف الخادمات في الإمارات',
                    'description' => 'احصل على أفضل الخادمات المدربات في الإمارات العربية المتحدة. خدمة موثوقة ومدربة مهنياً لرعاية منزلك وعائلتك.',
                    'keywords' => 'خادمات, خادمة, منزلية, رعاية, الإمارات, دبي, أبوظبي'
                ],
                'en' => [
                    'title' => 'Miss Helpers - Best Maid Hiring Platform in UAE',
                    'description' => 'Find the best trained maids in UAE. Professional and reliable service for your home and family care needs.',
                    'keywords' => 'maids, domestic help, housekeeping, UAE, Dubai, Abu Dhabi'
                ]
            ],
            'about' => [
                'ar' => [
                    'title' => 'عن Miss Helpers - منصة توظيف الخادمات الرائدة',
                    'description' => 'تعرف على Miss Helpers، منصة توظيف الخادمات الرائدة في الإمارات. نحن نقدم أفضل الخدمات المنزلية المدربة.',
                    'keywords' => 'عن Miss Helpers, توظيف خادمات, خدمات منزلية, الإمارات'
                ],
                'en' => [
                    'title' => 'About Miss Helpers - Leading Maid Hiring Platform',
                    'description' => 'Learn about Miss Helpers, the leading maid hiring platform in UAE. We provide the best trained domestic services.',
                    'keywords' => 'about Miss Helpers, maid hiring, domestic services, UAE'
                ]
            ],
            'service' => [
                'ar' => [
                    'title' => 'خدمات Miss Helpers - باقات توظيف الخادمات',
                    'description' => 'اكتشف باقاتنا المتنوعة لخدمات الخادمات. باقة مرنة وتقليدية تناسب احتياجاتك المنزلية.',
                    'keywords' => 'خدمات خادمات, باقات, مرنة, تقليدية, منزلية'
                ],
                'en' => [
                    'title' => 'Miss Helpers Services - Maid Hiring Packages',
                    'description' => 'Discover our diverse maid service packages. Flexible and traditional packages to suit your domestic needs.',
                    'keywords' => 'maid services, packages, flexible, traditional, domestic'
                ]
            ],
            'contact' => [
                'ar' => [
                    'title' => 'اتصل بنا - Miss Helpers',
                    'description' => 'تواصل معنا للحصول على أفضل الخادمات. نحن هنا لمساعدتك في العثور على الحل المناسب لاحتياجاتك المنزلية.',
                    'keywords' => 'اتصل بنا, تواصل, خادمات, استفسار, مساعدة'
                ],
                'en' => [
                    'title' => 'Contact Us - Miss Helpers',
                    'description' => 'Get in touch with us for the best maids. We are here to help you find the right solution for your domestic needs.',
                    'keywords' => 'contact us, get in touch, maids, inquiry, help'
                ]
            ],
            'maids' => [
                'ar' => [
                    'title' => 'تصفح الخادمات - Miss Helpers',
                    'description' => 'تصفح مجموعة واسعة من الخادمات المدربات. ابحث حسب الجنسية، الخبرة، ونوع الخدمة.',
                    'keywords' => 'تصفح خادمات, خادمات مدربات, جنسية, خبرة, خدمات'
                ],
                'en' => [
                    'title' => 'Browse Maids - Miss Helpers',
                    'description' => 'Browse our wide selection of trained maids. Search by nationality, experience, and service type.',
                    'keywords' => 'browse maids, trained maids, nationality, experience, services'
                ]
            ],
            'blog' => [
                'ar' => [
                    'title' => 'المدونة - Miss Helpers',
                    'description' => 'اقرأ أحدث المقالات والنصائح حول الخدمات المنزلية ورعاية العائلة.',
                    'keywords' => 'مدونة, مقالات, نصائح, خدمات منزلية, رعاية'
                ],
                'en' => [
                    'title' => 'Blog - Miss Helpers',
                    'description' => 'Read the latest articles and tips about domestic services and family care.',
                    'keywords' => 'blog, articles, tips, domestic services, family care'
                ]
            ]
        ];

        $pageDefaults = $defaults[$pageType][$locale] ?? $defaults[$pageType]['en'] ?? [
            'title' => 'Miss Helpers - Professional Maid Services',
            'description' => 'Professional maid services in UAE',
            'keywords' => 'maids, services, UAE'
        ];

        return (object) $pageDefaults;
    }
}