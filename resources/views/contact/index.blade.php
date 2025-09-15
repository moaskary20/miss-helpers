<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.contact') }} - {{ config('app.name', 'Miss Helpers') }}</title>
    
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
        
        .contact-page {
            min-height: 100vh;
            padding: 40px 0;
        }
        
        .page-title {
            text-align: center;
            color: #23336b;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 50px;
        }
        
        .contact-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .form-section {
            padding: 40px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        
        .form-title {
            color: #23336b;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            color: #495057;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-control:focus {
            border-color: #23336b;
            box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25);
            outline: none;
        }
        
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            cursor: pointer;
        }
        
        .form-select:focus {
            border-color: #23336b;
            box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25);
            outline: none;
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
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
        }
        
        .submit-btn:hover {
            background: #1a2540;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(35, 51, 107, 0.3);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .info-section {
            padding: 40px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .info-item {
            margin-bottom: 30px;
        }
        
        .info-label {
            color: #23336b;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        
        .info-value {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }
        
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }
        
        .social-icon.instagram {
            background: #000;
        }
        
        .social-icon.whatsapp {
            background: #25D366;
        }
        
        .social-icon.facebook {
            background: #1877F2;
        }
        
        .social-icon.tiktok {
            background: #000000;
        }
        
        /* تصميم متجاوب */
        @media (max-width: 767.98px) {
            .page-title {
                font-size: 2rem;
                margin-bottom: 30px;
            }
            
            .contact-container {
                margin: 0 15px;
            }
            
            .form-section,
            .info-section {
                padding: 30px 25px;
            }
            
            .form-title {
                font-size: 1.5rem;
                margin-bottom: 25px;
            }
            
            .submit-btn {
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

    <div class="contact-page">
        <div class="container">
            <h1 class="page-title">{{ __('messages.contact') }}</h1>
            
            <div class="contact-container">
                <div class="row g-0">
                    <!-- قسم النموذج -->
                    <div class="col-lg-6">
                        <div class="form-section">
                            <h2 class="form-title">{{ __('messages.get_maid_now_title') }}</h2>
                            
                            <form id="contactForm" method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">{{ __('messages.full_name') }}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ __('messages.enter_full_name') }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">{{ __('messages.phone_number') }}</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="{{ __('messages.enter_phone_number') }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">{{ __('messages.select_service') }}</label>
                                    <select class="form-select" name="service_type" required>
                                        <option value="">{{ __('messages.select_service') }}</option>
                                        <option value="خادمه منزليه" selected>{{ __('messages.housemaid') }}</option>
                                        <option value="طباخه">{{ __('messages.cook') }}</option>
                                        <option value="سائق">{{ __('messages.driver') }}</option>
                                        <option value="جليسه اطفال">{{ __('messages.nanny') }}</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">{{ __('messages.select_nationality') }}</label>
                                    <select class="form-select" name="nationality" required>
                                        <option value="">{{ __('messages.select_nationality') }}</option>
                                        <option value="سيرلنكا" selected>{{ __('messages.sri_lanka') }}</option>
                                        <option value="الفلبين">{{ __('messages.philippines') }}</option>
                                        <option value="اندونسيا">{{ __('messages.indonesia') }}</option>
                                        <option value="اقيوبيا">{{ __('messages.ethiopia') }}</option>
                                        <option value="كينيا">{{ __('messages.kenya') }}</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">{{ __('messages.select_emirate') }}</label>
                                    <select class="form-select" name="emirate" required>
                                        <option value="">{{ __('messages.select_emirate') }}</option>
                                        <option value="راس الخيمة" selected>{{ __('messages.ras_al_khaimah') }}</option>
                                        <option value="دبي">{{ __('messages.dubai') }}</option>
                                        <option value="ابوظبي">{{ __('messages.abu_dhabi') }}</option>
                                        <option value="الشارقه">{{ __('messages.sharjah') }}</option>
                                        <option value="عجمان">{{ __('messages.ajman') }}</option>
                                        <option value="ام القوين">{{ __('messages.umm_al_quwain') }}</option>
                                        <option value="العين">{{ __('messages.fujairah') }}</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">{{ __('messages.message') }}</label>
                                    <textarea class="form-control form-textarea" name="notes" placeholder="{{ __('messages.write_message_here_contact') }}" required></textarea>
                                </div>
                                
                                <input type="hidden" name="status" value="تحت المراجعه">
                                <input type="hidden" name="is_active" value="1">
                                
                                <button type="submit" class="submit-btn">{{ __('messages.send') }}</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- قسم معلومات الاتصال -->
                    <div class="col-lg-6">
                        <div class="info-section">
                            <div class="info-item">
                                <div class="info-label">{{ __('messages.email') }}</div>
                                <p class="info-value">Support@Misshelpers.com</p>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">{{ __('messages.phone') }}</div>
                                <p class="info-value">04 343 0391</p>
                            </div>
                            
                            <div class="social-icons">
                                <a href="https://www.instagram.com/miss.helpers.uae" target="_blank" class="social-icon instagram" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="https://wa.link/misshelpers" target="_blank" class="social-icon whatsapp" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="https://www.tiktok.com/@misshelpers?_t=zs-8xvsshzpo9y&_r=1" target="_blank" class="social-icon tiktok" title="TikTok">
                                    <i class="bi bi-tiktok"></i>
                                </a>
                            </div>
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
    
    <script>
        // معالجة إرسال النموذج
        document.getElementById('contactForm').addEventListener('submit', function(e) {
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
    </script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>
</body>
</html>
