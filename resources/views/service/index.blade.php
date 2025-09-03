<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>الخدمات - Miss Helpers</title>
    
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
            <a href="{{ route('welcome') }}" class="brand">
                <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
            </a>
            <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <a href="{{ route('about.index') }}">عنا</a>
                <a href="{{ route('service.index') }}">الخدمات</a>
                <a href="{{ route('contact.index') }}">الاتصال بنا</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contact.index') }}" class="cta-btn d-none d-md-inline">احصل على خادمة الآن</a>
                <a href="#" class="text-decoration-none">English</a>
                <div class="auth d-none d-md-inline"><a href="{{ route('admin.login') }}">Login / Register</a></div>
                <button class="btn btn-outline-secondary d-md-none" data-bs-toggle="collapse" data-bs-target="#mnav"><i class="bi bi-list"></i></button>
            </div>
        </div>
        <div id="mnav" class="collapse border-top d-md-none">
            <div class="container py-2 nav-links">
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <a href="{{ route('about.index') }}">عنا</a>
                <a href="{{ route('service.index') }}">الخدمات</a>
                <a href="{{ route('contact.index') }}">الاتصال بنا</a>
                <a href="#">English</a>
                <a href="{{ route('admin.login') }}">Login / Register</a>
                <a href="{{ route('contact.index') }}" class="cta-btn mt-2 w-100">احصل على خادمة الآن</a>
            </div>
        </div>
    </header>

    <div class="services-page">
        <div class="container">
            <h1 class="page-title">
                <span class="title-highlight">اختر</span> من الباقات
            </h1>
            
            <div class="packages-container">
                <div class="packages-row">
                    <!-- الباقة الشهرية -->
                    <div class="package-card">
                        <div class="package-header">
                            <h2 class="package-title">الباقة الشهرية</h2>
                            <p class="package-subtitle">حل توظيف شهري مرن</p>
                        </div>
                        
                        <div class="package-price">
                            <span class="price-currency">درهم إماراتي</span>
                            <span class="price-period">شهريا</span>
                        </div>
                        
                        <div class="package-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">يبقى العامل تحت كفالة المركز للحصول على التأشيرة</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">عقد شهري - لا يوجد التزام طويل الأجل</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">يوفر المركز الراتب والتأمين الصحي وأوراق الإقامة</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">عملية خالية من المتاعب للعميل</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">مثالية لفترات قصيرة أو تجريبية</p>
                            </div>
                        </div>
                        
                        <div class="package-action">
                            <a href="{{ route('maids.all') }}" class="choose-btn">اختر الباقة</a>
                        </div>
                        
                        <div class="package-footer">
                            Miss Helpers UAE
                        </div>
                    </div>
                    
                    <!-- الباقة الرئيسية -->
                    <div class="package-card">
                        <div class="recommended-ribbon">RECOMMENDED</div>
                        
                        <div class="package-header">
                            <h2 class="package-title">الباقة الرئيسية</h2>
                            <p class="package-subtitle">حل توظيف طويل الأمد وفعال من حيث التكلفة</p>
                        </div>
                        
                        <div class="package-price">
                            <span class="price-currency">درهم إماراتي</span>
                            <span class="price-period">لمرة واحدة</span>
                        </div>
                        
                        <div class="package-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">دفعة توظيف لمرة واحدة</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">العامل تحت كفالة التأشيرة الشخصية للعميل</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">عقد لمدة عامين</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">ضمان لمدة عامين ضد الهروب أو رفض العمل</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">فعالة من حيث التكلفة على المدى الطويل</p>
                            </div>
                            
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <p class="feature-text">دعم كامل للنقل القانوني والتوثيق</p>
                            </div>
                        </div>
                        
                        <div class="package-action">
                            <a href="{{ route('maids.all') }}" class="choose-btn">اختر الباقة</a>
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
