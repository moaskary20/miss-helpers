<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>عنا - Miss Helpers</title>
    
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
            background: #0d6efd;
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
    <!-- Header -->
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ url('/') }}" class="brand">
                <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
                <span class="title">Miss Helpers</span>
            </a>
            <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <a href="{{ route('about.index') }}" class="active">عنا</a>
                <a href="{{ route('service.index') }}">الخدمات</a>
                <a href="{{ route('contact.index') }}">الاتصال بنا</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contact.index') }}" class="cta-btn d-none d-md-inline">احصل على خادمة الآن</a>
                <a href="#" class="text-decoration-none">English</a>
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
                <a href="{{ route('welcome') }}">الرئيسية</a>
                <a href="{{ route('about.index') }}" class="active">عنا</a>
                <a href="{{ route('service.index') }}">الخدمات</a>
                <a href="{{ route('contact.index') }}">الاتصال بنا</a>
                <a href="#">English</a>
                <a href="{{ route('admin.login') }}">Login / Register</a>
                <a href="{{ route('contact.index') }}" class="cta-btn mt-2 w-100">احصل على خادمة الآن</a>
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
                         onerror="this.src='https://via.placeholder.com/600x500/23336b/ffffff?text=Miss+Helpers+Office'">
                </div>
                
                <!-- Right Side - Text Content -->
                <div class="about-text">
                    <span class="company-name">Miss Helpers</span>
                    <h1 class="main-title">شريكك الموثوق في الدعم المنزلي</h1>
                    
                    <p class="about-description">
                        نحن نؤمن بأن كل منزل يستحق مساعدة موثوقة ومتعاطفة ومهنية. في Miss Helpers، مهمتنا في الإمارات العربية المتحدة هي تسهيل التوظيف الآمن والمخصص للعمالة المنزلية لتلبية احتياجاتك المحددة.
                    </p>
                    
                    <p class="about-description">
                        مع سنوات من الخبرة في التوظيف، نتخصص في ربط العائلات بالعمالة المنزلية المؤهلة من مصادر دولية موثوقة. نقدم مجموعة شاملة من الخدمات تشمل المربية والخادمة ومقدم الرعاية والمساعد المتخصص، مع ضمان أن جميع المرشحين يخضعون لفحص شامل وتدريب صارم، مستعدون للخدمة بإخلاص.
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
                    <h3 class="section-subtitle">لماذا تختار Miss Helpers</h3>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">عملية توظيف شفافة</h4>
                                <p class="feature-description">
                                    نحن نعمل على تبسيط كل شيء - من تصفح المرشحين إلى توقيع العقود وإجراء المدفوعات الآمنة عبر الإنترنت
                                </p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">التوظيف القانوني والأخلاقي</h4>
                                <p class="feature-description">
                                    جميع عملياتنا تتوافق مع قوانين العمل في دولة الإمارات العربية المتحدة ومعايير التوظيف الدولية
                                </p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">المرشحون متعددو الجنسيات</h4>
                                <p class="feature-description">
                                    اختر من بين مجموعة واسعة من الجنسيات والخلفيات والمجموعات المهارية للعثور على الشخص المثالي لعائلتك
                                </p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">دعم ما بعد البيع</h4>
                                <p class="feature-description">
                                    نبقى معكم حتى بعد التعاقد. فريقنا جاهز دائمًا لمساعدتكم في عمليات المتابعة والتجديد وأي دعم قد تحتاجونه
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="read-more-link">
                        <i class="bi bi-link-45deg"></i>
                        Read more
                    </a>
                </div>
                
                <!-- Right Side - Team Photo -->
                <div class="why-choose-image">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Miss Helpers Professional Team" 
                         onerror="this.src='https://via.placeholder.com/600x500/6f42c1/ffffff?text=Miss+Helpers+Team'">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision and Mission Section -->
    <section class="vision-mission">
        <div class="container">
            <h2 class="section-main-title">الرؤية والرسالة</h2>
            
            <div class="vision-mission-cards">
                <!-- Vision Card -->
                <div class="vision-card">
                    <div class="card-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 class="card-title">رؤيتنا</h3>
                    <p class="card-description">
                        أن نصبح وكالة توظيف العمالة المنزلية الأكثر ثقة وتركيزا على العملاء في دولة الإمارات العربية المتحدة
                    </p>
                </div>
                
                <!-- Mission Card -->
                <div class="mission-card">
                    <div class="card-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="card-title">مهمتنا</h3>
                    <p class="card-description">
                        تمكين الأسر من خلال توفير مساعدين منزليين مؤهلين ومتعاطفين من خلال عملية خالية من المتاعب وشفافة
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
                         onerror="this.src='https://via.placeholder.com/600x500/6f42c1/ffffff?text=Training+Session'">
                </div>
                
                <!-- Right Side - Text Content -->
                <div class="training-text">
                    <span class="training-subtitle">تمكين المساعدين لخدمتكم بشكل أفضل</span>
                    <h2 class="training-title">ندعم التدريب وتطوير المهارات</h2>
                    
                    <div class="training-features">
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">الإرشاد قبل المغادرة والتوعية الثقافية</p>
                        </div>
                        
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">التدريب العملي في إدارة المنزل ورعاية الأطفال وكبار السن</p>
                        </div>
                        
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">مهارات التواصل ودروس اللغة الإنجليزية الأساسية</p>
                        </div>
                        
                        <div class="training-feature">
                            <div class="training-feature-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="training-feature-text">التدريب المستمر والدعم أثناء العمل</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('contact.index') }}" class="book-now-btn">
                        <i class="bi bi-paperclip"></i>
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>
</body>
</html>
