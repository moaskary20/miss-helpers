<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول سريع - Miss Helpers</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #ffa19c;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-admin {
            background: #dc3545;
            color: white;
        }
        .btn-admin:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        .btn-user {
            background: #28a745;
            color: white;
        }
        .btn-user:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        .btn-manager {
            background: #007bff;
            color: white;
        }
        .btn-manager:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        .form-control {
            margin: 10px 0;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        .form-control:focus {
            border-color: #ffa19c;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 class="text-center mb-4">تسجيل دخول سريع</h2>
        
        <!-- تسجيل دخول تلقائي -->
        <div class="mb-4">
            <h5>تسجيل دخول مباشر:</h5>
            
            <button class="btn btn-login btn-admin" onclick="quickLogin('admin@admin.com', 'admin123')">
                🔑 مدير النظام (admin@admin.com)
            </button>
            
            <button class="btn btn-login btn-user" onclick="quickLogin('mo.askary@gmail.com', 'newpassword')">
                👤 محمد عسكري (mo.askary@gmail.com)
            </button>
            
            <button class="btn btn-login btn-manager" onclick="quickLogin('manager@admin.com', 'manager123')">
                🛠️ مدير الموقع (manager@admin.com)
            </button>
        </div>
        
        <!-- تسجيل دخول يدوي -->
        <hr>
        <h5>تسجيل دخول يدوي:</h5>
        
        <form method="POST" action="{{ route('admin.doLogin') }}" id="manualForm">
            @csrf
            
            <input type="email" 
                   name="email" 
                   class="form-control" 
                   placeholder="البريد الإلكتروني"
                   value="admin@admin.com"
                   required>
            
            <input type="password" 
                   name="password" 
                   class="form-control" 
                   placeholder="كلمة المرور"
                   value="admin123"
                   required>
            
            <button type="submit" class="btn btn-primary btn-login">
                تسجيل الدخول
            </button>
        </form>
        
        <div class="mt-3 text-center">
            <small class="text-muted">
                جميع البيانات محققة ومحدثة ✅
            </small>
        </div>
    </div>

    <script>
        function quickLogin(email, password) {
            console.log('Quick login attempt:', email);
            
            // إنشاء نموذج مخفي
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.doLogin") }}';
            form.style.display = 'none';
            
            // إضافة CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfInput);
            
            // إضافة الإيميل
            const emailInput = document.createElement('input');
            emailInput.type = 'hidden';
            emailInput.name = 'email';
            emailInput.value = email;
            form.appendChild(emailInput);
            
            // إضافة كلمة المرور
            const passwordInput = document.createElement('input');
            passwordInput.type = 'hidden';
            passwordInput.name = 'password';
            passwordInput.value = password;
            form.appendChild(passwordInput);
            
            // إرسال النموذج
            document.body.appendChild(form);
            form.submit();
        }
        
        // تأكد من أن النموذج اليدوي يعمل
        document.getElementById('manualForm').addEventListener('submit', function(e) {
            const email = this.email.value.trim();
            const password = this.password.value.trim();
            
            if (!email || !password) {
                e.preventDefault();
                alert('يرجى ملء جميع الحقول');
                return false;
            }
            
            console.log('Manual form submission:', email);
        });
        
        console.log('Quick Login Page Loaded Successfully');
    </script>
</body>
</html>

