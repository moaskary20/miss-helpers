# حساب العمر التلقائي من تاريخ الميلاد

## الميزة الجديدة
تم إضافة حساب العمر التلقائي في صفحة إضافة الخادمة الجديدة (`http://localhost:8000/admin/maids/create`).

## المميزات المضافة:

### 1. **حساب العمر التلقائي**
- يتم حساب العمر تلقائياً عند اختيار تاريخ الميلاد
- حساب دقيق يأخذ في الاعتبار الشهر واليوم
- تحديث فوري لحقل العمر

### 2. **التحقق من صحة العمر**
- التأكد من أن العمر ضمن الحدود المسموحة (18-65 سنة)
- عرض رسائل خطأ واضحة للعمر غير المسموح
- عرض رسائل نجاح للعمر الصحيح

### 3. **تجربة مستخدم محسنة**
- رسائل مرئية واضحة (أخضر للنجاح، أحمر للخطأ)
- تحديث الحقل تلقائياً بدون تدخل المستخدم
- تحسينات بصرية مع Bootstrap classes

## كيفية العمل:

### **عند اختيار تاريخ الميلاد:**
1. يتم حساب العمر تلقائياً
2. إذا كان العمر صحيح (18-65): 
   - ✅ يظهر العمر في الحقل
   - ✅ رسالة نجاح خضراء
   - ✅ حقل العمر يصبح أخضر
3. إذا كان العمر غير صحيح:
   - ❌ رسالة خطأ حمراء
   - ❌ حقل العمر يصبح أحمر
   - ❌ رسالة توضح المشكلة

### **الرسائل المختلفة:**
- **العمر أقل من 18:** "العمر يجب أن يكون 18 سنة أو أكثر"
- **العمر أكثر من 65:** "العمر يجب أن يكون 65 سنة أو أقل"
- **العمر صحيح:** "العمر المحسوب: X سنة"

## الكود المطبق:

### **JavaScript Function:**
```javascript
function calculateAge() {
    const birthDateInput = document.getElementById('birth_date');
    const ageInput = document.getElementById('age');
    
    if (birthDateInput.value) {
        const birthDate = new Date(birthDateInput.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        // التحقق من صحة العمر وإضافة الرسائل المناسبة
        if (age >= 18 && age <= 65) {
            ageInput.value = age;
            ageInput.classList.remove('is-invalid');
            ageInput.classList.add('is-valid');
            // إضافة رسالة نجاح
        } else {
            ageInput.classList.add('is-invalid');
            ageInput.classList.remove('is-valid');
            // إضافة رسالة خطأ
        }
    }
}
```

### **Event Listeners:**
```javascript
// حساب العمر عند تغيير تاريخ الميلاد
document.getElementById('birth_date').addEventListener('change', calculateAge);

// حساب العمر عند تحميل الصفحة إذا كان هناك قيمة
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('birth_date').value) {
        calculateAge();
    }
});
```

### **CSS Styling:**
```css
.valid-feedback {
    display: block;
    font-size: 0.875em;
    color: #198754;
}

.invalid-feedback {
    display: block;
    font-size: 0.875em;
    color: #dc3545;
}

.age-success {
    background-color: #d1e7dd;
    border: 1px solid #badbcc;
    border-radius: 0.375rem;
    padding: 0.5rem;
    margin-top: 0.25rem;
}

.age-error {
    background-color: #f8d7da;
    border: 1px solid #f5c2c7;
    border-radius: 0.375rem;
    padding: 0.5rem;
    margin-top: 0.25rem;
}

.form-control.is-valid {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
}

.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}
```

### **HTML Enhancement:**
```html
<div class="col-md-6">
    <div class="mb-3">
        <label for="age" class="form-label">العمر <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('age') is-invalid @enderror" 
               id="age" name="age" value="{{ old('age') }}" min="18" max="65" required>
        <small class="form-text text-muted">
            <i class="bi bi-info-circle"></i>
            سيتم حساب العمر تلقائياً عند اختيار تاريخ الميلاد
        </small>
        @error('age')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
```

## كيفية الاختبار:

### 1. **اختبار العمر الصحيح:**
- اذهب إلى `http://localhost:8000/admin/maids/create`
- اختر تاريخ ميلاد ينتج عمر بين 18-65 سنة
- يجب أن ترى العمر محسوباً تلقائياً مع رسالة نجاح خضراء

### 2. **اختبار العمر أقل من 18:**
- اختر تاريخ ميلاد حديث (مثل اليوم)
- يجب أن ترى رسالة خطأ حمراء: "العمر يجب أن يكون 18 سنة أو أكثر"

### 3. **اختبار العمر أكثر من 65:**
- اختر تاريخ ميلاد قديم جداً (مثل 1950)
- يجب أن ترى رسالة خطأ حمراء: "العمر يجب أن يكون 65 سنة أو أقل"

### 4. **اختبار التحديث التلقائي:**
- غير تاريخ الميلاد عدة مرات
- يجب أن يتحدث العمر فوراً مع كل تغيير

## المميزات:

### ✅ **دقة في الحساب:**
- يأخذ في الاعتبار الشهر واليوم
- لا يخطئ في حساب العمر

### ✅ **تحقق من صحة البيانات:**
- يمنع إدخال أعمار غير صحيحة
- رسائل خطأ واضحة ومفيدة

### ✅ **تجربة مستخدم ممتازة:**
- تحديث فوري بدون إعادة تحميل
- رسائل مرئية واضحة
- تصميم جذاب ومتجاوب

### ✅ **سهولة الاستخدام:**
- لا حاجة لحساب العمر يدوياً
- توفير الوقت والجهد
- تقليل الأخطاء البشرية

## النتيجة النهائية:

### ✅ **حساب تلقائي:**
- العمر يُحسب تلقائياً عند اختيار تاريخ الميلاد
- لا حاجة لتدخل المستخدم

### ✅ **تحقق من الصحة:**
- يتحقق من أن العمر ضمن الحدود المسموحة
- رسائل خطأ واضحة للقيم غير الصحيحة

### ✅ **تجربة مستخدم محسنة:**
- تحديث فوري ومرئي
- تصميم جذاب ومتجاوب
- رسائل واضحة ومفيدة

### ✅ **توفير الوقت:**
- لا حاجة لحساب العمر يدوياً
- تقليل الأخطاء
- سرعة في إدخال البيانات

🎉 **الآن يمكن للمدير إدخال تاريخ الميلاد والحصول على العمر محسوباً تلقائياً!**
