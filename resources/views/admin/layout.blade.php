<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'لوحة الإدارة') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link i {
            margin-left: 10px;
            width: 20px;
        }
        
        /* Unread messages badge */
        .sidebar .nav-link .badge {
            font-size: 0.7rem;
            padding: 4px 6px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            font-weight: 600;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .stats-card .stats-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .badge {
            border-radius: 20px;
            padding: 8px 12px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar">
                    <div class="p-3">
                        <h4 class="text-white text-center mb-4">
                            <i class="bi bi-shield-check"></i>
                            لوحة الإدارة
                        </h4>
                    </div>
                    
                    <nav class="nav flex-column">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            الرئيسية
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.maids.*') ? 'active' : '' }}" href="{{ route('admin.maids.index') }}">
                            <i class="bi bi-people"></i>
                            إدارة الخادمات
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}" href="{{ route('admin.blog.index') }}">
                            <i class="bi bi-file-text"></i>
                            إدارة المواضيع
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-tags"></i>
                            إدارة الأقسام
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.customer-reviews.*') ? 'active' : '' }}" href="{{ route('admin.customer-reviews.index') }}">
                            <i class="bi bi-star"></i>
                            آراء العملاء
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.service-requests.*') ? 'active' : '' }}" href="{{ route('admin.service-requests.index') }}">
                            <i class="bi bi-clipboard-list"></i>
                            إدارة الطلبات
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.chat.*') ? 'active' : '' }}" href="{{ route('admin.chat.index') }}">
                            <i class="bi bi-chat-dots"></i>
                            إدارة الشات
                            @php
                                $unreadChatMessages = \App\Models\ChatMessage::where('sender_type', 'visitor')
                                    ->where('is_read', false)
                                    ->count();
                            @endphp
                            @if($unreadChatMessages > 0)
                                <span class="badge bg-danger ms-2">{{ $unreadChatMessages }}</span>
                            @endif
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="bi bi-person-gear"></i>
                            إدارة المستخدمين
                        </a>
                        
                        <a class="nav-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}" href="{{ route('admin.seo.index') }}">
                            <i class="bi bi-search"></i>
                            إدارة SEO
                        </a>
                        

                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Top Navigation -->
                    <nav class="navbar navbar-expand-lg navbar-admin">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-outline-secondary d-md-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                                    <i class="bi bi-list"></i>
                                </button>
                                <h5 class="mb-0">@yield('page-title', 'لوحة الإدارة')</h5>
                            </div>
                            
                            <div class="navbar-nav ms-auto">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-person-circle"></i>
                                        المدير
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> الملف الشخصي</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> الإعدادات</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> تسجيل الخروج</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                    
                    <!-- Page Content -->
                    <div class="container-fluid p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Confirm delete actions
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-delete') || e.target.closest('.btn-delete')) {
                if (!confirm('هل أنت متأكد من الحذف؟ لا يمكن التراجع عن هذا الإجراء.')) {
                    e.preventDefault();
                }
            }
        });
        
        // تحديث عداد الرسائل غير المقروءة كل 30 ثانية
        function updateUnreadMessagesCount() {
            fetch('/admin/chat/unread-count', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const badge = document.querySelector('.nav-link[href*="chat"] .badge');
                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                        } else {
                            // إنشاء العداد إذا لم يكن موجوداً
                            const chatLink = document.querySelector('.nav-link[href*="chat"]');
                            if (chatLink) {
                                const newBadge = document.createElement('span');
                                newBadge.className = 'badge bg-danger ms-2';
                                newBadge.textContent = data.count;
                                chatLink.appendChild(newBadge);
                            }
                        }
                    } else {
                        // إزالة العداد إذا لم توجد رسائل غير مقروءة
                        if (badge) {
                            badge.remove();
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error updating unread count:', error);
            });
        }

        // تحديث العداد عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            updateUnreadMessagesCount();
            
            // تحديث العداد كل 30 ثانية
            setInterval(updateUnreadMessagesCount, 30000);
        });
    </script>
    
    @yield('scripts')
</body>
</html>
