@extends('admin.layout')
@section('title', 'تعديل مستخدم')
@section('page-title', 'تعديل مستخدم')
@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-pencil"></i> تعديل مستخدم</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right"></i>
            العودة
        </a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>يرجى تصحيح الأخطاء التالية:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">اسم المستخدم</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">الدور</label>
                    <select name="role" class="form-select" required>
                        <option value="super_admin" {{ $user->role=='super_admin' ? 'selected' : '' }}>مدير عام</option>
                        <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>مدير</option>
                        <option value="moderator" {{ $user->role=='moderator' ? 'selected' : '' }}>مشرف</option>
                        <option value="editor" {{ $user->role=='editor' ? 'selected' : '' }}>محرر</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ $user->status=='active' ? 'selected' : '' }}>نشط</option>
                        <option value="inactive" {{ $user->status=='inactive' ? 'selected' : '' }}>غير نشط</option>
                        <option value="suspended" {{ $user->status=='suspended' ? 'selected' : '' }}>معلق</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">كلمة المرور الجديدة (اختياري)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">الصورة الرمزية</label>
                    <input type="file" name="avatar" class="form-control">
                    @if($user->avatar)
                        <small class="text-muted d-block mt-1">صورة حالية: {{ $user->avatar }}</small>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check"></i>
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
