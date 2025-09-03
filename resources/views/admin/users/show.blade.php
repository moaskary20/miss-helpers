@extends('admin.layout')
@section('title', 'عرض المستخدم')
@section('page-title', 'عرض المستخدم')
@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-person"></i> {{ $user->name }}</h2>
        <div>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil"></i>
                تعديل
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header"><strong>البيانات الأساسية</strong></div>
            <div class="card-body">
                <p><strong>الاسم:</strong> {{ $user->name }}</p>
                <p><strong>اسم المستخدم:</strong> {{ $user->username }}</p>
                <p><strong>البريد الإلكتروني:</strong> {{ $user->email }}</p>
                <p><strong>الهاتف:</strong> {{ $user->phone ?? '-' }}</p>
                <p><strong>الدور:</strong> <span class="badge bg-{{ $user->role_color }}">{{ $user->role_display_name }}</span></p>
                <p><strong>الحالة:</strong> <span class="badge bg-{{ $user->status_color }}">{{ $user->status_display_name }}</span></p>
                <p><strong>آخر دخول:</strong> {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : '-' }}</p>
                <p><strong>تاريخ الإنشاء:</strong> {{ $user->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>آخر تحديث:</strong> {{ $user->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>آخر الأنشطة</strong>
                <a href="{{ route('admin.users.activities', $user->id) }}" class="btn btn-sm btn-outline-primary">عرض الكل</a>
            </div>
            <div class="card-body">
                @if($user->activities->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الحدث</th>
                                    <th>الوصف</th>
                                    <th>التاريخ</th>
                                    <th>IP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->activities as $activity)
                                    <tr>
                                        <td><span class="badge bg-{{ $activity->action_color }}">{{ $activity->action_display_name }}</span></td>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                        <td><small class="text-muted">{{ $activity->ip_address }}</small></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted">لا توجد أنشطة</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
