# إصلاح خطأ user_id في UserProfileController

## المشكلة:
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'user_id' in 'where clause' 
(Connection: mysql, SQL: select * from `service_requests` where `user_id` = 1)
app/Http/Controllers/UserProfileController.php :32
```

## السبب:
- كان الكود يحاول البحث عن `user_id` في جدول `service_requests`
- العمود `user_id` لم يكن موجوداً في قاعدة البيانات
- Migration لم يتم تشغيله بشكل صحيح

## الحل المطبق:

### 1. **تشغيل Migration:**
```bash
php artisan migrate
```
تم تشغيل migration `2025_09_10_155938_add_user_maid_to_service_requests_table` بنجاح

### 2. **تحديث UserProfileController:**
```php
// جلب الخادمات المرتبطة بالعميل من خلال طلبات الخدمة
$userMaids = collect();

// البحث عن طلبات الخدمة المرتبطة بالمستخدم
if ($user->phone) {
    $userServiceRequests = ServiceRequest::where('user_id', $user->id)
        ->orWhere('phone', $user->phone)
        ->with('maid')
        ->get();
        
    $userMaids = $userServiceRequests
        ->pluck('maid')
        ->unique('id')
        ->filter();
}
```

### 3. **المنطق الجديد:**
- البحث عن طلبات الخدمة المرتبطة بالمستخدم عبر `user_id`
- البحث أيضاً عبر رقم الهاتف (`phone`) لربط الطلبات العامة بالمستخدمين المسجلين
- جلب الخادمات المرتبطة بطلبات الخدمة هذه

## المميزات:

### ✅ **ربط ذكي:**
- يربط طلبات الخدمة بالمستخدمين المسجلين
- يبحث عبر `user_id` و `phone` للربط الأفضل

### ✅ **مرونة في الربط:**
- حتى لو لم يكن `user_id` محدداً، يمكن الربط عبر رقم الهاتف
- يدعم الطلبات العامة والطلبات المسجلة

### ✅ **أمان في الكود:**
- فحص وجود رقم الهاتف قبل البحث
- استخدام `collect()` للتعامل الآمن مع البيانات

## Migration Details:

### **العمود المضاف:**
```php
Schema::table('service_requests', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id')->nullable()->after('id');
    $table->unsignedBigInteger('maid_id')->nullable()->after('user_id');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('maid_id')->references('id')->on('maids')->onDelete('cascade');
});
```

### **العلاقات في Model:**
```php
// ServiceRequest.php
public function user()
{
    return $this->belongsTo(User::class);
}

public function maid()
{
    return $this->belongsTo(Maid::class);
}
```

## كيفية الاختبار:

### 1. **إنشاء مستخدم جديد:**
- سجل مستخدماً جديداً مع رقم هاتف
- تأكد من أن الحساب يعمل بشكل صحيح

### 2. **إنشاء طلب خدمة:**
- استخدم نفس رقم الهاتف في نموذج الاتصال
- تأكد من أن الطلب يتم ربطه بالمستخدم

### 3. **التحقق من البروفيل:**
- اذهب إلى صفحة البروفيل
- تأكد من عدم وجود أخطاء
- تحقق من ظهور الخادمات المرتبطة

## النتيجة:

### ✅ **إصلاح الخطأ:**
- لا مزيد من أخطاء `user_id` column not found
- الكود يعمل بشكل صحيح

### ✅ **تحسين الوظائف:**
- ربط أفضل بين المستخدمين وطلبات الخدمة
- دعم للطلبات العامة والمسجلة

### ✅ **استقرار النظام:**
- لا أخطاء في قاعدة البيانات
- كود آمن ومحمي

## ملاحظات مهمة:

### **للمطورين:**
- تأكد من تشغيل migrations قبل استخدام الأعمدة الجديدة
- استخدم `nullable()` للأعمدة الاختيارية
- أضف foreign keys للأمان والاتساق

### **للمستخدمين:**
- تأكد من إدخال رقم هاتف صحيح عند التسجيل
- سيتم ربط طلبات الخدمة تلقائياً بحسابك

🎉 **تم إصلاح المشكلة بنجاح!**
