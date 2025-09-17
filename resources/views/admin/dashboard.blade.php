@extends('admin.layout')

@section('title', 'لوحة الإدارة الرئيسية')
@section('page-title', 'لوحة الإدارة الرئيسية')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">
            <i class="bi bi-speedometer2"></i>
            لوحة الإدارة الرئيسية
        </h2>
    </div>
</div>

<!-- إحصائيات سريعة -->
<div class="row mb-4">
    <div class="col-md-2">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $maidsCount }}</h3>
                    <p class="mb-0">إجمالي الخادمات</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $postsCount }}</h3>
                    <p class="mb-0">إجمالي المواضيع</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-file-text"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $publishedPostsCount }}</h3>
                    <p class="mb-0">المواضيع المنشورة</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $categoriesCount }}</h3>
                    <p class="mb-0">إجمالي الأقسام</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stats-card" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $reviewsCount }}</h3>
                    <p class="mb-0">إجمالي الآراء</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-star"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
        <div class="stats-card" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ number_format($averageRating, 1) }}</h3>
                    <p class="mb-0">متوسط التقييم</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-star-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- إحصائيات الطلبات -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card" style="background: #ffa19c;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $requestsCount }}</h3>
                    <p class="mb-0">إجمالي الطلبات</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-clipboard-list"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $pendingRequestsCount }}</h3>
                    <p class="mb-0">طلبات تحت المراجعة</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-clock"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $completedRequestsCount }}</h3>
                    <p class="mb-0">طلبات مكتملة</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $requestsCount > 0 ? round(($completedRequestsCount / $requestsCount) * 100, 1) : 0 }}%</h3>
                    <p class="mb-0">نسبة الإنجاز</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-percent"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- إحصائيات الشات -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $chatRoomsCount }}</h3>
                    <p class="mb-0">إجمالي غرف الشات</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-chat-dots"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #26de81 0%, #20bf6b 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $activeChatRoomsCount }}</h3>
                    <p class="mb-0">غرف نشطة</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-circle-fill"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $unreadMessagesCount }}</h3>
                    <p class="mb-0">رسائل غير مقروءة</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card" style="background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-1">{{ $chatRoomsCount > 0 ? round(($activeChatRoomsCount / $chatRoomsCount) * 100, 1) : 0 }}%</h3>
                    <p class="mb-0">نسبة النشاط</p>
                </div>
                <div class="stats-icon">
                    <i class="bi bi-activity"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- إجراءات سريعة -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning"></i>
                    إجراءات سريعة
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.maids.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus"></i>
                            إضافة خادمة
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i>
                            إضافة موضوع
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-info w-100">
                            <i class="bi bi-tags"></i>
                            إضافة قسم
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.customer-reviews.create') }}" class="btn btn-warning w-100">
                            <i class="bi bi-star"></i>
                            إضافة رأي
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.service-requests.create') }}" class="btn btn-danger w-100">
                            <i class="bi bi-clipboard-plus"></i>
                            إضافة طلب
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.maids.index') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-list"></i>
                            الخادمات
                        </a>
                    </div>
                    <div class="col-md-2 mb-3">
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-success w-100">
                            <i class="bi bi-file-text"></i>
                            المواضيع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- الخادمات والمواضيع والآراء والطلبات والشات الحديثة -->
