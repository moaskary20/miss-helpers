@extends('admin.layout')
@section('title', 'أنشطة المستخدم')
@section('page-title', 'أنشطة المستخدم')
@section('content')
<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-activity"></i> أنشطة: {{ $user->name }}</h2>
        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right"></i>
            العودة
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($activities->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الحدث</th>
                            <th>الوصف</th>
                            <th>التفاصيل</th>
                            <th>التاريخ</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td><span class="badge bg-{{ $activity->action_color }}">{{ $activity->action_display_name }}</span></td>
                                <td>{{ $activity->description }}</td>
                                <td>
                                    @if($activity->details)
                                        <pre class="mb-0" style="white-space:pre-wrap">{{ json_encode($activity->details, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) }}</pre>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                <td><small class="text-muted">{{ $activity->ip_address }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $activities->links() }}
            </div>
        @else
            <div class="text-center text-muted">لا توجد أنشطة</div>
        @endif
    </div>
</div>
@endsection
