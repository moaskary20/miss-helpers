// Chat Widget - Simple and Reliable
(function() {
    'use strict';
    
    let chatRoomId = null;
    let isOpen = false;
    
    // Initialize chat widget
    function init() {
        createChatWidget();
        loadChatRoomId();
        console.log('Chat Widget initialized');
    }
    
    // Create chat widget HTML
    function createChatWidget() {
        // Remove existing widget if any
        const existingWidget = document.getElementById('chat-widget');
        if (existingWidget) {
            existingWidget.remove();
        }
        
        const widget = document.createElement('div');
        widget.id = 'chat-widget';
        widget.innerHTML = `
            <!-- Chat Toggle Button -->
            <div id="chat-toggle" style="
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 60px;
                height: 60px;
                background: #007bff;
                border-radius: 50%;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(0,123,255,0.3);
                z-index: 1000;
                transition: all 0.3s ease;
            ">
                <i class="bi bi-chat-dots" style="color: white; font-size: 24px;"></i>
            </div>
            
            <!-- Chat Window -->
            <div id="chat-window" style="
                position: fixed;
                bottom: 90px;
                right: 20px;
                width: 350px;
                height: 500px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                z-index: 1001;
                display: none;
                flex-direction: column;
                overflow: hidden;
            ">
                <!-- Chat Header -->
                <div style="
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 15px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                ">
                    <div>
                        <h4 style="margin: 0; font-size: 16px;">Miss Helpers Support</h4>
                        <small>متاح الآن</small>
                    </div>
                    <button id="chat-close" style="
                        background: none;
                        border: none;
                        color: white;
                        font-size: 20px;
                        cursor: pointer;
                    ">×</button>
                </div>
                
                <!-- Chat Messages -->
                <div id="chat-messages" style="
                    flex: 1;
                    padding: 15px;
                    overflow-y: auto;
                    background: #f8f9fa;
                ">
                    <div style="text-align: center; color: #666; font-size: 14px;">
                        مرحباً! كيف يمكنني مساعدتك؟
                    </div>
                </div>
                
                <!-- Chat Input -->
                <div style="
                    padding: 15px;
                    background: white;
                    border-top: 1px solid #eee;
                ">
                    <div style="display: flex; gap: 10px;">
                        <input type="text" id="chat-input" placeholder="اكتب رسالتك هنا..." style="
                            flex: 1;
                            padding: 10px;
                            border: 1px solid #ddd;
                            border-radius: 20px;
                            outline: none;
                            font-size: 14px;
                        ">
                        <button id="chat-send" style="
                            background: #007bff;
                            color: white;
                            border: none;
                            border-radius: 50%;
                            width: 40px;
                            height: 40px;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="bi bi-send" style="font-size: 14px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(widget);
        
        // Add event listeners
        document.getElementById('chat-toggle').addEventListener('click', toggleChat);
        document.getElementById('chat-close').addEventListener('click', closeChat);
        document.getElementById('chat-send').addEventListener('click', sendMessage);
        document.getElementById('chat-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
    
    // Toggle chat
    function toggleChat() {
        if (isOpen) {
            closeChat();
        } else {
            openChat();
        }
    }
    
    // Open chat
    function openChat() {
        console.log('Opening chat...');
        
        // Check if visitor has name
        if (!VisitorSystem.hasName()) {
            console.log('Visitor has no name, showing popup...');
            VisitorSystem.showPopup();
            
            // Listen for visitor registration
            document.addEventListener('visitorRegistered', function() {
                console.log('Visitor registered, opening chat...');
                openChatDirectly();
            }, { once: true });
            return;
        }
        
        console.log('Visitor has name, opening chat directly');
        openChatDirectly();
    }
    
    // Open chat directly
    function openChatDirectly() {
        const window = document.getElementById('chat-window');
        const toggle = document.getElementById('chat-toggle');
        
        window.style.display = 'flex';
        toggle.style.background = '#dc3545';
        isOpen = true;
        
        // Focus on input
        setTimeout(() => {
            document.getElementById('chat-input').focus();
        }, 100);
    }
    
    // Close chat
    function closeChat() {
        const window = document.getElementById('chat-window');
        const toggle = document.getElementById('chat-toggle');
        
        window.style.display = 'none';
        toggle.style.background = '#007bff';
        isOpen = false;
    }
    
    // Send message
    function sendMessage() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        
        if (!message) return;
        
        console.log('Sending message:', message);
        
        // Check if visitor has name
        if (!VisitorSystem.hasName()) {
            console.log('Visitor has no name, showing popup...');
            VisitorSystem.showPopup();
            
            // Listen for visitor registration
            document.addEventListener('visitorRegistered', function() {
                console.log('Visitor registered, sending message...');
                // Add user message after registration
                addMessage(message, 'user');
                input.value = '';
                // Send to server
                sendToServer(message);
            }, { once: true });
            return;
        }
        
        console.log('Visitor has name, sending message directly');
        // Add user message
        addMessage(message, 'user');
        input.value = '';
        
        // Send to server
        sendToServer(message);
    }
    
    // Add message to chat
    function addMessage(content, sender) {
        const messagesContainer = document.getElementById('chat-messages');
        const messageDiv = document.createElement('div');
        
        const isUser = sender === 'user';
        const time = new Date().toLocaleTimeString('ar-EG', { 
            hour: '2-digit', 
            minute: '2-digit',
            hour12: true 
        });
        
        messageDiv.style.cssText = `
            margin-bottom: 15px;
            display: flex;
            ${isUser ? 'justify-content: flex-end;' : 'justify-content: flex-start;'}
        `;
        
        messageDiv.innerHTML = `
            <div style="
                max-width: 80%;
                padding: 10px 15px;
                border-radius: 18px;
                background: ${isUser ? '#007bff' : '#e9ecef'};
                color: ${isUser ? 'white' : '#333'};
                font-size: 14px;
                word-wrap: break-word;
            ">
                ${content}
                <div style="
                    font-size: 11px;
                    opacity: 0.7;
                    margin-top: 5px;
                ">${time}</div>
            </div>
        `;
        
        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    
    // Send message to server
    function sendToServer(message) {
        const visitorName = VisitorSystem.getName();
        const visitorEmail = VisitorSystem.getEmail();
        
        console.log('Sending to server:', { message, visitorName, visitorEmail, chatRoomId });
        
        if (!chatRoomId) {
            // Create new chat room
            createChatRoom(message, visitorName, visitorEmail);
        } else {
            // Send to existing chat room
            sendToChatRoom(message);
        }
    }
    
    // Create chat room
    function createChatRoom(message, visitorName, visitorEmail) {
        const data = {
            visitor_name: visitorName,
            visitor_email: visitorEmail,
            type: 'live_chat',
            initial_message: message
        };
        
        console.log('Creating chat room with data:', data);
        
        fetch('/chat/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Create chat room response status:', response.status);
            if (!response.ok) {
                throw new Error('HTTP error! status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Create chat room response data:', data);
            if (data.success) {
                chatRoomId = data.chat_room_id;
                localStorage.setItem('chat_room_id', chatRoomId);
                console.log('Chat room created successfully:', chatRoomId);
                
                // Add confirmation message
                addMessage('تم إرسال رسالتك بنجاح! سنتواصل معك قريباً.', 'bot');
                console.log('Message sent to admin panel successfully!');
            } else {
                console.error('Failed to create chat room:', data.message);
                addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
            }
        })
        .catch(error => {
            console.error('Error creating chat room:', error);
            addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
        });
    }
    
    // Send to chat room
    function sendToChatRoom(message) {
        const data = {
            chat_room_id: chatRoomId,
            message: message
        };
        
        console.log('Sending message to chat room:', data);
        
        fetch('/chat/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Send message response status:', response.status);
            if (!response.ok) {
                throw new Error('HTTP error! status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Send message response data:', data);
            if (data.success) {
                console.log('Message sent successfully');
                addMessage('تم إرسال رسالتك بنجاح!', 'bot');
            } else {
                console.error('Failed to send message:', data.message);
                addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
            }
        })
        .catch(error => {
            console.error('Error sending message:', error);
            addMessage('عذراً، حدث خطأ في إرسال رسالتك. يرجى المحاولة مرة أخرى.', 'bot');
        });
    }
    
    // Load chat room ID from localStorage
    function loadChatRoomId() {
        const savedChatRoomId = localStorage.getItem('chat_room_id');
        if (savedChatRoomId) {
            chatRoomId = savedChatRoomId;
            console.log('Loaded chat room ID:', chatRoomId);
        }
    }
    
    // Expose functions globally
    window.ChatWidget = {
        init: init,
        open: openChat,
        close: closeChat,
        sendMessage: sendMessage
    };
    
    console.log('Chat Widget loaded - Version 2.0');
})();