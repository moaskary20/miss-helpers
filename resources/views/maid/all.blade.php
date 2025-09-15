<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.view_all_maids') }} | {{ config('app.name', 'Miss Helpers') }}</title>
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
            <a href="{{ route('welcome') }}" class="brand">
                <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
            </a>
            <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="{{ route('welcome') }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index') }}">{{ __('messages.about') }}</a>
                <a href="{{ route('service.index') }}">{{ __('messages.services') }}</a>
                <a href="{{ route('contact.index') }}">{{ __('messages.contact') }}</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contact.index') }}" class="cta-btn d-none d-md-inline">{{ __('messages.get_maid_now') }}</a>
                <form action="{{ route('language.switch') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}">
                    <button type="submit" class="btn btn-link text-decoration-none p-0">
                        {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
                    </button>
                </form>
                <div class="auth d-none d-md-inline"><a href="{{ route('admin.login') }}">Login / Register</a></div>
                <button class="btn btn-outline-secondary d-md-none" data-bs-toggle="collapse" data-bs-target="#mnav"><i class="bi bi-list"></i></button>
            </div>
        </div>
        <div id="mnav" class="collapse border-top d-md-none">
            <div class="container py-2 nav-links">
                <a href="{{ route('welcome') }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index') }}">{{ __('messages.about') }}</a>
                <a href="{{ route('service.index') }}">{{ __('messages.services') }}</a>
                <a href="{{ route('contact.index') }}">{{ __('messages.contact') }}</a>
                <form action="{{ route('language.switch') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}">
                    <button type="submit" class="btn btn-link text-decoration-none p-0 w-100 text-start">
                        {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
                    </button>
                </form>
                <a href="{{ route('admin.login') }}">Login / Register</a>
                <a href="{{ route('contact.index') }}" class="cta-btn mt-2 w-100">{{ __('messages.get_maid_now') }}</a>
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
            <form method="GET" action="{{ route('maids.all') }}" id="searchForm">
                <!-- البحث النصي -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="bi bi-search me-2"></i>
                                البحث النصي
                            </label>
                            <input type="text" name="search" class="form-control filter-select" 
                                   placeholder="ابحث بالاسم، الجنسية، أو نوع الخدمة..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                </div>

                <!-- الفلاتر الأساسية -->
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">{{ __('messages.nationality') }}</label>
                            <select name="nationality" class="form-select filter-select">
                                <option value="">جميع الجنسيات</option>
                                @if(isset($searchOptions['nationalities']))
                                    @foreach($searchOptions['nationalities'] as $nationality)
                                        <option value="{{ $nationality }}" {{ request('nationality') == $nationality ? 'selected' : '' }}>
                                            {{ $nationality }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">نوع الخدمة</label>
                            <select name="service" class="form-select filter-select">
                                <option value="">جميع أنواع الخدمات</option>
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
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">سنوات الخبرة</label>
                            <select name="experience" class="form-select filter-select">
                                <option value="">جميع المستويات</option>
                                <option value="1-3" {{ request('experience') == '1-3' ? 'selected' : '' }}>1-3 سنوات</option>
                                <option value="4-6" {{ request('experience') == '4-6' ? 'selected' : '' }}>4-6 سنوات</option>
                                <option value="7-10" {{ request('experience') == '7-10' ? 'selected' : '' }}>7-10 سنوات</option>
                                <option value="10+" {{ request('experience') == '10+' ? 'selected' : '' }}>أكثر من 10 سنوات</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">نوع الباقة</label>
                            <select name="package_type" class="form-select filter-select">
                                <option value="">جميع الباقات</option>
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
                            <label class="filter-label">الحالة</label>
                            <select name="status" class="form-select filter-select">
                                <option value="">جميع الحالات</option>
                                <option value="متاحة" {{ request('status') == 'متاحة' ? 'selected' : '' }}>متاحة</option>
                                <option value="غير متاحة" {{ request('status') == 'غير متاحة' ? 'selected' : '' }}>غير متاحة</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">الديانة</label>
                            <select name="religion" class="form-select filter-select">
                                <option value="">جميع الديانات</option>
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
                            <label class="filter-label">الحالة الاجتماعية</label>
                            <select name="marital_status" class="form-select filter-select">
                                <option value="">جميع الحالات</option>
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

                    <div class="col-lg-3 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">اللغة</label>
                            <select name="language" class="form-select filter-select">
                                <option value="">جميع اللغات</option>
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
                </div>

                <!-- فلاتر العمر والراتب -->
                <div class="row g-3 mt-2">
                    <div class="col-lg-6">
                        <div class="filter-group">
                            <label class="filter-label">نطاق العمر</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="age_min" class="form-control filter-select" 
                                           placeholder="الحد الأدنى" min="18" max="65" 
                                           value="{{ request('age_min') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="age_max" class="form-control filter-select" 
                                           placeholder="الحد الأقصى" min="18" max="65" 
                                           value="{{ request('age_max') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="filter-group">
                            <label class="filter-label">نطاق الراتب الشهري (درهم)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="salary_min" class="form-control filter-select" 
                                           placeholder="الحد الأدنى" min="0" 
                                           value="{{ request('salary_min') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="salary_max" class="form-control filter-select" 
                                           placeholder="الحد الأقصى" min="0" 
                                           value="{{ request('salary_max') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ترتيب النتائج -->
                <div class="row g-3 mt-2">
                    <div class="col-lg-4 col-md-6">
                        <div class="filter-group">
                            <label class="filter-label">ترتيب النتائج</label>
                            <select name="sort" class="form-select filter-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>الأحدث أولاً</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم أولاً</option>
                                <option value="age_asc" {{ request('sort') == 'age_asc' ? 'selected' : '' }}>العمر (الأصغر أولاً)</option>
                                <option value="age_desc" {{ request('sort') == 'age_desc' ? 'selected' : '' }}>العمر (الأكبر أولاً)</option>
                                <option value="experience_desc" {{ request('sort') == 'experience_desc' ? 'selected' : '' }}>الأكثر خبرة</option>
                                <option value="experience_asc" {{ request('sort') == 'experience_asc' ? 'selected' : '' }}>الأقل خبرة</option>
                                <option value="salary_asc" {{ request('sort') == 'salary_asc' ? 'selected' : '' }}>الراتب (الأقل أولاً)</option>
                                <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>الراتب (الأعلى أولاً)</option>
                                <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>الأكثر مشاهدة</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn search-btn me-2">
                            <i class="bi bi-search me-2"></i>
                            بحث
                        </button>
                        <a href="{{ route('maids.all') }}" class="btn btn-outline-secondary ms-2">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            إعادة تعيين
                        </a>
                        <button type="button" class="btn btn-outline-info ms-2" id="toggleAdvancedFilters">
                            <i class="bi bi-funnel me-2"></i>
                            فلاتر متقدمة
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
                            تم العثور على {{ $filteredCount }} خادمة
                            @if($filteredCount != $totalMaids)
                                من أصل {{ $totalMaids }} خادمة متاحة
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
                            <span class="badge bg-primary">الفلاتر المطبقة:</span>
                            @if(request('nationality'))
                                <span class="badge bg-secondary">الجنسية: {{ request('nationality') }}</span>
                            @endif
                            @if(request('service'))
                                <span class="badge bg-secondary">الخدمة: {{ request('service') }}</span>
                            @endif
                            @if(request('experience'))
                                <span class="badge bg-secondary">الخبرة: {{ request('experience') }}</span>
                            @endif
                            @if(request('package_type'))
                                <span class="badge bg-secondary">الباقة: {{ request('package_type') }}</span>
                            @endif
                            @if(request('status'))
                                <span class="badge bg-secondary">الحالة: {{ request('status') }}</span>
                            @endif
                            @if(request('religion'))
                                <span class="badge bg-secondary">الديانة: {{ request('religion') }}</span>
                            @endif
                            @if(request('marital_status'))
                                <span class="badge bg-secondary">الحالة الاجتماعية: {{ request('marital_status') }}</span>
                            @endif
                            @if(request('language'))
                                <span class="badge bg-secondary">اللغة: {{ request('language') }}</span>
                            @endif
                            @if(request('age_min') || request('age_max'))
                                <span class="badge bg-secondary">
                                    العمر: {{ request('age_min', '18') }}-{{ request('age_max', '65') }}
                                </span>
                            @endif
                            @if(request('salary_min') || request('salary_max'))
                                <span class="badge bg-secondary">
                                    الراتب: {{ request('salary_min', '0') }}-{{ request('salary_max', '∞') }} درهم
                                </span>
                            @endif
                            @if(request('search'))
                                <span class="badge bg-secondary">البحث: "{{ request('search') }}"</span>
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
                                    <span class="nationality-badge">{{ $maid->nationality }}</span>
                                </div>
                                
                                <div class="maid-actions-bottom">
                                    <a href="{{ route('maid.profile', $maid->id) }}" class="btn btn-primary w-100">
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
                <a href="{{ route('maids.all') }}" class="btn btn-primary">
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
        const advancedFilters = document.querySelectorAll('.filter-group:nth-child(n+5)');
        let advancedVisible = false;

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                advancedVisible = !advancedVisible;
                advancedFilters.forEach(filter => {
                    filter.style.display = advancedVisible ? 'block' : 'none';
                });
                
                this.innerHTML = advancedVisible ? 
                    '<i class="bi bi-funnel-fill me-2"></i>إخفاء الفلاتر المتقدمة' :
                    '<i class="bi bi-funnel me-2"></i>فلاتر متقدمة';
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
