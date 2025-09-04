@extends('admin.layout')

@section('title', 'تعديل الخادمة - ' . $maid->name)
@section('page-title', 'تعديل الخادمة')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="bi bi-pencil"></i>
                تعديل الخادمة: {{ $maid->name }}
            </h2>
            <div>
                <a href="{{ route('admin.maids.show', $maid->id) }}" class="btn btn-info me-2">
                    <i class="bi bi-eye"></i>
                    عرض التفاصيل
                </a>
                <a href="{{ route('admin.maids.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.maids.update', $maid->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
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
                               id="name" name="name" value="{{ old('name', $maid->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="video" class="form-label">فيديو الخادمة</label>
                        <input type="file" class="form-control @error('video') is-invalid @enderror" 
                               id="video" name="video" accept="video/*">
                        @if($maid->video_path)
                            <div class="mt-2">
                                <small class="text-muted">الفيديو الحالي:</small>
                                <video controls class="w-100 mt-1" style="max-height: 150px;">
                                    <source src="{{ Storage::url($maid->video_path) }}" type="video/mp4">
                                </video>
                            </div>
                        @endif
                        <div class="form-text">يمكن رفع ملفات الفيديو بصيغة MP4, AVI, MOV, WMV (حد أقصى 10MB)</div>
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">صورة الخادمة</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @if($maid->image_path)
                            <div class="mt-2">
                                <small class="text-muted">الصورة الحالية:</small>
                                <img src="{{ Storage::url($maid->image_path) }}" 
                                     alt="{{ $maid->name }}" 
                                     class="img-thumbnail mt-1" 
                                     style="max-height: 150px;">
                            </div>
                        @endif
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
                                    <option value="مسلمة" {{ old('religion', $maid->religion) == 'مسلمة' ? 'selected' : '' }}>مسلمة</option>
                                    <option value="مسيحية" {{ old('religion', $maid->religion) == 'مسيحية' ? 'selected' : '' }}>مسيحية</option>
                                    <option value="أخرى" {{ old('religion', $maid->religion) == 'أخرى' ? 'selected' : '' }}>أخرى</option>
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
                                    <option value="عربية" {{ old('language', $maid->language) == 'عربية' ? 'selected' : '' }}>عربية</option>
                                    <option value="إنجليزية" {{ old('language', $maid->language) == 'إنجليزية' ? 'selected' : '' }}>إنجليزية</option>
                                    <option value="فرنسية" {{ old('language', $maid->language) == 'فرنسية' ? 'selected' : '' }}>فرنسية</option>
                                    <option value="أردو" {{ old('language', $maid->language) == 'أردو' ? 'selected' : '' }}>أردو</option>
                                    <option value="فلبينية" {{ old('language', $maid->language) == 'فلبينية' ? 'selected' : '' }}>فلبينية</option>
                                    <option value="أخرى" {{ old('language', $maid->language) == 'أخرى' ? 'selected' : '' }}>أخرى</option>
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
                                       id="birth_date" name="birth_date" value="{{ old('birth_date', $maid->birth_date->format('Y-m-d')) }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="age" class="form-label">العمر <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                       id="age" name="age" value="{{ old('age', $maid->age) }}" min="18" max="65" required>
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
                            <option value="ابتدائي" {{ old('education', $maid->education) == 'ابتدائي' ? 'selected' : '' }}>ابتدائي</option>
                            <option value="متوسط" {{ old('education', $maid->education) == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                            <option value="ثانوي" {{ old('education', $maid->education) == 'ثانوي' ? 'selected' : '' }}>ثانوي</option>
                            <option value="جامعي" {{ old('education', $maid->education) == 'جامعي' ? 'selected' : '' }}>جامعي</option>
                            <option value="أمي" {{ old('education', $maid->education) == 'أمي' ? 'selected' : '' }}>أمي</option>
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
                                       id="height" name="height" value="{{ old('height', $maid->height) }}" min="100" max="250" step="0.1">
                                @error('height')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="weight" class="form-label">الوزن (كجم)</label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" 
                                       id="weight" name="weight" value="{{ old('weight', $maid->weight) }}" min="30" max="150" step="0.1">
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
                            <option value="باقة أساسية" {{ old('package_type', $maid->package_type) == 'باقة أساسية' ? 'selected' : '' }}>باقة أساسية</option>
                            <option value="باقة متقدمة" {{ old('package_type', $maid->package_type) == 'باقة متقدمة' ? 'selected' : '' }}>باقة متقدمة</option>
                            <option value="باقة مميزة" {{ old('package_type', $maid->package_type) == 'باقة مميزة' ? 'selected' : '' }}>باقة مميزة</option>
                            <option value="باقة VIP" {{ old('package_type', $maid->package_type) == 'باقة VIP' ? 'selected' : '' }}>باقة VIP</option>
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
                            <option value="خادمة منزلية" {{ old('job_title', $maid->job_title) == 'خادمة منزلية' ? 'selected' : '' }}>خادمة منزلية</option>
                            <option value="طباخة" {{ old('job_title', $maid->job_title) == 'طباخة' ? 'selected' : '' }}>طباخة</option>
                            <option value="مربية أطفال" {{ old('job_title', $maid->job_title) == 'مربية أطفال' ? 'selected' : '' }}>مربية أطفال</option>
                            <option value="ممرضة" {{ old('job_title', $maid->job_title) == 'ممرضة' ? 'selected' : '' }}>ممرضة</option>
                            <option value="سائق" {{ old('job_title', $maid->job_title) == 'سائق' ? 'selected' : '' }}>سائق</option>
                            <option value="حارس" {{ old('job_title', $maid->job_title) == 'حارس' ? 'selected' : '' }}>حارس</option>
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
                            <option value="عقد سنوي" {{ old('contract_type', $maid->contract_type) == 'عقد سنوي' ? 'selected' : '' }}>عقد سنوي</option>
                            <option value="عقد نصف سنوي" {{ old('contract_type', $maid->contract_type) == 'عقد نصف سنوي' ? 'selected' : '' }}>عقد نصف سنوي</option>
                            <option value="عقد شهري" {{ old('contract_type', $maid->contract_type) == 'عقد شهري' ? 'selected' : '' }}>عقد شهري</option>
                            <option value="عقد مؤقت" {{ old('contract_type', $maid->contract_type) == 'عقد مؤقت' ? 'selected' : '' }}>عقد مؤقت</option>
                        </select>
                        @error('contract_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="contract_fees" class="form-label">رسوم العقد (ريال) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('contract_fees') is-invalid @enderror" 
                               id="contract_fees" name="contract_fees" value="{{ old('contract_fees', $maid->contract_fees) }}" 
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
                        @if(old('skills'))
                            @foreach(old('skills') as $index => $skill)
                                <div class="skill-item row mb-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="skills[{{ $index }}][skill_name]" 
                                               placeholder="اسم المهارة" value="{{ $skill['skill_name'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="skills[{{ $index }}][description]" 
                                               placeholder="وصف المهارة" value="{{ $skill['description'] ?? '' }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeSkill(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($maid->skills as $index => $skill)
                                <div class="skill-item row mb-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="skills[{{ $index }}][skill_name]" 
                                               placeholder="اسم المهارة" value="{{ $skill->skill_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="skills[{{ $index }}][description]" 
                                               placeholder="وصف المهارة" value="{{ $skill->description }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeSkill(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                        @if(old('work_experiences'))
                            @foreach(old('work_experiences') as $index => $work)
                                <div class="work-experience-item row mb-3">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="work_experiences[{{ $index }}][company_name]" 
                                               placeholder="اسم الشركة" value="{{ $work['company_name'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="work_experiences[{{ $index }}][position]" 
                                               placeholder="المنصب" value="{{ $work['position'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="work_experiences[{{ $index }}][start_date]" 
                                               value="{{ $work['start_date'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="work_experiences[{{ $index }}][end_date]" 
                                               value="{{ $work['end_date'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="work_experiences[{{ $index }}][description]" 
                                               placeholder="الوصف" value="{{ $work['description'] ?? '' }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeWorkExperience(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($maid->workExperiences as $index => $work)
                                <div class="work-experience-item row mb-3">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="work_experiences[{{ $index }}][company_name]" 
                                               placeholder="اسم الشركة" value="{{ $work->company_name }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="work_experiences[{{ $index }}][position]" 
                                               placeholder="المنصب" value="{{ $work->position }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="work_experiences[{{ $index }}][start_date]" 
                                               value="{{ $work->start_date->format('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="work_experiences[{{ $index }}][end_date]" 
                                               value="{{ $work->end_date ? $work->end_date->format('Y-m-d') : '' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="work_experiences[{{ $index }}][description]" 
                                               placeholder="الوصف" value="{{ $work->description }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeWorkExperience(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
                        حفظ التعديلات
                    </button>
                    <a href="{{ route('admin.maids.show', $maid->id) }}" class="btn btn-outline-info btn-lg me-3">
                        <i class="bi bi-eye"></i>
                        عرض التفاصيل
                    </a>
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
    let skillIndex = {{ old('skills') ? count(old('skills')) : $maid->skills()->count() }};
    let workExperienceIndex = {{ old('work_experiences') ? count(old('work_experiences')) : $maid->workExperiences()->count() }};

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
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    });
</script>
@endsection
