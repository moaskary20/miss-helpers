@extends('admin.layout')

@section('title', 'إدارة المواضيع')
@section('page-title', 'إدارة المواضيع')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-file-text"></i>
                إدارة المواضيع
            </h2>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة موضوع جديد
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
                @if($posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الصورة</th>
                                    <th>العنوان</th>
                                    <th>القسم</th>
                                    <th>الحالة</th>
                                    <th>مميز</th>
                                    <th>المشاهدات</th>
                                    <th>تاريخ النشر</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            @if($post->featured_image)
                                                @php
                                                    if (str_starts_with($post->featured_image, 'http')) {
                                                        $img = $post->featured_image;
                                                    } else {
                                                        $img = url('/storage/' . $post->featured_image);
                                                    }
                                                @endphp
                                                <img src="{{ $img }}" 
                                                     alt="{{ $post->title }}" 
                                                     class="rounded" 
                                                     width="60" height="40" 
                                                     style="object-fit: cover;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            @endif
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 40px; {{ $post->featured_image ? 'display: none;' : '' }}">
                                                <i class="bi bi-image text-white"></i>
                                            </div>
                                        </td>
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
                                                <form action="{{ route('admin.blog.destroy', $post->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الموضوع؟')">
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
                        {{ $posts->links() }}
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
</div>
@endsection
