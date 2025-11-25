<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تصفح الخادمات - Miss Helpers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        * {
            box-sizing: border-box;
        }
        
        
        .brand {
    width: 8%;
  
}
       
@media (max-width: 480px) {
    .logo-image {
        max-width: 396% !important  ;
    }
}
 
        
        .container {
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }
        
        @media (max-width: 768px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            body {
                font-size: 14px;
                line-height: 1.4;
            }
            
            .page-header {
                padding: 30px 0;
            }
            
            .page-header h1 {
                font-size: 1.8rem;
                margin-bottom: 15px;
            }
            
            .page-header p {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            body {
                font-size: 13px;
            }
            
            .page-header {
                padding: 20px 0;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
                margin-bottom: 10px;
            }
            
            .page-header p {
                font-size: 0.9rem;
            }
        }
        
        
        
        /* Footer Styles */
        .footer-section {
            background: #23336b;
            color: white;
            padding: 60px 0 30px;
            margin-top: 80px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: #ffa19c;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .logo-text {
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }
        
        .company-description {
            color: #b8c5d6;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .footer-title {
            font-weight: 700;
            margin-bottom: 20px;
            color: white;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #b8c5d6;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #ffa19c;
        }
        
        .footer-bottom {
            border-top: 1px solid #3a4a6b;
            padding-top: 30px;
            margin-top: 40px;
            text-align: center;
            color: #b8c5d6;
        }
        
        
        .page-header {
            background: linear-gradient(135deg, #23336b 0%, #1a2533 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        .maid-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
        }
        .maid-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .maid-image-wrapper {
            position: relative;
            height: 400px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .maid-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .maid-card:hover .maid-image {
            transform: scale(1.1);
        }
        .maid-info {
            padding: 15px;
        }
        .maid-name {
            color: #23336b;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 8px;
            line-height: 1.3;
        }
        .maid-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
        }
        .stars {
            color: #ffc107;
            font-size: 1rem;
        }
        .maid-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }
        .views-badge {
            background: #e91e63;
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .nationality-badge {
            background: #6f42c1;
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .maid-actions-bottom .btn-primary {
            background: #23336b;
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #fff !important;
            transition: all 0.3s ease;
        }
        .maid-actions-bottom .btn-primary:hover {
            background: #1a2533;
            transform: translateY(-2px);
        }
        .pagination-wrapper {
            margin-top: 50px;
        }
        .page-link {
            color: #23336b;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            margin: 0 5px;
            padding: 12px 18px;
            transition: all 0.3s ease;
        }
        .page-link:hover {
            background: #23336b;
            color: white;
            border-color: #23336b;
        }
        .page-item.active .page-link {
            background: #23336b;
            border-color: #23336b;
        }
        
        /* تقليل حجم SVG في الـ pagination */
        .pagination-wrapper svg,
        .pagination svg,
        .page-item svg,
        .page-link svg,
        .pagination .page-link svg {
            width: 14px !important;
            height: 14px !important;
            max-width: 14px !important;
            max-height: 14px !important;
            display: inline-block;
            vertical-align: middle;
        }
        
        /* تقليل حجم SVG مع كلاسات Tailwind */
        svg.w-5,
        svg.h-5 {
            width: 14px !important;
            height: 14px !important;
        }
        
        .results-count {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .no-results i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        
        .search-filters {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .filter-group {
            margin-bottom: 20px;
        }
        
        .filter-label {
            color: #23336b;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .filter-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        
        .filter-select:focus {
            border-color: #23336b;
            box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25);
        }
        
        .search-btn {
            background: #e91e63;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: #c2185b;
            transform: translateY(-2px);
        }
        
        
        /* Mobile Footer Styles */
        @media (max-width: 768px) {
            .footer-section {
                padding: 40px 0 20px;
                margin-top: 60px;
            }
            
            .footer-logo {
                margin-bottom: 15px;
            }
            
            .logo-icon {
                width: 35px;
                height: 35px;
                font-size: 1.2rem;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .footer-title {
                font-size: 1rem;
                margin-bottom: 15px;
            }
            
            .footer-bottom {
                padding-top: 20px;
                margin-top: 30px;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .footer-section {
                padding: 30px 0 15px;
                margin-top: 40px;
            }
            
            .logo-icon {
                width: 30px;
                height: 30px;
                font-size: 1rem;
            }
            
            .logo-text {
                font-size: 0.9rem;
            }
            
            .footer-title {
                font-size: 0.9rem;
                margin-bottom: 10px;
            }
            
            .footer-bottom {
                padding-top: 15px;
                margin-top: 20px;
                font-size: 0.8rem;
            }
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .page-header {
                padding: 40px 0;
            }
            
            .page-header h1 {
                font-size: 1.8rem;
            }
            
            .page-header p {
                font-size: 1rem;
            }
            
            .filters-container {
                padding: 20px 15px;
                margin: 20px 0;
            }
            
            .filter-group {
                margin-bottom: 15px;
            }
            
            .search-filters .row {
                margin: 0;
            }
            
            .search-filters .col-lg-4,
            .search-filters .col-lg-3,
            .search-filters .col-md-6 {
                padding: 0 5px;
                margin-bottom: 15px;
            }
            
            .filter-label {
                font-size: 0.9rem;
                margin-bottom: 8px;
            }
            
            .filter-select {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
            
            .search-input {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
            
            .search-btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
            
            .advanced-search-btn {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
            
            .maids-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
                padding: 0 15px;
            }
            
            .maid-card {
                margin-bottom: 20px;
            }
            
            .maid-image-wrapper {
                height: 400px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f8f9fa;
            }
            
            .maid-info {
                padding: 12px;
            }
            
            .maid-name {
                font-size: 1rem;
                margin-bottom: 6px;
            }
            
            .maid-rating {
                margin-bottom: 8px;
            }
            
            .maid-stats {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                margin-bottom: 10px;
            }
            
            .views-badge {
                font-size: 0.8rem;
                padding: 3px 8px;
            }
            
            .nationality-badge {
                font-size: 0.8rem;
                padding: 3px 8px;
            }
            
            .maid-actions-bottom .btn {
                font-size: 0.85rem;
                padding: 8px 12px;
            }
            
            .no-results {
                padding: 40px 20px;
            }
            
            .no-results h3 {
                font-size: 1.3rem;
            }
            
            .no-results p {
                font-size: 0.9rem;
            }
            
            .stats-row {
                margin: 20px 0;
            }
            
            .stat-item {
                text-align: center;
                margin-bottom: 15px;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .stat-label {
                font-size: 0.8rem;
            }
            
            .advanced-filters {
                padding: 15px;
            }
            
            .advanced-filters .row {
                margin: 0;
            }
            
            .advanced-filters .col-lg-3,
            .advanced-filters .col-lg-4,
            .advanced-filters .col-md-6 {
                padding: 0 5px;
                margin-bottom: 15px;
            }
        }
        
        @media (max-width: 480px) {
            .page-header {
                padding: 30px 0;
            }
            
            .page-header h1 {
                font-size: 1.5rem;
            }
            
            .filters-container {
                padding: 15px 10px;
            }
            
            .maids-grid {
                padding: 0 10px;
                gap: 15px;
            }
            
            .maid-image-wrapper {
                height: 160px;
            }
            
            .maid-info {
                padding: 10px;
            }
            
            .maid-name {
                font-size: 0.95rem;
                margin-bottom: 5px;
            }
            
            .maid-rating {
                margin-bottom: 6px;
            }
            
            .stars {
                font-size: 0.85rem;
            }
            
            .maid-stats {
                margin-bottom: 8px;
                font-size: 0.8rem;
            }
            
            .maid-actions-bottom .btn {
                font-size: 0.8rem;
                padding: 6px 10px;
            }
            
            .advanced-filters {
                padding: 10px;
            }
            
            .advanced-filters .col-lg-3,
            .advanced-filters .col-lg-4,
            .advanced-filters .col-md-6 {
                padding: 0 3px;
                margin-bottom: 10px;
            }
            
            .search-filters .col-lg-4,
            .search-filters .col-lg-3,
            .search-filters .col-md-6 {
                padding: 0 3px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    @include('partials.header')
    
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">{{ __('messages.view_all_maids') }}</h1>
            <p class="lead">{{ __('messages.find_perfect_maid') }}</p>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="container">
        <div class="search-filters">
            <form method="GET" action="{{ route('maids.all.' . app()->getLocale()) }}" id="searchForm">
                <!-- البحث النصي -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="bi bi-search me-2"></i>
                                {{ __('messages.text_search') }}
                            </label>
                            <input type="text" name="search" class="form-control filter-select" 
                                   placeholder="{{ __('messages.search_placeholder') }}" 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                </div>

                <!-- الفلاتر الأساسية -->
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">{{ __('messages.nationality') }}</label>
                            <select name="nationality" class="form-select filter-select">
                                <option value="">{{ __('messages.all_nationalities') }}</option>
                                @foreach(\App\Models\Maid::getAvailableNationalities() as $key => $value)
                                    <option value="{{ $key }}" {{ request('nationality') == $key ? 'selected' : '' }}>
                                        {{ \App\Helpers\TranslationHelper::translateMaidValue($value) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">{{ __('messages.service_type') }}</label>
                            <select name="service" class="form-select filter-select">
                                <option value="">{{ __('messages.all_service_types') }}</option>
                                @if(isset($searchOptions['jobTitles']))
                                    @foreach($searchOptions['jobTitles'] as $jobTitle)
                                        <option value="{{ $jobTitle }}" {{ request('service') == $jobTitle ? 'selected' : '' }}>
                                            {{ \App\Helpers\TranslationHelper::translateMaidValue($jobTitle) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">{{ __('messages.experience_years') }}</label>
                            <select name="experience" class="form-select filter-select">
                                <option value="">{{ __('messages.all_levels') }}</option>
                                <option value="1-3" {{ request('experience') == '1-3' ? 'selected' : '' }}>{{ __('messages.years_1_3') }}</option>
                                <option value="4-6" {{ request('experience') == '4-6' ? 'selected' : '' }}>{{ __('messages.years_4_6') }}</option>
                                <option value="7-10" {{ request('experience') == '7-10' ? 'selected' : '' }}>{{ __('messages.years_7_10') }}</option>
                                <option value="10+" {{ request('experience') == '10+' ? 'selected' : '' }}>{{ __('messages.years_10_plus') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- الفلاتر المتقدمة (مخفية افتراضياً) -->
                <div id="advancedFilters" class="mt-3" style="display: none;">
                    <!-- الصف الأول -->
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.package_type') }}</label>
                                <select name="package_type" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_packages') }}</option>
                                    @foreach(\App\Models\Maid::distinct()->pluck('package_type')->filter()->sort()->values() as $packageType)
                                        <option value="{{ $packageType }}" {{ request('package_type') == $packageType ? 'selected' : '' }}>
                                            {{ $packageType }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.status') }}</label>
                                <select name="status" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_statuses') }}</option>
                                    <option value="متاحة" {{ request('status') == 'متاحة' ? 'selected' : '' }}>{{ __('messages.available') }}</option>
                                    <option value="غير متاحة" {{ request('status') == 'غير متاحة' ? 'selected' : '' }}>{{ __('messages.unavailable') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.religion') }}</label>
                                <select name="religion" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_religions') }}</option>
                                    <option value="مسلمة" {{ request('religion') == 'مسلمة' ? 'selected' : '' }}>{{ __('messages.muslim') }}</option>
                                    <option value="مسيحية" {{ request('religion') == 'مسيحية' ? 'selected' : '' }}>{{ __('messages.christian') }}</option>
                                    <option value="أخرى" {{ request('religion') == 'أخرى' ? 'selected' : '' }}>{{ __('messages.other_religion') }}</option>
                                    <option value="غير محدد" {{ request('religion') == 'غير محدد' ? 'selected' : '' }}>{{ __('messages.not_specified_religion') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.marital_status') }}</label>
                                <select name="marital_status" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_marital_statuses') }}</option>
                                    <option value="أعزب/عزباء" {{ request('marital_status') == 'أعزب/عزباء' ? 'selected' : '' }}>{{ __('messages.single_male') }}</option>
                                    <option value="متزوج/متزوجة" {{ request('marital_status') == 'متزوج/متزوجة' ? 'selected' : '' }}>{{ __('messages.married_male') }}</option>
                                    <option value="متزوجة" {{ request('marital_status') == 'متزوجة' ? 'selected' : '' }}>{{ __('messages.married_female') }}</option>
                                    <option value="أرملة" {{ request('marital_status') == 'أرملة' ? 'selected' : '' }}>{{ __('messages.widowed_female') }}</option>
                                    <option value="مطلق/مطلقة" {{ request('marital_status') == 'مطلق/مطلقة' ? 'selected' : '' }}>{{ __('messages.divorced_male') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- الصف الثاني -->
                    <div class="row g-3 mb-3">
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.language') }}</label>
                                <select name="language" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_languages') }}</option>
                                    <option value="عربية" {{ request('language') == 'عربية' ? 'selected' : '' }}>{{ __('messages.arabic') }}</option>
                                    <option value="English" {{ request('language') == 'English' ? 'selected' : '' }}>{{ __('messages.english') }}</option>
                                    <option value="Arabic & L.English" {{ request('language') == 'Arabic & L.English' ? 'selected' : '' }}>{{ __('messages.arabic_limited_english') }}</option>
                                    <option value="English & L.Arabic" {{ request('language') == 'English & L.Arabic' ? 'selected' : '' }}>{{ __('messages.english_limited_arabic') }}</option>
                                    <option value="Little English" {{ request('language') == 'Little English' ? 'selected' : '' }}>{{ __('messages.little_english') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- فلاتر العمر -->
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.age_range') }}</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="age_min" class="form-control filter-select" 
                                               placeholder="{{ __('messages.age_minimum') }}" min="18" max="65" 
                                               value="{{ request('age_min') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="age_max" class="form-control filter-select" 
                                               placeholder="{{ __('messages.age_maximum') }}" min="18" max="65" 
                                               value="{{ request('age_max') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- فلاتر الراتب -->
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.salary_range') }} (درهم إماراتي)</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="salary_min" class="form-control filter-select" 
                                               placeholder="{{ __('messages.salary_minimum') }}" min="0" 
                                               value="{{ request('salary_min') }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="salary_max" class="form-control filter-select" 
                                               placeholder="{{ __('messages.salary_maximum') }}" min="0" 
                                               value="{{ request('salary_max') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ترتيب النتائج -->
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.sort_results') }}</label>
                                <select name="sort" class="form-select filter-select">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>{{ __('messages.newest_first') }}</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('messages.oldest_first') }}</option>
                                    <option value="age_asc" {{ request('sort') == 'age_asc' ? 'selected' : '' }}>{{ __('messages.age_youngest_first') }}</option>
                                    <option value="age_desc" {{ request('sort') == 'age_desc' ? 'selected' : '' }}>{{ __('messages.age_oldest_first') }}</option>
                                    <option value="experience_desc" {{ request('sort') == 'experience_desc' ? 'selected' : '' }}>{{ __('messages.most_experienced') }}</option>
                                    <option value="experience_asc" {{ request('sort') == 'experience_asc' ? 'selected' : '' }}>{{ __('messages.least_experienced') }}</option>
                                    <option value="salary_asc" {{ request('sort') == 'salary_asc' ? 'selected' : '' }}>{{ __('messages.salary_lowest_first') }}</option>
                                    <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>{{ __('messages.salary_highest_first') }}</option>
                                    <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>{{ __('messages.most_viewed') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn search-btn me-2">
                            <i class="bi bi-search me-2"></i>
                            {{ __('messages.search') }}
                        </button>
                        <a href="{{ route('maids.all.' . app()->getLocale()) }}" class="btn btn-outline-secondary ms-2">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            {{ __('messages.reset') }}
                        </a>
                        <button type="button" class="btn btn-outline-info ms-2" id="toggleAdvancedFilters">
                            <i class="bi bi-funnel me-2"></i>
                            {{ __('messages.advanced_search') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Results -->
    <div class="container mt-5">
        @if($maids->count() > 0)
            <div class="results-count">
                <h4>
                    <i class="bi bi-search me-2"></i>
                    {{ __('messages.found_maids') }} {{ $filteredCount }} {{ __('messages.maids_available') }}
                    @if($filteredCount != $totalMaids)
                        {{ __('messages.out_of_available') }} {{ $totalMaids }} {{ __('messages.maids_available') }}
                    @endif
                </h4>
            </div>
            
            <div class="row g-3">
                @foreach($maids as $maid)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="maid-card">
                            <div class="maid-image-wrapper">
                                <img src="{{ $maid->image_path ? asset('storage/' . $maid->image_path) : asset('/images/default-maid.jpg') }}" 
                                     alt="{{ $maid->name }}" class="maid-image"
                                     onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                            </div>
                            
                            <div class="maid-info">
                                <h5 class="maid-name">{{ $maid->name }}</h5>
                                
                                <div class="maid-rating">
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= ($maid->rating ?? 0))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-muted">({{ $maid->reviews_count ?? 0 }} تقييم)</small>
                                </div>
                                
                                <div class="maid-stats">
                                    <span class="views-badge">
                                        <i class="bi bi-eye me-1"></i>
                                        {{ __('messages.views') }} {{ $maid->views_count ?? rand(40, 80) }}
                                    </span>
                                    <span class="nationality-badge">
                                        {{ $maid->nationality ?? 'غير محدد' }}
                                    </span>
                                </div>
                                
                                <div class="maid-actions-bottom">
                                    <a href="{{ route('maid.profile.' . app()->getLocale(), ['id' => $maid->id]) }}" class="btn btn-primary w-100">
                                        {{ __('messages.view_profile') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $maids->appends(request()->query())->links() }}
            </div>
        @else
            <div class="no-results">
                <i class="bi bi-search"></i>
                <h3>{{ __('messages.no_results') }}</h3>
                <p>{{ __('messages.search_placeholder') }}</p>
                <a href="{{ route('maids.all.' . app()->getLocale()) }}" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    {{ __('messages.search_now') }}
                </a>
            </div>
        @endif
    </div>

    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Ensure page loads properly on mobile
    document.addEventListener('DOMContentLoaded', function() {
        // Force mobile viewport fix
        if (window.innerWidth <= 768) {
            document.body.style.overflowX = 'hidden';
            document.body.style.width = '100%';
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.body.style.overflowX = 'hidden';
                document.body.style.width = '100%';
            }
        });
        
        // Ensure all images are responsive
        const images = document.querySelectorAll('img');
        images.forEach(function(img) {
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
        });
        // تحسين تجربة البحث
        const searchForm = document.getElementById('searchForm');
        const filterSelects = document.querySelectorAll('.filter-select');
        
        // البحث التلقائي عند تغيير الفلاتر (مع تأخير)
        let searchTimeout;
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    searchForm.submit();
                }, 500);
            });
        });

        // البحث النصي مع تأخير
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (this.value.length >= 2 || this.value.length === 0) {
                        searchForm.submit();
                    }
                }, 800);
            });
        }

        // تحسين UX للبحث
        const searchBtn = document.querySelector('.search-btn');
        if (searchBtn) {
            searchForm.addEventListener('submit', function() {
                searchBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>جاري البحث...';
                searchBtn.disabled = true;
            });
        }

        // إخفاء/إظهار الفلاتر المتقدمة
        const toggleBtn = document.getElementById('toggleAdvancedFilters');
        const advancedFilters = document.getElementById('advancedFilters');
        let advancedVisible = false;

        if (toggleBtn && advancedFilters) {
            toggleBtn.addEventListener('click', function() {
                advancedVisible = !advancedVisible;
                advancedFilters.style.display = advancedVisible ? 'block' : 'none';
                
                this.innerHTML = advancedVisible ? 
                    '<i class="bi bi-funnel-fill me-2"></i>{{ __("messages.hide_advanced_filters") }}' :
                    '<i class="bi bi-funnel me-2"></i>{{ __("messages.advanced_search") }}';
            });
        }
    });
    </script>
</body>
</html>