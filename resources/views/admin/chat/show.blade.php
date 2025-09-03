@extends('admin.layout')

@section('title', 'غرفة الشات')
@section('page-title', 'غرفة الشات')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-chat-dots"></i>
                غرفة الشات: {{ $chatRoom->visitor_name }}
            </h2>
            <div>
                @if($chatRoom->status === 'active')
                    <form action="{{ route('admin.chat.close', $chatRoom->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-x-circle"></i>
                            إغلاق الشات
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.chat.reopen', $chatRoom->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-arrow-clockwise"></i>
                            إعادة فتح
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('admin.chat.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للشات
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- معلومات الزائر -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person"></i>
                    معلومات الزائر
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">الاسم:</label>
                    <p class="mb-0">{{ $chatRoom->visitor_name }}</p>
                </div>
                
                @if($chatRoom->visitor_email)
                    <div class="mb-3">
                        <label class="form-label fw-bold">البريد الإلكتروني:</label>
                        <p class="mb-0">
                            <a href="mailto:{{ $chatRoom->visitor_email }}">{{ $chatRoom->visitor_email }}</a>
                        </p>
                    </div>
                @endif
                
                @if($chatRoom->visitor_phone)
                    <div class="mb-3">
                        <label class="form-label fw-bold">التليفون:</label>
                        <p class="mb-0">
                            <a href="tel:{{ $chatRoom->visitor_phone }}">{{ $chatRoom->visitor_phone }}</a>
                        </p>
                    </div>
                @endif
                
                <div class="mb-3">
                    <label class="form-label fw-bold">نوع الشات:</label>
                    <p class="mb-0">
                        <span class="badge bg-{{ $chatRoom->type_color }}">
                            {{ $chatRoom->type_text }}
                        </span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الحالة:</label>
                    <p class="mb-0">
                        <span class="badge bg-{{ $chatRoom->status_color }}">
                            {{ $chatRoom->status_text }}
                        </span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">تاريخ البدء:</label>
                    <p class="mb-0">{{ $chatRoom->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">آخر نشاط:</label>
                    <p class="mb-0">
                        @if($chatRoom->last_activity)
                            {{ $chatRoom->last_activity->format('Y-m-d H:i') }}
                        @else
                            <span class="text-muted">غير محدد</span>
                        @endif
                    </p>
                </div>
                
                @if($chatRoom->initial_message)
                    <div class="mb-3">
                        <label class="form-label fw-bold">الرسالة الأولى:</label>
                        <div class="p-3 bg-light rounded">
                            <p class="mb-0">{{ $chatRoom->initial_message }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- إحصائيات سريعة -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-graph-up"></i>
                    إحصائيات
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $chatRoom->messages->count() }}</h4>
                        <small>إجمالي الرسائل</small>
                    </div>
                    <div class="col-6">
                        <h4 class="text-danger">{{ $chatRoom->unread_messages_count }}</h4>
                        <small>غير مقروءة</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- منطقة الشات -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-chat-text"></i>
                    المحادثة
                </h5>
            </div>
            <div class="card-body">
                <!-- منطقة الرسائل -->
                <div id="chat-messages" class="chat-messages mb-3" style="height: 400px; overflow-y: auto;">
                    @foreach($chatRoom->messages as $message)
                        <div class="message {{ $message->isFromVisitor() ? 'visitor' : 'admin' }} mb-3">
                            <div class="d-flex {{ $message->isFromVisitor() ? 'justify-content-start' : 'justify-content-end' }}">
                                <div class="message-content {{ $message->isFromVisitor() ? 'bg-light' : 'bg-primary text-white' }} p-3 rounded" 
                                     style="max-width: 70%;">
                                    <div class="message-header mb-2">
                                        <strong>{{ $message->sender_name }}</strong>
                                        <small class="text-muted ms-2">{{ $message->time_ago }}</small>
                                    </div>
                                    <div class="message-text">
                                        {{ $message->message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- نموذج إرسال الرسالة -->
                @if($chatRoom->status === 'active')
                    <form action="{{ route('admin.chat.sendMessage', $chatRoom->id) }}" method="POST" id="chat-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   name="message" 
                                   id="message-input"
                                   placeholder="اكتب رسالتك هنا..." 
                                   required>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i>
                                إرسال
                            </button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-exclamation-triangle"></i>
                        هذه الغرفة مغلقة. لا يمكن إرسال رسائل جديدة.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.chat-messages {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
    background-color: #f8f9fa;
}

.message.visitor .message-content {
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 20px;
}

.message.admin .message-content {
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 20px;
}

.message-content {
    word-wrap: break-word;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // التمرير إلى آخر رسالة
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
    
    // تحديث حالة القراءة
    fetch('{{ route("admin.chat.markRead", $chatRoom->id) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    });
});
</script>
@endsection
