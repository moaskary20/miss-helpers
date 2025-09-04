@extends('admin.layout')

@section('title', 'إدارة آراء العملاء')
@section('page-title', 'إدارة آراء العملاء')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-star"></i>
                إدارة آراء العملاء
            </h2>
            <a href="{{ route('admin.customer-reviews.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة رأي جديد
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($reviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>صورة العميل</th>
                                    <th>اسم العميل</th>
                                    <th>التقييم</th>
                                    <th>المسمى الوظيفي</th>
                                    <th>الخدمة المقدمة</th>
                                    <th>الحالة</th>
                                    <th>الترتيب</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>
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
                                                     class="rounded-circle" 
                                                     width="50" height="50" 
                                                     style="object-fit: cover;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            @endif
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; {{ $review->customer_photo ? 'display: none;' : '' }}">
                                                <i class="bi bi-person text-white"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $review->customer_name }}</strong>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    {!! $review->rating_stars !!}
                                                </div>
                                                <span class="badge bg-warning">{{ $review->rating }}/5</span>
                                            </div>
                                            <small class="text-muted d-block">{{ $review->rating_text }}</small>
                                        </td>
                                        <td>{{ $review->job_title }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $review->service_received }}</span>
                                        </td>
                                        <td>
                                            @if($review->is_active)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-secondary">غير نشط</span>
                                            @endif
                                        </td>
                                        <td>{{ $review->sort_order }}</td>
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
                                                <form action="{{ route('admin.customer-reviews.destroy', $review->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الرأي؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="حذف">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-3">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-star text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد آراء عملاء مسجلة بعد</p>
                        <a href="{{ route('admin.customer-reviews.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول رأي
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
