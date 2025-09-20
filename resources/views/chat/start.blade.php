<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
    new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
    "https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,"script","dataLayer","GTM-TB5M9MCD");</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ابدأ الشات - خدمة العملاء</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffa19c;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .chat-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        
        .chat-header {
            background: #ffa19c;
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .chat-header h2 {
            margin: 0;
            font-weight: 600;
        }
        
        .chat-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        
        .chat-form {
            padding: 40px;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #ffa19c;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-start-chat {
            background: #ffa19c;
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-start-chat:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .chat-type-selector {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .chat-type-option {
            flex: 1;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .chat-type-option:hover {
            border-color: #ffa19c;
            background-color: #f8f9fa;
        }
        
        .chat-type-option.selected {
            border-color: #ffa19c;
            background-color: #ffa19c;
            color: white;
        }
        
        .chat-type-option i {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }
        
        .loading {
            display: none;
        }
        
        .success-message {
            display: none;
            text-align: center;
            padding: 40px;
        }
        
        .success-message i {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB5M9MCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="chat-container">
                    <!-- Header -->
                    <div class="chat-header">
                        <h2><i class="bi bi-chat-dots"></i></h2>
                        <h2>خدمة العملاء</h2>
                        <p>نحن هنا لمساعدتك! اختر نوع التواصل المناسب لك</p>
                    </div>
                    
                    <!-- Chat Form -->
                    <div class="chat-form" id="chat-form">
                        <form id="start-chat-form">
                            <!-- Chat Type Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">نوع التواصل:</label>
                                <div class="chat-type-selector">
                                    <div class="chat-type-option" data-type="live_chat">
                                        <i class="bi bi-chat-dots"></i>
                                        <div>شات مباشر</div>
                                        <small>تحدث معنا الآن</small>
                                    </div>
                                    <div class="chat-type-option" data-type="leave_message">
                                        <i class="bi bi-envelope"></i>
                                        <div>ترك رسالة</div>
                                        <small>سنرد عليك لاحقاً</small>
                                    </div>
                                </div>
                                <input type="hidden" name="type" id="chat-type" value="live_chat" required>
                            </div>
                            
                            <!-- Visitor Information -->
                            <div class="mb-3">
                                <label for="visitor_name" class="form-label">الاسم <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control" 
                                       id="visitor_name" 
                                       name="visitor_name" 
                                       placeholder="أدخل اسمك" 
                                       required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="visitor_email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email" 
                                               class="form-control" 
                                               id="visitor_email" 
                                               name="visitor_email" 
                                               placeholder="example@email.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="visitor_phone" class="form-label">رقم التليفون</label>
                                        <input type="tel" 
                                               class="form-control" 
                                               id="visitor_phone" 
                                               name="visitor_phone" 
                                               placeholder="0501234567">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="initial_message" class="form-label">رسالتك <span class="text-danger">*</span></label>
                                <textarea class="form-control" 
                                          id="initial_message" 
                                          name="initial_message" 
                                          rows="4" 
                                          placeholder="اكتب رسالتك هنا..." 
                                          required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-start-chat w-100" id="submit-btn">
                                <span class="normal-text">
                                    <i class="bi bi-send"></i>
                                    ابدأ الشات
                                </span>
                                <span class="loading">
                                    <i class="bi bi-arrow-clockwise spin"></i>
                                    جاري الإرسال...
                                </span>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Success Message -->
                    <div class="success-message" id="success-message">
                        <i class="bi bi-check-circle"></i>
                        <h3>تم إرسال رسالتك بنجاح!</h3>
                        <p>سنقوم بالرد عليك في أقرب وقت ممكن</p>
                        <div id="chat-room-info" style="display: none;">
                            <hr>
                            <p><strong>رقم الطلب:</strong> <span id="chat-room-id"></span></p>
                            <a href="#" id="chat-room-link" class="btn btn-primary">
                                <i class="bi bi-chat-dots"></i>
                                متابعة المحادثة
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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

            // Fill visitor info if available
            const visitorInfo = VisitorPopup.getVisitorInfo();
            if (visitorInfo.name) {
                document.getElementById('visitor_name').value = visitorInfo.name;
            }
            if (visitorInfo.email) {
                document.getElementById('visitor_email').value = visitorInfo.email;
            }

            // Chat type selection
            const chatTypeOptions = document.querySelectorAll('.chat-type-option');
            const chatTypeInput = document.getElementById('chat-type');
            
            chatTypeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    chatTypeOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    chatTypeInput.value = this.dataset.type;
                });
            });
            
            // Set default selection
            document.querySelector('[data-type="live_chat"]').classList.add('selected');
            
            // Form submission
            const form = document.getElementById('start-chat-form');
            const submitBtn = document.getElementById('submit-btn');
            const normalText = submitBtn.querySelector('.normal-text');
            const loading = submitBtn.querySelector('.loading');
            const chatForm = document.getElementById('chat-form');
            const successMessage = document.getElementById('success-message');
            
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if visitor has a name
            if (!VisitorSystem.hasName()) {
                console.log('Visitor has no name, showing popup...');
                VisitorSystem.showPopup();
                
                // Listen for visitor registration
                document.addEventListener('visitorRegistered', () => {
                    console.log('Visitor registered, submitting form...');
                    // Fill form with visitor info
                    document.getElementById('visitor_name').value = VisitorSystem.getName();
                    document.getElementById('visitor_email').value = VisitorSystem.getEmail();
                    // Submit form
                    submitForm();
                });
                return;
            }
            
            // Submit form directly
            submitForm();
        });
            
            function submitForm() {
                // Show loading
                normalText.style.display = 'none';
                loading.style.display = 'inline-block';
                submitBtn.disabled = true;
                
                // Get form data
                const formData = new FormData(form);
                
                // Send request
                fetch('{{ route("chat.startChat") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        visitor_name: formData.get('visitor_name'),
                        visitor_email: formData.get('visitor_email'),
                        visitor_phone: formData.get('visitor_phone'),
                        type: formData.get('type'),
                        initial_message: formData.get('initial_message')
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        chatForm.style.display = 'none';
                        successMessage.style.display = 'block';
                        
                        // If it's a live chat, show chat room info
                        if (data.chat_room_id) {
                            document.getElementById('chat-room-id').textContent = data.chat_room_id;
                            document.getElementById('chat-room-link').href = '/chat/' + data.session_id;
                            document.getElementById('chat-room-info').style.display = 'block';
                        }
                    } else {
                        alert('حدث خطأ: ' + data.message);
                        // Reset form
                        normalText.style.display = 'inline-block';
                        loading.style.display = 'none';
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.');
                    // Reset form
                    normalText.style.display = 'inline-block';
                    loading.style.display = 'none';
                    submitBtn.disabled = false;
                });
            }
        });
    </script>
    
    <!-- Visitor Check System -->
    <script src="{{ asset('js/visitor-system.js') }}"></script>
</body>
</html>
