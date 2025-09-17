<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoSetting;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoSettings = [
            // Home Page - Arabic
            [
                'page_type' => 'home',
                'locale' => 'ar',
                'title' => 'Miss Helpers - أفضل موقع لتوظيف الخادمات في الإمارات',
                'description' => 'احصل على أفضل الخادمات المدربات في الإمارات العربية المتحدة. خدمة موثوقة ومدربة مهنياً لرعاية منزلك وعائلتك.',
                'keywords' => 'خادمات, خادمة, منزلية, رعاية, الإمارات, دبي, أبوظبي, Miss Helpers',
                'og_title' => 'Miss Helpers - أفضل موقع لتوظيف الخادمات في الإمارات',
                'og_description' => 'احصل على أفضل الخادمات المدربات في الإمارات العربية المتحدة. خدمة موثوقة ومدربة مهنياً لرعاية منزلك وعائلتك.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'Miss Helpers - أفضل موقع لتوظيف الخادمات في الإمارات',
                'twitter_description' => 'احصل على أفضل الخادمات المدربات في الإمارات العربية المتحدة. خدمة موثوقة ومدربة مهنياً لرعاية منزلك وعائلتك.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Home Page - English
            [
                'page_type' => 'home',
                'locale' => 'en',
                'title' => 'Miss Helpers - Best Maid Hiring Platform in UAE',
                'description' => 'Find the best trained maids in UAE. Professional and reliable service for your home and family care needs.',
                'keywords' => 'maids, domestic help, housekeeping, UAE, Dubai, Abu Dhabi, Miss Helpers',
                'og_title' => 'Miss Helpers - Best Maid Hiring Platform in UAE',
                'og_description' => 'Find the best trained maids in UAE. Professional and reliable service for your home and family care needs.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'Miss Helpers - Best Maid Hiring Platform in UAE',
                'twitter_description' => 'Find the best trained maids in UAE. Professional and reliable service for your home and family care needs.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // About Page - Arabic
            [
                'page_type' => 'about',
                'locale' => 'ar',
                'title' => 'عن Miss Helpers - منصة توظيف الخادمات الرائدة',
                'description' => 'تعرف على Miss Helpers، منصة توظيف الخادمات الرائدة في الإمارات. نحن نقدم أفضل الخدمات المنزلية المدربة.',
                'keywords' => 'عن Miss Helpers, توظيف خادمات, خدمات منزلية, الإمارات, منصة',
                'og_title' => 'عن Miss Helpers - منصة توظيف الخادمات الرائدة',
                'og_description' => 'تعرف على Miss Helpers، منصة توظيف الخادمات الرائدة في الإمارات. نحن نقدم أفضل الخدمات المنزلية المدربة.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'عن Miss Helpers - منصة توظيف الخادمات الرائدة',
                'twitter_description' => 'تعرف على Miss Helpers، منصة توظيف الخادمات الرائدة في الإمارات. نحن نقدم أفضل الخدمات المنزلية المدربة.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // About Page - English
            [
                'page_type' => 'about',
                'locale' => 'en',
                'title' => 'About Miss Helpers - Leading Maid Hiring Platform',
                'description' => 'Learn about Miss Helpers, the leading maid hiring platform in UAE. We provide the best trained domestic services.',
                'keywords' => 'about Miss Helpers, maid hiring, domestic services, UAE, platform',
                'og_title' => 'About Miss Helpers - Leading Maid Hiring Platform',
                'og_description' => 'Learn about Miss Helpers, the leading maid hiring platform in UAE. We provide the best trained domestic services.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'About Miss Helpers - Leading Maid Hiring Platform',
                'twitter_description' => 'Learn about Miss Helpers, the leading maid hiring platform in UAE. We provide the best trained domestic services.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Service Page - Arabic
            [
                'page_type' => 'service',
                'locale' => 'ar',
                'title' => 'خدمات Miss Helpers - باقات توظيف الخادمات',
                'description' => 'اكتشف باقاتنا المتنوعة لخدمات الخادمات. باقة مرنة وتقليدية تناسب احتياجاتك المنزلية.',
                'keywords' => 'خدمات خادمات, باقات, مرنة, تقليدية, منزلية, Miss Helpers',
                'og_title' => 'خدمات Miss Helpers - باقات توظيف الخادمات',
                'og_description' => 'اكتشف باقاتنا المتنوعة لخدمات الخادمات. باقة مرنة وتقليدية تناسب احتياجاتك المنزلية.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'خدمات Miss Helpers - باقات توظيف الخادمات',
                'twitter_description' => 'اكتشف باقاتنا المتنوعة لخدمات الخادمات. باقة مرنة وتقليدية تناسب احتياجاتك المنزلية.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Service Page - English
            [
                'page_type' => 'service',
                'locale' => 'en',
                'title' => 'Miss Helpers Services - Maid Hiring Packages',
                'description' => 'Discover our diverse maid service packages. Flexible and traditional packages to suit your domestic needs.',
                'keywords' => 'maid services, packages, flexible, traditional, domestic, Miss Helpers',
                'og_title' => 'Miss Helpers Services - Maid Hiring Packages',
                'og_description' => 'Discover our diverse maid service packages. Flexible and traditional packages to suit your domestic needs.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'Miss Helpers Services - Maid Hiring Packages',
                'twitter_description' => 'Discover our diverse maid service packages. Flexible and traditional packages to suit your domestic needs.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Contact Page - Arabic
            [
                'page_type' => 'contact',
                'locale' => 'ar',
                'title' => 'اتصل بنا - Miss Helpers',
                'description' => 'تواصل معنا للحصول على أفضل الخادمات. نحن هنا لمساعدتك في العثور على الحل المناسب لاحتياجاتك المنزلية.',
                'keywords' => 'اتصل بنا, تواصل, خادمات, استفسار, مساعدة, Miss Helpers',
                'og_title' => 'اتصل بنا - Miss Helpers',
                'og_description' => 'تواصل معنا للحصول على أفضل الخادمات. نحن هنا لمساعدتك في العثور على الحل المناسب لاحتياجاتك المنزلية.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'اتصل بنا - Miss Helpers',
                'twitter_description' => 'تواصل معنا للحصول على أفضل الخادمات. نحن هنا لمساعدتك في العثور على الحل المناسب لاحتياجاتك المنزلية.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Contact Page - English
            [
                'page_type' => 'contact',
                'locale' => 'en',
                'title' => 'Contact Us - Miss Helpers',
                'description' => 'Get in touch with us for the best maids. We are here to help you find the right solution for your domestic needs.',
                'keywords' => 'contact us, get in touch, maids, inquiry, help, Miss Helpers',
                'og_title' => 'Contact Us - Miss Helpers',
                'og_description' => 'Get in touch with us for the best maids. We are here to help you find the right solution for your domestic needs.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'Contact Us - Miss Helpers',
                'twitter_description' => 'Get in touch with us for the best maids. We are here to help you find the right solution for your domestic needs.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Maids Page - Arabic
            [
                'page_type' => 'maids',
                'locale' => 'ar',
                'title' => 'تصفح الخادمات - Miss Helpers',
                'description' => 'تصفح مجموعة واسعة من الخادمات المدربات. ابحث حسب الجنسية، الخبرة، ونوع الخدمة.',
                'keywords' => 'تصفح خادمات, خادمات مدربات, جنسية, خبرة, خدمات, Miss Helpers',
                'og_title' => 'تصفح الخادمات - Miss Helpers',
                'og_description' => 'تصفح مجموعة واسعة من الخادمات المدربات. ابحث حسب الجنسية، الخبرة، ونوع الخدمة.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'تصفح الخادمات - Miss Helpers',
                'twitter_description' => 'تصفح مجموعة واسعة من الخادمات المدربات. ابحث حسب الجنسية، الخبرة، ونوع الخدمة.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Maids Page - English
            [
                'page_type' => 'maids',
                'locale' => 'en',
                'title' => 'Browse Maids - Miss Helpers',
                'description' => 'Browse our wide selection of trained maids. Search by nationality, experience, and service type.',
                'keywords' => 'browse maids, trained maids, nationality, experience, services, Miss Helpers',
                'og_title' => 'Browse Maids - Miss Helpers',
                'og_description' => 'Browse our wide selection of trained maids. Search by nationality, experience, and service type.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'Browse Maids - Miss Helpers',
                'twitter_description' => 'Browse our wide selection of trained maids. Search by nationality, experience, and service type.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Blog Page - Arabic
            [
                'page_type' => 'blog',
                'locale' => 'ar',
                'title' => 'المدونة - Miss Helpers',
                'description' => 'اقرأ أحدث المقالات والنصائح حول الخدمات المنزلية ورعاية العائلة.',
                'keywords' => 'مدونة, مقالات, نصائح, خدمات منزلية, رعاية, Miss Helpers',
                'og_title' => 'المدونة - Miss Helpers',
                'og_description' => 'اقرأ أحدث المقالات والنصائح حول الخدمات المنزلية ورعاية العائلة.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'المدونة - Miss Helpers',
                'twitter_description' => 'اقرأ أحدث المقالات والنصائح حول الخدمات المنزلية ورعاية العائلة.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
            // Blog Page - English
            [
                'page_type' => 'blog',
                'locale' => 'en',
                'title' => 'Blog - Miss Helpers',
                'description' => 'Read the latest articles and tips about domestic services and family care.',
                'keywords' => 'blog, articles, tips, domestic services, family care, Miss Helpers',
                'og_title' => 'Blog - Miss Helpers',
                'og_description' => 'Read the latest articles and tips about domestic services and family care.',
                'og_image' => url('/images/logo.png'),
                'twitter_title' => 'Blog - Miss Helpers',
                'twitter_description' => 'Read the latest articles and tips about domestic services and family care.',
                'twitter_image' => url('/images/logo.png'),
                'is_active' => true,
            ],
        ];

        foreach ($seoSettings as $setting) {
            SeoSetting::updateOrCreate(
                ['page_type' => $setting['page_type'], 'locale' => $setting['locale']],
                $setting
            );
        }
    }
}