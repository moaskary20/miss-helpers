# عداد الرسائل غير المقروءة في لوحة الإدارة

## الميزة الجديدة
تم إضافة عداد للرسائل غير المقروءة أعلى كلمة "إدارة الشات" في القائمة الجانبية للوحة الإدارة.

## المميزات المضافة:

### 1. **عداد مرئي للرسائل غير المقروءة**
- يظهر بجانب "إدارة الشات" في القائمة الجانبية
- لون أحمر جذاب مع تأثير pulse
- يختفي تلقائياً عند عدم وجود رسائل غير مقروءة

### 2. **تحديث تلقائي**
- يتم تحديث العداد كل 30 ثانية تلقائياً
- لا حاجة لإعادة تحميل الصفحة
- تحديث فوري عند وصول رسائل جديدة

### 3. **تصميم جذاب**
- شارة حمراء صغيرة مع تأثير pulse
- متجاوب مع جميع الأجهزة
- يتناسب مع تصميم لوحة الإدارة

## كيفية العمل:

### **في القائمة الجانبية:**
```
📱 إدارة الشات [3] ← العداد يظهر هنا
```

### **عند عدم وجود رسائل غير مقروءة:**
```
📱 إدارة الشات ← بدون عداد
```

## التحديثات المطبقة:

### 1. **تحديث Layout (admin/layout.blade.php):**
- إضافة PHP code لحساب الرسائل غير المقروءة
- إضافة CSS للعداد مع تأثير pulse
- إضافة JavaScript للتحديث التلقائي

### 2. **إضافة Route جديد:**
```php
Route::get('/chat/unread-count', [ChatController::class, 'getUnreadCount'])
```

### 3. **إضافة Method في ChatController:**
```php
public function getUnreadCount()
{
    $unreadCount = ChatMessage::where('sender_type', 'visitor')
        ->where('is_read', false)
        ->count();

    return response()->json([
        'success' => true,
        'count' => $unreadCount
    ]);
}
```

## كيفية الاختبار:

### 1. **إرسال رسالة من الشات:**
- اذهب إلى الصفحة الرئيسية
- أرسل رسالة من الشات
- انتظر بضع ثوان

### 2. **التحقق من العداد:**
- اذهب إلى لوحة الإدارة
- انظر إلى القائمة الجانبية
- يجب أن ترى عداد أحمر بجانب "إدارة الشات"

### 3. **قراءة الرسالة:**
- اضغط على "إدارة الشات"
- اضغط على "عرض" لأي غرفة شات
- العداد يجب أن يختفي أو ينقص

## الكود المطبق:

### **HTML Structure:**
```html
<a class="nav-link" href="{{ route('admin.chat.index') }}">
    <i class="bi bi-chat-dots"></i>
    إدارة الشات
    @if($unreadChatMessages > 0)
        <span class="badge bg-danger ms-2">{{ $unreadChatMessages }}</span>
    @endif
</a>
```

### **CSS Styling:**
```css
.sidebar .nav-link .badge {
    font-size: 0.7rem;
    padding: 4px 6px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}
```

### **JavaScript Auto-Update:**
```javascript
function updateUnreadMessagesCount() {
    fetch('/admin/chat/unread-count', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // تحديث العداد
    });
}

// تحديث كل 30 ثانية
setInterval(updateUnreadMessagesCount, 30000);
```

## النتيجة النهائية:

### ✅ **عداد مرئي:**
- يظهر عدد الرسائل غير المقروءة
- لون أحمر جذاب
- تأثير pulse يجذب الانتباه

### ✅ **تحديث تلقائي:**
- كل 30 ثانية
- لا حاجة لإعادة تحميل
- تحديث فوري

### ✅ **تجربة مستخدم محسنة:**
- المدير يعرف فوراً عند وصول رسائل جديدة
- لا يفوت أي رسالة
- سهولة في المتابعة

### ✅ **تصميم متجاوب:**
- يعمل على جميع الأجهزة
- يتناسب مع تصميم الموقع
- سهل القراءة

## استكشاف الأخطاء:

### **إذا لم يظهر العداد:**
1. تحقق من Console في Developer Tools
2. تأكد من وجود رسائل غير مقروءة
3. تحقق من route `/admin/chat/unread-count`

### **إذا لم يتم التحديث:**
1. تحقق من JavaScript errors
2. تأكد من اتصال الإنترنت
3. تحقق من CSRF token

🎉 **الآن المدير سيعرف فوراً عند وصول رسائل جديدة من الزوار!**
