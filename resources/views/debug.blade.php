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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>اختبار النظام</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffa19c;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            margin: 10px;
            font-size: 18px;
            font-weight: bold;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-warning {
            background: #ffc107;
            color: #212529;
        }
        .status {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB5M9MCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container">
        <h1 style="color: #333; margin-bottom: 30px;">
            🔧 اختبار النظام
        </h1>
        
        <div>
            <button class="btn btn-warning" onclick="clearData()">
                🗑️ مسح البيانات
            </button>
            <button class="btn btn-success" onclick="testPopup()">
                🪟 اختبار النافذة المنبثقة
            </button>
            <button class="btn" onclick="testChat()">
                💬 اختبار الشات
            </button>
            <button class="btn" onclick="showStatus()">
                📊 عرض الحالة
            </button>
        </div>
        
        <div id="status-display" class="status" style="display: none;">
            <h4>حالة النظام:</h4>
            <p><strong>مسجل:</strong> <span id="is-registered">-</span></p>
            <p><strong>الاسم:</strong> <span id="visitor-name">-</span></p>
            <p><strong>البريد الإلكتروني:</strong> <span id="visitor-email">-</span></p>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="/" class="btn" target="_blank">
                🏠 الصفحة الرئيسية
            </a>
            <a href="/chat" class="btn btn-success" target="_blank">
                💬 صفحة الشات
            </a>
            <a href="/admin/chat" class="btn" target="_blank">
                🔧 لوحة الإدارة
            </a>
        </div>
    </div>

    <!-- Visitor Check System -->
    <script src="{{ asset('js/visitor-check.js') }}"></script>
    <script src="{{ asset('js/chat-system.js') }}"></script>
    
    <script>
        function clearData() {
            localStorage.removeItem('visitor_name');
            localStorage.removeItem('visitor_email');
            localStorage.removeItem('visitor_registered');
            localStorage.removeItem('chat_room_id');
            alert('تم مسح جميع البيانات.');
            showStatus();
        }
        
        function testPopup() {
            if (window.VisitorCheck) {
                VisitorCheck.showPopup();
            } else {
                alert('خطأ: VisitorCheck غير محمل');
            }
        }
        
        function testChat() {
            if (window.ChatSystem) {
                ChatSystem.init();
                alert('تم تحميل الشات! ابحث عن علامة الشات في الزاوية اليمنى السفلى.');
            } else {
                alert('خطأ: ChatSystem غير محمل');
            }
        }
        
        function showStatus() {
            const isRegistered = localStorage.getItem('visitor_registered') === 'true';
            const visitorName = localStorage.getItem('visitor_name') || '-';
            const visitorEmail = localStorage.getItem('visitor_email') || '-';
            
            document.getElementById('is-registered').textContent = isRegistered ? 'نعم' : 'لا';
            document.getElementById('is-registered').style.color = isRegistered ? '#28a745' : '#dc3545';
            document.getElementById('visitor-name').textContent = visitorName;
            document.getElementById('visitor-email').textContent = visitorEmail;
            
            document.getElementById('status-display').style.display = 'block';
        }
        
        // Show status on load
        document.addEventListener('DOMContentLoaded', function() {
            showStatus();
        });
        
        // Listen for visitor registered event
        document.addEventListener('visitorRegistered', function(e) {
            console.log('Visitor registered:', e.detail);
            showStatus();
        });
    </script>
</body>
</html>
