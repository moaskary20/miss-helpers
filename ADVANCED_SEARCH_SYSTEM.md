# نظام البحث المتقدم في صفحة الخادمات

## الميزة الجديدة
تم تطوير نظام بحث قوي ومتقدم في صفحة الخادمات (`http://localhost:8000/maids`) مع إمكانية البحث حسب معايير متعددة.

## المميزات المضافة:

### 1. **البحث النصي الذكي**
- ✅ البحث في الاسم، الجنسية، نوع الخدمة، والمهارات
- ✅ بحث فوري مع تأخير ذكي (800ms)
- ✅ دعم البحث الجزئي والكامل

### 2. **فلاتر البحث المتقدمة**
- ✅ **الجنسية:** جميع الجنسيات المتاحة
- ✅ **نوع الخدمة:** جميع الوظائف المتاحة
- ✅ **سنوات الخبرة:** 1-3، 4-6، 7-10، أكثر من 10
- ✅ **نوع الباقة:** الباقة التقليدية، الباقة المرنة
- ✅ **الحالة:** متاحة، غير متاحة
- ✅ **الديانة:** جميع الديانات المتاحة
- ✅ **الحالة الاجتماعية:** جميع الحالات المتاحة
- ✅ **اللغة:** جميع اللغات المتاحة

### 3. **فلاتر نطاقية**
- ✅ **نطاق العمر:** من 18 إلى 65 سنة
- ✅ **نطاق الراتب الشهري:** حد أدنى وأقصى بالدرهم الإماراتي

### 4. **ترتيب النتائج**
- ✅ الأحدث أولاً / الأقدم أولاً
- ✅ العمر (الأصغر/الأكبر أولاً)
- ✅ الخبرة (الأكثر/الأقل خبرة)
- ✅ الراتب (الأقل/الأعلى أولاً)
- ✅ الأكثر مشاهدة

### 5. **تجربة مستخدم محسنة**
- ✅ بحث تلقائي عند تغيير الفلاتر
- ✅ حفظ الفلاتر في localStorage
- ✅ عرض الفلاتر المطبقة
- ✅ إحصائيات البحث المفصلة
- ✅ واجهة متجاوبة وجذابة

## كيفية العمل:

### **البحث الأساسي:**
```
🔍 البحث النصي: "خادمة منزلية سريلانكية"
```

### **البحث المتقدم:**
```
📋 الجنسية: سريلانكا
🏠 نوع الخدمة: خادمة منزلية
⭐ سنوات الخبرة: 4-6 سنوات
📦 نوع الباقة: الباقة التقليدية
✅ الحالة: متاحة
```

### **البحث النطاقي:**
```
👤 العمر: 25-40 سنة
💰 الراتب: 1500-2500 درهم
```

### **الترتيب:**
```
📊 ترتيب حسب: الأكثر خبرة
```

## الكود المطبق:

### **MaidController - منطق البحث:**
```php
public function index(Request $request)
{
    $query = Maid::query();

    // فلترة حسب الجنسية
    if ($request->filled('nationality')) {
        $query->where('nationality', $request->nationality);
    }

    // فلترة حسب نوع الخدمة
    if ($request->filled('service')) {
        $query->where('job_title', $request->service);
    }

    // فلترة حسب سنوات الخبرة
    if ($request->filled('experience')) {
        switch ($request->experience) {
            case '1-3':
                $query->whereBetween('experience_years', [1, 3]);
                break;
            case '4-6':
                $query->whereBetween('experience_years', [4, 6]);
                break;
            case '7-10':
                $query->whereBetween('experience_years', [7, 10]);
                break;
            case '10+':
                $query->where('experience_years', '>', 10);
                break;
        }
    }

    // البحث النصي
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('skills', 'like', "%{$searchTerm}%")
              ->orWhere('nationality', 'like', "%{$searchTerm}%")
              ->orWhere('job_title', 'like', "%{$searchTerm}%");
        });
    }

    // ترتيب النتائج
    $sortBy = $request->get('sort', 'latest');
    switch ($sortBy) {
        case 'experience_desc':
            $query->orderBy('experience_years', 'desc');
            break;
        case 'age_asc':
            $query->orderBy('age', 'asc');
            break;
        // ... المزيد من خيارات الترتيب
    }

    return view('maid.all', compact('maids', 'searchOptions', 'totalMaids', 'filteredCount'));
}
```

