@extends('admin.layout')

@section('title', 'إضافة خادمة جديدة')
@section('page-title', 'إضافة خادمة جديدة')

@section('content')
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
                            <option value="الفلبين" {{ old('nationality') == 'الفلبين' ? 'selected' : '' }}>الفلبين</option>
                            <option value="ميانمار" {{ old('nationality') == 'ميانمار' ? 'selected' : '' }}>ميانمار</option>
                            <option value="إثيوبيا" {{ old('nationality') == 'إثيوبيا' ? 'selected' : '' }}>إثيوبيا</option>
                            <option value="سريلانكا" {{ old('nationality') == 'سريلانكا' ? 'selected' : '' }}>سريلانكا</option>
                            <option value="أوغندا" {{ old('nationality') == 'أوغندا' ? 'selected' : '' }}>أوغندا</option>
                            <option value="كينيا" {{ old('nationality') == 'كينيا' ? 'selected' : '' }}>كينيا</option>
                            <option value="مدغشقر" {{ old('nationality') == 'مدغشقر' ? 'selected' : '' }}>مدغشقر</option>
                            <option value="إندونيسيا" {{ old('nationality') == 'إندونيسيا' ? 'selected' : '' }}>إندونيسيا</option>
                        </select>
                        @error('nationality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="video" class="form-label">فيديو الخادمة</label>
                        <input type="file" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" accept="video/*">
                        <div class="form-text">يمكن رفع ملفات الفيديو بصيغة MP4, AVI, MOV, WMV (حد أقصى 10MB)</div>
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">صورة الخادمة</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        <div class="form-text">يمكن رفع الصور بصيغة JPG, PNG, GIF (حد أقصى 2MB)</div>
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
                        <label for="contract_fees" class="form-label">رسوم العقد (ريال) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('contract_fees') is-invalid @enderror" 
                               id="contract_fees" name="contract_fees" value="{{ old('contract_fees') }}" 
                               min="0" step="0.01" required>
                        @error('contract_fees')
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
                                <input type="text" class="form-control @error('skills.0.skill_name') is-invalid @enderror" 
                                       name="skills[0][skill_name]" placeholder="اسم المهارة" 
                                       value="{{ old('skills.0.skill_name') }}" required>
                                @error('skills.0.skill_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('skills.0.description') is-invalid @enderror" 
                                       name="skills[0][description]" placeholder="وصف المهارة" 
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
                        <div class="work-experience-item row mb-3">
                            <div class="col-md-2">
                                <label class="form-label">اسم الشركة</label>
                                <input type="text" class="form-control @error('work_experiences.0.company_name') is-invalid @enderror" 
                                       name="work_experiences[0][company_name]" placeholder="اسم الشركة" 
                                       value="{{ old('work_experiences.0.company_name') }}" required>
                                @error('work_experiences.0.company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">المنصب</label>
                                <input type="text" class="form-control @error('work_experiences.0.position') is-invalid @enderror" 
                                       name="work_experiences[0][position]" placeholder="المنصب" 
                                       value="{{ old('work_experiences.0.position') }}" required>
                                @error('work_experiences.0.position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">البلد</label>
                                <input type="text" class="form-control @error('work_experiences.0.country') is-invalid @enderror" 
                                       name="work_experiences[0][country]" placeholder="البلد" 
                                       value="{{ old('work_experiences.0.country') }}">
                                @error('work_experiences.0.country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">نوع العمل</label>
                                <input type="text" class="form-control @error('work_experiences.0.work_type') is-invalid @enderror" 
                                       name="work_experiences[0][work_type]" placeholder="نوع العمل" 
                                       value="{{ old('work_experiences.0.work_type') }}">
                                @error('work_experiences.0.work_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">المدة</label>
                                <input type="text" class="form-control @error('work_experiences.0.duration') is-invalid @enderror" 
                                       name="work_experiences[0][duration]" placeholder="المدة" 
                                       value="{{ old('work_experiences.0.duration') }}">
                                @error('work_experiences.0.duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" class="btn btn-outline-danger d-block" onclick="removeWorkExperience(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="work-experience-item row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">تاريخ البداية</label>
                                <input type="date" class="form-control @error('work_experiences.0.start_date') is-invalid @enderror" 
                                       name="work_experiences[0][start_date]" 
                                       value="{{ old('work_experiences.0.start_date') }}" required>
                                @error('work_experiences.0.start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">تاريخ النهاية</label>
                                <input type="date" class="form-control @error('work_experiences.0.end_date') is-invalid @enderror" 
                                       name="work_experiences[0][end_date]" 
                                       value="{{ old('work_experiences.0.end_date') }}">
                                @error('work_experiences.0.end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">الوصف</label>
                                <textarea class="form-control @error('work_experiences.0.description') is-invalid @enderror" 
                                          name="work_experiences[0][description]" placeholder="وصف العمل" 
                                          rows="2">{{ old('work_experiences.0.description') }}</textarea>
                                @error('work_experiences.0.description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
                <input type="text" class="form-control" name="skills[${skillIndex}][skill_name]" 
                       placeholder="اسم المهارة" required>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="skills[${skillIndex}][description]" 
                       placeholder="وصف المهارة">
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
        
        // إضافة صف المعلومات الأساسية
        const workItem1 = document.createElement('div');
        workItem1.className = 'work-experience-item row mb-3';
        workItem1.innerHTML = `
            <div class="col-md-2">
                <label class="form-label">اسم الشركة</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][company_name]" 
                       placeholder="اسم الشركة" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">المنصب</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][position]" 
                       placeholder="المنصب" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">البلد</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][country]" 
                       placeholder="البلد">
            </div>
            <div class="col-md-2">
                <label class="form-label">نوع العمل</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][work_type]" 
                       placeholder="نوع العمل">
            </div>
            <div class="col-md-2">
                <label class="form-label">المدة</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][duration]" 
                       placeholder="المدة">
            </div>
            <div class="col-md-1">
                <label class="form-label">&nbsp;</label>
                <button type="button" class="btn btn-outline-danger d-block" onclick="removeWorkExperience(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        
        // إضافة صف التواريخ والوصف
        const workItem2 = document.createElement('div');
        workItem2.className = 'work-experience-item row mb-3';
        workItem2.innerHTML = `
            <div class="col-md-3">
                <label class="form-label">تاريخ البداية</label>
                <input type="date" class="form-control" name="work_experiences[${workExperienceIndex}][start_date]" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">تاريخ النهاية</label>
                <input type="date" class="form-control" name="work_experiences[${workExperienceIndex}][end_date]">
            </div>
            <div class="col-md-6">
                <label class="form-label">الوصف</label>
                <textarea class="form-control" name="work_experiences[${workExperienceIndex}][description]" 
                          placeholder="وصف العمل" rows="2"></textarea>
            </div>
        `;
        
        container.appendChild(workItem1);
        container.appendChild(workItem2);
        workExperienceIndex++;
    }

    function removeWorkExperience(button) {
        // إزالة الصفين المرتبطين بخبرة العمل الواحدة
        const workItem1 = button.closest('.work-experience-item');
        const workItem2 = workItem1.nextElementSibling;
        
        workItem1.remove();
        if (workItem2 && workItem2.classList.contains('work-experience-item')) {
            workItem2.remove();
        }
    }

    // إضافة validation للتواريخ
    function validateWorkExperienceDates() {
        const startDates = document.querySelectorAll('input[name*="[start_date]"]');
        const endDates = document.querySelectorAll('input[name*="[end_date]"]');
        
        for (let i = 0; i < startDates.length; i++) {
            const startDate = startDates[i];
            const endDate = endDates[i];
            
            if (startDate.value && endDate.value) {
                if (new Date(endDate.value) <= new Date(startDate.value)) {
                    endDate.setCustomValidity('تاريخ النهاية يجب أن يكون بعد تاريخ البداية');
                    endDate.reportValidity();
                    return false;
                } else {
                    endDate.setCustomValidity('');
                }
            }
        }
        return true;
    }

    // إضافة event listeners للتواريخ
    document.addEventListener('change', function(e) {
        if (e.target.name && e.target.name.includes('[start_date]') || e.target.name.includes('[end_date]')) {
            validateWorkExperienceDates();
        }
    });

    // إضافة validation قبل إرسال الـ form
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateWorkExperienceDates()) {
            e.preventDefault();
            return false;
        }
    });

    // حساب العمر تلقائياً عند تغيير تاريخ الميلاد
    document.getElementById('birth_date').addEventListener('change', function() {
        const birthDate = new Date(this.value);
        const today = new Date();
        const age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    });
</script>
@endsection
