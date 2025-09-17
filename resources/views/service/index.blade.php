<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.services') }} - {{ config('app.name', 'Miss Helpers') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .services-page {
            min-height: 100vh;
            padding: 80px 0;
        }
        
        .page-title {
            text-align: center;
            color: #23336b;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .title-highlight {
            color: #e91e63;
            position: relative;
            display: inline-block;
        }
        
        .title-highlight::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -10px;
            right: -10px;
            bottom: -5px;
            border: 3px solid #e91e63;
            border-radius: 50%;
            z-index: -1;
        }
        
        .packages-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .packages-row {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .package-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .package-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        .package-header {
            background: #23336b;
            color: white;
            padding: 25px 30px;
            text-align: center;
        }
        
        .package-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .package-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }
        
        .package-price {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .price-currency {
            color: #e91e63;
            font-size: 1.2rem;
            font-weight: 700;
        }
        
        .price-period {
            color: #e91e63;
            font-size: 0.9rem;
            display: block;
            margin-top: 5px;
        }
        
        .package-features {
            padding: 30px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .feature-icon {
            width: 25px;
            height: 25px;
            background: #23336b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        
        .feature-text {
            color: #495057;
            font-size: 1rem;
            line-height: 1.5;
            margin: 0;
        }
        
        .package-action {
            padding: 0 30px 30px;
            text-align: center;
        }
        
        .choose-btn {
            background: #23336b;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-decoration: none;
            display: inline-block;
        }
        
        .choose-btn:hover {
            background: #1a2540;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(35, 51, 107, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .choose-btn:active {
            transform: translateY(0);
        }
        
        .package-footer {
            text-align: center;
            padding: 20px 30px;
            background: #f8f9fa;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .recommended-ribbon {
            position: absolute;
            top: 20px;
            right: -30px;
            background: #e91e63;
            color: white;
            padding: 8px 40px;
            font-size: 0.8rem;
            font-weight: 700;
            transform: rotate(45deg);
            z-index: 10;
            box-shadow: 0 2px 10px rgba(233, 30, 99, 0.3);
        }
        
        /* تصميم متجاوب */
        @media (max-width: 991.98px) {
            .packages-row {
                flex-direction: column;
                align-items: center;
            }
            
            .package-card {
                max-width: 100%;
            }
        }
        
        @media (max-width: 767.98px) {
            .services-page {
                padding: 60px 0;
            }
            
            .page-title {
                font-size: 2.5rem;
            }
            
            .package-header {
                padding: 20px 25px;
            }
            
            .package-title {
                font-size: 1.3rem;
            }
            
            .package-features {
                padding: 25px;
            }
            
            .package-action {
                padding: 0 25px 25px;
            }
            
            .choose-btn {
                padding: 12px 30px;
                font-size: 1rem;
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
                @php
                    $newLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
                    $segments = request()->segments();
                    if (count($segments) > 0) { $segments[0] = $newLocale; } else { $segments = [$newLocale]; }
                    $toggleUrl = '/'.implode('/', $segments);
                    $qs = request()->getQueryString();
                    if ($qs) { $toggleUrl .= '?'.$qs; }
                @endphp
                <a href="{{ $toggleUrl }}" class="btn btn-link text-decoration-none p-0">
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
                @php
                    $newLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
                    $segments = request()->segments();
                    if (count($segments) > 0) { $segments[0] = $newLocale; } else { $segments = [$newLocale]; }
                    $toggleUrl = '/'.implode('/', $segments);
                    $qs = request()->getQueryString();
                    if ($qs) { $toggleUrl .= '?'.$qs; }
                @endphp
                <a href="{{ $toggleUrl }}" class="btn btn-link text-decoration-none p-0 w-100 text-start">
                    {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
                </a>
                <a href="{{ route('admin.login') }}">Login / Register</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn mt-2 w-100">{{ __('messages.get_maid_now') }}</a>
            </div>
        </div>
    </header>

    <div class="services-page">
        <div class="container">
            <h1 class="page-title">
                <span class="title-highlight">{{ __('messages.choose') }}</span> {{ __('messages.choose_from_packages') }}
            </h1>
            
            <div class="packages-container">
                <div class="packages-row">
                    <!-- الباقة المرنة -->
                    <div class="package-card">
                        <div class="package-header">
                            <h2 class="package-title">{{ __('messages.flexible_package') }}</h2>
                        </div>
                        
                        <div class="package-price">
                            <span class="price-currency">{{ __('messages.aed_currency') }}</span>
                            <span class="price-period">{{ __('messages.monthly') }}</span>
                        </div>
                        
                        <div class="package-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.monthly_feature_1') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.monthly_feature_2') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.monthly_feature_3') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.monthly_feature_4') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.monthly_feature_5') }}</p>
                            </div>
                        </div>
                        
                        <div class="package-action">
                            <a href="{{ route('service.index', ['locale' => app()->getLocale(), 'package' => 'الباقة المرنة']) }}" class="choose-btn">{{ __('messages.choose_package') }}</a>
                        </div>
                        
                        <div class="package-footer">
                            Miss Helpers UAE
                        </div>
                    </div>
                    
                    <!-- الباقة التقليدية -->
                    <div class="package-card">
                        <div class="recommended-ribbon">{{ __('messages.recommended') }}</div>
                        
                        <div class="package-header">
                            <h2 class="package-title">{{ __('messages.traditional_package') }}</h2>
                        </div>
                        
                        <div class="package-price">
                            <span class="price-currency">{{ __('messages.aed_currency') }}</span>
                            <span class="price-period">{{ __('messages.one_time') }}</span>
                        </div>
                        
                        <div class="package-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.main_feature_1') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.main_feature_2') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.main_feature_3') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.main_feature_4') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.main_feature_5') }}</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">{{ __('messages.main_feature_6') }}</p>
                            </div>
                        </div>
                        
                        <div class="package-action">
                            <a href="{{ route('service.index', ['locale' => app()->getLocale(), 'package' => 'الباقة التقليدية']) }}" class="choose-btn">{{ __('messages.choose_package') }}</a>
                        </div>
                        
                        <div class="package-footer">
                            Miss Helpers UAE
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>
</body>
</html>
