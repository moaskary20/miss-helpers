# 🚀 دليل تشغيل الخادم

## ❌ **المشكلة:**
أنت في المجلد الخطأ! يجب أن تكون في مجلد Laravel الصحيح.

## ✅ **الحل:**

### **1. انتقل للمجلد الصحيح:**
```bash
cd /media/mohamed/3E16609616605147/misshelpers/misshelpers
```

### **2. تأكد من أنك في المجلد الصحيح:**
```bash
ls -la artisan
```
يجب أن ترى ملف `artisan`

### **3. شغل الخادم:**
```bash
php artisan serve --port=8000
```

### **4. افتح المتصفح:**
```
http://localhost:8000/admin/quick-login
```

## 🔧 **إذا لم يعمل:**

### **حل بديل 1 - تشغيل في الخلفية:**
```bash
php artisan serve --port=8000 &
```

### **حل بديل 2 - تشغيل على منفذ آخر:**
```bash
php artisan serve --port=8080
```
ثم اذهب إلى: `http://localhost:8080/admin/quick-login`

### **حل بديل 3 - صفحة اختبار:**
```
http://localhost:8000/test-login.html
```

## 📁 **المجلدات:**

### **❌ المجلد الخطأ:**
```
/media/mohamed/3E16609616605147/misshelpers/
```

### **✅ المجلد الصحيح:**
```
/media/mohamed/3E16609616605147/misshelpers/misshelpers/
```

## 🎯 **الخطوات الكاملة:**

```bash
# 1. انتقل للمجلد الصحيح
cd /media/mohamed/3E16609616605147/misshelpers/misshelpers

# 2. تأكد من وجود ملف artisan
ls -la artisan

# 3. شغل الخادم
php artisan serve --port=8000

# 4. افتح المتصفح
# http://localhost:8000/admin/quick-login
```

## ✅ **بيانات تسجيل الدخول:**

### **مدير النظام:**
- الإيميل: `admin@admin.com`
- كلمة المرور: `admin123`

### **محمد عسكري:**
- الإيميل: `mo.askary@gmail.com`
- كلمة المرور: `newpassword`

### **مدير الموقع:**
- الإيميل: `manager@admin.com`
- كلمة المرور: `manager123`

## 🚀 **النتيجة:**

**بعد تشغيل الخادم من المجلد الصحيح، ستتمكن من الوصول لجميع الصفحات!**

