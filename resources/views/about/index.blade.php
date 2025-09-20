<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
    new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
    "https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,"script","dataLayer","GTM-TB5M9MCD");</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seoData = \App\Helpers\SeoHelper::generateMetaTags('about', app()->getLocale());
        $schemaMarkup = \App\Helpers\SeoHelper::generateSchemaMarkup('about');
        $seoData['schema_markup'] = $schemaMarkup;
    @endphp
    
    @include('partials.seo-meta', ['metaData' => $seoData])
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
        }

        .header-inner {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand img {
            height: 34px;
        }

        .brand .title {
            font-weight: 800;
            color: #1c1c1c;
            letter-spacing: .5px;
        }

        .nav-links a {
            color: #1c1c1c;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 12px;
            font-weight: 600;
        }

        .nav-links a:hover {
            background: #f6f7fb;
        }

        .cta-btn {
            background: #ffa19c;
            color: #fff;
            border: none;
            border-radius: 18px;
            padding: 10px 18px;
            font-weight: 800;
        }

        .auth a {
            color: #1c1c1c;
            text-decoration: none;
            margin-inline-start: 14px;
        }

        /* About Hero Section */
        .about-hero {
            padding: 80px 0;
            background: #fff;
        }

        .about-content {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .about-image {
            flex: 1;
            position: relative;
        }

        .about-image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .about-text {
            flex: 1;
            padding: 40px 0;
        }

        .company-name {
            color: #e91e63;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
        }

        .main-title {
            color: #23336b;
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 30px;
        }

        .about-description {
            color: #495057;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .about-description:last-child {
            margin-bottom: 0;
        }

        /* Why Choose Us Section */
        .why-choose-us {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .why-choose-content {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .why-choose-text {
            flex: 1;
            padding: 40px 0;
        }

        .section-title {
            color: #6f42c1;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-subtitle {
            color: #6f42c1;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin-bottom: 40px;
        }

        .feature-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .feature-icon {
            color: #6f42c1;
            font-size: 1.5rem;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .feature-content {
            flex: 1;
        }

        .feature-title {
            color: #6f42c1;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feature-description {
            color: #495057;
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
        }

        .read-more-link {
            color: #6f42c1;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        .read-more-link:hover {
            color: #5a32a3;
        }

        .read-more-link i {
            font-size: 1.1rem;
        }

        .why-choose-image {
            flex: 1;
            position: relative;
        }

        .why-choose-image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Vision and Mission Section */
        .vision-mission {
            padding: 80px 0;
            background: #fff;
        }

        .section-main-title {
            text-align: center;
            color: #6f42c1;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 60px;
        }

        .vision-mission-cards {
            display: flex;
            gap: 40px;
            justify-content: center;
        }

        .vision-card,
        .mission-card {
            flex: 1;
            max-width: 500px;
            padding: 40px 30px;
            border: 2px solid #6f42c1;
            border-radius: 20px;
            text-align: center;
            background: #fff;
            transition: all 0.3s ease;
        }

        .vision-card:hover,
        .mission-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(111, 66, 193, 0.15);
        }

        .card-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #000;
            border-radius: 50%;
        }

        .card-icon i {
            font-size: 2.5rem;
            color: #000;
        }

        .card-title {
            color: #e91e63;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .card-description {
            color: #495057;
            font-size: 1.1rem;
            line-height: 1.7;
            margin: 0;
        }

        /* Training and Development Section */
        .training-development {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .training-content {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .training-image {
            flex: 1;
            position: relative;
        }

        .training-image img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .training-text {
            flex: 1;
            padding: 40px 0;
        }

        .training-subtitle {
            color: #e91e63;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: block;
        }

        .training-title {
            color: #6f42c1;
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 40px;
        }

        .training-features {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-bottom: 40px;
        }

        .training-feature {
            display: flex;
            gap: 15px;
            align-items: flex-start;
        }

        .training-feature-icon {
            color: #e91e63;
            font-size: 1.3rem;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .training-feature-text {
            color: #495057;
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 0;
        }

        .book-now-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #6f42c1;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .book-now-btn:hover {
            background: #5a32a3;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(111, 66, 193, 0.3);
        }

        .book-now-btn i {
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .about-content,
            .why-choose-content,
            .training-content {
                flex-direction: column;
                gap: 40px;
            }
            
            .about-image img,
            .why-choose-image img,
            .training-image img {
                height: 400px;
            }
            
            .main-title,
            .section-subtitle,
            .training-title {
                font-size: 2rem;
            }

            .vision-mission-cards {
                flex-direction: column;
                align-items: center;
            }

            .vision-card,
            .mission-card {
                max-width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .about-hero,
            .why-choose-us,
            .vision-mission,
            .training-development {
                padding: 60px 0;
            }
            
            .about-image img,
            .why-choose-image img,
            .training-image img {
                height: 300px;
            }
            
            .main-title,
            .section-subtitle,
            .section-main-title,
            .training-title {
                font-size: 1.8rem;
            }
            
            .about-description,
            .feature-description,
            .training-feature-text {
                font-size: 1rem;
            }

            .feature-item {
                gap: 15px;
            }

            .feature-icon {
                font-size: 1.3rem;
            }

            .vision-mission-cards {
                gap: 30px;
            }

            .vision-card,
            .mission-card {
                padding: 30px 20px;
            }

            .card-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 20px;
            }

            .card-icon i {
                font-size: 2rem;
            }

            .card-title {
                font-size: 1.3rem;
            }

            .card-description {
                font-size: 1rem;
            }

            .training-features {
                gap: 20px;
            }

            .training-feature {
                gap: 12px;
            }

            .training-feature-icon {
                font-size: 1.2rem;
            }

            .book-now-btn {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB5M9MCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <!-- Header -->
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ url('/') }}" class="brand">
                <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
            </a>
            <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}" class="active">{{ __('messages.about') }}</a>
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
                <div class="auth d-none d-md-inline">
                    <a href="{{ route('admin.login') }}">Login / Register</a>
                </div>
                <button class="btn btn-outline-secondary d-md-none" data-bs-toggle="collapse" data-bs-target="#mnav">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
        <div id="mnav" class="collapse border-top d-md-none">
            <div class="container py-2 nav-links">
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}" class="active">{{ __('messages.about') }}</a>
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

    <!-- About Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="about-content">
                <!-- Left Side - Office Image -->
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Miss Helpers Office Reception" 
                         onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                </div>
                
                <!-- Right Side - Text Content -->
                <div class="about-text">
                    <span class="company-name">Miss Helpers</span>
                    <h1 class="main-title">{{ __('messages.trusted_partner') }}</h1>
                    
                    <p class="about-description">
                        {{ __('messages.about_description_1') }}
                    </p>
                    
                    <p class="about-description">
                        {{ __('messages.about_description_2') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-us">
        <div class="container">
            <div class="why-choose-content">
                <!-- Left Side - Text Content -->
                <div class="why-choose-text">
                    <h2 class="section-title">Miss Helpers</h2>
                    <h3 class="section-subtitle">{{ __('messages.why_choose_miss_helpers') }}</h3>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">{{ __('messages.transparent_process') }}</h4>
                                <p class="feature-description">
                                    {{ __('messages.transparent_process_desc') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">{{ __('messages.legal_ethical') }}</h4>
                                <p class="feature-description">
                                    {{ __('messages.legal_ethical_desc') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">{{ __('messages.multinational_candidates') }}</h4>
                                <p class="feature-description">
                                    {{ __('messages.multinational_candidates_desc') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">{{ __('messages.after_sales_support') }}</h4>
                                <p class="feature-description">
                                    {{ __('messages.after_sales_support_desc') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="read-more-link">
                        <i class="bi bi-link-45deg"></i>
                        {{ __('messages.read_more') }}
                    </a>
                </div>
                
                <!-- Right Side - Team Photo -->
                <div class="why-choose-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Miss Helpers Professional Team" 
                         onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision and Mission Section -->
    <section class="vision-mission">
        <div class="container">
            <h2 class="section-main-title">{{ __('messages.vision_mission') }}</h2>
            
            <div class="vision-mission-cards">
                <!-- Vision Card -->
                <div class="vision-card">
                    <div class="card-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 class="card-title">{{ __('messages.our_vision') }}</h3>
                    <p class="card-description">
                        {{ __('messages.our_vision_desc') }}
                    </p>
                </div>
                
                <!-- Mission Card -->
                <div class="mission-card">
                    <div class="card-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="card-title">{{ __('messages.our_mission') }}</h3>
                    <p class="card-description">
                        {{ __('messages.our_mission_desc') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Training and Development Section -->
    <section class="training-development">
        <div class="container">
            <div class="training-content">
                <!-- Left Side - Training Image -->
                <div class="training-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Miss Helpers Training Team" 
                         onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                </div>
                
                <!-- Right Side - Text Content -->
                <div class="training-text">
                    <span class="training-subtitle">{{ __('messages.empowering_helpers') }}</span>
                    <h2 class="training-title">{{ __('messages.support_training_development') }}</h2>
                    
                    <div class="training-features">
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">{{ __('messages.pre_departure_orientation') }}</p>
                        </div>
                        
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">{{ __('messages.practical_training') }}</p>
                        </div>
                        
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">{{ __('messages.communication_skills') }}</p>
                        </div>
                        
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">{{ __('messages.continuous_training') }}</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="book-now-btn">
                        <i class="bi bi-paperclip"></i>
                        {{ __('messages.book_now') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget - Inline CSS and JS -->
    <style>
    /* Chat Widget Styles */
    .chat-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .chat-toggle {
        width: 60px;
        height: 60px;
        background: #ffa19c;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
        position: relative;
    }

    .chat-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
    }

    .chat-toggle i {
        color: white;
        font-size: 24px;
    }

    .chat-toggle.active {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }

    .chat-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .chat-window {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 350px;
        height: 500px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        transform: translateY(20px) scale(0.9);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .chat-window.open {
        transform: translateY(0) scale(1);
        opacity: 1;
        visibility: visible;
    }

    .chat-header {
        background: #ffa19c;
        color: white;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 20px 20px 0 0;
    }

    .chat-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-avatar {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chat-avatar i {
        font-size: 18px;
    }

    .chat-title h6 {
        margin: 0;
        font-weight: 600;
        font-size: 16px;
    }

    .chat-status {
        font-size: 12px;
        opacity: 0.9;
    }

    .chat-controls {
        display: flex;
        gap: 8px;
    }

    .chat-controls button {
        background: none;
        border: none;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .chat-controls button:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .chat-messages {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
        background: #f8f9fa;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .message {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    .user-message {
        flex-direction: row-reverse;
    }

    .bot-message {
        flex-direction: row;
    }

    .message-content {
        max-width: 70%;
        background: white;
        padding: 12px 16px;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .user-message .message-content {
        background: #ffa19c;
        color: white;
        border-bottom-right-radius: 4px;
    }

    .bot-message .message-content {
        border-bottom-left-radius: 4px;
    }

    .message-content p {
        margin: 0;
        font-size: 14px;
        line-height: 1.4;
    }

    .message-time {
        font-size: 11px;
        opacity: 0.7;
        margin-top: 4px;
        display: block;
    }

    .chat-input-container {
        padding: 20px;
        background: white;
        border-top: 1px solid #e9ecef;
    }

    .chat-input {
        display: flex;
        align-items: flex-end;
        gap: 10px;
        background: #f8f9fa;
        border-radius: 25px;
        padding: 8px 15px;
        border: 2px solid transparent;
        transition: border-color 0.3s ease;
    }

    .chat-input:focus-within {
        border-color: #ffa19c;
    }

    .chat-input input {
        flex: 1;
        border: none;
        background: none;
        outline: none;
        font-size: 14px;
        padding: 8px 0;
        font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .chat-input input::placeholder {
        color: #6c757d;
    }

    .chat-send-btn {
        background: #ffa19c;
        border: none;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .chat-send-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .chat-send-btn i {
        font-size: 16px;
    }

    .chat-footer {
        text-align: center;
        margin-top: 10px;
    }

    .chat-footer small {
        color: #6c757d;
        font-size: 11px;
    }

    @media (max-width: 768px) {
        .chat-widget {
            bottom: 15px;
            right: 15px;
        }
        
        .chat-window {
            width: 320px;
            height: 450px;
        }
        
        .chat-toggle {
            width: 55px;
            height: 55px;
        }
        
        .chat-toggle i {
            font-size: 22px;
        }
    }

    @media (max-width: 480px) {
        .chat-window {
            width: calc(100vw - 30px);
            right: -15px;
        }
    }
    </style>

    <script>
        // Chat Widget JavaScript
        class ChatWidget {
            constructor() {
                this.isOpen = false;
                this.init();
            }

            init() {
                this.createWidget();
                this.bindEvents();
            }

            createWidget() {
                const chatHTML = `
                    <div id="chat-widget" class="chat-widget">
                        <div id="chat-toggle" class="chat-toggle">
                            <i class="bi bi-chat-dots"></i>
                            <span class="chat-badge">1</span>
                        </div>

                        <div id="chat-window" class="chat-window">
                            <div class="chat-header">
                                <div class="chat-header-info">
                                    <div class="chat-avatar">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <div class="chat-title">
                                        <h6>Miss Helpers Support</h6>
                                        <span class="chat-status">{{ __('messages.available_now') }}</span>
                                    </div>
                                </div>
                                <div class="chat-controls">
                                    <button class="chat-close" id="chat-close">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="chat-messages" id="chat-messages">
                                <div class="message bot-message">
                                    <div class="message-content">
                                        <p>{{ __('messages.chat_welcome') }}</p>
                                        <span class="message-time">الآن</span>
                                    </div>
                                </div>
                            </div>

                            <div class="chat-input-container">
                                <div class="chat-input">
                                    <input type="text" id="chat-input" placeholder="{{ __('messages.write_message_here_chat') }}" />
                                    <button id="chat-send" class="chat-send-btn">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                                <div class="chat-footer">
                                    <small>{{ __('messages.powered_by') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                document.body.insertAdjacentHTML('beforeend', chatHTML);
            }

            bindEvents() {
                const toggle = document.getElementById('chat-toggle');
                const close = document.getElementById('chat-close');
                const sendBtn = document.getElementById('chat-send');
                const input = document.getElementById('chat-input');

                toggle.addEventListener('click', () => this.toggleChat());
                close.addEventListener('click', () => this.closeChat());
                sendBtn.addEventListener('click', () => this.sendMessage());
                input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') this.sendMessage();
                });
            }

            toggleChat() {
                if (this.isOpen) {
                    this.closeChat();
                } else {
                    this.openChat();
                }
            }

            openChat() {
                const window = document.getElementById('chat-window');
                const toggle = document.getElementById('chat-toggle');
                
                window.classList.add('open');
                toggle.classList.add('active');
                this.isOpen = true;
                
                setTimeout(() => {
                    document.getElementById('chat-input').focus();
                }, 300);
            }

            closeChat() {
                const window = document.getElementById('chat-window');
                const toggle = document.getElementById('chat-toggle');
                
                window.classList.remove('open');
                toggle.classList.remove('active');
                this.isOpen = false;
            }

            sendMessage() {
                const input = document.getElementById('chat-input');
                const message = input.value.trim();
                
                if (message) {
                    this.addMessage(message, 'user');
                    input.value = '';
                    
                    setTimeout(() => {
                        this.addMessage("{{ __('messages.thank_you_message') }}", 'bot');
                    }, 1000);
                }
            }

            addMessage(content, sender) {
                const messagesContainer = document.getElementById('chat-messages');
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}-message`;
                
                const time = new Date().toLocaleTimeString('ar-SA', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                messageDiv.innerHTML = `
                    <div class="message-content">
                        <p>${content}</p>
                        <span class="message-time">${time}</span>
                    </div>
                `;
                
                messagesContainer.appendChild(messageDiv);
                this.scrollToBottom();
            }

            scrollToBottom() {
                const messagesContainer = document.getElementById('chat-messages');
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            new ChatWidget();
        });
    </script>
</body>
</html>
