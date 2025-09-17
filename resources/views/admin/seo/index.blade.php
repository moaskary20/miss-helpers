@extends('admin.layout')

@section('title', 'SEO Settings Management')

@section('content')
<style>
.btn-group .btn {
    margin: 0 2px;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}
.btn-group .btn i {
    margin-left: 0.25rem;
}
.table th {
    font-weight: 600;
    font-size: 0.9rem;
}
.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">SEO Settings Management</h3>
                    <div>
                        <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> إضافة إعدادات SEO جديدة
                        </a>
                        <a href="{{ route('admin.seo.generate-sitemap') }}" class="btn btn-success">
                            <i class="bi bi-gear"></i> توليد Sitemap
                        </a>
                        <a href="{{ route('admin.seo.download-sitemap') }}" class="btn btn-info">
                            <i class="bi bi-download"></i> تحميل Sitemap
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="15%">نوع الصفحة</th>
                                    <th width="10%">اللغة</th>
                                    <th width="25%">العنوان</th>
                                    <th width="30%">الوصف</th>
                                    <th width="10%">الحالة</th>
                                    <th width="20%">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($seoSettings as $setting)
                                    <tr>
                                        <td>
                                            <span class="badge bg-info fs-6">
                                                {{ ucfirst(str_replace('_', ' ', $setting->page_type)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $setting->locale === 'ar' ? 'warning' : 'primary' }} fs-6">
                                                {{ $setting->locale === 'ar' ? 'عربي' : 'English' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ Str::limit($setting->title, 40) }}</div>
                                        </td>
                                        <td>
                                            <div class="text-muted small">{{ Str::limit($setting->description, 60) }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $setting->is_active ? 'success' : 'danger' }} fs-6">
                                                {{ $setting->is_active ? 'نشط' : 'غير نشط' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.seo.edit', $setting->id) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil-square"></i>
                                                    تعديل
                                                </a>
                                                <a href="{{ route('admin.seo.preview', ['pageType' => $setting->page_type, 'locale' => $setting->locale]) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   target="_blank"
                                                   title="معاينة">
                                                    <i class="bi bi-eye"></i>
                                                    معاينة
                                                </a>
                                                <form action="{{ route('admin.seo.destroy', $setting->id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف إعدادات SEO هذه؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                                        <i class="bi bi-trash"></i>
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-search fs-1 d-block mb-3"></i>
                                                <h5>لا توجد إعدادات SEO</h5>
                                                <p>لم يتم العثور على أي إعدادات SEO. ابدأ بإضافة إعدادات جديدة.</p>
                                                <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
                                                    <i class="bi bi-plus-circle"></i>
                                                    إضافة إعدادات SEO جديدة
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
