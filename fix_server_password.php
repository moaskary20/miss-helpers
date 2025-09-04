<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

echo "=== إصلاح كلمة مرور المستخدم على السيرفر ===\n";

try {
    // البحث عن المستخدم
    $user = User::where('email', 'mo.askary@gmail.com')->first();
    
    if (!$user) {
        echo "❌ المستخدم غير موجود!\n";
        exit;
    }
    
    echo "✅ المستخدم موجود: " . $user->name . "\n";
    echo "البريد الإلكتروني: " . $user->email . "\n";
    echo "الدور: " . $user->role . "\n";
    echo "الحالة: " . $user->status . "\n";
    
    // إنشاء كلمة مرور جديدة
    $newPassword = '123456';
    
    echo "\n=== إصلاح كلمة المرور ===\n";
    echo "كلمة المرور الجديدة: " . $newPassword . "\n";
    
    // طريقة 1: استخدام Hash::make
    $hashedPassword1 = Hash::make($newPassword);
    echo "Hash::make: " . $hashedPassword1 . "\n";
    
    // طريقة 2: استخدام bcrypt مباشرة
    $hashedPassword2 = bcrypt($newPassword);
    echo "bcrypt: " . $hashedPassword2 . "\n";
    
    // طريقة 3: استخدام password_hash
    $hashedPassword3 = password_hash($newPassword, PASSWORD_DEFAULT);
    echo "password_hash: " . $hashedPassword3 . "\n";
    
    // تحديث كلمة المرور مباشرة في قاعدة البيانات
    echo "\n=== تحديث قاعدة البيانات ===\n";
    
    // جرب الطريقة الأولى
    $result1 = DB::table('users')
        ->where('email', 'mo.askary@gmail.com')
        ->update(['password' => $hashedPassword1]);
    
    echo "تحديث Hash::make: " . ($result1 ? 'نجح' : 'فشل') . "\n";
    
    // التحقق من التحديث
    $updatedUser = User::where('email', 'mo.askary@gmail.com')->first();
    $isValid1 = Hash::check($newPassword, $updatedUser->password);
    echo "فحص Hash::make: " . ($isValid1 ? '✅ صحيح' : '❌ خاطئ') . "\n";
    
    if (!$isValid1) {
        echo "\nجرب الطريقة الثانية...\n";
        
        // جرب الطريقة الثانية
        $result2 = DB::table('users')
            ->where('email', 'mo.askary@gmail.com')
            ->update(['password' => $hashedPassword2]);
        
        echo "تحديث bcrypt: " . ($result2 ? 'نجح' : 'فشل') . "\n";
        
        // التحقق من التحديث
        $updatedUser = User::where('email', 'mo.askary@gmail.com')->first();
        $isValid2 = Hash::check($newPassword, $updatedUser->password);
        echo "فحص bcrypt: " . ($isValid2 ? '✅ صحيح' : '❌ خاطئ') . "\n";
        
        if (!$isValid2) {
            echo "\nجرب الطريقة الثالثة...\n";
            
            // جرب الطريقة الثالثة
            $result3 = DB::table('users')
                ->where('email', 'mo.askary@gmail.com')
                ->update(['password' => $hashedPassword3]);
            
            echo "تحديث password_hash: " . ($result3 ? 'نجح' : 'فشل') . "\n";
            
            // التحقق من التحديث
            $updatedUser = User::where('email', 'mo.askary@gmail.com')->first();
            $isValid3 = Hash::check($newPassword, $updatedUser->password);
            echo "فحص password_hash: " . ($isValid3 ? '✅ صحيح' : '❌ خاطئ') . "\n";
        }
    }
    
    // اختبار نهائي
    echo "\n=== اختبار نهائي ===\n";
    $finalUser = User::where('email', 'mo.askary@gmail.com')->first();
    $finalCheck = Hash::check($newPassword, $finalUser->password);
    
    if ($finalCheck) {
        echo "✅ تم إصلاح كلمة المرور بنجاح!\n";
        echo "يمكنك الآن تسجيل الدخول باستخدام:\n";
        echo "البريد الإلكتروني: mo.askary@gmail.com\n";
        echo "كلمة المرور: " . $newPassword . "\n";
    } else {
        echo "❌ فشل في إصلاح كلمة المرور\n";
        echo "كلمة المرور الحالية: " . $finalUser->password . "\n";
        
        // جرب تحديث مباشر للعمود
        echo "\nجرب التحديث المباشر...\n";
        $directUpdate = DB::statement("UPDATE users SET password = ? WHERE email = ?", [
            Hash::make($newPassword),
            'mo.askary@gmail.com'
        ]);
        
        echo "التحديث المباشر: " . ($directUpdate ? 'نجح' : 'فشل') . "\n";
        
        // فحص نهائي
        $finalUser = User::where('email', 'mo.askary@gmail.com')->first();
        $finalCheck = Hash::check($newPassword, $finalUser->password);
        echo "الفحص النهائي: " . ($finalCheck ? '✅ صحيح' : '❌ خاطئ') . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ خطأ: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== انتهى الإصلاح ===\n";
