@extends('admin.layout')
@section('title', 'إدارة المستخدمين')
@section('page-title', 'إدارة المستخدمين')
@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2>
            <i class="bi bi-people"></i>
            إدارة المستخدمين
        </h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            إضافة مستخدم
        </a>
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

<div class="card">
    <div class="card-body">
        <form class="row g-3 mb-3" method="GET" action="{{ route('admin.users.index') }}">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالاسم أو البريد أو اسم المستخدم" class="form-control">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select">
                    <option value="">كل الأدوار</option>
                    <option value="super_admin" {{ request('role')=='super_admin' ? 'selected' : '' }}>مدير عام</option>
                    <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>مدير</option>
                    <option value="moderator" {{ request('role')=='moderator' ? 'selected' : '' }}>مشرف</option>
                    <option value="editor" {{ request('role')=='editor' ? 'selected' : '' }}>محرر</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">كل الحالات</option>
                    <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>نشط</option>
                    <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>غير نشط</option>
                    <option value="suspended" {{ request('status')=='suspended' ? 'selected' : '' }}>معلق</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100" type="submit">
                    <i class="bi bi-search"></i>
                    بحث
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>المستخدم</th>
                        <th>الدور</th>
                        <th>الحالة</th>
                        <th>البريد</th>
                        <th>الهاتف</th>
                        <th>آخر دخول</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                        <i class="bi bi-person text-white"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ '@' . $user->username }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->role_color }}">{{ $user->role_display_name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->status_color }}">{{ $user->status_display_name }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>
                                @if($user->last_login_at)
                                    <small>{{ $user->last_login_at->diffForHumans() }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-info" title="عرض"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-primary" title="تعديل"><i class="bi bi-pencil"></i></a>
                                    @if(!$user->isSuperAdmin())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="حذف"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">لا يوجد مستخدمون</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
