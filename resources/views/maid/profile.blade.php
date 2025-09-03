<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $maid->name }} - الملف الشخصي | ميس هيلبرز</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Header Styles */
        .site-header{position:sticky;top:0;z-index:1000;background:#fff;border-bottom:1px solid #f1f1f1}
        .header-inner{height:64px;display:flex;align-items:center;justify-content:space-between}
        .brand{display:flex;align-items:center;gap:10px;text-decoration:none}
        .brand img{height:34px}
        .brand .title{font-weight:800;color:#1c1c1c;letter-spacing:.5px}
        .nav-links a{color:#1c1c1c;text-decoration:none;padding:10px 14px;border-radius:12px;font-weight:600}
        .nav-links a:hover{background:#f6f7fb}
        .cta-btn{background:#0d6efd;color:#fff;border:none;border-radius:18px;padding:10px 18px;font-weight:800}
        .auth a{color:#1c1c1c;text-decoration:none;margin-inline-start:14px}
        
        .profile-header {
            background: linear-gradient(135deg, #23336b 0%, #1a2533 100%);
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            object-fit: cover;
        }
        
        .profile-stats {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #ffc107;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .main-content {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: #23336b;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: #e91e63;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #23336b;
        }
        
        .info-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #23336b;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .skill-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 10px 15px;
            border-radius: 20px;
            text-align: center;
            font-weight: 500;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .skill-tag:hover {
            background: #1976d2;
            color: white;
            transform: translateY(-2px);
        }
        
        .contact-btn {
            background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(233, 30, 99, 0.3);
        }
        
        .back-btn {
            background: #6c757d;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .rating-stars {
            color: #ffc107;
            font-size: 1.5rem;
        }
        
        .reviews-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }
        
        .review-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #e91e63;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .reviewer-name {
            font-weight: 600;
            color: #23336b;
        }
        
        .review-date {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .review-text {
            color: #495057;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .profile-avatar {
                width: 120px;
                height: 120px;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .skills-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
        }

        /* Button Styles */
        .contact-btn {
            background: linear-gradient(135deg, #e91e63 0%, #ff6b9d 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(233, 30, 99, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Modal Styles */
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
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(35, 51, 107, 0.3);
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
</head>
<body>
<!-- Header -->
<header class="site-header">
    <div class="container header-inner">
        <a href="{{ url('/') }}" class="brand">
            <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
            <span class="title">Miss Helpers</span>
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
            <div class="auth d-none d-md-inline">
                @guest
                    <button type="button" class="btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#loginModal">تسجيل الدخول</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#registerModal">إنشاء حساب</button>
                @else
                    <span class="me-3">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">تسجيل الخروج</button>
                    </form>
                @endguest
            </div>
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
            @guest
                <button type="button" class="btn btn-outline-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginModal">تسجيل الدخول</button>
                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#registerModal">إنشاء حساب</button>
            @else
                <span class="d-block py-2">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">تسجيل الخروج</button>
                </form>
            @endguest
            <a href="{{ route('contact.index') }}" class="cta-btn mt-2 w-100">احصل على خادمة الآن</a>
        </div>
    </div>
</header>
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 text-center">
                    <img src="{{ $maid->photo ? asset('storage/'.$maid->photo) : asset('/images/default-maid.jpg') }}" 
                         alt="{{ $maid->name }}" class="profile-avatar">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">{{ $maid->name }}</h1>
                    <p class="lead mb-4">{{ $maid->nationality }} • {{ $maid->age ?? 'غير محدد' }} سنة</p>
                    <div class="rating-stars mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($maid->rating ?? 0))
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                        <span class="ms-2">({{ $maid->reviews_count ?? 0 }} تقييم)</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="profile-stats">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $maid->views_count ?? rand(100, 500) }}</div>
                                    <div class="stat-label">مشاهدة</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $maid->reviews_count ?? 0 }}</div>
                                    <div class="stat-label">تقييم</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $maid->experience_years ?? rand(2, 8) }}</div>
                                    <div class="stat-label">سنوات خبرة</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container main-content">
        <div class="row">
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-person-circle"></i>
                        المعلومات الشخصية
                    </h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">الاسم الكامل</div>
                            <div class="info-value">{{ $maid->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">الجنسية</div>
                            <div class="info-value">{{ $maid->nationality }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">العمر</div>
                            <div class="info-value">{{ $maid->age ?? 'غير محدد' }} سنة</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">الحالة الاجتماعية</div>
                            <div class="info-value">{{ $maid->marital_status ?? 'غير محدد' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">عدد الأطفال</div>
                            <div class="info-value">{{ $maid->children_count ?? '0' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">سنوات الخبرة</div>
                            <div class="info-value">{{ $maid->experience_years ?? 'غير محدد' }} سنوات</div>
                        </div>
                    </div>
                </div>

                <!-- Skills & Experience -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-award"></i>
                        المهارات والخبرات
                    </h3>
                    <div class="skills-grid">
                        <div class="skill-tag">تنظيف المنزل</div>
                        <div class="skill-tag">الطبخ</div>
                        <div class="skill-tag">العناية بالأطفال</div>
                        <div class="skill-tag">غسيل الملابس</div>
                        <div class="skill-tag">التسوق</div>
                        <div class="skill-tag">العناية بالحديقة</div>
                    </div>
                    
                    <div class="mt-4">
                        <h5 class="mb-3">الخبرات السابقة:</h5>
                        <p class="text-muted">{{ $maid->previous_experience ?? 'خادمة منزلية مع خبرة في التنظيف والطبخ والعناية بالأطفال. عملت مع عائلات مختلفة في الإمارات العربية المتحدة.' }}</p>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-star"></i>
                        التقييمات والمراجعات
                    </h3>
                    <div class="reviews-section">
                        @if($maid->reviews_count > 0)
                            @foreach(range(1, min(3, $maid->reviews_count)) as $index)
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-name">عميل {{ $index }}</div>
                                        <div class="review-date">{{ now()->subDays(rand(1, 30))->format('Y-m-d') }}</div>
                                    </div>
                                    <div class="rating-stars mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= rand(3, 5))
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="review-text">
                                        {{ ['خدمة ممتازة ومهنية عالية', 'خادمة مجتهدة ونظيفة', 'أداء رائع وتعامُل محترم'][$index - 1] ?? 'تقييم إيجابي للخدمة المقدمة' }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted text-center py-4">لا توجد تقييمات بعد</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Contact & Actions -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-telephone"></i>
                        التواصل والحجز
                    </h3>
                    
                    <div class="d-grid gap-3 mb-4">
                        <a href="{{ route('contact.index') }}" class="btn contact-btn">
                            <i class="bi bi-telephone me-2"></i>
                            اتصل الآن
                        </a>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('maids.all') }}" class="btn back-btn">
                            <i class="bi bi-arrow-right me-2"></i>
                            العودة لقائمة الخادمات
                        </a>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-info-circle"></i>
                        معلومات إضافية
                    </h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">الراتب الشهري</div>
                            <div class="info-value">{{ number_format(rand(1500, 3000)) }} درهم</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">نوع العمل</div>
                            <div class="info-value">{{ $maid->work_type ?? 'دوام كامل' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">اللغة</div>
                            <div class="info-value">{{ $maid->languages ?? 'العربية، الإنجليزية' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">الحالة</div>
                            <div class="info-value">
                                <span class="badge bg-success">متاحة</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

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
                    <p class="mb-0">لديك حساب بالفعل؟ <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">تسجيل الدخول</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>

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
                            <p>مرحباً بك في Miss Helpers</li>
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
        document.getElementById('loginModal').addEventListener('show.bs.modal', function() {
            const alerts = this.querySelectorAll('.alert');
            alerts.forEach(alert => alert.remove());
        });

        document.getElementById('registerModal').addEventListener('show.bs.modal', function() {
            const alerts = this.querySelectorAll('.alert');
            alerts.forEach(alert => alert.remove());
        });
    </script>
</body>
</html>
