@extends('admin.layout')

@section('title', 'إدارة الطلبات')
@section('page-title', 'إدارة الطلبات')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-clipboard-list"></i>
                إدارة الطلبات
            </h2>
            <a href="{{ route('admin.service-requests.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                إضافة طلب جديد
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
                @if($requests->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>التليفون</th>
                                    <th>نوع الخدمة</th>
                                    <th>الجنسية</th>
                                    <th>الإمارة</th>
                                    <th>الحالة</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <td>
                                            <strong>{{ $request->name }}</strong>
                                        </td>
                                        <td>
                                            <a href="tel:{{ $request->phone }}" class="text-decoration-none">
                                                <i class="bi bi-telephone"></i>
                                                {{ $request->phone }}
                                            </a>
                                        </td>
                                        <td>
                                            @switch($request->service_type)
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
                                                    <span class="badge bg-secondary">{{ $request->service_type }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <span class="badge bg-dark">{{ $request->nationality }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ $request->emirate }}</span>
                                        </td>
                                        <td>
                                            @if($request->status === 'تم التنفيذ')
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
                                        </td>
                                        <td>
                                            @if($request->is_active)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-secondary">غير نشط</span>
                                            @endif
                                        </td>
                                        <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.service-requests.show', $request->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.service-requests.edit', $request->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.service-requests.destroy', $request->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟')">
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
                        {{ $requests->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-clipboard-list text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد طلبات مسجلة بعد</p>
                        <a href="{{ route('admin.service-requests.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            إضافة أول طلب
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
