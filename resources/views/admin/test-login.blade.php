<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختبار تسجيل الدخول - Miss Helpers</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .test-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
        }
        .test-user {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
        }
        .btn-test {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1 class="text-center mb-4">اختبار تسجيل الدخول</h1>
        
        <div class="alert alert-info">
            <h5>بيانات المستخدمين المتاحة:</h5>
        </div>
        
        <div class="test-user">
            <h6>مدير النظام (Super Admin)</h6>
            <p><strong>الإيميل:</strong> admin@admin.com</p>
            <p><strong>كلمة المرور:</strong> admin123</p>
            <button class="btn btn-primary btn-test" onclick="testLogin('admin@admin.com', 'admin123')">اختبار تسجيل الدخول</button>
        </div>
        
        <div class="test-user">
            <h6>مدير الموقع (Admin)</h6>
            <p><strong>الإيميل:</strong> manager@admin.com</p>
            <p><strong>كلمة المرور:</strong> manager123</p>
            <button class="btn btn-success btn-test" onclick="testLogin('manager@admin.com', 'manager123')">اختبار تسجيل الدخول</button>
        </div>
        
        <div class="test-user">
            <h6>محمد عسكري (Super Admin)</h6>
            <p><strong>الإيميل:</strong> mo.askary@gmail.com</p>
            <p><strong>كلمة المرور:</strong> newpassword</p>
            <button class="btn btn-warning btn-test" onclick="testLogin('mo.askary@gmail.com', 'newpassword')">اختبار تسجيل الدخول</button>
        </div>
        
        <div class="test-user">
            <h6>أحمد محمد (Admin)</h6>
            <p><strong>الإيميل:</strong> ahmed@example.com</p>
            <p><strong>كلمة المرور:</strong> ahmed123</p>
            <button class="btn btn-info btn-test" onclick="testLogin('ahmed@example.com', 'ahmed123')">اختبار تسجيل الدخول</button>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('admin.login') }}" class="btn btn-secondary">الذهاب لصفحة تسجيل الدخول</a>
        </div>
        
        <div id="result" class="mt-4"></div>
    </div>

    <script>
        function testLogin(email, password) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '<div class="alert alert-info">جاري اختبار تسجيل الدخول...</div>';
            
            fetch('{{ route("admin.doLogin") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            })
            .then(response => {
                if (response.ok) {
                    resultDiv.innerHTML = '<div class="alert alert-success">✅ تم تسجيل الدخول بنجاح! يتم التوجيه الآن...</div>';
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.dashboard") }}';
                    }, 2000);
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-danger">❌ فشل في تسجيل الدخول. تحقق من البيانات.</div>';
                }
            })
            .catch(error => {
                resultDiv.innerHTML = '<div class="alert alert-danger">❌ حدث خطأ: ' + error.message + '</div>';
            });
        }
    </script>
</body>
</html>
