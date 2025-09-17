<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seoData = \App\Helpers\SeoHelper::generateMetaTags('maids', app()->getLocale());
        $schemaMarkup = \App\Helpers\SeoHelper::generateSchemaMarkup('maids');
        $seoData['schema_markup'] = $schemaMarkup;
    @endphp
    
    @include('partials.seo-meta', ['metaData' => $seoData])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* Header */
        .site-header{position:sticky;top:0;z-index:1000;background:#fff;border-bottom:1px solid #f1f1f1}
        .header-inner{height:64px;display:flex;align-items:center;justify-content:space-between}
        .brand{text-decoration:none;color:#1c1c1c;font-weight:700;font-size:1.5rem}
        .brand img{height:40px;width:auto}
        .nav-links{display:flex;gap:10px}
        .nav-links a{color:#1c1c1c;text-decoration:none;padding:10px 14px;border-radius:12px;font-weight:600}
        .nav-links a:hover{background:#f6f7fb}
        .cta-btn{background:#0d6efd;color:#fff;border:none;border-radius:18px;padding:10px 18px;font-weight:800;text-decoration:none;display:inline-block}
        .cta-btn:hover{background:#0b5ed7;color:#fff;text-decoration:none}
        .auth a{color:#1c1c1c;text-decoration:none;margin-inline-start:14px}
        
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }
        
        .page-header {
            background: linear-gradient(135deg, #23336b 0%, #1a2533 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
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
            height: 250px;
            overflow: hidden;
        }
        
        .maid-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .maid-card:hover .maid-image {
            transform: scale(1.1);
        }
        
        .maid-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, transparent 50%, rgba(0,0,0,0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .maid-card:hover .maid-overlay {
            opacity: 1;
        }
        
        .maid-actions {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        
        .like-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.9);
            border: none;
            transition: all 0.3s ease;
        }
        
        .like-btn:hover {
            background: #fff;
            transform: scale(1.1);
        }
        
        .maid-info {
            padding: 20px;
        }
        
        .maid-name {
            color: #23336b;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .maid-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .stars {
            color: #ffc107;
            font-size: 1rem;
        }
        
        .maid-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
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
            padding: 12px;
            font-weight: 600;
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
        
        @media (max-width: 768px) {
            .search-filters {
                margin-top: -30px;
                padding: 20px;
            }
            
            .maid-image-wrapper {
                height: 200px;
            }
            
            .maid-name {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="container header-inner">
            <a href="/{{ app()->getLocale() }}" class="brand">
                <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
            </a>
            <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about') }}</a>
                <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.services') }}</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.contact') }}</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn d-none d-md-inline">{{ __('messages.get_maid_now') }}</a>
                <a href="/{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}" class="btn btn-link text-decoration-none p-0">
                    {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
                </a>
                <div class="auth d-none d-md-inline"><a href="{{ route('admin.login') }}">Login / Register</a></div>
                <button class="btn btn-outline-secondary d-md-none" data-bs-toggle="collapse" data-bs-target="#mnav"><i class="bi bi-list"></i></button>
            </div>
        </div>
        <div id="mnav" class="collapse border-top d-md-none">
            <div class="container py-2 nav-links">
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about') }}</a>
                <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.services') }}</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.contact') }}</a>
                <a href="/{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}" class="btn btn-link text-decoration-none p-0 w-100 text-start">
                    {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
                </a>
                <a href="{{ route('admin.login') }}">Login / Register</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn mt-2 w-100">{{ __('messages.get_maid_now') }}</a>
            </div>
        </div>
    </header>

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
            <form method="GET" action="{{ route('maids.all', ['locale' => app()->getLocale()]) }}" id="searchForm">
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
                                @if(isset($searchOptions['nationalities']))
                                    @foreach($searchOptions['nationalities'] as $nationality)
                                        @php
                                            // Map raw Arabic/English values to canonical translation keys
                                            $nationalityMap = [
                                                'أوغندا' => 'nationality_uganda',
                                                'الفلبين' => 'nationality_philippines',
                                                'سريلانكا' => 'nationality_sri_lanka',
                                                'إثيوبيا' => 'nationality_ethiopia',
                                                'كينيا' => 'nationality_kenya',
                                                'مدغشقر' => 'nationality_madagascar',
                                                'الهند' => 'nationality_india',
                                                'باكستان' => 'nationality_pakistan',
                                                'إندونيسيا' => 'nationality_indonesia',
                                                'ميانمار' => 'nationality_myanmar',
                                                'المغرب' => 'nationality_morocco',
                                                'تونس' => 'nationality_tunisia',
                                                'مصر' => 'nationality_egypt',
                                                // Also handle already-English inputs just in case
                                                'Uganda' => 'nationality_uganda',
                                                'Philippines' => 'nationality_philippines',
                                                'Sri Lanka' => 'nationality_sri_lanka',
                                                'Ethiopia' => 'nationality_ethiopia',
                                                'Kenya' => 'nationality_kenya',
                                                'Madagascar' => 'nationality_madagascar',
                                                'India' => 'nationality_india',
                                                'Pakistan' => 'nationality_pakistan',
                                                'Indonesia' => 'nationality_indonesia',
                                                'Myanmar' => 'nationality_myanmar',
                                                'Morocco' => 'nationality_morocco',
                                                'Tunisia' => 'nationality_tunisia',
                                                'Egypt' => 'nationality_egypt',
                                            ];
                                            $nationalityKey = $nationalityMap[$nationality] ?? ('nationality_' . strtolower(str_replace([' ', '-'], '_', $nationality)));
                                            $translatedNationality = __('messages.' . $nationalityKey);
                                            $displayNationality = $translatedNationality !== 'messages.' . $nationalityKey ? $translatedNationality : $nationality;
                                        @endphp
                                        <option value="{{ $nationality }}" {{ request('nationality') == $nationality ? 'selected' : '' }}>
                                            {{ $displayNationality }}
                                        </option>
                                    @endforeach
                                @endif
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
                                            {{ $jobTitle }}
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
                                <option value="1-3" {{ request('experience') == '1-3' ? 'selected' : '' }}>1-3 سنوات</option>
                                <option value="4-6" {{ request('experience') == '4-6' ? 'selected' : '' }}>4-6 سنوات</option>
                                <option value="7-10" {{ request('experience') == '7-10' ? 'selected' : '' }}>7-10 سنوات</option>
                                <option value="10+" {{ request('experience') == '10+' ? 'selected' : '' }}>أكثر من 10 سنوات</option>
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
                                    @if(isset($searchOptions['packageTypes']))
                                        @foreach($searchOptions['packageTypes'] as $packageType)
                                            <option value="{{ $packageType }}" {{ request('package_type') == $packageType ? 'selected' : '' }}>
                                                {{ $packageType }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.status') }}</label>
                                <select name="status" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_statuses') }}</option>
                                    <option value="متاحة" {{ request('status') == 'متاحة' ? 'selected' : '' }}>متاحة</option>
                                    <option value="غير متاحة" {{ request('status') == 'غير متاحة' ? 'selected' : '' }}>غير متاحة</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.religion') }}</label>
                                <select name="religion" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_religions') }}</option>
                                    @if(isset($searchOptions['religions']))
                                        @foreach($searchOptions['religions'] as $religion)
                                            <option value="{{ $religion }}" {{ request('religion') == $religion ? 'selected' : '' }}>
                                                {{ $religion }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="filter-group">
                                <label class="filter-label">{{ __('messages.marital_status') }}</label>
                                <select name="marital_status" class="form-select filter-select">
                                    <option value="">{{ __('messages.all_marital_statuses') }}</option>
                                    @if(isset($searchOptions['maritalStatuses']))
                                        @foreach($searchOptions['maritalStatuses'] as $maritalStatus)
                                            <option value="{{ $maritalStatus }}" {{ request('marital_status') == $maritalStatus ? 'selected' : '' }}>
                                                {{ $maritalStatus }}
                                            </option>
                                        @endforeach
                                    @endif
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
                                    @if(isset($searchOptions['languages']))
                                        @foreach($searchOptions['languages'] as $language)
                                            <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>
                                                {{ $language }}
                                            </option>
                                        @endforeach
                                    @endif
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
                                <label class="filter-label">{{ __('messages.salary_range') }} ({{ __('messages.riyal') }})</label>
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
                                    <option value="age_asc" {{ request('sort') == 'age_asc' ? 'selected' : '' }}>{{ __('messages.age_youngest') }}</option>
                                    <option value="age_desc" {{ request('sort') == 'age_desc' ? 'selected' : '' }}>{{ __('messages.age_oldest') }}</option>
                                    <option value="experience_desc" {{ request('sort') == 'experience_desc' ? 'selected' : '' }}>{{ __('messages.most_experienced') }}</option>
                                    <option value="experience_asc" {{ request('sort') == 'experience_asc' ? 'selected' : '' }}>{{ __('messages.least_experienced') }}</option>
                                    <option value="salary_asc" {{ request('sort') == 'salary_asc' ? 'selected' : '' }}>{{ __('messages.salary_lowest') }}</option>
                                    <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>{{ __('messages.salary_highest') }}</option>
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
                        <a href="{{ route('maids.all', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-secondary ms-2">
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
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-0">
                            <i class="bi bi-search me-2"></i>
                            {{ __('messages.found_maids') }} {{ $filteredCount }} {{ __('messages.maids_available') }}
                            @if($filteredCount != $totalMaids)
                                {{ __('messages.out_of_available') }} {{ $totalMaids }} {{ __('messages.maids_available') }}
                            @endif
                        </h4>
                    </div>
                    <div class="col-md-4 text-end">
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>
                            آخر تحديث: {{ now()->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
                
                @if(request()->hasAny(['nationality', 'service', 'experience', 'package_type', 'status', 'religion', 'marital_status', 'language', 'age_min', 'age_max', 'salary_min', 'salary_max', 'search']))
                    <div class="mt-3">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">{{ __('messages.applied_filters') }}:</span>
                            @if(request('nationality'))
                                <span class="badge bg-secondary">{{ __('messages.nationality') }}: {{ request('nationality') }}</span>
                            @endif
                            @if(request('service'))
                                <span class="badge bg-secondary">{{ __('messages.service') }}: {{ request('service') }}</span>
                            @endif
                            @if(request('experience'))
                                <span class="badge bg-secondary">{{ __('messages.experience') }}: {{ request('experience') }}</span>
                            @endif
                            @if(request('package_type'))
                                <span class="badge bg-secondary">{{ __('messages.package') }}: {{ request('package_type') }}</span>
                            @endif
                            @if(request('status'))
                                <span class="badge bg-secondary">{{ __('messages.status') }}: {{ request('status') }}</span>
                            @endif
                            @if(request('religion'))
                                <span class="badge bg-secondary">{{ __('messages.religion') }}: {{ request('religion') }}</span>
                            @endif
                            @if(request('marital_status'))
                                <span class="badge bg-secondary">{{ __('messages.marital_status') }}: {{ request('marital_status') }}</span>
                            @endif
                            @if(request('language'))
                                <span class="badge bg-secondary">{{ __('messages.language') }}: {{ request('language') }}</span>
                            @endif
                            @if(request('age_min') || request('age_max'))
                                <span class="badge bg-secondary">
                                    {{ __('messages.age_range') }}: {{ request('age_min', '18') }}-{{ request('age_max', '65') }}
                                </span>
                            @endif
                            @if(request('salary_min') || request('salary_max'))
                                <span class="badge bg-secondary">
                                    {{ __('messages.salary_range') }}: {{ request('salary_min', '0') }}-{{ request('salary_max', '∞') }} {{ __('messages.riyal') }}
                                </span>
                            @endif
                            @if(request('search'))
                                <span class="badge bg-secondary">{{ __('messages.search') }}: "{{ request('search') }}"</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="row g-4">
                @foreach($maids as $maid)
                    <div class="col-lg-4 col-md-6">
                        <div class="maid-card">
                            <div class="maid-image-wrapper">
                                <img src="{{ $maid->image_path ? asset('storage/' . $maid->image_path) : asset('/images/default-maid.jpg') }}" 
                                     alt="{{ $maid->name }}" class="maid-image"
                                     onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                                <div class="maid-overlay">
                                    <div class="maid-actions">
                                        <button class="btn btn-light btn-sm like-btn" data-maid-id="{{ $maid->id }}">
                                            <i class="bi bi-heart"></i>
                                        </button>
                                    </div>
                                </div>
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
                                        @php
                                            $nationalityMap = [
                                                'أوغندا' => 'nationality_uganda',
                                                'الفلبين' => 'nationality_philippines',
                                                'سريلانكا' => 'nationality_sri_lanka',
                                                'إثيوبيا' => 'nationality_ethiopia',
                                                'كينيا' => 'nationality_kenya',
                                                'مدغشقر' => 'nationality_madagascar',
                                                'الهند' => 'nationality_india',
                                                'باكستان' => 'nationality_pakistan',
                                                'إندونيسيا' => 'nationality_indonesia',
                                                'ميانمار' => 'nationality_myanmar',
                                                'المغرب' => 'nationality_morocco',
                                                'تونس' => 'nationality_tunisia',
                                                'مصر' => 'nationality_egypt',
                                                'Uganda' => 'nationality_uganda',
                                                'Philippines' => 'nationality_philippines',
                                                'Sri Lanka' => 'nationality_sri_lanka',
                                                'Ethiopia' => 'nationality_ethiopia',
                                                'Kenya' => 'nationality_kenya',
                                                'Madagascar' => 'nationality_madagascar',
                                                'India' => 'nationality_india',
                                                'Pakistan' => 'nationality_pakistan',
                                                'Indonesia' => 'nationality_indonesia',
                                                'Myanmar' => 'nationality_myanmar',
                                                'Morocco' => 'nationality_morocco',
                                                'Tunisia' => 'nationality_tunisia',
                                                'Egypt' => 'nationality_egypt',
                                            ];
                                            $nat = $maid->nationality ?? '';
                                            $nationalityKey = $nationalityMap[$nat] ?? ('nationality_' . strtolower(str_replace([' ', '-'], '_', $nat)));
                                            $translatedNationality = __('messages.' . $nationalityKey);
                                            echo $translatedNationality !== 'messages.' . $nationalityKey ? $translatedNationality : $nat;
                                        @endphp
                                    </span>
                                </div>
                                
                                <div class="maid-actions-bottom">
                                    <a href="{{ route('maid.profile', ['locale' => app()->getLocale(), 'id' => $maid->id]) }}" class="btn btn-primary w-100">
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
                <a href="{{ route('maids.all', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    {{ __('messages.search_now') }}
                </a>
            </div>
        @endif
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // زر الإعجاب
        const likeBtns = document.querySelectorAll('.like-btn');
        
        likeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const maidId = this.dataset.maidId;
                const icon = this.querySelector('i');
                
                // تبديل حالة الإعجاب
                if (icon.classList.contains('bi-heart')) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                    icon.style.color = '#e91e63';
                } else {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                    icon.style.color = '';
                }
                
                // هنا يمكن إرسال طلب AJAX لحفظ حالة الإعجاب
                console.log('Toggle like for maid:', maidId);
            });
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

        // إخفاء/إظهار الفلاتر المتقدمة
        const toggleBtn = document.getElementById('toggleAdvancedFilters');
        const advancedFilters = document.getElementById('advancedFilters');
        let advancedVisible = false;

        if (toggleBtn && advancedFilters) {
            toggleBtn.addEventListener('click', function() {
                advancedVisible = !advancedVisible;
                advancedFilters.style.display = advancedVisible ? 'block' : 'none';
                
                this.innerHTML = advancedVisible ? 
                    '<i class="bi bi-funnel-fill me-2"></i>{{ __('messages.hide_advanced_filters') }}' :
                    '<i class="bi bi-funnel me-2"></i>{{ __('messages.advanced_search') }}';
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

        // حفظ الفلاتر في localStorage
        filterSelects.forEach(select => {
            const savedValue = localStorage.getItem(`filter_${select.name}`);
            if (savedValue && !select.value) {
                select.value = savedValue;
            }
            
            select.addEventListener('change', function() {
                localStorage.setItem(`filter_${this.name}`, this.value);
            });
        });

        // استعادة الفلاتر المحفوظة
        window.addEventListener('load', function() {
            filterSelects.forEach(select => {
                const savedValue = localStorage.getItem(`filter_${select.name}`);
                if (savedValue && !select.value) {
                    select.value = savedValue;
                }
            });
        });
    });
    </script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>
</body>
</html>
