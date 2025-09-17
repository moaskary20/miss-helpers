<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Miss Helpers - المدونات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }
        
        /* Header */
        .site-header{position:sticky;top:0;z-index:1000;background:#fff;border-bottom:1px solid #f1f1f1}
        .header-inner{height:64px;display:flex;align-items:center;justify-content:space-between}
        .brand{display:flex;align-items:center;gap:10px;text-decoration:none}
        .brand img{height:34px}
        .brand .title{font-weight:800;color:#1c1c1c;letter-spacing:.5px}
        .nav-links a{color:#1c1c1c;text-decoration:none;padding:10px 14px;border-radius:12px;font-weight:600}
        .nav-links a:hover{background:#f6f7fb}
        .cta-btn{background:#0d6efd;color:#fff;border:none;border-radius:18px;padding:10px 18px;font-weight:800}
        .auth a{color:#1c1c1c;text-decoration:none;margin-inline-start:14px}
        
        .blog-header {
            background: linear-gradient(135deg, #23336b 0%, #6f42c1 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .blog-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }
        
        .blog-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
        }
        
        .search-section {
            background: white;
            padding: 40px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .search-form {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 25px;
            padding: 15px 25px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: #23336b;
            box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25);
        }
        
        .search-btn {
            background: #23336b;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: #1a2533;
            transform: translateY(-2px);
        }
        
        .categories-section {
            background: white;
            padding: 40px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .category-btn {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            color: #495057;
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .category-btn:hover,
        .category-btn.active {
            background: #23336b;
            border-color: #23336b;
            color: white;
            text-decoration: none;
        }
        
        .blog-content {
            padding: 60px 0;
        }
        
        .blog-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f0f0f0;
            margin-bottom: 30px;
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
        
        .blog-content-inner {
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
        
        .read-more {
            color: #23336b;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }
        
        .read-more:hover {
            color: #e91e63;
            text-decoration: none;
        }
        
        .read-more i {
            transition: transform 0.3s ease;
        }
        
        .read-more:hover i {
            transform: translateX(-5px);
        }
        
        .pagination {
            justify-content: center;
            margin-top: 50px;
        }
        
        .page-link {
            color: #23336b;
            border: 1px solid #dee2e6;
            margin: 0 5px;
            border-radius: 10px;
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
        
        .no-posts {
            text-align: center;
            padding: 80px 20px;
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
        
        .back-home {
            background: #23336b;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .back-home:hover {
            background: #1a2533;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }
        
        @media (max-width: 767.98px) {
            .blog-header {
                padding: 60px 0;
            }
            
            .blog-title {
                font-size: 2rem;
            }
            
            .blog-subtitle {
                font-size: 1.1rem;
            }
            
            .search-section {
                padding: 30px 0;
            }
            
            .categories-section {
                padding: 30px 0;
            }
            
            .blog-content {
                padding: 40px 0;
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
            </a>
            <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="{{ url('/') }}">الرئيسية</a>
                <a href="{{ route('about.index') }}">عنا</a>
                <a href="{{ route('service.index') }}">الخدمات</a>
                <a href="{{ route('contact.index') }}">الاتصال بنا</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contact.index') }}" class="cta-btn">احصل على خادمة الآن</a>
                <div class="auth d-none d-md-flex">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">تسجيل الدخول</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">إنشاء حساب</a>
                </div>
            </div>
        </div>
    </header>

    <!-- رأس المدونة -->
    <header class="blog-header">
        <div class="container">
            <h1 class="blog-title">Miss Helpers</h1>
            <p class="blog-subtitle">المدونات</p>
        </div>
    </header>
    
    <!-- قسم البحث -->
    <section class="search-section">
        <div class="container">
            <form class="search-form" method="GET" action="{{ route('blog.index') }}">
                <div class="row g-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control search-input" 
                               placeholder="ابحث في المدونة..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn search-btn w-100">
                            <i class="bi bi-search"></i>
                            بحث
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
    <!-- قسم الفئات -->
    <section class="categories-section">
        <div class="container">
            <div class="text-center">
                <a href="{{ route('blog.index') }}" 
                   class="category-btn {{ !request('category') ? 'active' : '' }}">
                    جميع المقالات
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" 
                   class="category-btn {{ request('category') == $cat->slug ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- محتوى المدونة -->
    <section class="blog-content">
        <div class="container">
            @if(isset($category))
            <div class="text-center mb-5">
                <h2>مقالات في فئة: {{ $category->name }}</h2>
            </div>
            @endif
            
            @if($posts->count() > 0)
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
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
                            <img src="{{ $img }}" 
                                 alt="{{ $post->title }}" 
                                 class="img-fluid"
                                 onerror="this.src='{{ asset('images/blog1.jpg') }}'">
                            <div class="blog-category">{{ $post->category->name ?? 'عام' }}</div>
                            <div class="blog-date">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F d, Y') : 'قريباً' }}
                            </div>
                        </div>
                        <div class="blog-content-inner">
                            <h3 class="blog-title">{{ $post->title }}</h3>
                            <p class="blog-excerpt">{{ Str::limit($post->excerpt ?? $post->content, 120) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="read-more">
                                اقرأ المزيد
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- الترقيم -->
            <div class="d-flex justify-content-center">
                {{ $posts->appends(request()->query())->links() }}
            </div>
            @else
            <div class="no-posts">
                <i class="bi bi-journal-text"></i>
                <h3>لا توجد مقالات</h3>
                <p>
                    @if(request('search'))
                        لا توجد نتائج للبحث: "{{ request('search') }}"
                    @elseif(isset($category))
                        لا توجد مقالات في هذه الفئة حالياً
                    @else
                        لا توجد مقالات حالياً
                    @endif
                </p>
                <a href="/{{ app()->getLocale() }}" class="back-home">
                    <i class="bi bi-house"></i>
                    العودة للرئيسية
                </a>
            </div>
            @endif
        </div>
    </section>
    
    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>
</body>
</html>
