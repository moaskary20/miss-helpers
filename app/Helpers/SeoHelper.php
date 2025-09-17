<?php

namespace App\Helpers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\View;

class SeoHelper
{
    /**
     * Generate SEO meta tags for a page
     */
    public static function generateMetaTags($pageType, $locale = null, $additionalData = [])
    {
        $locale = $locale ?: app()->getLocale();
        
        // Get SEO settings from database
        $seoSetting = SeoSetting::getForPage($pageType, $locale);
        
        // If not found, use defaults
        if (!$seoSetting) {
            $seoSetting = SeoSetting::getDefaultForPage($pageType, $locale);
        }

        // Merge with additional data for dynamic content
        $metaData = array_merge([
            'title' => $seoSetting->title ?? '',
            'description' => $seoSetting->description ?? '',
            'keywords' => $seoSetting->keywords ?? '',
            'og_title' => $seoSetting->og_title ?? $seoSetting->title ?? '',
            'og_description' => $seoSetting->og_description ?? $seoSetting->description ?? '',
            'og_image' => $seoSetting->og_image ?? asset('images/logo.png'),
            'twitter_title' => $seoSetting->twitter_title ?? $seoSetting->title ?? '',
            'twitter_description' => $seoSetting->twitter_description ?? $seoSetting->description ?? '',
            'twitter_image' => $seoSetting->twitter_image ?? $seoSetting->og_image ?? asset('images/logo.png'),
            'schema_markup' => $seoSetting->schema_markup ?? [],
            'canonical_url' => request()->url(),
            'locale' => $locale,
            'alternate_locales' => self::getAlternateLocales($pageType)
        ], $additionalData);

        return $metaData;
    }

    /**
     * Get alternate locales for the same page
     */
    private static function getAlternateLocales($pageType)
    {
        $locales = ['ar', 'en'];
        $alternates = [];
        
        foreach ($locales as $locale) {
            if ($locale !== app()->getLocale()) {
                $alternates[$locale] = self::getPageUrl($pageType, $locale);
            }
        }
        
        return $alternates;
    }

    /**
     * Get page URL for specific locale
     */
    private static function getPageUrl($pageType, $locale)
    {
        $baseUrl = url('/');
        
        switch ($pageType) {
            case 'home':
                return $baseUrl . '/' . $locale;
            case 'about':
                return $baseUrl . '/' . $locale . '/about';
            case 'service':
                return $baseUrl . '/' . $locale . '/service';
            case 'contact':
                return $baseUrl . '/' . $locale . '/contact';
            case 'maids':
                return $baseUrl . '/' . $locale . '/maids';
            case 'blog':
                return $baseUrl . '/' . $locale . '/blog';
            default:
                return $baseUrl . '/' . $locale;
        }
    }

    /**
     * Generate Schema Markup for different page types
     */
    public static function generateSchemaMarkup($pageType, $additionalData = [])
    {
        $baseSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Miss Helpers',
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'description' => 'Professional maid services in UAE',
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'AE',
                'addressLocality' => 'Dubai'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+97143430391',
                'contactType' => 'customer service'
            ]
        ];

        switch ($pageType) {
            case 'home':
                return array_merge($baseSchema, [
                    '@type' => 'WebSite',
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => url('/maids') . '?search={search_term_string}',
                        'query-input' => 'required name=search_term_string'
                    ]
                ], $additionalData);

            case 'maid_profile':
                if (isset($additionalData['maid'])) {
                    $maid = $additionalData['maid'];
                    return [
                        '@context' => 'https://schema.org',
                        '@type' => 'Person',
                        'name' => $maid->name,
                        'jobTitle' => 'Domestic Helper',
                        'description' => $maid->description,
                        'nationality' => $maid->nationality,
                        'workLocation' => 'UAE',
                        'offers' => [
                            '@type' => 'Offer',
                            'description' => 'Domestic services',
                            'priceCurrency' => 'AED',
                            'price' => $maid->monthly_salary ?? 'Contact for pricing'
                        ]
                    ];
                }
                break;

            case 'blog':
                if (isset($additionalData['post'])) {
                    $post = $additionalData['post'];
                    return [
                        '@context' => 'https://schema.org',
                        '@type' => 'BlogPosting',
                        'headline' => $post->title,
                        'description' => $post->excerpt ?? substr(strip_tags($post->content), 0, 160),
                        'datePublished' => $post->created_at->toISOString(),
                        'dateModified' => $post->updated_at->toISOString(),
                        'author' => [
                            '@type' => 'Organization',
                            'name' => 'Miss Helpers'
                        ],
                        'publisher' => [
                            '@type' => 'Organization',
                            'name' => 'Miss Helpers',
                            'logo' => [
                                '@type' => 'ImageObject',
                                'url' => asset('images/logo.png')
                            ]
                        ]
                    ];
                }
                break;
        }

        return $baseSchema;
    }

    /**
     * Render SEO meta tags HTML
     */
    public static function renderMetaTags($pageType, $locale = null, $additionalData = [])
    {
        $metaData = self::generateMetaTags($pageType, $locale, $additionalData);
        
        return View::make('partials.seo-meta', compact('metaData'))->render();
    }

    /**
     * Generate sitemap XML
     */
    public static function generateSitemap()
    {
        $pages = [
            ['type' => 'home', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['type' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['type' => 'service', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['type' => 'contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['type' => 'maids', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['type' => 'blog', 'priority' => '0.6', 'changefreq' => 'weekly'],
        ];

        $locales = ['ar', 'en'];
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

        foreach ($pages as $page) {
            foreach ($locales as $locale) {
                $url = self::getPageUrl($page['type'], $locale);
                $sitemap .= '  <url>' . "\n";
                $sitemap .= '    <loc>' . $url . '</loc>' . "\n";
                $sitemap .= '    <lastmod>' . now()->toISOString() . '</lastmod>' . "\n";
                $sitemap .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
                $sitemap .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
                
                // Add alternate language links
                foreach ($locales as $altLocale) {
                    if ($altLocale !== $locale) {
                        $altUrl = self::getPageUrl($page['type'], $altLocale);
                        $sitemap .= '    <xhtml:link rel="alternate" hreflang="' . $altLocale . '" href="' . $altUrl . '" />' . "\n";
                    }
                }
                
                $sitemap .= '  </url>' . "\n";
            }
        }

        $sitemap .= '</urlset>';
        
        return $sitemap;
    }
}
