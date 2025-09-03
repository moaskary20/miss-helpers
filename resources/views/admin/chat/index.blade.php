@extends('admin.layout')

@section('title', 'إدارة الشات')
@section('page-title', 'إدارة الشات')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-chat-dots"></i>
                إدارة الشات
            </h2>
            <div>
                <span class="badge bg-success me-2">
                    <i class="bi bi-circle-fill"></i>
                    نشط
                </span>
                <span class="badge bg-warning me-2">
                    <i class="bi bi-clock"></i>
                    في الانتظار
                </span>
                <span class="badge bg-secondary">
                    <i class="bi bi-x-circle"></i>
                    مغلق
                </span>
            </div>
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
                @if($chatRooms->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الزائر</th>
                                    <th>نوع الشات</th>
                                    <th>آخر رسالة</th>
                                    <th>عدد الرسائل</th>
                                    <th>الحالة</th>
                                    <th>آخر نشاط</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chatRooms as $chatRoom)
                                    <tr class="{{ $chatRoom->isActive() ? 'table-success' : '' }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $chatRoom->visitor_name }}</strong>
                                                    @if($chatRoom->visitor_email)
                                                        <br>
                                                        <small class="text-muted">{{ $chatRoom->visitor_email }}</small>
                                                    @endif
                                                    @if($chatRoom->visitor_phone)
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="bi bi-telephone"></i>
                                                            {{ $chatRoom->visitor_phone }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $chatRoom->type_color }}">
                                                {{ $chatRoom->type_text }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($chatRoom->lastMessage)
                                                <div class="text-truncate" style="max-width: 200px;">
                                                    <strong>{{ $chatRoom->lastMessage->sender_name }}:</strong>
                                                    {{ Str::limit($chatRoom->lastMessage->message, 50) }}
                                                </div>
                                                <small class="text-muted">{{ $chatRoom->lastMessage->time_ago }}</small>
                                            @else
                                                <span class="text-muted">لا توجد رسائل</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $chatRoom->messages_count }}</span>
                                            @if($chatRoom->unread_messages_count > 0)
                                                <span class="badge bg-danger">{{ $chatRoom->unread_messages_count }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $chatRoom->status_color }}">
                                                {{ $chatRoom->status_text }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($chatRoom->last_activity)
                                                <div>{{ $chatRoom->last_activity->format('Y-m-d') }}</div>
                                                <small class="text-muted">{{ $chatRoom->last_activity->format('H:i') }}</small>
                                            @else
                                                <span class="text-muted">غير محدد</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.chat.show', $chatRoom->id) }}" 
                                                   class="btn btn-outline-primary" 
                                                   title="عرض">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                
                                                @if($chatRoom->status === 'active')
                                                    <form action="{{ route('admin.chat.close', $chatRoom->id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-warning" title="إغلاق">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.chat.reopen', $chatRoom->id) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-success" title="إعادة فتح">
                                                            <i class="bi bi-arrow-clockwise"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <form action="{{ route('admin.chat.destroy', $chatRoom->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف غرفة الشات؟')">
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
                        {{ $chatRooms->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-chat-dots text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">لا توجد غرف شات مسجلة بعد</p>
                        <p class="text-muted">سيتم إنشاء غرف الشات تلقائياً عندما يبدأ الزوار في الشات</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- إحصائيات سريعة -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-chat-dots" style="font-size: 2rem;"></i>
                <h4 class="mt-2">{{ $chatRooms->total() }}</h4>
                <p class="mb-0">إجمالي غرف الشات</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-circle-fill" style="font-size: 2rem;"></i>
                <h4 class="mt-2">{{ $chatRooms->where('status', 'active')->count() }}</h4>
                <p class="mb-0">غرف نشطة</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="bi bi-clock" style="font-size: 2rem;"></i>
                <h4 class="mt-2">{{ $chatRooms->where('status', 'pending')->count() }}</h4>
                <p class="mb-0">في الانتظار</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <i class="bi bi-envelope" style="font-size: 2rem;"></i>
                <h4 class="mt-2">{{ $chatRooms->sum('unread_messages_count') }}</h4>
                <p class="mb-0">رسائل غير مقروءة</p>
            </div>
        </div>
    </div>
</div>
@endsection
