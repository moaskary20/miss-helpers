@extends('admin.layout')

@section('title', 'عرض الطلب')
@section('page-title', 'عرض الطلب')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-eye"></i>
                عرض الطلب: {{ $serviceRequest->name }}
            </h2>
            <div>
                <a href="{{ route('admin.service-requests.edit', $serviceRequest->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.service-requests.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للطلبات
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- معلومات الطلب الأساسية -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات الطلب الأساسية
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">الاسم:</label>
                    <p class="mb-0">{{ $serviceRequest->name }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">التليفون:</label>
                    <p class="mb-0">
                        <a href="tel:{{ $serviceRequest->phone }}" class="text-decoration-none">
                            <i class="bi bi-telephone"></i>
                            {{ $serviceRequest->phone }}
                        </a>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">نوع الخدمة:</label>
                    <p class="mb-0">
                        @switch($serviceRequest->service_type)
                            @case('خادمه منزليه')
                                <span class="badge bg-primary">خادمه منزليه</span>
                                @break
                            @case('جليسه اطفال')
                                <span class="badge bg-success">جليسه اطفال</span>
                                @break
                            @case('طباخه')
                                <span class="badge bg-warning">طباخه</span>
                                @break
                            @case('مقدمه رعاية')
                                <span class="badge bg-info">مقدمه رعاية</span>
                                @break
                            @case('سائق')
                                <span class="badge bg-secondary">سائق</span>
                                @break
                            @default
                                <span class="badge bg-secondary">{{ $serviceRequest->service_type }}</span>
                        @endswitch
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الجنسية:</label>
                    <p class="mb-0">
                        <span class="badge bg-dark">{{ $serviceRequest->nationality }}</span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الإمارة:</label>
                    <p class="mb-0">
                        <span class="badge bg-light text-dark">{{ $serviceRequest->emirate }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- حالة الطلب والمعلومات الإضافية -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clipboard-check"></i>
                    حالة الطلب والمعلومات
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">حالة الطلب:</label>
                    <p class="mb-0">
                        @if($serviceRequest->status === 'تم التنفيذ')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i>
                                تم التنفيذ
                            </span>
                        @else
                            <span class="badge bg-warning">
                                <i class="bi bi-clock"></i>
                                تحت المراجعه
                            </span>
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">حالة النشاط:</label>
                    <p class="mb-0">
                        @if($serviceRequest->is_active)
                            <span class="badge bg-success">نشط</span>
                        @else
                            <span class="badge bg-secondary">غير نشط</span>
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">تاريخ إنشاء الطلب:</label>
                    <p class="mb-0">{{ $serviceRequest->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">آخر تحديث:</label>
                    <p class="mb-0">{{ $serviceRequest->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- الملاحظات -->
@if($serviceRequest->notes)
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-chat-text"></i>
                        ملاحظات الطلب
                    </h5>
                </div>
                <div class="card-body">
                    <div class="content-area p-3 bg-light rounded">
                        <p class="mb-0">{{ $serviceRequest->notes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- ملخص سريع -->
<div class="row mt-3">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-person" style="font-size: 2rem;"></i>
                <h6 class="mt-2">معلومات العميل</h6>
                <p class="mb-0">{{ $serviceRequest->name }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-telephone" style="font-size: 2rem;"></i>
                <h6 class="mt-2">التواصل</h6>
                <p class="mb-0">{{ $serviceRequest->phone }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="bi bi-geo-alt" style="font-size: 2rem;"></i>
                <h6 class="mt-2">الموقع</h6>
                <p class="mb-0">{{ $serviceRequest->emirate }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <i class="bi bi-briefcase" style="font-size: 2rem;"></i>
                <h6 class="mt-2">الخدمة</h6>
                <p class="mb-0">{{ $serviceRequest->service_type }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
