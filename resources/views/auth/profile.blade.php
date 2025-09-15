@extends('admin.layout')
@section('title', 'الملف الشخصي')
@section('page-title', 'الملف الشخصي')
@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-person-circle"></i> الملف الشخصي</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right"></i>
            العودة للوحة الإدارة
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.doLogin') }}" method="POST" enctype="multipart/form-data" onsubmit="return false;">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">الاسم</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">اسم المستخدم</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->username }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الهاتف</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->phone }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الدور</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->role_display_name }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الحالة</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->status_display_name }}" disabled>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
