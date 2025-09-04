# تعليمات نشر التحديثات على السيرفر

## الخطوات المطلوبة بعد git pull origin main:

### 1. مسح الكاش
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 2. تحديث قاعدة البيانات (إذا لزم الأمر)
```bash
php artisan migrate
```

### 3. إنشاء رابط التخزين (إذا لم يكن موجود)
```bash
php artisan storage:link
```

### 4. تحديث الصلاحيات
```bash
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### 5. إعادة تشغيل الخدمات (إذا لزم الأمر)
```bash
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm
```

## ملاحظات مهمة:

- تأكد من أن متغير APP_URL في ملف .env يشير إلى السيرفر الصحيح
- تأكد من أن مجلد storage/app/public موجود وله الصلاحيات الصحيحة
- إذا كانت الصور لا تظهر، تحقق من رابط التخزين: php artisan storage:link
