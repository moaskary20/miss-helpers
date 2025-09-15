<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>المحادثة - {{ $chatRoom->visitor_name }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .chat-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 800px;
            width: 100%;
            margin: 20px auto;
        }
        
        .chat-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chat-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .chat-status {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #28a745;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        .chat-messages {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .message {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        
        .message.visitor {
            align-items: flex-end;
        }
        
        .message.admin {
            align-items: flex-start;
        }
        
        .message-content {
            max-width: 70%;
            padding: 15px;
            border-radius: 20px;
            position: relative;
        }
        
        .message.visitor .message-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 5px;
        }
        
        .message.admin .message-content {
            background: white;
            border: 1px solid #e9ecef;
            border-bottom-left-radius: 5px;
        }
        
        .message-header {
            font-size: 12px;
            margin-bottom: 5px;
            opacity: 0.8;
        }
        
        .message-text {
            word-wrap: break-word;
        }
        
        .message-time {
            font-size: 11px;
            margin-top: 5px;
            opacity: 0.7;
        }
        
        .chat-input {
            padding: 20px;
            border-top: 1px solid #e9ecef;
            background: white;
        }
        
        .input-group {
            gap: 10px;
        }
        
        .form-control {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 12px 20px;
            font-size: 16px;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-send {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            color: white;
            font-weight: 600;
        }
        
        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .chat-info {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        
        .typing-indicator {
            display: none;
            padding: 10px 20px;
            color: #6c757d;
            font-style: italic;
        }
        
        .typing-indicator.show {
            display: block;
        }
        
        .chat-closed {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        
        .chat-closed i {
            font-size: 60px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chat-container">
            <!-- Header -->
            <div class="chat-header">
                <div>
                    <h3><i class="bi bi-chat-dots"></i> المحادثة</h3>
                    <small>مرحباً {{ $chatRoom->visitor_name }}</small>
                </div>
                <div class="chat-status">
                    <div class="status-indicator"></div>
                    <span>
                        @if($chatRoom->status === 'active')
                            متصل
                        @else
                            مغلق
                        @endif
                    </span>
                </div>
            </div>
            
            <!-- Chat Info -->
            <div class="chat-info">
                <div class="info-item">
                    <span class="info-label">رقم الطلب:</span>
                    <span>{{ $chatRoom->id }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">نوع التواصل:</span>
                    <span>
                        @if($chatRoom->type === 'live_chat')
                            <span class="badge bg-primary">شات مباشر</span>
                        @else
                            <span class="badge bg-info">ترك رسالة</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">تاريخ البدء:</span>
                    <span>{{ $chatRoom->created_at->format('Y-m-d H:i') }}</span>
                </div>
            </div>
            
            @if($chatRoom->status === 'active')
                <!-- Messages -->
                <div class="chat-messages" id="chat-messages">
                    @foreach($chatRoom->messages as $message)
                        <div class="message {{ $message->isFromVisitor() ? 'visitor' : 'admin' }}">
                            <div class="message-content">
                                <div class="message-header">
                                    {{ $message->sender_name }}
                                </div>
                                <div class="message-text">
                                    {{ $message->message }}
                                </div>
                                <div class="message-time">
                                    {{ $message->time_ago }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Typing Indicator -->
                <div class="typing-indicator" id="typing-indicator">
                    <i class="bi bi-three-dots"></i> المدير يكتب...
                </div>
                
                <!-- Chat Input -->
                <div class="chat-input">
                    <form id="chat-form">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   id="message-input" 
                                   placeholder="اكتب رسالتك هنا..." 
                                   required>
                            <button type="submit" class="btn btn-send">
                                <i class="bi bi-send"></i>
                                إرسال
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Chat Closed -->
                <div class="chat-closed">
                    <i class="bi bi-x-circle"></i>
                    <h4>المحادثة مغلقة</h4>
                    <p>هذه المحادثة مغلقة حالياً. لا يمكن إرسال رسائل جديدة.</p>
                    <a href="{{ route('chat.start') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        بدء محادثة جديدة
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Protect the page - require visitor registration
            VisitorGuard.protectPage({
                showPopup: true,
                checkOnLoad: true
            });

            const chatMessages = document.getElementById('chat-messages');
            const messageInput = document.getElementById('message-input');
            const chatForm = document.getElementById('chat-form');
            const typingIndicator = document.getElementById('typing-indicator');
            
            if (chatMessages) {
                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                // Auto-refresh messages every 5 seconds
                setInterval(function() {
                    refreshMessages();
                }, 5000);
            }
            
            if (chatForm) {
                chatForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const message = messageInput.value.trim();
                    if (!message) return;
                    
                    // Send message
                    sendMessage(message);
                    
                    // Clear input
                    messageInput.value = '';
                });
            }
            
        function sendMessage(message) {
            // Check if visitor has a name
            if (!VisitorSystem.hasName()) {
                console.log('Visitor has no name, showing popup...');
                VisitorSystem.showPopup();
                
                // Listen for visitor registration
                document.addEventListener('visitorRegistered', () => {
                    console.log('Visitor registered, sending message...');
                    // Send message after registration
                    sendMessageToServer(message);
                });
                return;
            }
            
            // Send message directly
            sendMessageToServer(message);
        }
            
            function sendMessageToServer(message) {
                // Get CSRF token from meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                
                console.log('Sending message:', message);
                console.log('Chat room ID:', {{ $chatRoom->id }});
                console.log('CSRF Token:', csrfToken);
                
                fetch('{{ route("chat.sendMessage") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        chat_room_id: {{ $chatRoom->id }},
                        message: message
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        // Add message to chat
                        addMessage('{{ $chatRoom->visitor_name }}', message, 'visitor');
                    } else {
                        alert('حدث خطأ: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ في الإرسال. يرجى المحاولة مرة أخرى.');
                });
            }
            
            function addMessage(senderName, message, type) {
                console.log('Adding message:', { senderName, message, type });
                
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${type}`;
                
                const now = new Date();
                const timeAgo = 'الآن';
                
                messageDiv.innerHTML = `
                    <div class="message-content">
                        <div class="message-header">${senderName}</div>
                        <div class="message-text">${message}</div>
                        <div class="message-time">${timeAgo}</div>
                    </div>
                `;
                
                if (chatMessages) {
                    chatMessages.appendChild(messageDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                } else {
                    console.error('chatMessages element not found');
                }
            }
            
            function refreshMessages() {
                fetch('{{ route("chat.getMessages", $chatRoom->id) }}')
                .then(response => {
                    console.log('Refresh response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Refresh response data:', data);
                    if (data.success) {
                        // Clear existing messages and reload all
                        chatMessages.innerHTML = '';
                        data.messages.forEach(msg => {
                            const type = msg.sender_type === 'visitor' ? 'visitor' : 'admin';
                            addMessage(msg.sender_name, msg.message, type);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error refreshing messages:', error);
                });
            }
        });
    </script>
    
    <!-- Chat System -->
    <script src="{{ asset('js/visitor-system.js') }}"></script>
</body>
</html>
