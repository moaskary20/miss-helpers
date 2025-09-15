@extends('admin.layout')

@section('title', 'الشات - عرض مبسط')
@section('page-title', 'الشات - عرض مبسط')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <h5><i class="bi bi-info-circle"></i> عرض مبسط للشات</h5>
            <p>هذه صفحة مبسطة لعرض بيانات الشات مباشرة من قاعدة البيانات</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="bi bi-bar-chart"></i> إحصائيات</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary">{{ \App\Models\ChatRoom::count() }}</h4>
                            <small>غرف الشات</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">{{ \App\Models\ChatMessage::count() }}</h4>
                        <small>الرسائل</small>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-info">{{ \App\Models\ChatMessage::where('sender_type', 'visitor')->count() }}</h4>
                            <small>رسائل الزوار</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger">{{ \App\Models\ChatMessage::where('sender_type', 'visitor')->where('is_read', false)->count() }}</h4>
                        <small>غير مقروءة</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6><i class="bi bi-chat-dots"></i> آخر غرف الشات</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>الزائر</th>
                                <th>النوع</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\ChatRoom::latest()->take(10)->get() as $room)
                            <tr class="{{ $room->status === 'active' ? 'table-success' : '' }}">
                                <td>{{ $room->id }}</td>
                                <td>
                                    <strong>{{ $room->visitor_name }}</strong>
                                    @if($room->visitor_email)
                                        <br><small class="text-muted">{{ $room->visitor_email }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $room->type }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $room->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $room->status }}
                                    </span>
                                </td>
                                <td>
                                    <small>{{ $room->created_at->format('Y-m-d H:i') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.chat.show', $room->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="bi bi-envelope"></i> آخر الرسائل</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>المرسل</th>
                                <th>الاسم</th>
                                <th>الرسالة</th>
                                <th>مقروءة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\ChatMessage::latest()->take(15)->get() as $message)
                            <tr class="{{ $message->sender_type === 'visitor' ? 'table-light' : 'table-info' }}">
                                <td>{{ $message->id }}</td>
                                <td>
                                    <span class="badge {{ $message->sender_type === 'visitor' ? 'bg-success' : 'bg-primary' }}">
                                        {{ $message->sender_type === 'visitor' ? 'زائر' : 'مدير' }}
                                    </span>
                                </td>
                                <td>{{ $message->sender_name }}</td>
                                <td>{{ Str::limit($message->message, 50) }}</td>
                                <td>
                                    @if($message->is_read)
                                        <span class="badge bg-success">نعم</span>
                                    @else
                                        <span class="badge bg-danger">لا</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ $message->created_at->format('Y-m-d H:i:s') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="bi bi-tools"></i> أدوات الاختبار</h6>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <button class="btn btn-primary" onclick="location.reload()">
                        <i class="bi bi-arrow-clockwise"></i> تحديث الصفحة
                    </button>
                    <a href="{{ route('admin.chat.index') }}" class="btn btn-secondary">
                        <i class="bi bi-chat-dots"></i> صفحة الشات العادية
                    </a>
                    <a href="{{ route('admin.chat.test') }}" class="btn btn-info">
                        <i class="bi bi-bug"></i> صفحة التشخيص
                    </a>
                    <a href="/" class="btn btn-success" target="_blank">
                        <i class="bi bi-house"></i> الموقع الرئيسي
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// تحديث تلقائي كل 30 ثانية
setInterval(() => {
    if (document.visibilityState === 'visible') {
        location.reload();
    }
}, 30000);

console.log('Chat Simple Page Loaded');
console.log('Total Rooms: {{ \App\Models\ChatRoom::count() }}');
console.log('Total Messages: {{ \App\Models\ChatMessage::count() }}');
console.log('Unread Messages: {{ \App\Models\ChatMessage::where("sender_type", "visitor")->where("is_read", false)->count() }}');
</script>
@endsection

