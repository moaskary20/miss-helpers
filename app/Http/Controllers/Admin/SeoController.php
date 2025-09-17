<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use App\Helpers\SeoHelper;

class SeoController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSetting::orderBy('page_type')->orderBy('locale')->get();
        $pageTypes = ['home', 'about', 'service', 'contact', 'maids', 'blog', 'maid_profile'];
        $locales = ['ar', 'en'];
        
        return view('admin.seo.index', compact('seoSettings', 'pageTypes', 'locales'));
    }

    public function create()
    {
        $pageTypes = ['home', 'about', 'service', 'contact', 'maids', 'blog', 'maid_profile'];
        $locales = ['ar', 'en'];
        
        return view('admin.seo.create', compact('pageTypes', 'locales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_type' => 'required|string|in:home,about,service,contact,maids,blog,maid_profile',
            'locale' => 'required|string|in:ar,en',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'keywords' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:500',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string|max:500',
            'twitter_image' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        SeoSetting::updateOrCreate(
            ['page_type' => $request->page_type, 'locale' => $request->locale],
            $data
        );

        return redirect()->route('admin.seo.index')->with('success', 'SEO settings saved successfully!');
    }

    public function edit($id)
    {
        $seoSetting = SeoSetting::findOrFail($id);
        $pageTypes = ['home', 'about', 'service', 'contact', 'maids', 'blog', 'maid_profile'];
        $locales = ['ar', 'en'];
        
        return view('admin.seo.edit', compact('seoSetting', 'pageTypes', 'locales'));
    }

    public function update(Request $request, $id)
    {
        $seoSetting = SeoSetting::findOrFail($id);
        
        $request->validate([
            'page_type' => 'required|string|in:home,about,service,contact,maids,blog,maid_profile',
            'locale' => 'required|string|in:ar,en',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'keywords' => 'nullable|string|max:500',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:500',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string|max:500',
            'twitter_image' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $seoSetting->update($data);

        return redirect()->route('admin.seo.index')->with('success', 'SEO settings updated successfully!');
    }

    public function destroy($id)
    {
        $seoSetting = SeoSetting::findOrFail($id);
        $seoSetting->delete();

        return redirect()->route('admin.seo.index')->with('success', 'SEO settings deleted successfully!');
    }

    public function generateSitemap()
    {
        $sitemap = SeoHelper::generateSitemap();
        
        $filePath = public_path('sitemap.xml');
        file_put_contents($filePath, $sitemap);
        
        return redirect()->back()->with('success', 'Sitemap generated successfully!');
    }

    public function preview($pageType, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $metaData = SeoHelper::generateMetaTags($pageType, $locale);
        
        return view('admin.seo.preview', compact('metaData', 'pageType', 'locale'));
    }
}