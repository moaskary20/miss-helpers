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
                                    <option value="عربية" {{ old('language') == 'عربية' ? 'selected' : '' }}>عربية</option>
                                    <option value="إنجليزية" {{ old('language') == 'إنجليزية' ? 'selected' : '' }}>إنجليزية</option>
                                    <option value="فرنسية" {{ old('language') == 'فرنسية' ? 'selected' : '' }}>فرنسية</option>
                                    <option value="أردو" {{ old('language') == 'أردو' ? 'selected' : '' }}>أردو</option>
                                    <option value="فلبينية" {{ old('language') == 'فلبينية' ? 'selected' : '' }}>فلبينية</option>
                                    <option value="أخرى" {{ old('language') == 'أخرى' ? 'selected' : '' }}>أخرى</option>
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
                            <option value="باقة أساسية" {{ old('package_type') == 'باقة أساسية' ? 'selected' : '' }}>باقة أساسية</option>
                            <option value="باقة متقدمة" {{ old('package_type') == 'باقة متقدمة' ? 'selected' : '' }}>باقة متقدمة</option>
                            <option value="باقة مميزة" {{ old('package_type') == 'باقة مميزة' ? 'selected' : '' }}>باقة مميزة</option>
                            <option value="باقة VIP" {{ old('package_type') == 'باقة VIP' ? 'selected' : '' }}>باقة VIP</option>
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
                            <option value="خادمة منزلية" {{ old('job_title') == 'خادمة منزلية' ? 'selected' : '' }}>خادمة منزلية</option>
                            <option value="طباخة" {{ old('job_title') == 'طباخة' ? 'selected' : '' }}>طباخة</option>
                            <option value="مربية أطفال" {{ old('job_title') == 'مربية أطفال' ? 'selected' : '' }}>مربية أطفال</option>
                            <option value="ممرضة" {{ old('job_title') == 'ممرضة' ? 'selected' : '' }}>ممرضة</option>
                            <option value="سائق" {{ old('job_title') == 'سائق' ? 'selected' : '' }}>سائق</option>
                            <option value="حارس" {{ old('job_title') == 'حارس' ? 'selected' : '' }}>حارس</option>
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
                            <option value="عقد سنوي" {{ old('contract_type') == 'عقد سنوي' ? 'selected' : '' }}>عقد سنوي</option>
                            <option value="عقد نصف سنوي" {{ old('contract_type') == 'عقد نصف سنوي' ? 'selected' : '' }}>عقد نصف سنوي</option>
                            <option value="عقد شهري" {{ old('contract_type') == 'عقد شهري' ? 'selected' : '' }}>عقد شهري</option>
                            <option value="عقد مؤقت" {{ old('contract_type') == 'عقد مؤقت' ? 'selected' : '' }}>عقد مؤقت</option>
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
                                <input type="text" class="form-control" name="skills[0][skill_name]" 
                                       placeholder="اسم المهارة" value="{{ old('skills.0.skill_name') }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="skills[0][description]" 
                                       placeholder="وصف المهارة" value="{{ old('skills.0.description') }}">
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
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="work_experiences[0][company_name]" 
                                       placeholder="اسم الشركة" value="{{ old('work_experiences.0.company_name') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="work_experiences[0][position]" 
                                       placeholder="المنصب" value="{{ old('work_experiences.0.position') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="work_experiences[0][start_date]" 
                                       value="{{ old('work_experiences.0.start_date') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="work_experiences[0][end_date]" 
                                       value="{{ old('work_experiences.0.end_date') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="work_experiences[0][description]" 
                                       placeholder="الوصف" value="{{ old('work_experiences.0.description') }}">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-danger" onclick="removeWorkExperience(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
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
                       placeholder="اسم المهارة">
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
        const workItem = document.createElement('div');
        workItem.className = 'work-experience-item row mb-3';
        workItem.innerHTML = `
            <div class="col-md-3">
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][company_name]" 
                       placeholder="اسم الشركة">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][position]" 
                       placeholder="المنصب">
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="work_experiences[${workExperienceIndex}][start_date]">
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="work_experiences[${workExperienceIndex}][end_date]">
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][description]" 
                       placeholder="الوصف">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-outline-danger" onclick="removeWorkExperience(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(workItem);
        workExperienceIndex++;
    }

    function removeWorkExperience(button) {
        button.closest('.work-experience-item').remove();
    }

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
