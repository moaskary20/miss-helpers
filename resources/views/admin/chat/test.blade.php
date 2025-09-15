@extends('admin.layout')

@section('title', 'اختبار الشات')
@section('page-title', 'اختبار الشات')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-bug"></i> اختبار نظام الشات</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>إحصائيات قاعدة البيانات:</h6>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>إجمالي غرف الشات:</span>
                                <span class="badge bg-primary">{{ \App\Models\ChatRoom::count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>إجمالي الرسائل:</span>
                                <span class="badge bg-info">{{ \App\Models\ChatMessage::count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>رسائل الزوار:</span>
                                <span class="badge bg-success">{{ \App\Models\ChatMessage::where('sender_type', 'visitor')->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>رسائل غير مقروءة:</span>
                                <span class="badge bg-danger">{{ \App\Models\ChatMessage::where('sender_type', 'visitor')->where('is_read', false)->count() }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>آخر 5 غرف شات:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>الزائر</th>
                                        <th>النوع</th>
                                        <th>الحالة</th>
                                        <th>التاريخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\ChatRoom::latest()->take(5)->get() as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->visitor_name }}</td>
                                        <td><span class="badge bg-info">{{ $room->type }}</span></td>
                                        <td><span class="badge bg-success">{{ $room->status }}</span></td>
                                        <td>{{ $room->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <h6>آخر 10 رسائل:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
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
                                    @foreach(\App\Models\ChatMessage::latest()->take(10)->get() as $message)
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
                                        <td>{{ $message->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <h6>اختبار API:</h6>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" onclick="testUnreadCount()">اختبار عدد الرسائل غير المقروءة</button>
                            <button class="btn btn-success" onclick="testChatRooms()">اختبار غرف الشات</button>
                            <button class="btn btn-info" onclick="testMessages()">اختبار الرسائل</button>
                            <a href="{{ route('admin.chat.index') }}" class="btn btn-secondary">الذهاب لصفحة الشات</a>
                        </div>
                        <div id="testResults" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function testUnreadCount() {
    const resultsDiv = document.getElementById('testResults');
    resultsDiv.innerHTML = '<div class="alert alert-info">جاري اختبار عدد الرسائل غير المقروءة...</div>';
    
    fetch('/admin/chat/unread-count')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resultsDiv.innerHTML = `<div class="alert alert-success">✅ عدد الرسائل غير المقروءة: ${data.count}</div>`;
            } else {
                resultsDiv.innerHTML = '<div class="alert alert-danger">❌ فشل في الحصول على عدد الرسائل</div>';
            }
        })
        .catch(error => {
            resultsDiv.innerHTML = `<div class="alert alert-danger">❌ خطأ: ${error.message}</div>`;
        });
}

function testChatRooms() {
    const resultsDiv = document.getElementById('testResults');
    resultsDiv.innerHTML = '<div class="alert alert-info">جاري اختبار غرف الشات...</div>';
    
    fetch('/admin/chat')
        .then(response => {
            if (response.ok) {
                resultsDiv.innerHTML = '<div class="alert alert-success">✅ صفحة غرف الشات تعمل بشكل صحيح</div>';
            } else {
                resultsDiv.innerHTML = `<div class="alert alert-danger">❌ خطأ في صفحة غرف الشات: ${response.status}</div>`;
            }
        })
        .catch(error => {
            resultsDiv.innerHTML = `<div class="alert alert-danger">❌ خطأ: ${error.message}</div>`;
        });
}

function testMessages() {
    const resultsDiv = document.getElementById('testResults');
    resultsDiv.innerHTML = '<div class="alert alert-info">جاري اختبار الرسائل...</div>';
    
    // اختبار آخر غرفة شات
    fetch('/admin/chat/16')
        .then(response => {
            if (response.ok) {
                resultsDiv.innerHTML = '<div class="alert alert-success">✅ صفحة الرسائل تعمل بشكل صحيح</div>';
            } else {
                resultsDiv.innerHTML = `<div class="alert alert-danger">❌ خطأ في صفحة الرسائل: ${response.status}</div>`;
            }
        })
        .catch(error => {
            resultsDiv.innerHTML = `<div class="alert alert-danger">❌ خطأ: ${error.message}</div>`;
        });
}
</script>
@endsection

