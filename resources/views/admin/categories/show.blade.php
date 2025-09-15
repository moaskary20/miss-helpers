@extends('admin.layout')

@section('title', 'عرض القسم')
@section('page-title', 'عرض القسم')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-eye"></i>
                عرض القسم: {{ $category->name }}
            </h2>
            <div>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للأقسام
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- معلومات القسم -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات القسم
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">اسم القسم:</label>
                    <p class="mb-0">{{ $category->name }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الرابط:</label>
                    <p class="mb-0">
                        <code>{{ $category->slug }}</code>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">اللون:</label>
                    <div class="d-flex align-items-center">
                        <div class="color-indicator me-2" 
                             style="background-color: {{ $category->color }}; width: 30px; height: 30px; border-radius: 50%; border: 2px solid #ddd;"></div>
                        <span>{{ $category->color }}</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الوصف:</label>
                    <p class="mb-0">
                        @if($category->description)
                            {{ $category->description }}
                        @else
                            <span class="text-muted">لا يوجد وصف</span>
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الحالة:</label>
                    <p class="mb-0">
                        @if($category->is_active)
                            <span class="badge bg-success">نشط</span>
                        @else
                            <span class="badge bg-secondary">غير نشط</span>
                        @endif
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">ترتيب العرض:</label>
                    <p class="mb-0">{{ $category->sort_order }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">تاريخ الإنشاء:</label>
                    <p class="mb-0">{{ $category->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">آخر تحديث:</label>
                    <p class="mb-0">{{ $category->updated_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- المواضيع في القسم -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-file-text"></i>
                    المواضيع في هذا القسم ({{ $category->posts->count() }})
                </h5>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i>
                    إضافة موضوع جديد
                </a>
            </div>
            <div class="card-body">
                @if($category->posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>العنوان</th>
                                    <th>الحالة</th>
                                    <th>مميز</th>
                                    <th>المشاهدات</th>
                                    <th>تاريخ النشر</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->posts as $post)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ Str::limit($post->title, 50) }}</strong>
                                                @if($post->excerpt)
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($post->excerpt, 80) }}</small>
                                                @endif
                                            </div>
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
                                        <td>
                                            @if($post->is_featured)
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-star-fill"></i>
                                                    مميز
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $post->views_count }}</span>
                                        </td>
                                        <td>
                                            @if($post->published_at)
                                                {{ $post->published_at->format('Y-m-d') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
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
                        <p class="text-muted mt-3">لا توجد مواضيع في هذا القسم</p>
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول موضوع
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
