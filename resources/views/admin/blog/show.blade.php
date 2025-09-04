@extends('admin.layout')

@section('title', 'عرض الموضوع')
@section('page-title', 'عرض الموضوع')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-eye"></i>
                عرض الموضوع: {{ $post->title }}
            </h2>
            <div>
                <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للمواضيع
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- معلومات الموضوع -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات الموضوع
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">العنوان:</label>
                    <p class="mb-0">{{ $post->title }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الرابط:</label>
                    <p class="mb-0">
                        <code>{{ $post->slug }}</code>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">القسم:</label>
                    <p class="mb-0">
                        @if($post->category)
                            <span class="badge" style="background-color: {{ $post->category->color }}; color: white;">
                                {{ $post->category->name }}
                            </span>
                        @else
                            <span class="badge bg-secondary">بدون قسم</span>
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الحالة:</label>
                    <p class="mb-0">
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
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">مميز:</label>
                    <p class="mb-0">
                        @if($post->is_featured)
                            <span class="badge bg-warning">
                                <i class="bi bi-star-fill"></i>
                                نعم
                            </span>
                        @else
                            <span class="badge bg-secondary">لا</span>
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">المشاهدات:</label>
                    <p class="mb-0">
                        <span class="badge bg-info">{{ $post->views_count }}</span>
                    </p>
                </div>
                
                @if($post->published_at)
                    <div class="mb-3">
                        <label class="form-label fw-bold">تاريخ النشر:</label>
                        <p class="mb-0">{{ $post->published_at->format('Y-m-d H:i') }}</p>
                    </div>
                @endif
                
                <div class="mb-3">
                    <label class="form-label fw-bold">تاريخ الإنشاء:</label>
                    <p class="mb-0">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">آخر تحديث:</label>
                    <p class="mb-0">{{ $post->updated_at->format('Y-m-d H:i') }}</p>
                </div>
                
                @if($post->meta_title)
                    <div class="mb-3">
                        <label class="form-label fw-bold">عنوان Meta:</label>
                        <p class="mb-0">{{ $post->meta_title }}</p>
                    </div>
                @endif
                
                @if($post->meta_description)
                    <div class="mb-3">
                        <label class="form-label fw-bold">وصف Meta:</label>
                        <p class="mb-0">{{ $post->meta_description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- محتوى الموضوع -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-file-text"></i>
                    محتوى الموضوع
                </h5>
            </div>
            <div class="card-body">
                @if($post->featured_image)
                    <div class="text-center mb-4">
                        @php
                            if (str_starts_with($post->featured_image, 'http')) {
                                $img = $post->featured_image;
                            } else {
                                $img = url('/storage/' . $post->featured_image);
                            }
                        @endphp
                        <img src="{{ $img }}" 
                             alt="{{ $post->title }}" 
                             class="img-fluid rounded" 
                             style="max-height: 300px;"
                             onerror="this.src='{{ asset('images/hero-bg.jpg') }}'">
                    </div>
                @endif
                
                @if($post->excerpt)
                    <div class="mb-4">
                        <h6 class="fw-bold">ملخص الموضوع:</h6>
                        <p class="text-muted">{{ $post->excerpt }}</p>
                    </div>
                @endif
                
                <div class="mb-4">
                    <h6 class="fw-bold">المحتوى:</h6>
                    <div class="content-area p-3 bg-light rounded">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
