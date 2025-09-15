<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تعديل الخادمة - {{ $maid->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-primary">
                        <i class="fas fa-user-edit me-2"></i>
                        تعديل الخادمة - {{ $maid->name }}
                    </h1>
                    <div>
                        <a href="{{ route('maids.show', $maid) }}" class="btn btn-info me-2">
                            <i class="fas fa-eye me-1"></i>
                            عرض التفاصيل
                        </a>
                        <a href="{{ route('maids.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-right me-1"></i>
                            العودة للقائمة
                        </a>
                    </div>
                </div>

                <form action="{{ route('maids.update', $maid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                المعلومات الشخصية
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">اسم الخادمة <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $maid->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
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
                                
                                <div class="col-md-6 mb-3">
                                    <label for="language" class="form-label">اللغة <span class="text-danger">*</span></label>
                                    <select class="form-select @error('language') is-invalid @enderror" 
                                            id="language" name="language" required>
                                        <option value="">اختر اللغة</option>
                                        <option value="English" {{ old('language', $maid->language) == 'English' ? 'selected' : '' }}>English</option>
                                        <option value="Little English" {{ old('language', $maid->language) == 'Little English' ? 'selected' : '' }}>Little English</option>
                                        <option value="Arabic" {{ old('language', $maid->language) == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                                        <option value="Little Arabic" {{ old('language', $maid->language) == 'Little Arabic' ? 'selected' : '' }}>Little Arabic</option>
                                        <option value="English & L.Arabic" {{ old('language', $maid->language) == 'English & L.Arabic' ? 'selected' : '' }}>English & L.Arabic</option>
                                        <option value="Arabic & L.English" {{ old('language', $maid->language) == 'Arabic & L.English' ? 'selected' : '' }}>Arabic & L.English</option>
                                    </select>
                                    @error('language')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="birth_date" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                           id="birth_date" name="birth_date" value="{{ old('birth_date', $maid->birth_date ? $maid->birth_date->format('Y-m-d') : '') }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="age" class="form-label">العمر <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                           id="age" name="age" value="{{ old('age', $maid->age) }}" min="18" max="65" required>
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="education" class="form-label">التعليم <span class="text-danger">*</span></label>
                                    <select class="form-select @error('education') is-invalid @enderror" 
                                            id="education" name="education" required>
                                        <option value="">اختر مستوى التعليم</option>
                                        <option value="أمي" {{ old('education', $maid->education) == 'أمي' ? 'selected' : '' }}>أمي</option>
                                        <option value="ابتدائي" {{ old('education', $maid->education) == 'ابتدائي' ? 'selected' : '' }}>ابتدائي</option>
                                        <option value="متوسط" {{ old('education', $maid->education) == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                                        <option value="ثانوي" {{ old('education', $maid->education) == 'ثانوي' ? 'selected' : '' }}>ثانوي</option>
                                        <option value="جامعي" {{ old('education', $maid->education) == 'جامعي' ? 'selected' : '' }}>جامعي</option>
                                    </select>
                                    @error('education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="height" class="form-label">الطول (سم)</label>
                                    <input type="number" class="form-control @error('height') is-invalid @enderror" 
                                           id="height" name="height" value="{{ old('height', $maid->height) }}" min="100" max="250">
                                    @error('height')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="weight" class="form-label">الوزن (كجم)</label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror" 
                                           id="weight" name="weight" value="{{ old('weight', $maid->weight) }}" min="30" max="200">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">صورة الخادمة</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                           id="image" name="image" accept="image/*">
                                    @if($maid->image_path)
                                        <small class="text-muted">الصورة الحالية: 
                                            <a href="{{ asset('storage/' . $maid->image_path) }}" target="_blank">عرض الصورة</a>
                                        </small>
                                    @endif
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="video" class="form-label">فيديو الخادمة</label>
                                    <input type="file" class="form-control @error('video') is-invalid @enderror" 
                                           id="video" name="video" accept="video/*">
                                    @if($maid->video_path)
                                        <small class="text-muted">الفيديو الحالي: 
                                            <a href="{{ asset('storage/' . $maid->video_path) }}" target="_blank">عرض الفيديو</a>
                                        </small>
                                    @endif
                                    @error('video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-file-contract me-2"></i>
                                معلومات العقد
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="package_type" class="form-label">نوع الباقة <span class="text-danger">*</span></label>
                                    <select class="form-select @error('package_type') is-invalid @enderror" 
                                            id="package_type" name="package_type" required>
                                        <option value="">اختر نوع الباقة</option>
                                        <option value="باقة أساسية" {{ old('package_type', $maid->package_type) == 'باقة أساسية' ? 'selected' : '' }}>باقة أساسية</option>
                                        <option value="باقة متقدمة" {{ old('package_type', $maid->package_type) == 'باقة متقدمة' ? 'selected' : '' }}>باقة متقدمة</option>
                                        <option value="باقة مميزة" {{ old('package_type', $maid->package_type) == 'باقة مميزة' ? 'selected' : '' }}>باقة مميزة</option>
                                    </select>
                                    @error('package_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="job_title" class="form-label">الوظيفة <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('job_title') is-invalid @enderror" 
                                           id="job_title" name="job_title" value="{{ old('job_title', $maid->job_title) }}" required>
                                    @error('job_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="contract_type" class="form-label">نوع العقد <span class="text-danger">*</span></label>
                                    <select class="form-select @error('contract_type') is-invalid @enderror" 
                                            id="contract_type" name="contract_type" required>
                                        <option value="">اختر نوع العقد</option>
                                        <option value="عقد سنوي" {{ old('contract_type', $maid->contract_type) == 'عقد سنوي' ? 'selected' : '' }}>عقد سنوي</option>
                                        <option value="عقد نصف سنوي" {{ old('contract_type', $maid->contract_type) == 'عقد نصف سنوي' ? 'selected' : '' }}>عقد نصف سنوي</option>
                                        <option value="عقد شهري" {{ old('contract_type', $maid->contract_type) == 'عقد شهري' ? 'selected' : '' }}>عقد شهري</option>
                                    </select>
                                    @error('contract_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="contract_fees" class="form-label">رسوم العقد (درهم إماراتي) <span class="text-danger">*</span></label>
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

                    <div class="card mt-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-tools me-2"></i>
                                المهارات
                            </h5>
                        </div>
                        <div class="card-body">
                            <div id="skills-container">
                                @foreach($maid->skills() as $index => $skill)
                                    <div class="skill-item row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-label">اسم المهارة</label>
                                            <input type="text" class="form-control" name="skills[{{ $index }}][name]" 
                                                   value="{{ $skill->skill_name }}" placeholder="مثال: الطبخ">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">وصف المهارة</label>
                                            <input type="text" class="form-control" name="skills[{{ $index }}][description]" 
                                                   value="{{ $skill->description }}" placeholder="وصف مختصر للمهارة">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeSkill(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if($maid->skills()->count() == 0)
                                    <div class="skill-item row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-label">اسم المهارة</label>
                                            <input type="text" class="form-control" name="skills[0][name]" placeholder="مثال: الطبخ">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">وصف المهارة</label>
                                            <input type="text" class="form-control" name="skills[0][description]" placeholder="وصف مختصر للمهارة">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeSkill(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary" onclick="addSkill()">
                                <i class="fas fa-plus me-1"></i>
                                إضافة مهارة جديدة
                            </button>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-briefcase me-2"></i>
                                الخبرات العملية
                            </h5>
                        </div>
                        <div class="card-body">
                            <div id="experiences-container">
                                @foreach($maid->workExperiences() as $index => $experience)
                                    <div class="experience-item row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label">اسم الشركة/المكان</label>
                                            <input type="text" class="form-control" name="work_experiences[{{ $index }}][company_name]" 
                                                   value="{{ $experience->company_name }}" placeholder="اسم الشركة">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">المنصب</label>
                                            <input type="text" class="form-control" name="work_experiences[{{ $index }}][position]" 
                                                   value="{{ $experience->position }}" placeholder="المنصب">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">تاريخ البداية</label>
                                            <input type="date" class="form-control" name="work_experiences[{{ $index }}][start_date]" 
                                                   value="{{ $experience->start_date ? $experience->start_date->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">تاريخ النهاية</label>
                                            <input type="date" class="form-control" name="work_experiences[{{ $index }}][end_date]" 
                                                   value="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeExperience(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if($maid->workExperiences()->count() == 0)
                                    <div class="experience-item row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label">اسم الشركة/المكان</label>
                                            <input type="text" class="form-control" name="work_experiences[0][company_name]" placeholder="اسم الشركة">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">المنصب</label>
                                            <input type="text" class="form-control" name="work_experiences[0][position]" placeholder="المنصب">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">تاريخ البداية</label>
                                            <input type="date" class="form-control" name="work_experiences[0][start_date]">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">تاريخ النهاية</label>
                                            <input type="date" class="form-control" name="work_experiences[0][end_date]">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeExperience(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-outline-primary" onclick="addExperience()">
                                <i class="fas fa-plus me-1"></i>
                                إضافة خبرة جديدة
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('maids.show', $maid) }}" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-1"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let skillIndex = {{ $maid->skills()->count() }};
        let experienceIndex = {{ $maid->workExperiences()->count() }};

        function addSkill() {
            const container = document.getElementById('skills-container');
            const newSkill = document.createElement('div');
            newSkill.className = 'skill-item row mb-3';
            newSkill.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label">اسم المهارة</label>
                    <input type="text" class="form-control" name="skills[${skillIndex}][name]" placeholder="مثال: الطبخ">
                </div>
                <div class="col-md-6">
                    <label class="form-label">وصف المهارة</label>
                    <input type="text" class="form-control" name="skills[${skillIndex}][description]" placeholder="وصف مختصر للمهارة">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeSkill(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(newSkill);
            skillIndex++;
        }

        function removeSkill(button) {
            button.closest('.skill-item').remove();
        }

        function addExperience() {
            const container = document.getElementById('experiences-container');
            const newExperience = document.createElement('div');
            newExperience.className = 'experience-item row mb-3';
            newExperience.innerHTML = `
                <div class="col-md-3">
                    <label class="form-label">اسم الشركة/المكان</label>
                    <input type="text" class="form-control" name="work_experiences[${experienceIndex}][company_name]" placeholder="اسم الشركة">
                </div>
                <div class="col-md-3">
                    <label class="form-label">المنصب</label>
                    <input type="text" class="form-control" name="work_experiences[${experienceIndex}][position]" placeholder="المنصب">
                </div>
                <div class="col-md-2">
                    <label class="form-label">تاريخ البداية</label>
                    <input type="date" class="form-control" name="work_experiences[${experienceIndex}][start_date]">
                </div>
                <div class="col-md-2">
                    <label class="form-label">تاريخ النهاية</label>
                    <input type="date" class="form-control" name="work_experiences[${experienceIndex}][end_date]">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeExperience(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(newExperience);
            experienceIndex++;
        }

        function removeExperience(button) {
            button.closest('.experience-item').remove();
        }
    </script>
</body>
</html>
