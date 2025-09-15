<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - Miss Helpers</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }
        .login-header {
            background: linear-gradient(135deg, #23336b 0%, #4a5fc1 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .login-header h1 {
            font-weight: 800;
            font-size: 2rem;
            margin: 0;
        }
        .login-body {
            padding: 40px 30px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .test-credentials {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .test-credential {
            background: white;
            border-radius: 8px;
            padding: 10px;
            margin: 5px 0;
            border-left: 4px solid #28a745;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="bi bi-shield-lock"></i> تسجيل الدخول</h1>
            <p class="mb-0">لوحة إدارة Miss Helpers</p>
        </div>
        
        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.doLogin') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', 'admin@admin.com') }}" 
                           placeholder="أدخل بريدك الإلكتروني"
                           required 
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           value="admin123"
                           placeholder="أدخل كلمة المرور"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary btn-login" onclick="validateForm(event)">
                    <i class="bi bi-box-arrow-in-right"></i> تسجيل الدخول
                </button>
            </form>

            <div class="test-credentials">
                <h6><i class="bi bi-info-circle"></i> بيانات الاختبار:</h6>
                
                <div class="test-credential">
                    <strong>مدير النظام:</strong><br>
                    <small>الإيميل: admin@admin.com</small><br>
                    <small>كلمة المرور: admin123</small>
                    <button class="btn btn-sm btn-success ms-2" onclick="fillCredentials('admin@admin.com', 'admin123')">استخدام</button>
                </div>
                
                <div class="test-credential">
                    <strong>محمد عسكري:</strong><br>
                    <small>الإيميل: mo.askary@gmail.com</small><br>
                    <small>كلمة المرور: newpassword</small>
                    <button class="btn btn-sm btn-success ms-2" onclick="fillCredentials('mo.askary@gmail.com', 'newpassword')">استخدام</button>
                </div>
                
                <div class="test-credential">
                    <strong>مدير الموقع:</strong><br>
                    <small>الإيميل: manager@admin.com</small><br>
                    <small>كلمة المرور: manager123</small>
                    <button class="btn btn-sm btn-success ms-2" onclick="fillCredentials('manager@admin.com', 'manager123')">استخدام</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm(event) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            
            console.log('Email:', email);
            console.log('Password:', password);
            
            if (!email) {
                alert('البريد الإلكتروني مطلوب');
                event.preventDefault();
                return false;
            }
            
            if (!password) {
                alert('كلمة المرور مطلوبة');
                event.preventDefault();
                return false;
            }
            
            console.log('Form validation passed');
            return true;
        }

        function fillCredentials(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }

        // اختبار تسجيل الدخول
        function testLogin(email, password) {
            const formData = new FormData();
            formData.append('email', email);
            formData.append('password', password);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            fetch('{{ route("admin.doLogin") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    alert('✅ تم تسجيل الدخول بنجاح!');
                    window.location.href = '{{ route("admin.dashboard") }}';
                } else {
                    alert('❌ فشل في تسجيل الدخول');
                }
            })
            .catch(error => {
                alert('❌ خطأ: ' + error.message);
            });
        }

        console.log('Simple Login Page Loaded');
        console.log('Available credentials:');
        console.log('- admin@admin.com / admin123');
        console.log('- mo.askary@gmail.com / newpassword');
        console.log('- manager@admin.com / manager123');
    </script>
</body>
</html>
