@extends('admin.layout')

@section('title', 'تعديل الموضوع')
@section('page-title', 'تعديل الموضوع')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-pencil"></i>
                تعديل الموضوع: {{ $post->title }}
            </h2>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة للمواضيع
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
                    معلومات الموضوع
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان الموضوع <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $post->title) }}" 
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">القسم <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" 
                                        name="category_id" 
                                        required>
                                    <option value="">اختر القسم</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="excerpt" class="form-label">ملخص الموضوع</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" 
                                  name="excerpt" 
                                  rows="3" 
                                  placeholder="ملخص مختصر للموضوع...">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">محتوى الموضوع <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" 
                                  name="content" 
                                  rows="10" 
                                  required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="featured_image" class="form-label">الصورة المميزة</label>
                                @if($post->featured_image)
                                    <div class="mb-2">
                                        @php
                                            if (str_starts_with($post->featured_image, 'http')) {
                                                $currentImg = $post->featured_image;
                                            } else {
                                                $currentImg = url('/storage/' . $post->featured_image);
                                            }
                                        @endphp
                                        <img src="{{ $currentImg }}" 
                                             alt="الصورة الحالية" 
                                             class="img-thumbnail" 
                                             style="max-height: 100px;"
                                             onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                                        <small class="d-block text-muted">الصورة الحالية</small>
                                    </div>
                                @endif
                                <input type="file" 
                                       class="form-control @error('featured_image') is-invalid @enderror" 
                                       id="featured_image" 
                                       name="featured_image" 
                                       accept="image/*">
                                @error('featured_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">الأبعاد المفضلة: 1200×630 بكسل</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">حالة الموضوع <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>منشور</option>
                                    <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>مؤرشف</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_featured" 
                                           name="is_featured" 
                                           value="1"
                                           {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        موضوع مميز
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">عنوان Meta</label>
                                <input type="text" 
                                       class="form-control @error('meta_title') is-invalid @enderror" 
                                       id="meta_title" 
                                       name="meta_title" 
                                       value="{{ old('meta_title', $post->meta_title) }}" 
                                       placeholder="عنوان للـ SEO">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">وصف Meta</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" 
                                  name="meta_description" 
                                  rows="3" 
                                  placeholder="وصف مختصر للـ SEO">{{ old('meta_description', $post->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            تحديث الموضوع
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
    const titleInput = document.getElementById('title');
    const metaTitleInput = document.getElementById('meta_title');
    
    // تعبئة عنوان Meta تلقائياً إذا كان فارغاً
    titleInput.addEventListener('input', function() {
        if (!metaTitleInput.value) {
            metaTitleInput.value = this.value;
        }
    });
    
    // تعبئة ملخص الموضوع تلقائياً إذا كان فارغاً
    const contentTextarea = document.getElementById('content');
    const excerptTextarea = document.getElementById('excerpt');
    
    contentTextarea.addEventListener('input', function() {
        if (!excerptTextarea.value && this.value.length > 100) {
            excerptTextarea.value = this.value.substring(0, 100) + '...';
        }
    });
});
</script>
@endpush
@endsection
