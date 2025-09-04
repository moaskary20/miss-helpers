# إصلاح مشكلة تسجيل الدخول

## المشكلة
المستخدم `mo.askary@gmail.com` مع كلمة المرور `newpassword` لا يستطيع تسجيل الدخول.

## الحل

### على السيرفر المحلي (تم إصلاحه)
تم إصلاح المشكلة بنجاح! يمكنك الآن تسجيل الدخول باستخدام:
- **البريد الإلكتروني**: `mo.askary@gmail.com`
- **كلمة المرور**: `newpassword`

### على السيرفر الخارجي
إذا كانت المشكلة موجودة على السيرفر أيضاً، قم بتشغيل هذا الأمر:

```bash
cd /var/www/misshelpers/miss-helpers
php artisan tinker
```

ثم في Tinker، قم بتشغيل:

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'mo.askary@gmail.com')->first();
$user->password = Hash::make('newpassword');
$user->save();

echo "تم إصلاح كلمة المرور بنجاح!";
exit
```

### أو استخدم هذا السكريبت
أنشئ ملف `fix_login.php` في مجلد المشروع:

```php
<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== إصلاح كلمة مرور المستخدم ===\n";

$user = User::where('email', 'mo.askary@gmail.com')->first();

if ($user) {
    echo "المستخدم موجود: " . $user->name . "\n";
    
    // إنشاء كلمة مرور جديدة
    $newPassword = 'newpassword';
    $hashedPassword = Hash::make($newPassword);
    
    // تحديث كلمة المرور
    $user->password = $hashedPassword;
    $user->save();
    
    // التحقق من التحديث
    $isValid = Hash::check($newPassword, $user->password);
    
    if ($isValid) {
        echo "✅ تم إصلاح كلمة المرور بنجاح!\n";
        echo "يمكنك الآن تسجيل الدخول باستخدام:\n";
        echo "البريد الإلكتروني: mo.askary@gmail.com\n";
        echo "كلمة المرور: newpassword\n";
    } else {
        echo "❌ فشل في إصلاح كلمة المرور\n";
    }
} else {
    echo "المستخدم غير موجود!\n";
}
```

ثم قم بتشغيله:

```bash
php fix_login.php
```

## التحقق من النجاح
بعد إصلاح المشكلة، يمكنك التحقق من خلال:

1. **تسجيل الدخول في Admin Panel**:
   - اذهب إلى: `https://your-domain.com/admin/login`
   - استخدم: `mo.askary@gmail.com` / `newpassword`

2. **التحقق من البيانات**:
   ```bash
   php artisan tinker
   ```
   ```php
   $user = \App\Models\User::where('email', 'mo.askary@gmail.com')->first();
   echo $user->name . ' - ' . $user->email . ' - ' . $user->role;
   ```

## ملاحظات مهمة
- تأكد من أن قاعدة البيانات محدثة
- تأكد من أن صلاحيات الملفات صحيحة
- تأكد من أن Laravel يعمل بشكل صحيح

## بيانات المستخدمين المتاحة
1. **مدير النظام**: `admin@admin.com` / `password`
2. **مدير الموقع**: `manager@admin.com` / `password`
3. **مشرف الموقع**: `moderator@admin.com` / `password`
4. **محرر الموقع**: `editor@admin.com` / `password`
5. **محمد عسكري**: `mo.askary@gmail.com` / `newpassword` ✅
6. **أحمد محمد**: `ahmed@example.com` / `password`
7. **فاطمة علي**: `fatima@example.com` / `password`
8. **سارة أحمد**: `sara@example.com` / `password`

## إذا استمرت المشكلة
1. تحقق من ملف `.env` - تأكد من إعدادات قاعدة البيانات
2. تحقق من logs Laravel: `storage/logs/laravel.log`
3. تأكد من أن المشروع محدث: `git pull origin main`
4. مسح الكاش: `php artisan cache:clear`
