@extends('admin.layout')

@section('title', 'تعديل رأي العميل')
@section('page-title', 'تعديل رأي العميل')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-pencil"></i>
                تعديل رأي العميل: {{ $review->customer_name }}
            </h2>
            <a href="{{ route('admin.customer-reviews.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة لآراء العملاء
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات العميل والرأي
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.customer-reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">اسم العميل <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('customer_name') is-invalid @enderror" 
                                       id="customer_name" 
                                       name="customer_name" 
                                       value="{{ old('customer_name', $review->customer_name) }}" 
                                       required>
                                @error('customer_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_photo" class="form-label">صورة العميل</label>
                                @if($review->customer_photo)
                                    <div class="mb-2">
                                        @php
                                            if (str_starts_with($review->customer_photo, 'http')) {
                                                $currentImg = $review->customer_photo;
                                            } else {
                                                $currentImg = url('/storage/' . $review->customer_photo);
                                            }
                                        @endphp
                                        <img src="{{ $currentImg }}" 
                                             alt="الصورة الحالية" 
                                             class="img-thumbnail" 
                                             style="max-width: 100px;"
                                             onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                                        <small class="d-block text-muted">الصورة الحالية</small>
                                    </div>
                                @endif
                                <input type="file" 
                                       class="form-control @error('customer_photo') is-invalid @enderror" 
                                       id="customer_photo" 
                                       name="customer_photo" 
                                       accept="image/*">
                                @error('customer_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">الأبعاد المفضلة: 200×200 بكسل</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_location" class="form-label">موقع العميل</label>
                                <input type="text" 
                                       class="form-control @error('customer_location') is-invalid @enderror" 
                                       id="customer_location" 
                                       name="customer_location" 
                                       value="{{ old('customer_location', $review->customer_location) }}" 
                                       placeholder="مثال: الرياض، جدة">
                                @error('customer_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rating" class="form-label">التقييم <span class="text-danger">*</span></label>
                                <select class="form-select @error('rating') is-invalid @enderror" 
                                        id="rating" 
                                        name="rating" 
                                        required>
                                    <option value="">اختر التقييم</option>
                                    <option value="1" {{ old('rating', $review->rating) == '1' ? 'selected' : '' }}>⭐ (1) - ضعيف جداً</option>
                                    <option value="2" {{ old('rating', $review->rating) == '2' ? 'selected' : '' }}>⭐⭐ (2) - ضعيف</option>
                                    <option value="3" {{ old('rating', $review->rating) == '3' ? 'selected' : '' }}>⭐⭐⭐ (3) - مقبول</option>
                                    <option value="4" {{ old('rating', $review->rating) == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4) - جيد</option>
                                    <option value="5" {{ old('rating', $review->rating) == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5) - ممتاز</option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">ترتيب العرض</label>
                                <input type="number" 
                                       class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" 
                                       name="sort_order" 
                                       value="{{ old('sort_order', $review->sort_order) }}" 
                                       min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="job_title" class="form-label">المسمى الوظيفي <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('job_title') is-invalid @enderror" 
                                       id="job_title" 
                                       name="job_title" 
                                       value="{{ old('job_title', $review->job_title) }}" 
                                       placeholder="مثال: مدير شركة، رجل أعمال، إلخ"
                                       required>
                                @error('job_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="service_received" class="form-label">الخدمة المقدمة <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('service_received') is-invalid @enderror" 
                                       id="service_received" 
                                       name="service_received" 
                                       value="{{ old('service_received', $review->service_received) }}" 
                                       placeholder="مثال: تنظيف منزل، طبخ، رعاية أطفال"
                                       required>
                                @error('service_received')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">وصف الرأي <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="5" 
                                  placeholder="اكتب رأي العميل في الخدمة المقدمة..."
                                  required>{{ old('description', $review->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   {{ old('is_active', $review->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                الرأي نشط
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.customer-reviews.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            تحديث الرأي
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // معاينة الصورة
    const imageInput = document.getElementById('customer_image');
    const previewContainer = document.createElement('div');
    previewContainer.className = 'mt-2';
    previewContainer.innerHTML = '<img id="image-preview" class="img-thumbnail" style="max-width: 200px; display: none;">';
    
    imageInput.parentNode.appendChild(previewContainer);
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush
@endsection
