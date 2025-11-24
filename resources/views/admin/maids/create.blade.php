@extends('admin.layout')

@section('title', 'إضافة خادمة جديدة')
@section('page-title', 'إضافة خادمة جديدة')

@section('content')
<style>
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
</style>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="bi bi-person-plus"></i>
                إضافة خادمة جديدة
            </h2>
            <a href="{{ route('admin.maids.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة للقائمة
            </a>
        </div>
    </div>
</div>

<form action="{{ route('admin.maids.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <!-- المعلومات الشخصية -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person"></i>
                        المعلومات الشخصية
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nationality" class="form-label">الجنسية <span class="text-danger">*</span></label>
                        <select class="form-select @error('nationality') is-invalid @enderror" 
                                id="nationality" name="nationality" required>
                            <option value="">اختر الجنسية</option>
                            @foreach(\App\Models\Maid::getAvailableNationalities() as $key => $value)
                                <option value="{{ $key }}" {{ old('nationality') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('nationality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="video" class="form-label">فيديو الخادمة</label>
                        <input type="file" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" accept="video/*">
                        <div class="form-text">يمكن رفع ملفات الفيديو بصيغة MP4, AVI, MOV, WMV (حد أقصى 40MB)</div>
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">صورة الخادمة</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        <div class="form-text">يمكن رفع الصور بصيغة JPG, PNG, GIF (حد أقصى 5MB)</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="religion" class="form-label">الديانة <span class="text-danger">*</span></label>
                                <select class="form-select @error('religion') is-invalid @enderror" 
                                        id="religion" name="religion" required>
                                    <option value="">اختر الديانة</option>
                                    <option value="مسلمة" {{ old('religion') == 'مسلمة' ? 'selected' : '' }}>مسلمة</option>
                                    <option value="مسيحية" {{ old('religion') == 'مسيحية' ? 'selected' : '' }}>مسيحية</option>
                                    <option value="أخرى" {{ old('religion') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
                                </select>
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="language" class="form-label">اللغة <span class="text-danger">*</span></label>
                                <select class="form-select @error('language') is-invalid @enderror" 
                                        id="language" name="language" required>
                                    <option value="">اختر اللغة</option>
                                    <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>English</option>
                                    <option value="Little English" {{ old('language') == 'Little English' ? 'selected' : '' }}>Little English</option>
                                    <option value="Arabic" {{ old('language') == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                                    <option value="Little Arabic" {{ old('language') == 'Little Arabic' ? 'selected' : '' }}>Little Arabic</option>
                                    <option value="English & L.Arabic" {{ old('language') == 'English & L.Arabic' ? 'selected' : '' }}>English & L.Arabic</option>
                                    <option value="Arabic & L.English" {{ old('language') == 'Arabic & L.English' ? 'selected' : '' }}>Arabic & L.English</option>
                                </select>
                                @error('language')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                       id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
                    </div>
                    
                    <div class="mb-3">
                        <label for="education" class="form-label">التعليم <span class="text-danger">*</span></label>
                        <select class="form-select @error('education') is-invalid @enderror" 
                                id="education" name="education" required>
                            <option value="">اختر مستوى التعليم</option>
                            <option value="ابتدائي" {{ old('education') == 'ابتدائي' ? 'selected' : '' }}>ابتدائي</option>
                            <option value="متوسط" {{ old('education') == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                            <option value="ثانوي" {{ old('education') == 'ثانوي' ? 'selected' : '' }}>ثانوي</option>
                            <option value="جامعي" {{ old('education') == 'جامعي' ? 'selected' : '' }}>جامعي</option>
                            <option value="أمي" {{ old('education') == 'أمي' ? 'selected' : '' }}>أمي</option>
                        </select>
                        @error('education')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="marital_status" class="form-label">الحالة الاجتماعية <span class="text-danger">*</span></label>
                                <select class="form-select @error('marital_status') is-invalid @enderror" 
                                        id="marital_status" name="marital_status" required>
                                    <option value="">اختر الحالة الاجتماعية</option>
                                    <option value="عزباء" {{ old('marital_status') == 'عزباء' ? 'selected' : '' }}>عزباء</option>
                                    <option value="متزوجة" {{ old('marital_status') == 'متزوجة' ? 'selected' : '' }}>متزوجة</option>
                                    <option value="مطلقة" {{ old('marital_status') == 'مطلقة' ? 'selected' : '' }}>مطلقة</option>
                                    <option value="أرملة" {{ old('marital_status') == 'أرملة' ? 'selected' : '' }}>أرملة</option>
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="children_count" class="form-label">عدد الأطفال <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('children_count') is-invalid @enderror" 
                                       id="children_count" name="children_count" value="{{ old('children_count') }}" 
                                       min="0" max="10" required>
                                @error('children_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="height" class="form-label">الطول (سم)</label>
                                <input type="number" class="form-control @error('height') is-invalid @enderror" 
                                       id="height" name="height" value="{{ old('height') }}" min="100" max="250" step="0.1">
                                @error('height')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="weight" class="form-label">الوزن (كجم)</label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" 
                                       id="weight" name="weight" value="{{ old('weight') }}" min="30" max="150" step="0.1">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="experience_years" class="form-label">سنوات الخبرة (محسوبة تلقائياً)</label>
                        <input type="number" class="form-control @error('experience_years') is-invalid @enderror" 
                               id="experience_years" name="experience_years" value="{{ old('experience_years') }}" 
                               min="0" max="50" readonly>
                        <small class="form-text text-muted">سيتم حساب سنوات الخبرة تلقائياً من مجموع مدة خبرات العمل السابقة</small>
                        @error('experience_years')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- معلومات العقد -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-file-earmark-text"></i>
                        معلومات العقد
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="package_type" class="form-label">نوع الباقة <span class="text-danger">*</span></label>
                        <select class="form-select @error('package_type') is-invalid @enderror" 
                                id="package_type" name="package_type" required>
                            <option value="">اختر نوع الباقة</option>
                            <option value="الباقة التقليدية" {{ old('package_type') == 'الباقة التقليدية' ? 'selected' : '' }}>الباقة التقليدية</option>
                            <option value="الباقة المرنة" {{ old('package_type') == 'الباقة المرنة' ? 'selected' : '' }}>الباقة المرنة</option>
                        </select>
                        @error('package_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="job_title" class="form-label">الوظيفة <span class="text-danger">*</span></label>
                        <select class="form-select @error('job_title') is-invalid @enderror" 
                                id="job_title" name="job_title" required>
                            <option value="">اختر الوظيفة</option>
                            <optgroup label="الباقة التقليدية">
                                <option value="عاملة منزلية" {{ old('job_title') == 'عاملة منزلية' ? 'selected' : '' }}>عاملة منزلية</option>
                                <option value="مربية أطفال" {{ old('job_title') == 'مربية أطفال' ? 'selected' : '' }}>مربية أطفال</option>
                                <option value="رعاية كبار السن" {{ old('job_title') == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                <option value="طباخة" {{ old('job_title') == 'طباخة' ? 'selected' : '' }}>طباخة</option>
                                <option value="سائقة" {{ old('job_title') == 'سائقة' ? 'selected' : '' }}>سائقة</option>
                            </optgroup>
                            <optgroup label="الباقة المرنة">
                                <option value="عاملة منزلية" {{ old('job_title') == 'عاملة منزلية' ? 'selected' : '' }}>عاملة منزلية</option>
                                <option value="مربية أطفال" {{ old('job_title') == 'مربية أطفال' ? 'selected' : '' }}>مربية أطفال</option>
                                <option value="رعاية كبار السن" {{ old('job_title') == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                <option value="طباخة" {{ old('job_title') == 'طباخة' ? 'selected' : '' }}>طباخة</option>
                                <option value="سائقة" {{ old('job_title') == 'سائقة' ? 'selected' : '' }}>سائقة</option>
                            </optgroup>
                        </select>
                        @error('job_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="contract_type" class="form-label">نوع العقد <span class="text-danger">*</span></label>
                        <select class="form-select @error('contract_type') is-invalid @enderror" 
                                id="contract_type" name="contract_type" required>
                            <option value="">اختر نوع العقد</option>
                            <option value="عقد سنتين" {{ old('contract_type') == 'عقد سنتين' ? 'selected' : '' }}>عقد سنتين</option>
                            <option value="عقد شهري" {{ old('contract_type') == 'عقد شهري' ? 'selected' : '' }}>عقد شهري</option>
                        </select>
                        @error('contract_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="contract_fees" class="form-label">رسوم العقد (درهم إماراتي)</label>
                        <input type="number" class="form-control @error('contract_fees') is-invalid @enderror" 
                               id="contract_fees" name="contract_fees" value="{{ old('contract_fees') }}" 
                               min="0" step="0.01">
                        @error('contract_fees')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="monthly_salary" class="form-label">الراتب الشهري (درهم إماراتي)</label>
                        <input type="number" class="form-control @error('monthly_salary') is-invalid @enderror" 
                               id="monthly_salary" name="monthly_salary" value="{{ old('monthly_salary') }}" 
                               min="0" step="0.01">
                        @error('monthly_salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- المهارات -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-award"></i>
                        المهارات
                    </h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSkill()">
                        <i class="bi bi-plus"></i>
                        إضافة مهارة
                    </button>
                </div>
                <div class="card-body">
                    <div id="skills-container">
                        <div class="skill-item row mb-3">
                            <div class="col-md-5">
                                <select class="form-select @error('skills.0.skill_name') is-invalid @enderror" 
                                        name="skills[0][skill_name]" required>
                                    <option value="">اختر المهارة</option>
                                    <option value="تنظيف" {{ old('skills.0.skill_name') == 'تنظيف' ? 'selected' : '' }}>تنظيف</option>
                                    <option value="غسيل" {{ old('skills.0.skill_name') == 'غسيل' ? 'selected' : '' }}>غسيل</option>
                                    <option value="كوي" {{ old('skills.0.skill_name') == 'كوي' ? 'selected' : '' }}>كوي</option>
                                    <option value="طبخ" {{ old('skills.0.skill_name') == 'طبخ' ? 'selected' : '' }}>طبخ</option>
                                    <option value="رعاية اطفال" {{ old('skills.0.skill_name') == 'رعاية اطفال' ? 'selected' : '' }}>رعاية اطفال</option>
                                    <option value="رعاية كبار السن" {{ old('skills.0.skill_name') == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                    <option value="سائقة" {{ old('skills.0.skill_name') == 'سائقة' ? 'selected' : '' }}>سائقة</option>
                                </select>
                                @error('skills.0.skill_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('skills.0.description') is-invalid @enderror" 
                                       name="skills[0][description]" placeholder="وصف المهارة (اختياري)" 
                                       value="{{ old('skills.0.description') }}">
                                @error('skills.0.description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-danger" onclick="removeSkill(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- خبرات العمل السابقة -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-briefcase"></i>
                        خبرات العمل السابقة
                    </h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addWorkExperience()">
                        <i class="bi bi-plus"></i>
                        إضافة خبرة عمل
                    </button>
                </div>
                <div class="card-body">
                    <div id="work-experiences-container">
                        <!-- سيتم إضافة خبرات العمل هنا عند الضغط على "إضافة خبرة عمل" -->
                        <p class="text-muted">يمكنك إضافة خبرات العمل السابقة (اختياري)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- أزرار الحفظ -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary btn-lg me-3">
                        <i class="bi bi-check-circle"></i>
                        حفظ الخادمة
                    </button>
                    <a href="{{ route('admin.maids.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-x-circle"></i>
                        إلغاء
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    let skillIndex = 1;
    let workExperienceIndex = 1;

    function addSkill() {
        const container = document.getElementById('skills-container');
        const skillItem = document.createElement('div');
        skillItem.className = 'skill-item row mb-3';
        skillItem.innerHTML = `
            <div class="col-md-5">
                <select class="form-select" name="skills[${skillIndex}][skill_name]" required>
                    <option value="">اختر المهارة</option>
                    <option value="تنظيف">تنظيف</option>
                    <option value="غسيل">غسيل</option>
                    <option value="كوي">كوي</option>
                    <option value="طبخ">طبخ</option>
                    <option value="رعاية اطفال">رعاية اطفال</option>
                    <option value="رعاية كبار السن">رعاية كبار السن</option>
                    <option value="سائقة">سائقة</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="skills[${skillIndex}][description]" 
                       placeholder="وصف المهارة (اختياري)">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger" onclick="removeSkill(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(skillItem);
        skillIndex++;
    }

    function removeSkill(button) {
        button.closest('.skill-item').remove();
    }

    function addWorkExperience() {
        const container = document.getElementById('work-experiences-container');
        
        // إزالة الرسالة التوضيحية إذا كانت موجودة
        const infoText = container.querySelector('p.text-muted');
        if (infoText) {
            infoText.remove();
        }
        
        const workItem = document.createElement('div');
        workItem.className = 'work-experience-item row mb-3';
        workItem.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">الوظيفة</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][position]" 
                       placeholder="الوظيفة">
            </div>
            <div class="col-md-4">
                <label class="form-label">البلد</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][country]" 
                       placeholder="البلد">
            </div>
            <div class="col-md-3">
                <label class="form-label">المدة</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][duration]" 
                       placeholder="المدة" oninput="calculateExperienceYears()">
            </div>
            <div class="col-md-1">
                <label class="form-label">&nbsp;</label>
                <button type="button" class="btn btn-outline-danger d-block" onclick="removeWorkExperience(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        
        container.appendChild(workItem);
        workExperienceIndex++;
    }

    function removeWorkExperience(button) {
        // إزالة صف خبرة العمل الواحد
        const workItem = button.closest('.work-experience-item');
        workItem.remove();
        // إعادة حساب سنوات الخبرة بعد الحذف
        calculateExperienceYears();
    }

    // دالة لحساب سنوات الخبرة من مجموع المدة
    function calculateExperienceYears() {
        const durationInputs = document.querySelectorAll('input[name*="[duration]"]');
        let totalYears = 0;
        
        durationInputs.forEach(input => {
            const duration = input.value.trim();
            if (duration) {
                // استخراج الأرقام من النص (مثل "2 سنة" أو "3 سنوات" أو "1.5 سنة")
                const match = duration.match(/(\d+(?:\.\d+)?)/);
                if (match) {
                    totalYears += parseFloat(match[1]);
                }
            }
        });
        
        // تحديث حقل سنوات الخبرة
        const experienceYearsInput = document.getElementById('experience_years');
        if (experienceYearsInput) {
            experienceYearsInput.value = Math.round(totalYears * 10) / 10; // تقريب لرقم عشري واحد
        }
    }

    // إضافة event listeners لحقول المدة
    document.addEventListener('input', function(e) {
        if (e.target.name && e.target.name.includes('[duration]')) {
            calculateExperienceYears();
        }
    });


    // دالة حساب العمر
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
            
            // التأكد من أن العمر ضمن الحدود المسموحة
            if (age >= 18 && age <= 65) {
                ageInput.value = age;
                ageInput.classList.remove('is-invalid');
                ageInput.classList.add('is-valid');
                
                // إضافة رسالة نجاح
                const ageField = ageInput.parentElement;
                let successMsg = ageField.querySelector('.age-success');
                let errorMsg = ageField.querySelector('.age-error');
                
                // إزالة رسالة الخطأ إذا كانت موجودة
                if (errorMsg) {
                    errorMsg.remove();
                }
                
                if (!successMsg) {
                    successMsg = document.createElement('div');
                    successMsg.className = 'age-success valid-feedback';
                    ageField.appendChild(successMsg);
                }
                successMsg.textContent = `العمر المحسوب: ${age} سنة`;
                successMsg.style.display = 'block';
            } else {
                ageInput.classList.add('is-invalid');
                ageInput.classList.remove('is-valid');
                
                // إضافة رسالة خطأ
                const ageField = ageInput.parentElement;
                let errorMsg = ageField.querySelector('.age-error');
                let successMsg = ageField.querySelector('.age-success');
                
                // إزالة رسالة النجاح إذا كانت موجودة
                if (successMsg) {
                    successMsg.style.display = 'none';
                }
                
                if (!errorMsg) {
                    errorMsg = document.createElement('div');
                    errorMsg.className = 'age-error invalid-feedback';
                    ageField.appendChild(errorMsg);
                }
                if (age < 18) {
                    errorMsg.textContent = 'العمر يجب أن يكون 18 سنة أو أكثر';
                } else {
                    errorMsg.textContent = 'العمر يجب أن يكون 65 سنة أو أقل';
                }
                errorMsg.style.display = 'block';
            }
        }
    }

    // حساب العمر تلقائياً عند تغيير تاريخ الميلاد
    document.getElementById('birth_date').addEventListener('change', calculateAge);

    // حساب العمر عند تحميل الصفحة إذا كان هناك قيمة في تاريخ الميلاد
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('birth_date').value) {
            calculateAge();
        }
    });
</script>
@endsection
