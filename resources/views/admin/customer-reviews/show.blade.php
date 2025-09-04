@extends('admin.layout')

@section('title', 'عرض رأي العميل')
@section('page-title', 'عرض رأي العميل')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-eye"></i>
                عرض رأي العميل: {{ $review->customer_name }}
            </h2>
            <div>
                <a href="{{ route('admin.customer-reviews.edit', $review->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.customer-reviews.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة لآراء العملاء
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- معلومات العميل -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person"></i>
                    معلومات العميل
                </h5>
            </div>
            <div class="card-body text-center">
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
                         class="rounded-circle mb-3" 
                         width="150" height="150" 
                         style="object-fit: cover;"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                @endif
                <div class="bg-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                     style="width: 150px; height: 150px; {{ $review->customer_photo ? 'display: none;' : '' }}">
                    <i class="bi bi-person text-white" style="font-size: 4rem;"></i>
                </div>
                
                <h4 class="mb-2">{{ $review->customer_name }}</h4>
                <p class="text-muted mb-2">{{ $review->job_title }}</p>
                
                <div class="mb-3">
                    <span class="badge bg-info fs-6">{{ $review->service_received }}</span>
                </div>
                
                <div class="mb-3">
                    <div class="fs-4 mb-2">
                        {!! $review->rating_stars !!}
                    </div>
                    <span class="badge bg-warning fs-6">{{ $review->rating }}/5</span>
                    <div class="text-muted mt-1">{{ $review->rating_text }}</div>
                </div>
                
                <div class="d-grid gap-2">
                    @if($review->is_active)
                        <span class="badge bg-success fs-6">نشط</span>
                    @else
                        <span class="badge bg-secondary fs-6">غير نشط</span>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات إضافية
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <label class="form-label fw-bold">ترتيب العرض:</label>
                    <p class="mb-0">{{ $review->sort_order }}</p>
                </div>
                
                <div class="mb-2">
                    <label class="form-label fw-bold">تاريخ الإضافة:</label>
                    <p class="mb-0">{{ $review->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-2">
                    <label class="form-label fw-bold">آخر تحديث:</label>
                    <p class="mb-0">{{ $review->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- تفاصيل الرأي -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-chat-quote"></i>
                    تفاصيل الرأي
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="fw-bold">وصف الرأي:</h6>
                    <div class="content-area p-4 bg-light rounded">
                        <p class="mb-0 fs-5">{{ $review->description }}</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <i class="bi bi-star-fill text-warning" style="font-size: 2rem;"></i>
                                <h5 class="mt-2">التقييم</h5>
                                <div class="fs-4 mb-2">
                                    {!! $review->rating_stars !!}
                                </div>
                                <span class="badge bg-warning fs-6">{{ $review->rating }}/5</span>
                                <div class="text-muted mt-1">{{ $review->rating_text }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <i class="bi bi-briefcase text-primary" style="font-size: 2rem;"></i>
                                <h5 class="mt-2">الخدمة</h5>
                                <span class="badge bg-info fs-6">{{ $review->service_received }}</span>
                                <div class="text-muted mt-2">
                                    <small>{{ $review->job_title }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