<div class="row">
    <!-- الخادمات الحديثة -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i>
                    الخادمات المضافة حديثاً
                </h5>
                <a href="{{ route('admin.maids.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>
            </div>
            <div class="card-body">
                @if($recentMaids->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>العمر</th>
                                    <th>الديانة</th>
                                    <th>نوع الباقة</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentMaids as $maid)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($maid->image_path)
                                                    <img src="{{ url('/storage/' . $maid->image_path) }}" 
                                                         alt="{{ $maid->name }}" 
                                                         class="rounded-circle me-2" 
                                                         width="40" height="40" 
                                                         style="object-fit: cover;">
                                                @else
                                                    <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="bi bi-person text-white"></i>
                                                    </div>
                                                @endif
                                                <span>{{ $maid->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $maid->age }} سنة</td>
                                        <td>{{ $maid->religion }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $maid->package_type }}</span>
                                        </td>
                                        <td>{{ $maid->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.maids.show', $maid->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.maids.edit', $maid->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد خادمات مسجلة بعد</p>
                        <a href="{{ route('admin.maids.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i>
                            إضافة أول خادمة
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- المواضيع الحديثة -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i>
                    المواضيع المضافة حديثاً
                </h5>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>
            </div>
            <div class="card-body">
                @if($recentPosts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>العنوان</th>
                                    <th>القسم</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPosts as $post)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ Str::limit($post->title, 30) }}</strong>
                                                @if($post->excerpt)
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($post->excerpt, 40) }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($post->category)
                                                <span class="badge" style="background-color: {{ $post->category->color }}; color: white;">
                                                    {{ $post->category->name }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">بدون قسم</span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch($post->status)
                                                @case('published')
                                                    <span class="badge bg-success">منشور</span>
                                                    @break
                                                @case('draft')
                                                    <span class="badge bg-warning">مسودة</span>
                                                    @break
                                                @case('archived')
                                                    <span class="badge bg-secondary">مؤرشف</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ $post->status }}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.blog.show', $post->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.blog.edit', $post->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-file-text text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد مواضيع مسجلة بعد</p>
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول موضوع
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- آراء العملاء الحديثة -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i>
                    آراء العملاء الحديثة
                </h5>
                <a href="{{ route('admin.customer-reviews.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>
            </div>
            <div class="card-body">
                @if($recentReviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>اسم العميل</th>
                                    <th>التقييم</th>
                                    <th>الخدمة</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReviews as $review)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($review->customer_photo)
                                                    @php
                                                        if (str_starts_with($review->customer_photo, 'http')) {
                                                            $img = $review->customer_photo;
                                                        } else {
                                                            $img = url('/storage/' . $review->customer_photo);
                                                        }
                                                    @endphp
                                                    <img src="{{ $img }}" 
                                                         alt="{{ $review->customer_name }}" 
                                                         class="rounded-circle me-2" 
                                                         width="30" height="30" 
                                                         style="object-fit: cover;"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                @endif
                                                <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 30px; height: 30px; {{ $review->customer_photo ? 'display: none;' : '' }}">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                                <span>{{ Str::limit($review->customer_name, 20) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-1">
                                                    {!! $review->rating_stars !!}
                                                </div>
                                                <span class="badge bg-warning">{{ $review->rating }}/5</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ Str::limit($review->service_received, 15) }}</span>
                                        </td>
                                        <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.customer-reviews.show', $review->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.customer-reviews.edit', $review->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-star text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد آراء مسجلة بعد</p>
                        <a href="{{ route('admin.customer-reviews.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول رأي
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- الطلبات الحديثة -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i>
                    الطلبات الحديثة
                </h5>
                <a href="{{ route('admin.service-requests.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>
            </div>
            <div class="card-body">
                @if($recentRequests->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>اسم العميل</th>
                                    <th>نوع الخدمة</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRequests as $request)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 30px; height: 30px;">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                                <span>{{ Str::limit($request->name, 20) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @switch($request->service_type)
                                                @case('خادمه منزليه')
                                                    <span class="badge bg-primary">خادمه</span>
                                                    @break
                                                @case('جليسه اطفال')
                                                    <span class="badge bg-success">جليسه</span>
                                                    @break
                                                @case('طباخه')
                                                    <span class="badge bg-warning">طباخه</span>
                                                    @break
                                                @case('مقدمه رعاية')
                                                    <span class="badge bg-info">رعاية</span>
                                                    @break
                                                @case('سائق')
                                                    <span class="badge bg-secondary">سائق</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary">{{ Str::limit($request->service_type, 10) }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($request->status === 'تم التنفيذ')
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i>
                                                    مكتمل
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-clock"></i>
                                                    مراجعة
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.service-requests.show', $request->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.service-requests.edit', $request->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-clipboard-list text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد طلبات مسجلة بعد</p>
                        <a href="{{ route('admin.service-requests.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول طلب
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- الشات الحديثة -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i>
                    الشات الحديثة
                </h5>
                <a href="{{ route('admin.chat.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل
                </a>
            </div>
            <div class="card-body">
                @if($recentChatRooms->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الزائر</th>
                                    <th>النوع</th>
                                    <th>آخر رسالة</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentChatRooms as $chatRoom)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 25px; height: 25px;">
                                                    <i class="bi bi-person text-white" style="font-size: 0.8rem;"></i>
                                                </div>
                                                <span>{{ Str::limit($chatRoom->visitor_name, 15) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $chatRoom->type_color }}">
                                                {{ Str::limit($chatRoom->type_text, 8) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($chatRoom->messages->count() > 0)
                                                <small class="text-muted">{{ Str::limit($chatRoom->messages->first()->message, 20) }}</small>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $chatRoom->status_color }}">
                                                {{ Str::limit($chatRoom->status_text, 8) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.chat.show', $chatRoom->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-chat-dots text-muted" style="font-size: 2rem;"></i>
                        <p class="text-muted mt-3">لا توجد غرف شات</p>
                        <small class="text-muted">سيتم إنشاؤها تلقائياً</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
