<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $post->title }} - Miss Helpers</title>
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
        .cta-btn{background:#ffa19c;color:#fff;border:none;border-radius:18px;padding:10px 18px;font-weight:800}
        .auth a{color:#1c1c1c;text-decoration:none;margin-inline-start:14px}
        
        .blog-header {
            background: linear-gradient(135deg, #23336b 0%, #6f42c1 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .blog-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        .blog-meta {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
        }
        
        .meta-item i {
            color: #e91e63;
        }
        
        .blog-content {
            padding: 60px 0;
        }
        
        .post-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 40px;
        }
        
        .post-image-container {
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 20px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .post-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }
        
        .post-image:hover {
            transform: scale(1.05);
        }
        
        .post-header {
            padding: 40px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .post-category {
            background: #e91e63;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .post-title {
            color: #23336b;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        .post-meta {
            display: flex;
            align-items: center;
            gap: 30px;
            color: #6c757d;
            font-size: 1rem;
        }
        
        .post-body {
            padding: 40px;
            line-height: 1.8;
            color: #495057;
            font-size: 1.1rem;
        }
        
        .post-body h2,
        .post-body h3,
        .post-body h4 {
            color: #23336b;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        .post-body p {
            margin-bottom: 20px;
        }
        
        .post-body ul,
        .post-body ol {
            margin-bottom: 20px;
            padding-right: 20px;
        }
        
        .post-body li {
            margin-bottom: 10px;
        }
        
        .post-body blockquote {
            border-right: 4px solid #23336b;
            padding-right: 20px;
            margin: 30px 0;
            font-style: italic;
            color: #6c757d;
        }
        
        .related-posts {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
        }
        
        .related-title {
            color: #23336b;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .related-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .related-card:hover {
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        
        .related-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .related-title-small {
            color: #23336b;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.4;
        }
        
        .related-excerpt {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        
        .read-more {
            color: #23336b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .read-more:hover {
            color: #e91e63;
            text-decoration: none;
        }
        
        .back-btn {
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
            margin-bottom: 30px;
        }
        
        .back-btn:hover {
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
                font-size: 1.8rem;
            }
            
            .blog-meta {
                gap: 20px;
            }
            
            .post-header,
            .post-body {
                padding: 25px;
            }
            
            .post-title {
                font-size: 1.5rem;
            }
            
            .post-meta {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .related-posts {
                padding: 25px;
            }
            
            .related-title {
                font-size: 1.5rem;
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
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">عنا</a>
                <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">الخدمات</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}">الاتصال بنا</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn">احصل على خادمة الآن</a>
                <div class="auth d-none d-md-flex">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">تسجيل الدخول</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">إنشاء حساب</a>
                </div>
            </div>
        </div>
    </header>

    <!-- رأس المقال -->
    <header class="blog-header">
        <div class="container">
            <h1 class="blog-title">{{ $post->title }}</h1>
            <div class="blog-meta">
                <div class="meta-item">
                    <i class="bi bi-person"></i>
                    <span>{{ $post->author->name ?? 'فريق Miss Helpers' }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-calendar"></i>
                    <span>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F d, Y') : 'قريباً' }}</span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-folder"></i>
                    <span>{{ $post->category->name ?? 'عام' }}</span>
                </div>
            </div>
        </div>
    </header>
    
    <!-- محتوى المقال -->
    <section class="blog-content">
        <div class="container">
            <div class="text-center">
                <a href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}" class="back-btn">
                    <i class="bi bi-arrow-right"></i>
                    العودة للمدونة
                </a>
            </div>
            
            <div class="post-container">
                <div class="post-image-container">
                    @if($post->featured_image)
                        @php 
                            if (str_starts_with($post->featured_image, 'http')) {
                                $img = $post->featured_image;
                            } else {
                                $img = asset('storage/' . $post->featured_image);
                            }
                        @endphp
                        <img src="{{ $img }}" alt="{{ $post->title }}" class="post-image" 
                             onerror="this.src='{{ asset('images/hero-bg.jpg') }}'; this.onerror=null;"
                             loading="lazy">
                    @else
                        <img src="{{ asset('images/hero-bg.jpg') }}" alt="{{ $post->title }}" class="post-image">
                    @endif
                </div>
                
                <div class="post-header">
                    <div class="post-category">{{ $post->category->name ?? 'عام' }}</div>
                    <h1 class="post-title">{{ $post->title }}</h1>
                    <div class="post-meta">
                        <span><i class="bi bi-person"></i> {{ $post->author->name ?? 'فريق Miss Helpers' }}</span>
                        <span><i class="bi bi-calendar"></i> {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('F d, Y') : 'قريباً' }}</span>
                        <span><i class="bi bi-clock"></i> {{ $post->reading_time ?? '5' }} دقائق قراءة</span>
                    </div>
                </div>
                
                <div class="post-body">
                    {!! $post->content !!}
                </div>
            </div>
            
            <!-- المقالات ذات الصلة -->
            @if($relatedPosts->count() > 0)
            <div class="related-posts">
                <h2 class="related-title">مقالات ذات صلة</h2>
                <div class="row">
                    @foreach($relatedPosts as $relatedPost)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="related-card">
                            @if($relatedPost->featured_image)
                                @php 
                                    if (str_starts_with($relatedPost->featured_image, 'http')) {
                                        $img = $relatedPost->featured_image;
                                    } else {
                                        $img = asset('storage/' . $relatedPost->featured_image);
                                    }
                                @endphp
                                <img src="{{ $img }}" alt="{{ $relatedPost->title }}" class="related-image" onerror="this.src='{{ asset('images/blog1.jpg') }}'">
                            @endif
                            <h3 class="related-title-small">{{ $relatedPost->title }}</h3>
                            <p class="related-excerpt">{{ Str::limit($relatedPost->excerpt ?? $relatedPost->content, 100) }}</p>
                            <a href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $relatedPost->slug]) }}" class="read-more">
                                اقرأ المزيد
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
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
