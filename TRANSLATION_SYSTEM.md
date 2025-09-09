# نظام الترجمة - Translation System

تم تنفيذ نظام ترجمة شامل للموقع يدعم اللغتين العربية والإنجليزية.

## الميزات المنجزة

### 1. ملفات الترجمة
- **العربية**: `/resources/lang/ar/messages.php`
- **الإنجليزية**: `/resources/lang/en/messages.php`
- تحتوي على جميع النصوص المستخدمة في الموقع

### 2. Middleware للغة
- **SetLocale**: يحدد اللغة الحالية من الجلسة
- يتم تطبيقه على جميع الطلبات تلقائياً

### 3. Controller للغة
- **LanguageController**: يتعامل مع تغيير اللغة
- Route: `POST /language/switch`
- Route: `GET /language/current`

### 4. Helper Functions
- **TranslationHelper**: دوال مساعدة للترجمة
- دوال للتحقق من اللغة الحالية
- دوال للحصول على الاتجاه (RTL/LTR)

### 5. Partials
- **Header**: `/resources/views/partials/header.blade.php`
- **Modals**: `/resources/views/partials/modals.blade.php`
- يمكن إعادة استخدامها في جميع الصفحات

## كيفية الاستخدام

### 1. في Blade Templates
```php
{{ __('messages.home') }}
{{ __('messages.about') }}
{{ __('messages.services') }}
```

### 2. تغيير اللغة
```html
<form method="POST" action="{{ route('language.switch') }}">
    @csrf
    <input type="hidden" name="locale" value="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}">
    <button type="submit">{{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}</button>
</form>
```

### 3. التحقق من اللغة الحالية
```php
@if(app()->getLocale() === 'ar')
    // محتوى عربي
@else
    // English content
@endif
```

### 4. استخدام Helper Functions
```php
use App\Helpers\TranslationHelper;

// التحقق من اللغة
if (TranslationHelper::isArabic()) {
    // محتوى عربي
}

// الحصول على الاتجاه
$direction = TranslationHelper::getDirection(); // 'rtl' or 'ltr'

// الحصول على اللغة المعاكسة
$oppositeLang = TranslationHelper::getOppositeLanguage(); // 'en' or 'ar'
```

## إضافة ترجمات جديدة

### 1. إضافة مفتاح جديد في ملفات الترجمة
```php
// في /resources/lang/ar/messages.php
'new_key' => 'النص العربي',

// في /resources/lang/en/messages.php
'new_key' => 'English Text',
```

### 2. استخدام المفتاح الجديد
```php
{{ __('messages.new_key') }}
```

## الصفحات المحدثة

### 1. صفحة الملف الشخصي للخادمة
- تم تحديث جميع النصوص لتستخدم نظام الترجمة
- تم ربط زر "English" بتغيير اللغة
- تم تحديث الـ modals والـ forms

### 2. Partials
- Header مع زر تغيير اللغة
- Modals مع النصوص المترجمة

## كيفية إضافة صفحات جديدة

### 1. استخدام Partials
```php
@include('partials.header')
<!-- محتوى الصفحة -->
@include('partials.modals')
```

### 2. تحديث HTML Attributes
```html
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
```

### 3. استخدام النصوص المترجمة
```php
<h1>{{ __('messages.page_title') }}</h1>
<p>{{ __('messages.page_description') }}</p>
```

## ملاحظات مهمة

1. **اللغة الافتراضية**: العربية
2. **Fallback Language**: العربية
3. **Session Storage**: يتم حفظ اللغة في الجلسة
4. **Auto Detection**: يتم تطبيق اللغة تلقائياً على جميع الصفحات
5. **RTL Support**: دعم كامل للاتجاه من اليمين لليسار

## اختبار النظام

1. انتقل إلى أي صفحة في الموقع
2. اضغط على زر "English" في الـ header
3. ستتحول جميع النصوص إلى الإنجليزية
4. اضغط على زر "العربية" للعودة للعربية

## إضافة لغات جديدة

لإضافة لغة جديدة (مثل الفرنسية):

1. أنشئ مجلد جديد: `/resources/lang/fr/`
2. انسخ `messages.php` من الإنجليزية
3. ترجم النصوص إلى الفرنسية
4. أضف اللغة في `LanguageController`
5. حدث الـ middleware إذا لزم الأمر

## استكشاف الأخطاء

### 1. النص لا يظهر مترجماً
- تأكد من وجود المفتاح في ملف الترجمة
- تأكد من استخدام `__('messages.key')` بشكل صحيح

### 2. زر تغيير اللغة لا يعمل
- تأكد من وجود CSRF token
- تأكد من صحة الـ route

### 3. اللغة لا تتغير
- تأكد من تطبيق الـ middleware
- تأكد من حفظ اللغة في الجلسة

## الدعم

لأي استفسارات أو مشاكل، يرجى مراجعة:
1. ملفات الترجمة في `/resources/lang/`
2. `LanguageController` في `/app/Http/Controllers/`
3. `SetLocale` middleware في `/app/Http/Middleware/`
