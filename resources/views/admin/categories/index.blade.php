@extends('admin.layout')

@section('title', 'إدارة الأقسام')
@section('page-title', 'إدارة الأقسام')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-tags"></i>
                إدارة الأقسام
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة قسم جديد
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الوصف</th>
                                    <th>عدد المواضيع</th>
                                    <th>اللون</th>
                                    <th>الحالة</th>
                                    <th>ترتيب</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="color-indicator me-2" 
                                                     style="background-color: {{ $category->color }}; width: 20px; height: 20px; border-radius: 50%;"></div>
                                                <strong>{{ $category->name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            @if($category->description)
                                                {{ Str::limit($category->description, 50) }}
                                            @else
                                                <span class="text-muted">لا يوجد وصف</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $category->posts_count }}</span>
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $category->color }}; color: white;">
                                                {{ $category->color }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($category->is_active)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-secondary">غير نشط</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->sort_order }}</td>
                                        <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.categories.show', $category->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟')">
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
                        {{ $categories->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-tags text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد أقسام مسجلة بعد</p>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول قسم
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
