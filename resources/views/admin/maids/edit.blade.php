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
                        <label for="nationality" class="form-label">الجنسية <span class="text-danger">*</span></label>
                        <select class="form-select @error('nationality') is-invalid @enderror" 
                                id="nationality" name="nationality" required>
                            <option value="">اختر الجنسية</option>
                            @foreach(\App\Models\Maid::getAvailableNationalities() as $key => $value)
                                <option value="{{ $key }}" {{ old('nationality', $maid->nationality) == $key ? 'selected' : '' }}>
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
                        @if($maid->video_path)
                            <div class="mt-2 position-relative" id="current-video-container">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" 
                                        style="z-index: 10; margin: 5px;" 
                                        onclick="deleteVideo()" 
                                        title="حذف الفيديو">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <small class="text-muted d-block mb-1">الفيديو الحالي:</small>
                                <video controls class="w-100 mt-1" style="max-height: 150px;">
                                    <source src="{{ url('/storage/' . $maid->video_path) }}" type="video/mp4">
                                </video>
                            </div>
                            <input type="hidden" name="delete_video" id="delete_video" value="0">
                        @endif
                        <div class="form-text">يمكن رفع ملفات الفيديو بصيغة MP4, AVI, MOV, WMV (حد أقصى 10MB - إذا كان الملف أكبر من 2MB قد تحتاج لتعديل إعدادات PHP)</div>
                        @error('video')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">صورة الخادمة</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @if($maid->image_path)
                            <div class="mt-2 position-relative" id="current-image-container">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" 
                                        style="z-index: 10; margin: 5px;" 
                                        onclick="deleteImage()" 
                                        title="حذف الصورة">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <small class="text-muted d-block mb-1">الصورة الحالية:</small>
                                <img src="{{ url('/storage/' . $maid->image_path) }}?v={{ strtotime($maid->updated_at) }}" 
                                     alt="{{ $maid->name }}" 
                                     class="img-thumbnail mt-1" 
                                     style="max-height: 150px;"
                                     id="current-maid-image"
                                     onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                            </div>
                            <input type="hidden" name="delete_image" id="delete_image" value="0">
                        @endif
                        <div id="new-maid-image-preview" class="mt-2" style="display: none;">
                            <small class="text-success">
                                <i class="bi bi-check-circle"></i> الصورة الجديدة (سيتم حفظها عند الضغط على تحديث):
                            </small>
                            <img id="maid-image-preview" 
                                 src="" 
                                 alt="معاينة الصورة الجديدة" 
                                 class="img-thumbnail mt-1" 
                                 style="max-height: 150px; display: block;">
                        </div>
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
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">تاريخ الميلاد <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                       id="birth_date" name="birth_date" value="{{ old('birth_date', $maid->birth_date ? $maid->birth_date->format('Y-m-d') : '') }}" required>
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
                                <label for="marital_status" class="form-label">الحالة الاجتماعية <span class="text-danger">*</span></label>
                                <select class="form-select @error('marital_status') is-invalid @enderror" 
                                        id="marital_status" name="marital_status" required>
                                    <option value="">اختر الحالة الاجتماعية</option>
                                    <option value="عزباء" {{ old('marital_status', $maid->marital_status) == 'عزباء' ? 'selected' : '' }}>عزباء</option>
                                    <option value="متزوجة" {{ old('marital_status', $maid->marital_status) == 'متزوجة' ? 'selected' : '' }}>متزوجة</option>
                                    <option value="مطلقة" {{ old('marital_status', $maid->marital_status) == 'مطلقة' ? 'selected' : '' }}>مطلقة</option>
                                    <option value="أرملة" {{ old('marital_status', $maid->marital_status) == 'أرملة' ? 'selected' : '' }}>أرملة</option>
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
                                       id="children_count" name="children_count" value="{{ old('children_count', $maid->children_count) }}" 
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
                    
                    <div class="mb-3">
                        <label for="experience_years" class="form-label">سنوات الخبرة (محسوبة تلقائياً)</label>
                        <input type="number" class="form-control @error('experience_years') is-invalid @enderror" 
                               id="experience_years" name="experience_years" value="{{ old('experience_years', $maid->experience_years) }}" 
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
                            <option value="الباقة التقليدية" {{ old('package_type', $maid->package_type) == 'الباقة التقليدية' ? 'selected' : '' }}>الباقة التقليدية</option>
                            <option value="الباقة المرنة" {{ old('package_type', $maid->package_type) == 'الباقة المرنة' ? 'selected' : '' }}>الباقة المرنة</option>
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
                                <option value="عاملة منزلية" {{ old('job_title', $maid->job_title) == 'عاملة منزلية' ? 'selected' : '' }}>عاملة منزلية</option>
                                <option value="مربية أطفال" {{ old('job_title', $maid->job_title) == 'مربية أطفال' ? 'selected' : '' }}>مربية أطفال</option>
                                <option value="رعاية كبار السن" {{ old('job_title', $maid->job_title) == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                <option value="طباخة" {{ old('job_title', $maid->job_title) == 'طباخة' ? 'selected' : '' }}>طباخة</option>
                                <option value="سائقة" {{ old('job_title', $maid->job_title) == 'سائقة' ? 'selected' : '' }}>سائقة</option>
                            </optgroup>
                            <optgroup label="الباقة المرنة">
                                <option value="عاملة منزلية" {{ old('job_title', $maid->job_title) == 'عاملة منزلية' ? 'selected' : '' }}>عاملة منزلية</option>
                                <option value="مربية أطفال" {{ old('job_title', $maid->job_title) == 'مربية أطفال' ? 'selected' : '' }}>مربية أطفال</option>
                                <option value="رعاية كبار السن" {{ old('job_title', $maid->job_title) == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                <option value="طباخة" {{ old('job_title', $maid->job_title) == 'طباخة' ? 'selected' : '' }}>طباخة</option>
                                <option value="سائقة" {{ old('job_title', $maid->job_title) == 'سائقة' ? 'selected' : '' }}>سائقة</option>
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
                            <option value="عقد سنتين" {{ old('contract_type', $maid->contract_type) == 'عقد سنتين' ? 'selected' : '' }}>عقد سنتين</option>
                            <option value="عقد شهري" {{ old('contract_type', $maid->contract_type) == 'عقد شهري' ? 'selected' : '' }}>عقد شهري</option>
                        </select>
                        @error('contract_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="contract_fees" class="form-label">رسوم العقد (درهم إماراتي)</label>
                        <input type="number" class="form-control @error('contract_fees') is-invalid @enderror" 
                               id="contract_fees" name="contract_fees" value="{{ old('contract_fees', $maid->contract_fees) }}" 
                               min="0" step="0.01">
                        @error('contract_fees')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="monthly_salary" class="form-label">الراتب الشهري (درهم إماراتي)</label>
                        <input type="number" class="form-control @error('monthly_salary') is-invalid @enderror" 
                               id="monthly_salary" name="monthly_salary" value="{{ old('monthly_salary', $maid->monthly_salary) }}" 
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
                        @if(old('skills'))
                            @foreach(old('skills') as $index => $skill)
                                <div class="skill-item row mb-3">
                                    <div class="col-md-5">
                                        <select class="form-select @error('skills.'.$index.'.skill_name') is-invalid @enderror" 
                                                name="skills[{{ $index }}][skill_name]" required>
                                            <option value="">اختر المهارة</option>
                                            <option value="تنظيف" {{ ($skill['skill_name'] ?? '') == 'تنظيف' ? 'selected' : '' }}>تنظيف</option>
                                            <option value="غسيل" {{ ($skill['skill_name'] ?? '') == 'غسيل' ? 'selected' : '' }}>غسيل</option>
                                            <option value="كوي" {{ ($skill['skill_name'] ?? '') == 'كوي' ? 'selected' : '' }}>كوي</option>
                                            <option value="طبخ" {{ ($skill['skill_name'] ?? '') == 'طبخ' ? 'selected' : '' }}>طبخ</option>
                                            <option value="رعاية اطفال" {{ ($skill['skill_name'] ?? '') == 'رعاية اطفال' ? 'selected' : '' }}>رعاية اطفال</option>
                                            <option value="رعاية كبار السن" {{ ($skill['skill_name'] ?? '') == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                            <option value="سائقة" {{ ($skill['skill_name'] ?? '') == 'سائقة' ? 'selected' : '' }}>سائقة</option>
                                        </select>
                                        @error('skills.'.$index.'.skill_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('skills.'.$index.'.description') is-invalid @enderror" 
                                               name="skills[{{ $index }}][description]" placeholder="وصف المهارة (اختياري)" 
                                               value="{{ $skill['description'] ?? '' }}">
                                        @error('skills.'.$index.'.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeSkill(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($maid->skills()->get() as $index => $skill)
                                <div class="skill-item row mb-3">
                                    <div class="col-md-5">
                                        <select class="form-select @error('skills.'.$index.'.skill_name') is-invalid @enderror" 
                                                name="skills[{{ $index }}][skill_name]" required>
                                            <option value="">اختر المهارة</option>
                                            <option value="تنظيف" {{ $skill->skill_name == 'تنظيف' ? 'selected' : '' }}>تنظيف</option>
                                            <option value="غسيل" {{ $skill->skill_name == 'غسيل' ? 'selected' : '' }}>غسيل</option>
                                            <option value="كوي" {{ $skill->skill_name == 'كوي' ? 'selected' : '' }}>كوي</option>
                                            <option value="طبخ" {{ $skill->skill_name == 'طبخ' ? 'selected' : '' }}>طبخ</option>
                                            <option value="رعاية اطفال" {{ $skill->skill_name == 'رعاية اطفال' ? 'selected' : '' }}>رعاية اطفال</option>
                                            <option value="رعاية كبار السن" {{ $skill->skill_name == 'رعاية كبار السن' ? 'selected' : '' }}>رعاية كبار السن</option>
                                            <option value="سائقة" {{ $skill->skill_name == 'سائقة' ? 'selected' : '' }}>سائقة</option>
                                        </select>
                                        @error('skills.'.$index.'.skill_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('skills.'.$index.'.description') is-invalid @enderror" 
                                               name="skills[{{ $index }}][description]" placeholder="وصف المهارة (اختياري)" 
                                               value="{{ $skill->description }}">
                                        @error('skills.'.$index.'.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                    <div class="col-md-2">
                                        <label class="form-label">اسم الشركة</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.company_name') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][company_name]" placeholder="اسم الشركة" 
                                               value="{{ $work['company_name'] ?? '' }}" required>
                                        @error('work_experiences.'.$index.'.company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">المنصب</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.position') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][position]" placeholder="المنصب" 
                                               value="{{ $work['position'] ?? '' }}" required>
                                        @error('work_experiences.'.$index.'.position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">البلد</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.country') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][country]" placeholder="البلد" 
                                               value="{{ $work['country'] ?? '' }}">
                                        @error('work_experiences.'.$index.'.country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">نوع العمل</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.work_type') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][work_type]" placeholder="نوع العمل" 
                                               value="{{ $work['work_type'] ?? '' }}">
                                        @error('work_experiences.'.$index.'.work_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">المدة</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.duration') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][duration]" placeholder="المدة" 
                                               value="{{ $work['duration'] ?? '' }}">
                                        @error('work_experiences.'.$index.'.duration')
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
                                        <input type="date" class="form-control @error('work_experiences.'.$index.'.start_date') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][start_date]" 
                                               value="{{ $work['start_date'] ?? '' }}" required>
                                        @error('work_experiences.'.$index.'.start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">تاريخ النهاية</label>
                                        <input type="date" class="form-control @error('work_experiences.'.$index.'.end_date') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][end_date]" 
                                               value="{{ $work['end_date'] ?? '' }}">
                                        @error('work_experiences.'.$index.'.end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">الوصف</label>
                                        <textarea class="form-control @error('work_experiences.'.$index.'.description') is-invalid @enderror" 
                                                  name="work_experiences[{{ $index }}][description]" placeholder="وصف العمل" 
                                                  rows="2">{{ $work['description'] ?? '' }}</textarea>
                                        @error('work_experiences.'.$index.'.description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach($maid->workExperiences as $index => $work)
                                <div class="work-experience-item row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">الوظيفة</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.position') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][position]" placeholder="الوظيفة" 
                                               value="{{ $work->position }}" required>
                                        @error('work_experiences.'.$index.'.position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">البلد</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.country') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][country]" placeholder="البلد" 
                                               value="{{ $work->country ?? '' }}" required>
                                        @error('work_experiences.'.$index.'.country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">المدة</label>
                                        <input type="text" class="form-control @error('work_experiences.'.$index.'.duration') is-invalid @enderror" 
                                               name="work_experiences[{{ $index }}][duration]" placeholder="المدة" 
                                               value="{{ $work->duration ?? '' }}" required>
                                        @error('work_experiences.'.$index.'.duration')
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
    // دالة حذف الفيديو
    function deleteVideo() {
        if (confirm('هل أنت متأكد من حذف الفيديو؟')) {
            document.getElementById('delete_video').value = '1';
            const container = document.getElementById('current-video-container');
            if (container) {
                container.style.display = 'none';
            }
            // إزالة أي ملف محدد في input
            const videoInput = document.getElementById('video');
            if (videoInput) {
                videoInput.value = '';
            }
        }
    }

    // دالة حذف الصورة
    function deleteImage() {
        if (confirm('هل أنت متأكد من حذف الصورة؟')) {
            document.getElementById('delete_image').value = '1';
            const container = document.getElementById('current-image-container');
            if (container) {
                container.style.display = 'none';
            }
            // إزالة أي ملف محدد في input
            const imageInput = document.getElementById('image');
            if (imageInput) {
                imageInput.value = '';
            }
            // إخفاء معاينة الصورة الجديدة إن وجدت
            const previewContainer = document.getElementById('new-maid-image-preview');
            if (previewContainer) {
                previewContainer.style.display = 'none';
            }
        }
    }

    // معاينة صورة الخادمة عند اختيار صورة جديدة
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const currentImageContainer = document.getElementById('current-image-container');
        const newImagePreviewContainer = document.getElementById('new-maid-image-preview');
        const imagePreview = document.getElementById('maid-image-preview');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // إلغاء حذف الصورة إذا تم اختيار صورة جديدة
                    const deleteImageInput = document.getElementById('delete_image');
                    if (deleteImageInput) {
                        deleteImageInput.value = '0';
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (imagePreview) {
                            imagePreview.src = e.target.result;
                            if (newImagePreviewContainer) {
                                newImagePreviewContainer.style.display = 'block';
                            }
                        }
                        if (currentImageContainer) {
                            currentImageContainer.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    if (newImagePreviewContainer) {
                        newImagePreviewContainer.style.display = 'none';
                    }
                    if (currentImageContainer && document.getElementById('delete_image').value === '0') {
                        currentImageContainer.style.display = 'block';
                    }
                }
            });
        }

        // معاينة الفيديو عند اختيار فيديو جديد
        const videoInput = document.getElementById('video');
        if (videoInput) {
            videoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // إلغاء حذف الفيديو إذا تم اختيار فيديو جديد
                    const deleteVideoInput = document.getElementById('delete_video');
                    if (deleteVideoInput) {
                        deleteVideoInput.value = '0';
                    }
                    
                    // إظهار الحاوية إذا كانت مخفية
                    const currentVideoContainer = document.getElementById('current-video-container');
                    if (currentVideoContainer && deleteVideoInput && deleteVideoInput.value === '0') {
                        currentVideoContainer.style.display = 'block';
                    }
                }
            });
        }
    });
</script>
<script>
    let skillIndex = {{ old('skills') ? count(old('skills')) : $maid->skills()->count() }};
    let workExperienceIndex = {{ old('work_experiences') ? count(old('work_experiences')) : $maid->workExperiences()->count() }};

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
        
        // إضافة خبرة عمل مبسطة (الوظيفة - البلد - المدة فقط)
        const workItem = document.createElement('div');
        workItem.className = 'work-experience-item row mb-3';
        workItem.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">الوظيفة</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][position]" 
                       placeholder="الوظيفة" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">البلد</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][country]" 
                       placeholder="البلد" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">المدة</label>
                <input type="text" class="form-control" name="work_experiences[${workExperienceIndex}][duration]" 
                       placeholder="المدة" required>
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
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    });
</script>
@endsection

