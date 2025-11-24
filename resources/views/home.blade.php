<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TB5M9MCD');</script>
    <!-- End Google Tag Manager -->
    
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seoData = \App\Helpers\SeoHelper::generateMetaTags('home', app()->getLocale());
        $schemaMarkup = \App\Helpers\SeoHelper::generateSchemaMarkup('home');
        $seoData['schema_markup'] = $schemaMarkup;
    @endphp
    
    @include('partials.seo-meta', ['metaData' => $seoData])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        body{font-family:'Tajawal',sans-serif;background:#0a0a0a;margin:0}
        /* Header */
        .site-header{position:sticky;top:0;z-index:1000;background:#fff;border-bottom:1px solid #f1f1f1}
        .header-inner{height:64px;display:flex;align-items:center;justify-content:space-between}
        .brand{display:flex;align-items:center;gap:10px;text-decoration:none}
        .brand img{height:34px}
        .brand .title{font-weight:800;color:#1c1c1c;letter-spacing:.5px}
        .nav-links a{color:#1c1c1c;text-decoration:none;padding:10px 14px;border-radius:12px;font-weight:600}
        .nav-links a:hover{background:#f6f7fb}
        .cta-btn{background:#ffa19c;color:#fff;border:none;border-radius:18px;padding:10px 18px;font-weight:800}
        .auth a{color:#1c1c1c;text-decoration:none;margin-inline-start:14px}

        .hero{position:relative;min-height:100vh;display:flex;align-items:center;overflow:hidden;border-radius:24px}
        .hero-bg{position:absolute;inset:0;background:url('/images/hero-bg.jpg') center/cover no-repeat;filter:brightness(.62) saturate(.9)}
        .hero-tint{position:absolute;inset:0;background:linear-gradient(115deg, rgba(74,58,255,.55) 0%, rgba(118,54,120,.35) 45%, rgba(10,10,10,.25) 100%)}
        .hero-content{position:relative;z-index:2;color:#fff;padding:64px 0}
        .hero-title{font-weight:800;font-size:clamp(36px,6vw,68px);line-height:1.15;letter-spacing:.2px;margin-bottom:28px}
        .actions .btn{border:none;border-radius:16px;padding:12px 26px;font-weight:800}
        .btn-classic{background:#2d37e6}
        .btn-monthly{background:#ff7b8a;color:#fff}

        .stack{gap:24px}
        .card-w{width:360px;min-height:210px}
        .card-elevated{border-radius:28px;background:#fff;color:#0a0a0a;box-shadow:0 18px 40px rgba(0,0,0,.18);padding:22px}
        .glass{background:rgba(255,255,255,.1);color:#fff;backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.16)}
        .top-arrow{width:36px;height:36px;border-radius:12px;background:#1c1c1c;color:#fff;display:flex;align-items:center;justify-content:center}
        .stars{color:#ffcc66;letter-spacing:2px}
        .avatars{display:flex;align-items:center}
        .avatars img{width:34px;height:34px;border-radius:50%;border:2px solid #fff;margin-left:-10px}
        .card-rating{background:#ffffff;color:#0a0a0a;border-radius:28px;box-shadow:0 12px 28px rgba(0,0,0,.12);padding:18px;border:1px solid rgba(0,0,0,.04)}
        .card-sm{width:299px;height:169px}
        .arch{border:2px solid #6c5ce7;border-radius:28px;padding:12px;text-align:center}
        .maid-photo{max-height:230px;width:auto}
        .caption{font-weight:800;font-size:18px}

        /* Image Animation */
        .post-image {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .post-image img {
            transition: all 0.6s ease;
            transform: scale(1);
        }

        .post-image:hover img {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(35, 51, 107, 0.8), rgba(233, 30, 99, 0.8));
            opacity: 0;
            transition: all 0.4s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .post-image:hover .image-overlay {
            opacity: 1;
        }

        .service-badge {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 25px;
            border-radius: 25px;
            text-align: center;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .post-image:hover .service-badge {
            transform: translateY(0);
        }

        .main-text {
            display: block;
            font-weight: 700;
            color: #23336b;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .sub-text {
            display: block;
            font-weight: 500;
            color: #e91e63;
            font-size: 0.9rem;
        }

        /* Interactive Features Section */
        .interactive-features {
            position: relative;
            overflow: hidden;
        }

        .features-orbital {
            position: relative;
            width: 100%;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .central-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
            border: 3px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .central-content {
            text-align: center;
            padding: 20px;
            color: #495057;
        }

        .central-content h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #23336b;
        }

        .central-content p {
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0;
        }

        .orbital-feature {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 5;
            animation: orbit 20s linear infinite;
            transform-origin: center;
            will-change: transform;
        }

        .orbital-feature:hover {
            z-index: 15;
        }
        
        .orbital-feature:hover .feature-icon {
            filter: brightness(1.1);
        }

        .orbital-feature.active {
            z-index: 15;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }
        
        .orbital-feature.active .feature-icon {
            filter: brightness(1.2);
        }
        
        /* Force animation to continue without interruption */
        .orbital-feature {
            animation-play-state: running !important;
        }
        
        .orbital-feature:hover,
        .orbital-feature.active,
        .orbital-feature:focus {
            animation-play-state: running !important;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            margin-bottom: 5px;
            transition: filter 0.2s ease;
        }

        .feature-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #495057;
            text-align: center;
            white-space: nowrap;
        }

        /* Feature Colors */
        .feature-1 .feature-icon { background: #9C27B0; }
        .feature-2 .feature-icon { background: #4CAF50; }
        .feature-3 .feature-icon { background: #00BCD4; }
        .feature-4 .feature-icon { background: #9C27B0; }
        .feature-5 .feature-icon { background: #E91E63; }
        .feature-6 .feature-icon { background: #FF9800; }
        .feature-7 .feature-icon { background: #673AB7; }
        .feature-8 .feature-icon { background: #2196F3; }

        /* Orbital Animation */
        @keyframes orbit {
            from { 
                transform: rotate(0deg) translateX(200px) rotate(0deg); 
            }
            to { 
                transform: rotate(360deg) translateX(200px) rotate(-360deg); 
            }
        }

        /* Feature Positions */
        .feature-1 { animation-delay: 0s; }
        .feature-2 { animation-delay: -2.5s; }
        .feature-3 { animation-delay: -5s; }
        .feature-4 { animation-delay: -7.5s; }
        .feature-5 { animation-delay: -10s; }
        .feature-6 { animation-delay: -12.5s; }
        .feature-7 { animation-delay: -15s; }
        .feature-8 { animation-delay: -17.5s; }

        @media(max-width:991.98px){
            .stack-right{margin-top:28px}
            .hero{border-radius:0}
            .card-w{width:100%}
            .card-sm{width:100%}
            
            .features-orbital {
                height: 500px;
            }
            
            .central-circle {
                width: 250px;
                height: 250px;
            }
            
            .central-content h3 {
                font-size: 1rem;
            }
            
            .central-content p {
                font-size: 0.8rem;
            }
            
            .orbital-feature {
                width: 70px;
                height: 70px;
            }
            
            .feature-icon {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
            
            .feature-label {
                font-size: 0.65rem;
            }
            
            @keyframes orbit {
                from { transform: rotate(0deg) translateX(160px) rotate(0deg); }
                to { transform: rotate(360deg) translateX(160px) rotate(-360deg); }
            }
        }

        @media(max-width:767.98px){
            .features-orbital {
                height: 400px;
            }
            
            .central-circle {
                width: 200px;
                height: 200px;
            }
            
            .central-content h3 {
                font-size: 0.9rem;
            }
            
            .central-content p {
                font-size: 0.75rem;
            }
            
            .orbital-feature {
                width: 60px;
                height: 60px;
            }
            
            .feature-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .feature-label {
                font-size: 0.6rem;
            }
            
            @keyframes orbit {
                from { transform: rotate(0deg) translateX(130px) rotate(0deg); }
                to { transform: rotate(360deg) translateX(130px) rotate(-360deg); }
            }
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB5M9MCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

@include('partials.header')

<section class="hero container-fluid p-0 my-3">
    <div class="hero-bg"></div>
    <div class="hero-tint"></div>
    <div class="container hero-content">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1 class="hero-title">{{ __('messages.get_maid_now') }}</h1>
                <div class="actions d-flex gap-3">
                    <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}" class="btn btn-classic">{{ __('messages.traditional_package') }}</a>
                    <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}" class="btn btn-monthly">{{ __('messages.monthly_package') }}</a>
                </div>
            </div>
            <div class="col-lg-6 stack-right">
                <div class="d-flex flex-column flex-lg-row stack justify-content-lg-end">
                    <div class="card-rating card-sm d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <div class="top-arrow"><i class="bi bi-arrow-up-right"></i></div>
                            </div>
                            <div class="fw-bold" style="font-size:18px">3.5K+ {{ __('messages.happy_customers') }}</div>
                        </div>
                        <div class="avatars mt-3">
                            <img src="https://i.pravatar.cc/64?img=1" alt="">
                            <img src="https://i.pravatar.cc/64?img=2" alt="">
                            <img src="https://i.pravatar.cc/64?img=3" alt="">
                            <img src="https://i.pravatar.cc/64?img=4" alt="">
                            <img src="https://i.pravatar.cc/64?img=5" alt="">
                        </div>
                    </div>
                    <div class="card-elevated card-w d-flex flex-column">
                        <div class="d-flex justify-content-end mb-2">
                            <div class="top-arrow" style="background:#f3f4f6;color:#1c1c1c"><i class="bi bi-arrow-up-right"></i></div>
                        </div>
                        <div class="arch mb-3 flex-grow-1 d-flex align-items-center justify-content-center">
                            <img class="maid-photo" src="/images/maid.png" alt="{{ __('messages.maid_alt') }}">
                        </div>
                        <div class="caption text-center">{{ __('messages.top_rated_services') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About / Intro Section -->
<section class="py-5" style="background:#fff6fa">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h2 class="fw-bold" style="color:#23336b">{{ __('messages.miss_helpers_center') }}</h2>
                <p class="mt-3" style="color:#3a3a3a;line-height:1.9">
                    {{ __('messages.miss_helpers_description') }}
                </p>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}" class="btn btn-primary px-4">{{ __('messages.learn_more_about_us') }}</a>
            </div>
            <div class="col-lg-6">
                <video class="w-100 rounded-3 shadow" controls preload="metadata" poster="/images/hero-bg.jpg">
                    <source src="https://misshelpers.com/wp-content/uploads/2025/05/ei.mp4" type="video/mp4">
                    {{ __('messages.video_not_supported') }}
                </video>
            </div>
        </div>
    </div>
</section>

<!-- Blog Slider Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-4">
            <div class="text-danger fw-bold mb-2" style="letter-spacing:.5px">{{ __('messages.lady_helpers_services') }}</div>
                <h2 class="fw-bolder" style="color:#23336b">{{ __('messages.welcome_subtitle') }}</h2>
        </div>

        @php
            $posts = \App\Models\BlogPost::with('category')
                ->where('status', 'published')
                ->latest('published_at')
                ->take(12)
                ->get();
        @endphp

        <style>
            .blog-card{position:relative;border-radius:18px;overflow:hidden}
            .blog-card img{width:100%;height:360px;object-fit:cover;display:block}
            .blog-overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,.0) 30%, rgba(0,0,0,.55) 100%)}
            .blog-caption{position:absolute;bottom:18px;right:18px;left:18px;color:#fff;font-weight:800;font-size:20px}
            .blog-slider{overflow:hidden}
            .blog-track{display:flex;gap:24px;will-change:transform}
            .blog-card-wrap{flex:0 0 calc(33.333% - 16px)}
                    @media (max-width: 991.98px){
            .blog-card img{height:240px}
            .blog-card-wrap{flex:0 0 100%}
        }

        /* Register Modal Styles */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, #23336b 0%, #4a5fc1 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
            padding: 20px 25px;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 20px 25px;
            text-align: center;
        }

        .modal-footer a {
            color: #23336b;
            text-decoration: none;
            font-weight: 600;
        }

        .modal-footer a:hover {
            text-decoration: underline;
        }

        .form-label {
            font-weight: 600;
            color: #23336b;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #23336b;
            box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #23336b 0%, #4a5fc1 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(35, 51, 107, 0.3);
        }

        a.btn.btn-classic {
            color: white;
        }

        /* Mobile menu order fix */
        @media (max-width: 767.98px) {
            /* Navigation links in one row */
            #mnav .nav-links a {
                display: inline-block;
                min-width: 80px;
                text-align: center;
                padding: 8px 12px;
                border-radius: 8px;
                background: #f8f9fa;
                text-decoration: none;
                color: #1c1c1c;
                font-weight: 600;
                margin: 0 5px;
            }
            
            /* Language selector */
            #mnav .nav-links .btn-link {
                display: inline-block;
                min-width: 80px;
                text-align: center;
                padding: 8px 12px;
                border-radius: 8px;
                background: #f8f9fa;
                text-decoration: none;
                color: #1c1c1c;
                font-weight: 600;
                margin: 0 5px;
            }
            
            /* Login/Register buttons in one row below nav */
            #mnav .text-center .btn {
                display: inline-block;
                min-width: 120px;
                margin: 0 5px;
            }
            
            /* CTA button full width below everything */
            #mnav .cta-btn {
                width: 100%;
                text-align: center;
            }
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
        </style>

        <div class="blog-slider" id="blogSlider">
            <div class="blog-track">
                @foreach($posts as $post)
                    @php 
                        if ($post->featured_image) {
                            if (str_starts_with($post->featured_image, 'http')) {
                                $img = $post->featured_image;
                            } else {
                                $img = asset('storage/' . $post->featured_image);
                            }
                        } else {
                            $img = asset('/images/hero-bg.jpg');
                        }
                        // Debug: إضافة تعليق للتحقق من الصورة
                        // echo "<!-- Debug: Post ID: {$post->id}, Image: {$img} -->";
                    @endphp
                    <div class="blog-card-wrap">
                        <a href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}" class="text-decoration-none">
                            <div class="blog-card shadow-sm">
                                <img src="{{ $img }}" alt="{{ $post->title }}" onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                                <div class="blog-overlay"></div>
                                <div class="blog-caption">{{ \App\Helpers\TranslationHelper::translateMaidValue($post->title) }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function(){
            const slider = document.getElementById('blogSlider');
            const track  = slider.querySelector('.blog-track');
            const intervalMs = 2000; // 2s
            const transitionMs = 600;
            let timer;

            function step(){
                const first = track.children[0];
                const style = getComputedStyle(track);
                const gap = parseFloat(style.gap) || 24;
                const cardWidth = first.getBoundingClientRect().width + gap;
                track.style.transition = `transform ${transitionMs}ms ease`;
                track.style.transform  = `translateX(-${cardWidth}px)`;
                const onEnd = () => {
                    track.style.transition = 'none';
                    track.appendChild(first);
                    track.style.transform = 'translateX(0)';
                    // force reflow then restore transition
                    void track.offsetWidth;
                    track.style.transition = '';
                    track.removeEventListener('transitionend', onEnd);
                };
                track.addEventListener('transitionend', onEnd);
            }
            function start(){ timer = setInterval(step, intervalMs); }
            function stop(){ clearInterval(timer); }
            start();
            slider.addEventListener('mouseenter', stop);
            slider.addEventListener('mouseleave', start);
        });
        </script>
    </div>
</section>

<!-- Interactive Features Section -->
<section class="interactive-features py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="features-orbital">
            <!-- Central Circle with Dynamic Content -->
            <div class="central-circle">
                <div class="central-content" id="centralContent">
                    <h3>{{ __('messages.choose_feature') }}</h3>
                    <p>{{ __('messages.click_circles') }}</p>
                </div>
            </div>
            
            <!-- Orbital Features -->
            <div class="orbital-feature feature-1" data-content="{{ __('messages.legal_employment') }}" data-description="{{ __('messages.legal_employment_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <span class="feature-label">{{ __('messages.legal_employment') }}</span>
            </div>
            
            <div class="orbital-feature feature-2" data-content="{{ __('messages.trained_staff') }}" data-description="{{ __('messages.trained_staff_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-person-badge"></i>
                </div>
                <span class="feature-label">{{ __('messages.trained_staff') }}</span>
            </div>
            
            <div class="orbital-feature feature-3" data-content="{{ __('messages.easy_steps') }}" data-description="{{ __('messages.easy_steps_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <span class="feature-label">{{ __('messages.easy_steps') }}</span>
            </div>
            
            <div class="orbital-feature feature-4" data-content="{{ __('messages.delivery') }}" data-description="{{ __('messages.delivery_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <span class="feature-label">{{ __('messages.delivery') }}</span>
            </div>
            
            <div class="orbital-feature feature-5" data-content="{{ __('messages.after_sales_support') }}" data-description="{{ __('messages.after_sales_support_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <span class="feature-label">{{ __('messages.after_sales_support') }}</span>
            </div>
            
            <div class="orbital-feature feature-6" data-content="{{ __('messages.secure_payment') }}" data-description="{{ __('messages.secure_payment_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-credit-card"></i>
                </div>
                <span class="feature-label">{{ __('messages.secure_payment') }}</span>
            </div>
            
            <div class="orbital-feature feature-7" data-content="{{ __('messages.legal_contract') }}" data-description="{{ __('messages.legal_contract_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-file-text"></i>
                </div>
                <span class="feature-label">{{ __('messages.legal_contract') }}</span>
            </div>
            
            <div class="orbital-feature feature-8" data-content="{{ __('messages.nationality') }}" data-description="{{ __('messages.nationality_desc') }}">
                <div class="feature-icon">
                    <i class="bi bi-globe"></i>
                </div>
                <span class="feature-label">{{ __('messages.nationality') }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-5" style="background: #fff;">
    <div class="container">
        <div class="row align-items-center">
            <!-- النموذج على اليسار -->
            <div class="col-lg-6">
                <div class="contact-form-wrapper">
                    <h2 class="fw-bolder mb-4" style="color: #23336b; font-size: 2.5rem;">{{ __('messages.find_perfect_maid') }}</h2>
                    
                    <form id="maidRequestForm" method="POST" action="{{ route('contact.store', ['locale' => app()->getLocale()]) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold" style="color: #23336b;">{{ __('messages.name') }}</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" required 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 15px;">
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-semibold" style="color: #23336b;">{{ __('messages.phone') }}</label>
                            <input type="tel" class="form-control form-control-lg" id="phone" name="phone" required 
                                   style="border: 2px solid #e9ecef; border-radius: 12px; padding: 15px;">
                        </div>
                        
                        <div class="mb-3">
                            <label for="service" class="form-label fw-semibold" style="color: #23336b;">{{ __('messages.choose_service') }}</label>
                            <select class="form-select form-select-lg" id="service" name="service_type" required 
                                    style="border: 2px solid #e9ecef; border-radius: 12px; padding: 15px;">
                                <option value="">{{ __('messages.choose_service') }}</option>
                                <option value="domestic_maid" selected>{{ __('messages.domestic_maid') }}</option>
                                <option value="cooking_maid">{{ __('messages.cooking_maid') }}</option>
                                <option value="childcare_maid">{{ __('messages.childcare_maid') }}</option>
                                <option value="elderly_care">{{ __('messages.elderly_care') }}</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nationality" class="form-label fw-semibold" style="color: #23336b;">{{ __('messages.choose_nationality') }}</label>
                            <select class="form-select form-select-lg" id="nationality" name="nationality" required 
                                    style="border: 2px solid #e9ecef; border-radius: 12px; padding: 15px;">
                                <option value="">{{ __('messages.choose_nationality') }}</option>
                                <option value="sri_lanka" selected>{{ __('messages.sri_lankan') }}</option>
                                <option value="philippines">{{ __('messages.filipino') }}</option>
                                <option value="indonesia">{{ __('messages.indonesia') }}</option>
                                <option value="ethiopia">{{ __('messages.ethiopian') }}</option>
                                <option value="kenya">{{ __('messages.kenya') }}</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="emirate" class="form-label fw-semibold" style="color: #23336b;">{{ __('messages.choose_emirate') }}</label>
                            <select class="form-select form-select-lg" id="emirate" name="emirate" required 
                                    style="border: 2px solid #e9ecef; border-radius: 12px; padding: 15px;">
                                <option value="">{{ __('messages.choose_emirate') }}</option>
                                <option value="ras_al_khaimah" selected>{{ __('messages.ras_al_khaimah') }}</option>
                                <option value="dubai">{{ __('messages.dubai') }}</option>
                                <option value="abu_dhabi">{{ __('messages.abu_dhabi') }}</option>
                                <option value="sharjah">{{ __('messages.sharjah') }}</option>
                                <option value="ajman">{{ __('messages.ajman') }}</option>
                                <option value="umm_al_quwain">{{ __('messages.umm_al_quwain') }}</option>
                                <option value="fujairah">{{ __('messages.fujairah') }}</option>
                            </select>
                            </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label fw-semibold" style="color: #23336b;">{{ __('messages.note') }}</label>
                            <textarea class="form-control" id="message" name="notes" rows="4" 
                                      style="border: 2px solid #e9ecef; border-radius: 12px; padding: 15px; resize: none;"
                                      placeholder="{{ __('messages.write_message_here') }}"></textarea>
                        </div>
                        
                        <input type="hidden" name="status" value="under_review">
                        <input type="hidden" name="is_active" value="1">
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold" 
                                style="background: #23336b; border: none; border-radius: 12px; padding: 18px; font-size: 1.1rem;">
                            {{ __('messages.submit_request') }}
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- الصور على اليمين -->
            <div class="col-lg-6">
                <div class="tablets-showcase position-relative">
                    <!-- الجهاز اللوحي العلوي -->
                    <div class="tablet tablet-1">
                        <div class="tablet-screen">
                            <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=300&fit=crop&crop=face" 
                                 alt="خادمة تنظيف" class="tablet-image">
                        </div>
                    </div>
                    
                    <!-- الجهاز اللوحي الأوسط -->
                    <div class="tablet tablet-2">
                        <div class="tablet-screen">
                            <div class="review-content text-center p-3">
                                <h6 class="mb-2" style="color: #333;">{{ __('messages.reviews') }}: 458</h6>
                                <div class="stars mb-2">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                </div>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-sm btn-outline-primary">Rate it</button>
                                    <button class="btn btn-sm btn-outline-secondary">Write</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- الجهاز اللوحي السفلي -->
                        <div class="tablet tablet-3">
                            <div class="tablet-screen">
                                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&h=300&fit=crop&crop=face" 
                                     alt="مقابلة مهنية" class="tablet-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-form-wrapper {
    padding: 20px;
}

.form-control, .form-select {
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #23336b !important;
    box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25) !important;
}

.tablets-showcase {
    height: 600px;
    position: relative;
}

.tablet {
    position: absolute;
    width: 280px;
    height: 200px;
    background: #000;
    border-radius: 20px;
    padding: 8px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.tablet:hover {
    transform: scale(1.05);
    z-index: 10;
}

.tablet-screen {
    width: 100%;
    height: 100%;
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
}

.tablet-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.tablet-1 {
    top: 50px;
    right: 100px;
    transform: rotate(15deg);
}

.tablet-2 {
    top: 200px;
    right: 50px;
    transform: rotate(-5deg);
}

.tablet-3 {
    top: 350px;
    right: 150px;
    transform: rotate(10deg);
}

.review-content {
    background: #f8f9fa;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.stars {
    font-size: 1.2rem;
}

@media (max-width: 991.98px) {
    .tablets-showcase {
        height: 400px;
        margin-top: 40px;
    }
    
    .tablet {
        width: 200px;
        height: 150px;
    }
    
    .tablet-1 { top: 30px; right: 70px; }
    .tablet-2 { top: 120px; right: 30px; }
    .tablet-3 { top: 210px; right: 90px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('maidRequestForm');
    
    form.addEventListener('submit', function(e) {
        // إزالة preventDefault للسماح بالإرسال الطبيعي
        // e.preventDefault();
        
        // إظهار رسالة تأكيد
        if (confirm('{{ __('messages.confirm_submission') }}')) {
            // النموذج سيتم إرساله تلقائياً
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });
    
    // إظهار رسالة نجاح إذا تم إرسال النموذج بنجاح
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif
    
    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
});
</script>

<!-- Maids Showcase Section -->
<section class="py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="text-pink fw-bold mb-2" style="color: #e91e63; letter-spacing: 0.5px;">{{ __('messages.find_perfect_maid') }}</div>
            <h2 class="fw-bolder mb-3" style="color: #23336b; font-size: 2.5rem;">
                {{ __('messages.maids_available') }}
                <i class="bi bi-person-wearing-hijab text-purple ms-2" style="color: #6f42c1;"></i>
            </h2>
            <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.1rem; line-height: 1.6;">
                {{ __('messages.maids_description') }}
            </p>
        </div>

        @php
            $latestMaids = \App\Models\Maid::latest()->take(3)->get();
        @endphp

        <div class="row g-4 mb-5">
            @foreach($latestMaids as $maid)
                <div class="col-lg-4 col-md-6">
                    <div class="maid-card h-100">
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
                        
                        <div class="maid-info p-3">
                            <h5 class="maid-name mb-2">{{ $maid->name }}</h5>
                            
                            <div class="maid-rating mb-2">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= ($maid->rating ?? 0))
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-muted">({{ $maid->reviews_count ?? 0 }} {{ __('messages.reviews') }})</small>
                            </div>
                            
                            <div class="maid-stats d-flex justify-content-between align-items-center mb-3">
                                <span class="views-badge">
                                    <i class="bi bi-eye me-1"></i>
                                    {{ __('messages.views') }} {{ $maid->views_count ?? rand(40, 80) }}
                                </span>
                                <span class="nationality-badge">{{ $maid->nationality }}</span>
                            </div>
                            
                            <div class="maid-actions-bottom">
                                <a href="{{ route('maid.profile.' . app()->getLocale(), ['id' => $maid->id]) }}" class="btn btn-primary w-100 mb-2">
                                    {{ __('messages.view_profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('maids.all.' . app()->getLocale()) }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">
                <i class="bi bi-grid-3x3-gap me-2"></i>
                {{ __('messages.explore_maids') }}
            </a>
        </div>
    </div>
</section>

<style>
.maid-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.maid-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.maid-image-wrapper {
    position: relative;
    height: 250px;
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

.maid-name {
    color: #23336b;
    font-weight: 700;
    font-size: 1.2rem;
}

.maid-rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.stars {
    color: #ffc107;
    font-size: 1rem;
}

.maid-stats {
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
    color: #fff !important;
    transition: all 0.3s ease;
}

.maid-actions-bottom .btn-primary:hover {
    background: #1a2533;
    transform: translateY(-2px);
}

.btn-outline-primary {
    color: #23336b;
    border-color: #23336b;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #23336b;
    border-color: #23336b;
    transform: translateY(-2px);
}

@media (max-width: 991.98px) {
    .maid-image-wrapper {
        height: 200px;
    }
    
    .maid-name {
        font-size: 1.1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // زر الإعجاب - مع فحص وجود العناصر
    const likeBtns = document.querySelectorAll('.like-btn');
    
    if (likeBtns.length > 0) {
        likeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const maidId = this.dataset.maidId;
                const icon = this.querySelector('i');
                
                if (icon) {
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
                }
                
                // هنا يمكن إرسال طلب AJAX لحفظ حالة الإعجاب
                console.log('Toggle like for maid:', maidId);
            });
        });
    }
});
</script>

<!-- قسم التميز والثقة -->
<section class="excellence-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- الجزء الأيسر: الصورة -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="social-post-wrapper">
                    <div class="social-post">
                        <div class="post-header">
                            <div class="profile-info">
                                <div class="profile-avatar">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <span class="username">Miss Helpers</span>
                            </div>
                            <div class="company-badge">MISS HELPERS UAE</div>
                        </div>
                        
                        <div class="post-image">
                            <img src="https://images.unsplash.com/photo-1556911220-bff31c812dba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                                 alt="خادمات محترفات" class="img-fluid rounded">
                            <div class="image-overlay">
                                <div class="service-badge">
                                    <span class="main-text">FULL-TIME MAID</span>
                                    <span class="sub-text">Monthly</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="post-actions">
                            <button class="action-btn like-btn">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                            <button class="action-btn comment-btn">
                                <i class="bi bi-chat"></i>
                            </button>
                            <button class="action-btn share-btn">
                                <i class="bi bi-send"></i>
                            </button>
                            <button class="action-btn save-btn">
                                <i class="bi bi-bookmark"></i>
                            </button>
                        </div>
                        
                        <div class="post-description">
                            <p>Because your loved ones deserve the best care. Hire professional, compassionate caregivers for the elderly trained to provide support with dignity and respect.</p>
                        </div>
                        
                        <div class="post-footer">
                            <div class="brand-logo">
                                <span class="logo-text">MISS HELPERS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- الجزء الأيمن: النص -->
            <div class="col-lg-6">
                <div class="excellence-content">
                    <h2 class="main-title">{{ __('messages.why_choose_us') }}</h2>
                    <h3 class="subtitle">{{ __('messages.quality_guarantee') }}</h3>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="check-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-text">
                                <p>{{ __('messages.quality_intro') }}</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="check-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-text">
                                <p>{{ __('messages.carefully_screened') }}</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="check-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-text">
                                <p>{{ __('messages.trained_in_household_and_care') }}</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="check-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-text">
                                <p>{{ __('messages.post_hiring_support') }}</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="check-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-text">
                                <p>{{ __('messages.legal_compliance_uae') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* قسم التميز والثقة */
.excellence-section {
    background: #f8f9fa;
    padding: 80px 0;
}

/* منشور وسائل التواصل الاجتماعي */
.social-post-wrapper {
    display: flex;
    justify-content: center;
}

.social-post {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    max-width: 400px;
    border: 2px solid #ff69b4;
}

.post-header {
    padding: 20px 20px 15px;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.profile-avatar {
    width: 40px;
    height: 40px;
    background: #ff69b4;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.username {
    font-weight: 600;
    color: #333;
}

.company-badge {
    background: #ff69b4;
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.post-image {
    position: relative;
}

.post-image img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
    padding: 20px;
    color: white;
}

.service-badge {
    text-align: center;
}

.service-badge .main-text {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #ffa500;
    margin-bottom: 5px;
}

.service-badge .sub-text {
    display: block;
    font-size: 1rem;
    font-style: italic;
    color: #ddd;
}

.post-actions {
    padding: 15px 20px;
    display: flex;
    gap: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.action-btn {
    background: none;
    border: none;
    font-size: 1.2rem;
    color: #666;
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 8px;
}

.action-btn:hover {
    background: #f0f0f0;
    color: #333;
}

.like-btn {
    color: #e91e63;
}

.post-description {
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
}

.post-description p {
    color: #333;
    line-height: 1.6;
    margin: 0;
}

.post-footer {
    padding: 15px 20px;
    text-align: center;
}

.brand-logo .logo-text {
    font-size: 1.2rem;
    font-weight: 700;
    color: #ff69b4;
    letter-spacing: 1px;
}

/* محتوى التميز */
.excellence-content {
    padding: 20px;
}

.main-title {
    color: #ffa500;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    line-height: 1.2;
}

.subtitle {
    color: #23336b;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 40px;
    line-height: 1.3;
}

.features-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.check-icon {
    color: #23336b;
    font-size: 1.5rem;
    margin-top: 5px;
    flex-shrink: 0;
}

.feature-text p {
    color: #333;
    font-size: 1.1rem;
    line-height: 1.6;
    margin: 0;
}

/* تصميم متجاوب */
@media (max-width: 991.98px) {
    .excellence-section {
        padding: 60px 0;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .subtitle {
        font-size: 1.5rem;
    }
    
    .social-post {
        max-width: 100%;
    }
}

@media (max-width: 767.98px) {
    .excellence-section {
        padding: 40px 0;
    }
    
    .main-title {
        font-size: 1.8rem;
    }
    
    .subtitle {
        font-size: 1.3rem;
    }
    
    .feature-text p {
        font-size: 1rem;
    }
}
</style>

<!-- قسم آراء العملاء -->
<section class="customer-reviews-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">{{ __('messages.customer_reviews') }}</h2>
        </div>
        
        <div class="reviews-container">
            <div class="row align-items-center">
                <!-- البطاقة الرئيسية -->
                <div class="col-lg-8">
                    <div class="main-review-card">
                        <div class="company-logo">
                            <div class="logo-icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <span class="company-name">{{ app()->getLocale() === 'ar' ? 'ميس هيلبرز' : 'Miss Helpers' }}</span>
                        </div>
                        
                        <div class="reviewer-profile">
                            @if(isset($customerReviews[0]) && $customerReviews[0]->customer_photo)
                                @php
                                    $img = $customerReviews[0]->customer_photo;
                                    if (str_starts_with($img, 'http')) {
                                        $img = $img;
                                    } else {
                                        $img = asset('storage/' . $img);
                                    }
                                @endphp
                                <img src="{{ $img }}" alt="{{ $customerReviews[0]->customer_name }}" class="profile-image" 
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            @endif
                            <div class="profile-image" style="{{ isset($customerReviews[0]) && $customerReviews[0]->customer_photo ? 'display: none;' : '' }}">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="rating-overlay">
                                <div class="stars">
                                    @if(isset($customerReviews[0]))
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $customerReviews[0]->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    @else
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="reviewer-info">
                            <div class="reviewer-name">{{ \App\Helpers\TranslationHelper::translateMaidValue($customerReviews[0]->customer_name ?? __('messages.satisfied_customer')) }}</div>
                        </div>
                        
                        <div class="review-text">
                            {{ \App\Helpers\TranslationHelper::translateMaidValue($customerReviews[0]->description ?? __('messages.default_review_text')) }}
                        </div>
                    </div>
                </div>
                
                <!-- النص الجانبي -->
                <div class="col-lg-4">
                    <div class="side-review">
                        <div class="review-content">
                            <p class="review-text-side">
                                {{ \App\Helpers\TranslationHelper::translateMaidValue($customerReviews[0]->description ?? __('messages.default_review_text')) }}
                            </p>
                            
                            <div class="rating-stars">
                                @if(isset($customerReviews[0]))
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $customerReviews[0]->rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                @else
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                @endif
                            </div>
                            
                            <div class="reviewer-details">
                                <div class="reviewer-name-side">{{ \App\Helpers\TranslationHelper::translateMaidValue($customerReviews[0]->customer_name ?? __('messages.satisfied_customer')) }} - {{ \App\Helpers\TranslationHelper::translateMaidValue($customerReviews[0]->customer_location ?? __('messages.riyadh')) }}</div>
                                <div class="reviewer-title">{{ \App\Helpers\TranslationHelper::translateMaidValue($customerReviews[0]->job_title ?? __('messages.satisfied_customer')) }}</div>
                            </div>
                        </div>
                        
                        <div class="navigation-buttons">
                            <button class="nav-btn" onclick="changeReview('prev')">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="nav-btn" onclick="changeReview('next')">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                        
                        <!-- مؤشرات التنقل -->
                        <div class="review-indicators">
                            @if(count($customerReviews) > 1)
                                @for($i = 0; $i < min(3, count($customerReviews)); $i++)
                                    <button class="indicator {{ $i === 0 ? 'active' : '' }}" onclick="showReview({{ $i }})"></button>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* قسم آراء العملاء */
.customer-reviews-section {
    background: #f8f9fa;
    padding: 80px 0;
}

.section-title {
    color: #6f42c1;
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 20px;
}

.reviews-container {
    max-width: 1200px;
    margin: 0 auto;
}

/* البطاقة الرئيسية */
.main-review-card {
    background: linear-gradient(135deg, #f8f0ff 0%, #f0e6ff 100%);
    border-radius: 25px;
    padding: 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(111, 66, 193, 0.1);
}

.main-review-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="waves" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M0 10 Q5 5 10 10 T20 10" fill="none" stroke="rgba(111,66,193,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23waves)"/></svg>');
    opacity: 0.3;
}

.company-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
    position: relative;
    z-index: 2;
}

.logo-icon {
    width: 50px;
    height: 50px;
    background: #e91e63;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

.company-name {
    color: #6f42c1;
    font-weight: 700;
    font-size: 1.3rem;
    letter-spacing: 1px;
}

.reviewer-profile {
    position: relative;
    margin-bottom: 25px;
    display: inline-block;
}

.profile-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: #6f42c1;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

.profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.rating-overlay {
    position: absolute;
    bottom: -10px;
    right: -10px;
    background: #6f42c1;
    border-radius: 20px;
    padding: 8px 12px;
    box-shadow: 0 3px 10px rgba(111, 66, 193, 0.3);
}

.stars {
    display: flex;
    gap: 2px;
}

.stars i {
    color: #ffc107;
    font-size: 0.9rem;
}

.reviewer-info {
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
}

.reviewer-name {
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    background: #6f42c1;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-block;
}

.review-text {
    color: #6f42c1;
    font-size: 1.1rem;
    line-height: 1.7;
    margin: 0;
    position: relative;
    z-index: 2;
}

/* النص الجانبي */
.side-review {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.review-content {
    flex: 1;
}

.review-text-side {
    color: #495057;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 25px;
    text-align: justify;
}

.rating-stars {
    margin-bottom: 20px;
}

.rating-stars i {
    color: #ffc107;
    font-size: 1.3rem;
    margin-right: 3px;
}

.reviewer-details {
    margin-bottom: 30px;
}

.reviewer-name-side {
    color: #6f42c1;
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.reviewer-title {
    color: #e91e63;
    font-size: 0.95rem;
    font-weight: 500;
}

/* أزرار التنقل */
.navigation-buttons {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
}

.nav-btn {
    width: 45px;
    height: 45px;
    background: #6f42c1;
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-btn:hover {
    background: #5a32a3;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
}

/* مؤشرات التنقل */
.review-indicators {
    display: flex;
    gap: 8px;
    margin-top: 15px;
    justify-content: center;
}

.indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
}

.indicator.active {
    background: #6f42c1;
    transform: scale(1.2);
}

.nav-btn:active {
    transform: translateY(0);
}

    overflow: hidden;
}

.reviewer-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.reviewer-avatar i {
    font-size: 1.8rem;
    color: #6f42c1;
}


</style>

<script>
// Carousel functionality
let currentIndex = 0;
const carousel = document.getElementById('reviewsCarousel');
const cards = carousel ? carousel.querySelectorAll('.review-card') : [];
const totalCards = cards.length;

function moveCarousel(direction) {
    currentIndex += direction;
    
    if (currentIndex < 0) {
        currentIndex = totalCards - 1;
    } else if (currentIndex >= totalCards) {
        currentIndex = 0;
    }
    
    updateCarousel();
}

function updateCarousel() {
    const offset = -currentIndex * (400 + 30); // card width + gap
    carousel.style.transform = `translateX(${offset}px)`;
}

// Auto-advance carousel every 5 seconds
setInterval(() => {
    moveCarousel(1);
}, 5000);

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    updateCarousel();
});
</script>

<!-- قسم الأسئلة الشائعة -->
<section class="faq-section py-5">
    <div class="container">
        <div class="row">
            <!-- القسم الأيسر: قائمة الأسئلة -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="faq-list">
                    <div class="faq-item active">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">-</span>
                            <h4>{{ __('messages.faq_question_1') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_1') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">+</span>
                            <h4>{{ __('messages.faq_question_2') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_2') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">+</span>
                            <h4>{{ __('messages.faq_question_3') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_3') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">+</span>
                            <h4>{{ __('messages.faq_question_4') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_4') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">+</span>
                            <h4>{{ __('messages.faq_question_5') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_5') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">+</span>
                            <h4>{{ __('messages.faq_question_6') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_6') }}</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFAQ(this)">
                            <span class="faq-icon">+</span>
                            <h4>{{ __('messages.faq_question_7') }}</h4>
                        </div>
                        <div class="faq-answer">
                            <p>{{ __('messages.faq_answer_7') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- القسم الأيمن: المقدمة وزر الاتصال -->
            <div class="col-lg-6">
                <div class="faq-intro">
                    <div class="subtitle">{{ __('messages.talk_to_support') }}</div>
                    <h2 class="main-title">{{ __('messages.frequently_asked_questions') }}</h2>
                    <div class="description">
                        <p>{{ __('messages.faq_description') }}</p>
                    </div>
                    <div class="contact-action">
                        <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="contact-btn">{{ __('messages.contact_us_now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* قسم المدونة */
.blog-section {
    background: white;
    padding: 80px 0;
}

.section-header {
    margin-bottom: 60px;
}

.main-title {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.title-main {
    color: #23336b;
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
}

.title-sub {
    color: #6f42c1;
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    position: relative;
}

.title-sub::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: #e91e63;
    border-radius: 2px;
}

/* بطاقات المدونة */
.blog-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid #f0f0f0;
}

.blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.blog-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-image img {
    transform: scale(1.1);
}

.blog-category {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #e91e63;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    z-index: 2;
}

.blog-date {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(35, 51, 107, 0.9);
    color: white;
    padding: 8px 16px;
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: 500;
    z-index: 2;
}

.blog-content {
    padding: 25px;
}

.blog-title {
    color: #23336b;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 15px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-excerpt {
    color: #6c757d;
    font-size: 1rem;
    line-height: 1.6;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* زر استكشف المزيد */
.explore-btn {
    background: #23336b;
    color: white;
    text-decoration: none;
    padding: 18px 40px;
    border-radius: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(35, 51, 107, 0.3);
}

.explore-btn:hover {
    background: #1a2533;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(35, 51, 107, 0.4);
}

.explore-btn i {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.explore-btn:hover i {
    transform: translateX(-5px);
}

/* حالة عدم وجود مقالات */
.no-posts {
    padding: 60px 20px;
    color: #6c757d;
}

.no-posts i {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 20px;
}

.no-posts h3 {
    color: #495057;
    margin-bottom: 15px;
}

/* قسم الأسئلة الشائعة */
.faq-section {
    background: #f8f9fa;
    padding: 80px 0;
}

/* قائمة الأسئلة */
.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.faq-item:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    transform: translateY(-2px);
}

.faq-item.active {
    border-color: #23336b;
}

.faq-question {
    padding: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.faq-question:hover {
    background: #e9ecef;
}

.faq-icon {
    width: 30px;
    height: 30px;
    background: #23336b;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.faq-item.active .faq-icon {
    background: #e91e63;
    transform: rotate(45deg);
}

.faq-question h4 {
    color: #23336b;
    font-weight: 600;
    font-size: 1.1rem;
    margin: 0;
    line-height: 1.4;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    background: white;
}

.faq-item.active .faq-answer {
    max-height: 200px;
}

.faq-answer p {
    padding: 0 25px 25px;
    color: #495057;
    line-height: 1.6;
    margin: 0;
}

/* مقدمة الأسئلة الشائعة */
.faq-intro {
    padding: 40px 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.subtitle {
    color: #e91e63;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.main-title {
    color: #23336b;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 25px;
    line-height: 1.2;
}

.description {
    margin-bottom: 40px;
}

.description p {
    color: #495057;
    font-size: 1.1rem;
    line-height: 1.7;
    margin: 0;
    text-align: justify;
}

.contact-action {
    text-align: center;
}

.contact-btn {
    background: #23336b;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 18px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(35, 51, 107, 0.3);
    text-decoration: none;
    display: inline-block;
}

.contact-btn:hover {
    background: #1a2533;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(35, 51, 107, 0.4);
}

    .contact-btn:active {
        transform: translateY(-1px);
    }
    
    /* تصميم متجاوب لقسم آراء العملاء */
    @media (max-width: 991.98px) {
        .customer-reviews-section {
            padding: 60px 0;
        }
        
        .section-title {
            font-size: 2.5rem;
        }
        
        .main-review-card {
            padding: 30px;
        }
        
        .side-review {
            padding: 25px;
            margin-top: 30px;
        }
    }
    
    @media (max-width: 767.98px) {
        .customer-reviews-section {
            padding: 40px 0;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .main-review-card {
            padding: 25px;
        }
        
        .side-review {
            padding: 20px;
        }
        
        .profile-image {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }
        
        .company-logo {
            margin-bottom: 20px;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
        
        .company-name {
            font-size: 1.1rem;
        }
        
        .review-text,
        .review-text-side {
            font-size: 1rem;
        }
        
        .nav-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
    
    /* Footer */
    .footer-section {
        background: #23336b;
        color: white;
        padding: 60px 0 0;
    }
    
    .company-info {
        margin-bottom: 30px;
    }
    
    .footer-logo {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .logo-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    
    .logo-text {
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: 2px;
    }
    
    .company-description {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.7;
        font-size: 1rem;
        margin: 0;
        text-align: justify;
    }
    
    .footer-links h4 {
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-links li {
        margin-bottom: 12px;
        text-align: center;
    }
    
    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    
    .footer-links a:hover {
        color: white;
        text-decoration: none;
    }
    
    .contact-info h4 {
        color: white;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
    }
    
    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .contact-details {
        flex: 1;
    }
    
    .contact-value {
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    
    .contact-hours {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .footer-bottom {
        background: #1a2533;
        padding: 20px 0;
        margin-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .copyright {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        text-align: center;
        text-align: center;
    }
    
    .footer-bottom-links {
        text-align: center;
    }
    
    .footer-bottom-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        margin: 0 10px;
    }
    
    .footer-bottom-links a:hover {
        color: white;
        text-decoration: none;
    }
    
    .separator {
        color: rgba(255, 255, 255, 0.4);
        margin: 0 5px;
    }
    
    /* تصميم متجاوب */
@media (max-width: 991.98px) {
    .blog-section {
        padding: 60px 0;
    }
    
    .title-main {
        font-size: 2rem;
    }
    
    .title-sub {
        font-size: 1.6rem;
    }
    
    .faq-section {
        padding: 60px 0;
    }
    
    .main-title {
        font-size: 2rem;
    }
    
    .faq-intro {
        padding: 30px 20px;
        text-align: center;
    }
}

@media (max-width: 767.98px) {
    .blog-section {
        padding: 40px 0;
    }
    
    .title-main {
        font-size: 1.8rem;
    }
    
    .title-sub {
        font-size: 1.4rem;
    }
    
    .blog-card {
        margin-bottom: 30px;
    }
    
    .blog-content {
        padding: 20px;
    }
    
    .blog-title {
        font-size: 1.1rem;
    }
    
    .explore-btn {
        padding: 15px 30px;
        font-size: 1rem;
    }
    
    .faq-section {
        padding: 40px 0;
    }
    
    .main-title {
        font-size: 1.8rem;
    }
    
    .faq-question {
        padding: 20px;
    }
    
    .faq-question h4 {
        font-size: 1rem;
    }
    
    .faq-answer p {
        padding: 0 20px 20px;
        font-size: 1rem;
    }
    
    .contact-btn {
        padding: 15px 30px;
        font-size: 1rem;
    }
    
    /* Footer responsive */
    .footer-section {
        padding: 40px 0 0;
    }
    
    .footer-logo {
        justify-content: center;
        margin-bottom: 25px;
    }
    
    .logo-text {
        font-size: 1.5rem;
    }
    
    .company-description {
        text-align: center;
        font-size: 0.95rem;
    }
    
    .footer-links h4 {
        font-size: 1.1rem;
        margin-bottom: 15px;
    }
    
    .footer-links a {
        font-size: 0.9rem;
    }
    
    .contact-info h4 {
        font-size: 1.1rem;
        margin-bottom: 20px;
    }
    
    .contact-item {
        gap: 12px;
        margin-bottom: 18px;
    }
    
    .contact-icon {
        width: 35px;
        height: 35px;
        font-size: 1.1rem;
    }
    
    .contact-value {
        font-size: 1rem;
    }
    
    .contact-hours {
        font-size: 0.85rem;
    }
    
    .footer-bottom {
        padding: 15px 0;
        margin-top: 30px;
    }
    
    .copyright {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .footer-bottom-links a {
        font-size: 0.9rem;
        margin: 0 8px;
    }
}
</style>

<script>
// وظيفة تبديل الأسئلة
function toggleFAQ(element) {
    if (!element) return;
    
    const faqItem = element.parentElement;
    if (!faqItem) return;
    
    const isActive = faqItem.classList.contains('active');
    
    // إغلاق جميع الأسئلة
    const faqItems = document.querySelectorAll('.faq-item');
    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            item.classList.remove('active');
            const icon = item.querySelector('.faq-icon');
            if (icon) {
                icon.textContent = '+';
            }
        });
    }
    
    // فتح السؤال المحدد إذا لم يكن مفتوحاً
    if (!isActive) {
        faqItem.classList.add('active');
        const icon = faqItem.querySelector('.faq-icon');
        icon.textContent = '-';
    }
}

// فتح أول سؤال عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    const firstFaq = document.querySelector('.faq-item');
    if (firstFaq) {
        firstFaq.classList.add('active');
    }
});

// تم نقل وظيفة تبديل آراء العملاء إلى نهاية الملف لاستخدام البيانات من قاعدة البيانات
</script>

<!-- قسم المدونة -->
<section class="blog-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="main-title">
                <span class="title-main">Miss Helpers</span>
                <span class="title-sub">{{ __('messages.blogs') }}</span>
            </h2>
        </div>
        
        <div class="row">
            @forelse($posts as $post)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="blog-card">
                    <div class="blog-image">
                        @php 
                            if ($post->featured_image) {
                                if (str_starts_with($post->featured_image, 'http')) {
                                    $img = $post->featured_image;
                                } else {
                                    $img = asset('storage/' . $post->featured_image);
                                }
                            } else {
                                $img = asset('images/blog1.jpg');
                            }
                        @endphp
                        <img src="{{ $img }}" alt="{{ $post->title }}" class="img-fluid" onerror="this.src='{{ asset('images/blog1.jpg') }}'">
                        <div class="blog-category">{{ \App\Helpers\TranslationHelper::translateMaidValue($post->category->name ?? __('messages.general')) }}</div>
                        <div class="blog-date">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F d, Y') : __('messages.coming_soon') }}</div>
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title">{{ \App\Helpers\TranslationHelper::translateMaidValue($post->title) }}</h3>
                        <p class="blog-excerpt">{{ \App\Helpers\TranslationHelper::translateMaidValue(Str::limit($post->excerpt ?? $post->content, 120)) }}</p>
                        <a href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}" class="read-more">
                            {{ __('messages.read_more') }}
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="no-posts">
                    <i class="bi bi-journal-text"></i>
                    <h3>{{ __('messages.no_articles_currently') }}</h3>
                    <p>{{ __('messages.new_articles_coming_soon') }}</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}" class="explore-btn">
                <i class="bi bi-arrow-left"></i>
                {{ __('messages.explore_more') }}
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <!-- معلومات الشركة -->
            <div class="col-lg-4 mb-4">
                <div class="company-info">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i class="bi bi-house-heart"></i>
                        </div>
                        <span class="logo-text">MISS HELPERS</span>
                    </div>
                    <p class="company-description">
                        {{ __('messages.company_mission') }}
                    </p>
                </div>
            </div>
            
            <!-- روابط التنقل -->
            <div class="col-lg-4 mb-4">
                <div class="row">
                    <div class="col-6">
                        <div class="footer-links">
                            <h4>{{ __('messages.top_rated_categories') }}</h4>
                            <ul>
                                <li><a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a></li>
                                <li><a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about_us') }}</a></li>
                                <li><a href="#contact">{{ __('messages.contact_us') }}</a></li>
                                <li><a href="{{ route('admin.login') }}">Login / Register</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="footer-links">
                            <h4>{{ __('messages.services') }}</h4>
                            <ul>
                                <li><a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a></li>
                                <li><a href="{{ route('maids.all.' . app()->getLocale()) }}">{{ __('messages.maids') }}</a></li>
                                <li><a href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.blogs') }}</a></li>
                                <li><a href="#services">{{ __('messages.services') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- معلومات الاتصال -->
            <div class="col-lg-4 mb-4">
                <div class="contact-info">
                    <h4>{{ __('messages.dont_hesitate_to_share') }}</h4>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-value"><a href="tel:+97143430391" class="text-decoration-none text-white">+97143430391</a></div>
                            <div class="contact-hours">{{ __('messages.working_hours') }}</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-value">support@misshelpers.com</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-value"><a href="https://wa.me/97143430391" target="_blank" class="text-decoration-none text-white">+97143430391</a></div>
                            <div class="contact-hours">{{ __('messages.working_hours') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- حقوق النشر والروابط السفلية -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright">
                        Miss Helpers© All rights reserved. 2025
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about_us') }}</a>
                        <span class="separator">|</span>
                        <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                        <span class="separator">|</span>
                        <a href="#contact">{{ __('messages.contact_us') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<div class="whatsapp-float">
    <a href="https://wa.me/97143430391" target="_blank" class="whatsapp-btn" title="تواصل معنا عبر واتساب">
        <i class="bi bi-whatsapp"></i>
    </a>
</div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">تسجيل الدخول</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="loginForm" method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="modal_login_email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="modal_login_email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   placeholder="أدخل بريدك الإلكتروني">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modal_login_password" class="form-label">كلمة المرور</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="modal_login_password" 
                                   name="password" 
                                   required 
                                   placeholder="أدخل كلمة المرور">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right"></i> تسجيل الدخول
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="mb-0">ليس لديك حساب؟ <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">إنشاء حساب جديد</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">إنشاء حساب جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="registerForm" method="POST" action="{{ route('auth.register') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="modal_name" class="form-label">الاسم الكامل</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="modal_name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="أدخل اسمك الكامل">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modal_email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="modal_email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   placeholder="أدخل بريدك الإلكتروني">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modal_phone" class="form-label">رقم الهاتف</label>
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="modal_phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   required 
                                   placeholder="أدخل رقم هاتفك">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modal_password" class="form-label">كلمة المرور</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="modal_password" 
                                   name="password" 
                                   required 
                                   placeholder="أدخل كلمة المرور">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="modal_password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="modal_password_confirmation" 
                                   name="password_confirmation" 
                                   required 
                                   placeholder="أعد إدخال كلمة المرور">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i> إنشاء الحساب
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <p class="mb-0">لديك حساب بالفعل؟ <a href="{{ route('auth.login') }}">تسجيل الدخول</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget - Inline CSS and JS for better compatibility -->
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

    .chat-messages::-webkit-scrollbar {
        width: 4px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 2px;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
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

    .message-avatar {
        width: 32px;
        height: 32px;
        background: #ffa19c;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .message-avatar i {
        color: white;
        font-size: 14px;
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
    }
    
    .sender-name {
        display: block;
        font-size: 0.75rem;
        color: #666;
        margin-top: 2px;
        font-weight: 500;
    }
    
    .user-message .sender-name {
        color: rgba(255, 255, 255, 0.8);
    }
    
    /* New message animations */
    .message-new {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease-out;
    }
    
    .message-visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Smooth scroll for new messages */
    .chat-messages {
        scroll-behavior: smooth;
    }
    
    /* Pulse animation for new messages */
    .pulse {
        animation: pulse 0.5s ease-in-out;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
        line-height: 1.4;
    }

    /* Visitor Registration Form Styles */
    .visitor-registration-form {
        margin: 20px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px solid #e9ecef;
    }

    .registration-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .registration-card h5 {
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }

    .registration-card p {
        color: #666;
        margin-bottom: 20px;
        text-align: center;
        font-size: 14px;
    }

    .registration-card .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
    }

    .registration-card .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }

    .registration-card .btn {
        padding: 10px;
        font-size: 14px;
        font-weight: 500;
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
        resize: none;
        max-height: 100px;
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

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message {
        animation: slideInUp 0.3s ease;
    }

    /* WhatsApp Floating Button */
    .whatsapp-float {
        position: fixed;
        bottom: 100px;
        right: 20px;
        z-index: 1000;
        animation: pulse 2s infinite;
    }

    .whatsapp-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background: #25D366;
        color: white;
        border-radius: 50%;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
        transition: all 0.3s ease;
        font-size: 28px;
    }

    .whatsapp-btn:hover {
        background: #128C7E;
        color: white;
        text-decoration: none;
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6);
    }

    .whatsapp-btn i {
        font-size: 28px;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* Mobile Responsive for WhatsApp Button */
    @media (max-width: 768px) {
        .whatsapp-float {
            bottom: 80px;
            right: 15px;
        }
        
        .whatsapp-btn {
            width: 50px;
            height: 50px;
            font-size: 24px;
        }
        
        .whatsapp-btn i {
            font-size: 24px;
        }
    }
    </style>

    <script>
        // Handle register form submission and modal behavior
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("auth.register") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const modalBody = document.querySelector('#registerModal .modal-body');
                    modalBody.innerHTML = `
                        <div class="alert alert-success text-center">
                            <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                            <h5 class="mt-3">تم إنشاء الحساب بنجاح!</h5>
                            <p>مرحباً بك في Miss Helpers</p>
                        </div>
                    `;
                    
                    // Reload page after 2 seconds
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    // Show error message
                    const modalBody = document.querySelector('#registerModal .modal-body');
                    const form = document.getElementById('registerForm');
                    modalBody.insertBefore(
                        document.createElement('div').innerHTML = `
                            <div class="alert alert-danger">
                                ${data.message || 'حدث خطأ أثناء إنشاء الحساب'}
                            </div>
                        `,
                        form
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const modalBody = document.querySelector('#registerModal .modal-body');
                const form = document.getElementById('registerForm');
                modalBody.insertBefore(
                    document.createElement('div').innerHTML = `
                        <div class="alert alert-danger">
                            حدث خطأ أثناء إنشاء الحساب
                        </div>
                    `,
                    form
                );
            });
        });

        // Handle login form submission and modal behavior
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("auth.login") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.redirected) {
                    // Redirect to the intended page
                    window.location.href = response.url;
                } else {
                    return response.json();
                }
            })
            .then(data => {
                if (data && !data.success) {
                    // Show error message
                    const modalBody = document.querySelector('#loginModal .modal-body');
                    const form = document.getElementById('loginForm');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'alert alert-danger';
                    errorDiv.innerHTML = data.message || 'بيانات الدخول غير صحيحة';
                    modalBody.insertBefore(errorDiv, form);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const modalBody = document.querySelector('#loginModal .modal-body');
                const form = document.getElementById('loginForm');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger';
                errorDiv.innerHTML = 'حدث خطأ أثناء تسجيل الدخول';
                modalBody.insertBefore(errorDiv, form);
            });
        });

        // Clear error messages when modals are opened
        const loginModal = document.getElementById('loginModal');
        if (loginModal) {
            loginModal.addEventListener('show.bs.modal', function() {
                const alerts = this.querySelectorAll('.alert');
                if (alerts.length > 0) {
                    alerts.forEach(alert => alert.remove());
                }
            });
        }

        const registerModal = document.getElementById('registerModal');
        if (registerModal) {
            registerModal.addEventListener('show.bs.modal', function() {
                const alerts = this.querySelectorAll('.alert');
                if (alerts.length > 0) {
                    alerts.forEach(alert => alert.remove());
                }
            });
        }

        // Interactive Features Orbital System
        document.addEventListener('DOMContentLoaded', function() {
            const orbitalFeatures = document.querySelectorAll('.orbital-feature');
            const centralContent = document.getElementById('centralContent');
            
            if (orbitalFeatures.length > 0) {
                orbitalFeatures.forEach(feature => {
                    feature.addEventListener('click', function() {
                        // Remove active class from all features
                        orbitalFeatures.forEach(f => f.classList.remove('active'));
                        
                        // Add active class to clicked feature
                        this.classList.add('active');
                        
                        // Get content and description
                        const content = this.getAttribute('data-content');
                        const description = this.getAttribute('data-description');
                        
                        // Update central content with animation
                        if (centralContent) {
                            centralContent.style.opacity = '0';
                            centralContent.style.transform = 'scale(0.8)';
                            
                            setTimeout(() => {
                                centralContent.innerHTML = `
                                    <h3>${content}</h3>
                                    <p>${description}</p>
                                `;
                                centralContent.style.opacity = '1';
                                centralContent.style.transform = 'scale(1)';
                            }, 150);
                        }
                    });
                });
            }
            
            // Pause animation on hover
            orbitalFeatures.forEach(feature => {
                feature.addEventListener('mouseenter', function() {
                    this.style.animationPlayState = 'paused';
                });
                
                feature.addEventListener('mouseleave', function() {
                    this.style.animationPlayState = 'running';
                });
            });
        });

        // Enhanced Chat Widget JavaScript
        class ChatWidget {
            constructor() {
                this.isOpen = false;
                this.chatRoomId = null;
                this.visitorName = null;
                this.visitorEmail = null;
                this.messagePollingInterval = null;
                this.init();
            }

            init() {
                this.loadVisitorData();
                this.createWidget();
                this.bindEvents();
                this.loadChatRoomId();
                this.requestNotificationPermission();
                console.log('Enhanced Chat Widget initialized');
            }

            loadVisitorData() {
                this.visitorName = localStorage.getItem('visitor_name');
                this.visitorEmail = localStorage.getItem('visitor_email');
                console.log('Loaded visitor data:', { name: this.visitorName, email: this.visitorEmail });
            }

            loadChatRoomId() {
                const savedChatRoomId = localStorage.getItem('chat_room_id');
                if (savedChatRoomId) {
                    this.chatRoomId = savedChatRoomId;
                    console.log('Loaded chat room ID:', this.chatRoomId);
                }
            }

            createWidget() {
                // Create chat widget HTML
                const chatHTML = `
                    <div id="chat-widget" class="chat-widget">
                        <!-- Chat Toggle Button -->
                        <div id="chat-toggle" class="chat-toggle">
                            <i class="bi bi-chat-dots"></i>
                            <span class="chat-badge">1</span>
                        </div>

                        <!-- Chat Window -->
                        <div id="chat-window" class="chat-window">
                            <!-- Chat Header -->
                            <div class="chat-header">
                                <div class="chat-header-info">
                                    <div class="chat-avatar">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <div class="chat-title">
                                        <h6>Miss Helpers Support</h6>
                                        <span class="chat-status">متاح الآن</span>
                                    </div>
                                </div>
                                <div class="chat-controls">
                                    <button class="chat-close" id="chat-close">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Chat Messages -->
                            <div class="chat-messages" id="chat-messages">
                                <div class="message bot-message">
                                    <div class="message-content">
                                        <p>مرحباً! أنا هنا لمساعدتك. كيف يمكنني مساعدتك اليوم؟</p>
                                        <span class="message-time">الآن</span>
                                    </div>
                                </div>
                                
                                <!-- Visitor Registration Form (hidden by default) -->
                                <div id="visitor-registration-form" class="visitor-registration-form" style="display: none;">
                                    <div class="registration-card">
                                        <h5>معلوماتك</h5>
                                        <p>يرجى إدخال اسمك للبدء في المحادثة</p>
                                        <form id="chat-visitor-form">
                                            <div class="mb-3">
                                                <input type="text" id="chat-visitor-name" placeholder="اسمك" required 
                                                       class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <input type="email" id="chat-visitor-email" placeholder="البريد الإلكتروني (اختياري)" 
                                                       class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">متابعة</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Input -->
                            <div class="chat-input-container">
                                <div class="chat-input">
                                    <input type="text" id="chat-input" placeholder="اكتب رسالتك هنا..." />
                                    <button id="chat-send" class="chat-send-btn">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                                <div class="chat-footer">
                                    <small>مدعوم بـ Miss Helpers</small>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Add to body
                document.body.insertAdjacentHTML('beforeend', chatHTML);
            }

            bindEvents() {
                const toggle = document.getElementById('chat-toggle');
                const close = document.getElementById('chat-close');
                const sendBtn = document.getElementById('chat-send');
                const input = document.getElementById('chat-input');

                // Toggle chat
                toggle.addEventListener('click', () => {
                    this.toggleChat();
                });

                // Close chat
                close.addEventListener('click', () => {
                    this.closeChat();
                });

                // Send message
                sendBtn.addEventListener('click', () => {
                    this.sendMessage();
                });

                // Enter key to send
                input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.sendMessage();
                    }
                });
            }

            toggleChat() {
                const window = document.getElementById('chat-window');
                const toggle = document.getElementById('chat-toggle');
                
                if (this.isOpen) {
                    this.closeChat();
                } else {
                    this.openChat();
                }
            }

            openChat() {
                console.log('Opening chat...');
                
                // Always check for visitor name first
                this.loadVisitorData();
                
                if (!this.visitorName || this.visitorName.trim() === '') {
                    console.log('Visitor has no name, showing popup...');
                    this.showVisitorPopup();
                    return;
                }
                
                console.log('Visitor has name, opening chat directly');
                this.openChatDirectly();
            }
            
            // Open chat directly
            openChatDirectly() {
                const window = document.getElementById('chat-window');
                const toggle = document.getElementById('chat-toggle');
                
                window.classList.add('open');
                toggle.classList.add('active');
                this.isOpen = true;
                
                // Reset message counter
                this.resetMessageCounter();
                
                // Check if visitor needs to register
                this.loadVisitorData();
                if (!this.visitorName || this.visitorName.trim() === '') {
                    this.showRegistrationFormInChat();
                } else {
                    this.hideRegistrationFormInChat();
                    // Focus input
                    setTimeout(() => {
                        document.getElementById('chat-input').focus();
                    }, 300);
                    
                    // Start polling for new messages
                    this.startMessagePolling();
                }
            }

            closeChat() {
                const window = document.getElementById('chat-window');
                const toggle = document.getElementById('chat-toggle');
                
                window.classList.remove('open');
                toggle.classList.remove('active');
                this.isOpen = false;
                
                // Stop polling for messages
                this.stopMessagePolling();
            }

            sendMessage() {
                const input = document.getElementById('chat-input');
                const message = input.value.trim();
                
                if (!message) return;
                
                console.log('Sending message:', message);
                
                // Always check for visitor name first
                this.loadVisitorData();
                
                if (!this.visitorName || this.visitorName.trim() === '') {
                    console.log('Visitor has no name, showing registration form in chat...');
                    this.showRegistrationFormInChat();
                    
                    // Store the message to send after registration
                    this.pendingMessage = message;
                    return;
                }
                
                console.log('Visitor has name, sending message directly');
                // Add user message
                this.addMessage(message, 'user');
                input.value = '';
                
                // Send to server
                this.sendToServer(message);
            }
            
            // Check if visitor has name
            hasVisitorName() {
                const name = localStorage.getItem('visitor_name');
                const hasName = name && name.trim() !== '';
                console.log('hasVisitorName check:', { name, hasName });
                return hasName;
            }
            
            // Get visitor name
            getVisitorName() {
                return localStorage.getItem('visitor_name') || '';
            }
            
            // Get visitor email
            getVisitorEmail() {
                return localStorage.getItem('visitor_email') || '';
            }
            
            // Show visitor popup
            showVisitorPopup() {
                // Remove existing popup if any
                const existingPopup = document.getElementById('visitor-popup');
                if (existingPopup) {
                    existingPopup.remove();
                }
                
                // Create popup
                const popup = document.createElement('div');
                popup.id = 'visitor-popup';
                popup.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.8);
                    z-index: 10000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                `;
                
                popup.innerHTML = `
                    <div style="
                        background: white;
                        padding: 30px;
                        border-radius: 10px;
                        max-width: 400px;
                        width: 90%;
                        text-align: center;
                        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                    ">
                        <h3 style="margin-bottom: 20px; color: #333;">مرحباً بك!</h3>
                        <p style="margin-bottom: 20px; color: #666;">يرجى إدخال اسمك للبدء في المحادثة</p>
                        
                        <form id="visitor-form">
                            <div style="margin-bottom: 15px;">
                                <input type="text" id="visitor-name" placeholder="اسمك" required 
                                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                            </div>
                            <div style="margin-bottom: 20px;">
                                <input type="email" id="visitor-email" placeholder="البريد الإلكتروني (اختياري)" 
                                       style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                            </div>
                            <button type="submit" style="
                                background: #007bff;
                                color: white;
                                border: none;
                                padding: 12px 30px;
                                border-radius: 5px;
                                font-size: 16px;
                                cursor: pointer;
                                width: 100%;
                            ">متابعة</button>
                        </form>
                    </div>
                `;
                
                document.body.appendChild(popup);
                
                // Handle form submission
                const form = document.getElementById('visitor-form');
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    const name = document.getElementById('visitor-name').value.trim();
                    const email = document.getElementById('visitor-email').value.trim();
                    
                    if (!name) {
                        alert('يرجى إدخال اسمك');
                        return;
                    }
                    
                    // Save visitor data
                    this.visitorName = name.trim();
                    this.visitorEmail = email.trim();
                    localStorage.setItem('visitor_name', this.visitorName);
                    if (email) {
                        localStorage.setItem('visitor_email', this.visitorEmail);
                    }
                    console.log('Visitor data saved:', { name: this.visitorName, email: this.visitorEmail });
                    
                    // Close popup
                    popup.remove();
                    
                    // Open chat if it was requested
                    if (this.isOpen) {
                        this.openChatDirectly();
                    }
                    
                    // Send pending message if exists
                    if (this.pendingMessage) {
                        this.addMessage(this.pendingMessage, 'user');
                        this.sendToServer(this.pendingMessage);
                        this.pendingMessage = null;
                    }
                    
                    console.log('Visitor registered successfully');
                });
                
                // Close popup when clicking outside
                popup.addEventListener('click', (e) => {
                    if (e.target === popup) {
                        popup.remove();
                    }
                });
            }
            
            // Send message to server
            sendToServer(message) {
                // Use current visitor data
                const visitorName = this.visitorName || this.getVisitorName();
                const visitorEmail = this.visitorEmail || this.getVisitorEmail();
                
                console.log('Sending to server:', { message, visitorName, visitorEmail, chatRoomId: this.chatRoomId });
                
                if (!this.chatRoomId) {
                    // Create new chat room
                    this.createChatRoom(message, visitorName, visitorEmail);
                } else {
                    // Send to existing chat room
                    this.sendToChatRoom(message);
                }
            }
            
            // Create chat room
            createChatRoom(message, visitorName, visitorEmail) {
                const data = {
                    visitor_name: visitorName,
                    visitor_email: visitorEmail,
                    type: 'live_chat',
                    initial_message: message
                };
                
                console.log('Creating chat room with data:', data);
                
                fetch('/chat/start', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    console.log('Create chat room response status:', response.status);
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Error response:', text);
                            throw new Error('HTTP error! status: ' + response.status);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Create chat room response data:', data);
                    if (data.success) {
                        this.chatRoomId = data.chat_room_id;
                        localStorage.setItem('chat_room_id', this.chatRoomId);
                        console.log('Chat room created successfully:', this.chatRoomId);
                        
                        // Add confirmation message
                        this.addMessage('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.', 'bot');
                        console.log('Message sent to admin panel successfully!');
                    } else {
                        console.error('Failed to create chat room:', data.message);
                        this.addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
                    }
                })
                .catch(error => {
                    console.error('Error creating chat room:', error);
                    this.addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
                });
            }
            
            // Send to chat room
            sendToChatRoom(message) {
                const data = {
                    chat_room_id: this.chatRoomId,
                    message: message
                };
                
                console.log('Sending message to chat room:', data);
                
                fetch('/chat/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    console.log('Send message response status:', response.status);
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Error response:', text);
                            throw new Error('HTTP error! status: ' + response.status);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Send message response data:', data);
                    if (data.success) {
                        console.log('Message sent successfully');
                        this.addMessage('تم إرسال رسالتك بنجاح!', 'bot');
                    } else {
                        console.error('Failed to send message:', data.message);
                        this.addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    this.addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
                });
            }

            addMessage(content, sender, senderName = null, isNew = false) {
                const messagesContainer = document.getElementById('chat-messages');
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}-message`;
                
                // Add animation class for new messages
                if (isNew) {
                    messageDiv.classList.add('message-new');
                }
                
                const time = new Date().toLocaleTimeString('ar-SA', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                // Use sender name if provided, otherwise use default
                const displayName = senderName || (sender === 'user' ? 'أنت' : 'المدير');
                
                messageDiv.innerHTML = `
                    <div class="message-content">
                        <p>${content}</p>
                        <span class="message-time">${time}</span>
                        ${senderName ? `<small class="sender-name">${displayName}</small>` : ''}
                    </div>
                `;
                
                messagesContainer.appendChild(messageDiv);
                
                // Add entrance animation for new messages
                if (isNew) {
                    setTimeout(() => {
                        messageDiv.classList.add('message-visible');
                    }, 100);
                }
                
                this.scrollToBottom();
            }

            scrollToBottom() {
                const messagesContainer = document.getElementById('chat-messages');
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Request notification permission
            requestNotificationPermission() {
                if ('Notification' in window && Notification.permission === 'default') {
                    Notification.requestPermission().then(permission => {
                        console.log('Notification permission:', permission);
                    });
                }
            }
            
            // Reset message counter
            resetMessageCounter() {
                const chatToggle = document.getElementById('chat-toggle');
                const badge = chatToggle.querySelector('.chat-badge');
                
                if (badge) {
                    badge.textContent = '0';
                }
            }
            
            // Show notification for new messages
            showNewMessageNotification(count) {
                const chatToggle = document.getElementById('chat-toggle');
                const badge = chatToggle.querySelector('.chat-badge');
                
                if (badge) {
                    // Update badge with new message count
                    const currentCount = parseInt(badge.textContent) || 0;
                    badge.textContent = currentCount + count;
                    
                    // Add pulse animation
                    badge.classList.add('pulse');
                    setTimeout(() => {
                        badge.classList.remove('pulse');
                    }, 1000);
                }
                
                // Show browser notification if chat is closed
                if (!this.isOpen && 'Notification' in window && Notification.permission === 'granted') {
                    new Notification('رسالة جديدة من Miss Helpers', {
                        body: `لديك ${count} رسالة جديدة`,
                        icon: '/images/logo.png'
                    });
                }
            }

            // Check if visitor has name (simplified version)
            hasVisitorName() {
                this.loadVisitorData();
                return this.visitorName && this.visitorName.trim() !== '';
            }

            // Force visitor registration
            forceVisitorRegistration() {
                console.log('Forcing visitor registration...');
                this.showVisitorPopup();
            }

            // Show registration form inside chat
            showRegistrationFormInChat() {
                const form = document.getElementById('visitor-registration-form');
                const input = document.getElementById('chat-input');
                const sendBtn = document.getElementById('chat-send');
                
                if (form) {
                    form.style.display = 'block';
                    input.style.display = 'none';
                    sendBtn.style.display = 'none';
                }
                
                // Bind form submission
                this.bindChatRegistrationForm();
            }

            // Hide registration form inside chat
            hideRegistrationFormInChat() {
                const form = document.getElementById('visitor-registration-form');
                const input = document.getElementById('chat-input');
                const sendBtn = document.getElementById('chat-send');
                
                if (form) {
                    form.style.display = 'none';
                    input.style.display = 'block';
                    sendBtn.style.display = 'flex';
                }
            }

            // Bind chat registration form
            bindChatRegistrationForm() {
                const form = document.getElementById('chat-visitor-form');
                if (form) {
                    // Remove existing listeners
                    form.removeEventListener('submit', this.handleChatRegistration);
                    
                    // Add new listener
                    this.handleChatRegistration = (e) => {
                        e.preventDefault();
                        
                        const name = document.getElementById('chat-visitor-name').value.trim();
                        const email = document.getElementById('chat-visitor-email').value.trim();
                        
                        if (!name) {
                            alert('يرجى إدخال اسمك');
                            return;
                        }
                        
                        // Save visitor data
                        this.visitorName = name.trim();
                        this.visitorEmail = email.trim();
                        localStorage.setItem('visitor_name', this.visitorName);
                        if (email) {
                            localStorage.setItem('visitor_email', this.visitorEmail);
                        }
                        console.log('Visitor data saved from chat form:', { name: this.visitorName, email: this.visitorEmail });
                        
                        // Hide form and show input
                        this.hideRegistrationFormInChat();
                        
                        // Add welcome message
                        this.addMessage(`مرحباً ${this.visitorName}! كيف يمكنني مساعدتك؟`, 'bot');
                        
                        // Send pending message if exists
                        if (this.pendingMessage) {
                            this.addMessage(this.pendingMessage, 'user');
                            this.sendToServer(this.pendingMessage);
                            this.pendingMessage = null;
                        }
                        
                        // Focus input
                        setTimeout(() => {
                            document.getElementById('chat-input').focus();
                        }, 300);
                        
                        console.log('Visitor registered successfully from chat');
                    };
                    
                    form.addEventListener('submit', this.handleChatRegistration);
                }
            }

            // Debug function to check system status
            debugSystem() {
                console.log('=== Chat System Debug Info ===');
                console.log('Visitor Name:', this.visitorName);
                console.log('Visitor Email:', this.visitorEmail);
                console.log('Chat Room ID:', this.chatRoomId);
                console.log('Is Open:', this.isOpen);
                console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));
                console.log('==============================');
            }
            
            // Start polling for new messages
            startMessagePolling() {
                if (this.messagePollingInterval) {
                    clearInterval(this.messagePollingInterval);
                }
                
                // Poll every 3 seconds
                this.messagePollingInterval = setInterval(() => {
                    this.refreshMessages();
                }, 3000);
                
                console.log('Started message polling');
            }
            
            // Stop polling for messages
            stopMessagePolling() {
                if (this.messagePollingInterval) {
                    clearInterval(this.messagePollingInterval);
                    this.messagePollingInterval = null;
                    console.log('Stopped message polling');
                }
            }
            
            // Refresh messages from server
            refreshMessages() {
                if (!this.chatRoomId) {
                    console.log('No chat room ID, skipping message refresh');
                    return;
                }
                
                fetch(`/chat/messages/${this.chatRoomId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.messages) {
                        this.updateMessagesDisplay(data.messages);
                    }
                })
                .catch(error => {
                    console.error('Error refreshing messages:', error);
                });
            }
            
            // Update messages display
            updateMessagesDisplay(messages) {
                const chatMessages = document.getElementById('chat-messages');
                if (!chatMessages) return;
                
                // Get current message count
                const currentMessageCount = chatMessages.querySelectorAll('.message').length;
                
                // If we have new messages, add only the new ones
                if (messages.length > currentMessageCount) {
                    // Add only new messages (not all messages)
                    const newMessages = messages.slice(currentMessageCount);
                    
                    newMessages.forEach(msg => {
                        const type = msg.sender_type === 'visitor' ? 'user' : 'bot';
                        this.addMessage(msg.message, type, msg.sender_name, true);
                    });
                    
                    // Show notification for new messages
                    this.showNewMessageNotification(newMessages.length);
                    
                    // Scroll to bottom smoothly
                    this.scrollToBottom();
                    
                    console.log(`Added ${newMessages.length} new messages`);
                }
            }
        }

        // Initialize chat widget when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing chat widget...');
            window.chatWidget = new ChatWidget();
            
            // Add global functions for debugging
            window.forceVisitorRegistration = function() {
                if (window.chatWidget) {
                    window.chatWidget.forceVisitorRegistration();
                }
            };
            
            window.clearVisitorData = function() {
                localStorage.removeItem('visitor_name');
                localStorage.removeItem('visitor_email');
                localStorage.removeItem('chat_room_id');
                console.log('Visitor data cleared');
                if (window.chatWidget) {
                    window.chatWidget.loadVisitorData();
                }
            };
            
            window.debugChatSystem = function() {
                if (window.chatWidget) {
                    window.chatWidget.debugSystem();
                }
            };
            
            window.testChatRegistration = function() {
                if (window.chatWidget) {
                    window.chatWidget.showRegistrationFormInChat();
                }
            };
            
            console.log('Chat widget initialized successfully');
            console.log('Debug functions available:');
            console.log('- forceVisitorRegistration() - Force visitor to register');
            console.log('- clearVisitorData() - Clear visitor data');
            console.log('- debugChatSystem() - Show debug info');
            console.log('- testChatRegistration() - Test registration form in chat');
        });

        // Customer Reviews Navigation
        let currentReviewIndex = 0;
        const reviews = @json($customerReviews);

        function changeReview(direction) {
            if (reviews.length <= 1) return;
            
            if (direction === 'next') {
                currentReviewIndex = (currentReviewIndex + 1) % reviews.length;
            } else {
                currentReviewIndex = (currentReviewIndex - 1 + reviews.length) % reviews.length;
            }
            
            showReview(currentReviewIndex);
        }

        function showReview(index) {
            if (!reviews[index]) return;
            
            currentReviewIndex = index;
            const review = reviews[index];
            
            // Update profile image
            const profileImg = document.querySelector('.reviewer-profile img');
            const profileIcon = document.querySelector('.reviewer-profile .profile-image');
            
            if (review.customer_photo) {
                let imgSrc = review.customer_photo;
                if (!imgSrc.startsWith('http')) {
                    imgSrc = '{{ asset("storage/") }}/' + imgSrc;
                }
                if (profileImg) {
                    profileImg.src = imgSrc;
                    profileImg.style.display = 'block';
                    profileIcon.style.display = 'none';
                }
            } else {
                if (profileImg) profileImg.style.display = 'none';
                profileIcon.style.display = 'flex';
            }
            
            // Update reviewer name
            const reviewerName = document.querySelector('.reviewer-name');
            if (reviewerName) {
                reviewerName.textContent = review.customer_name || '{{ __("messages.satisfied_customer_default") }}';
            }
            
            // Update review text
            const reviewText = document.querySelector('.review-text');
            if (reviewText) {
                reviewText.textContent = review.description || '{{ __("messages.default_review_text") }}';
            }
            
            // Update side review
            const sideReviewText = document.querySelector('.review-text-side');
            if (sideReviewText) {
                sideReviewText.textContent = review.description || '{{ __("messages.default_review_text") }}';
            }
            
            // Update rating stars
            updateStars(review.rating || 5);
            
            // Update reviewer details
            const reviewerNameSide = document.querySelector('.reviewer-name-side');
            if (reviewerNameSide) {
                const customerName = review.customer_name || '{{ __("messages.satisfied_customer_default") }}';
                const customerLocation = review.customer_location || '{{ __("messages.riyadh") }}';
                reviewerNameSide.textContent = `${customerName} - ${customerLocation}`;
            }
            
            // Update reviewer title
            const reviewerTitle = document.querySelector('.reviewer-title');
            if (reviewerTitle) {
                reviewerTitle.textContent = review.job_title || '{{ __("messages.satisfied_customer") }}';
            }
            
            // Update indicators
            updateIndicators(index);
        }

        function updateStars(rating) {
            const starElements = document.querySelectorAll('.rating-overlay .stars i, .rating-stars i');
            starElements.forEach((star, index) => {
                if (index < rating) {
                    star.className = 'bi bi-star-fill';
                } else {
                    star.className = 'bi bi-star';
                }
            });
        }

        function updateIndicators(activeIndex) {
            const indicators = document.querySelectorAll('.indicator');
            indicators.forEach((indicator, index) => {
                if (index === activeIndex) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>