### **JavaScript - البحث التلقائي:**
```javascript
// البحث التلقائي عند تغيير الفلاتر
filterSelects.forEach(select => {
    select.addEventListener('change', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            searchForm.submit();
        }, 500);
    });
});

// البحث النصي مع تأخير
searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        if (this.value.length >= 2 || this.value.length === 0) {
            searchForm.submit();
        }
    }, 800);
});

// حفظ الفلاتر في localStorage
filterSelects.forEach(select => {
    select.addEventListener('change', function() {
        localStorage.setItem(`filter_${this.name}`, this.value);
    });
});
```

### **HTML - واجهة البحث:**
```html
<form method="GET" action="{{ route('maids.all') }}" id="searchForm">
    <!-- البحث النصي -->
    <input type="text" name="search" class="form-control" 
           placeholder="ابحث بالاسم، الجنسية، أو نوع الخدمة..." 
           value="{{ request('search') }}">

    <!-- فلاتر البحث -->
    <select name="nationality" class="form-select">
        <option value="">جميع الجنسيات</option>
        @foreach($searchOptions['nationalities'] as $nationality)
            <option value="{{ $nationality }}">{{ $nationality }}</option>
        @endforeach
    </select>

    <!-- فلاتر نطاقية -->
    <input type="number" name="age_min" placeholder="الحد الأدنى للعمر">
    <input type="number" name="age_max" placeholder="الحد الأقصى للعمر">
</form>
```

## كيفية الاختبار:

### 1. **البحث النصي:**
- اذهب إلى `http://localhost:8000/maids`
- اكتب "سريلانكا" في مربع البحث النصي
- يجب أن تظهر النتائج فوراً

### 2. **البحث بالفلاتر:**
- اختر جنسية من القائمة المنسدلة
- اختر نوع خدمة
- اختر سنوات خبرة
- اضغط "بحث"

### 3. **البحث النطاقي:**
- أدخل حد أدنى للعمر (مثل 25)
- أدخل حد أقصى للعمر (مثل 40)
- أدخل نطاق راتب شهري

### 4. **ترتيب النتائج:**
- اختر "الأكثر خبرة" من قائمة الترتيب
- يجب أن تظهر النتائج مرتبة حسب الخبرة

### 5. **البحث المركب:**
- اجمع عدة فلاتر معاً
- يجب أن تظهر النتائج التي تطابق جميع المعايير

## المميزات المتقدمة:

### ✅ **البحث الذكي:**
- بحث فوري مع تأخير ذكي
- دعم البحث الجزئي
- حفظ الفلاتر تلقائياً

### ✅ **واجهة متجاوبة:**
- تصميم جذاب ومتجاوب
- فلاتر متقدمة قابلة للإخفاء
- رسائل حالة واضحة

### ✅ **إحصائيات مفصلة:**
- عدد النتائج المفلترة
- عرض الفلاتر المطبقة
- وقت آخر تحديث

### ✅ **أداء محسن:**
- استعلامات قاعدة بيانات محسنة
- تحميل العلاقات بشكل ذكي
- pagination فعال

## النتيجة النهائية:

### ✅ **نظام بحث قوي:**
- 10+ معايير بحث مختلفة
- بحث نصي ذكي
- فلاتر نطاقية متقدمة

### ✅ **تجربة مستخدم ممتازة:**
- بحث فوري وتلقائي
- واجهة سهلة الاستخدام
- نتائج سريعة ودقيقة

### ✅ **مرونة في البحث:**
- إمكانية البحث بمعيار واحد أو عدة معايير
- ترتيب النتائج حسب احتياجات المستخدم
- حفظ تفضيلات البحث

### ✅ **أداء محسن:**
- استعلامات محسنة لقاعدة البيانات
- تحميل سريع للنتائج
- تجربة مستخدم سلسة

🎉 **الآن يمكن للعملاء البحث عن الخادمات المناسبة لهم بسهولة ودقة!**
