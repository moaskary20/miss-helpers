@extends('admin.layout')

@section('title', 'تفاصيل الخادمة - ' . $maid->name)
@section('page-title', 'تفاصيل الخادمة')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="bi bi-person"></i>
                تفاصيل الخادمة: {{ $maid->name }}
            </h2>
            <div>
                <a href="{{ route('admin.maids.edit', $maid->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i>
                    تعديل
                </a>
                <a href="{{ route('admin.maids.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- الصورة والفيديو -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-image"></i>
                    الصورة والفيديو
                </h5>
            </div>
            <div class="card-body text-center">
                @if($maid->image_path)
                    <img src="{{ url('/storage/' . $maid->image_path) }}" 
                         alt="{{ $maid->name }}" 
                         class="img-fluid rounded mb-3" 
                         style="max-height: 300px; object-fit: cover;">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                         style="height: 300px;">
                        <i class="bi bi-person text-muted" style="font-size: 4rem;"></i>
                    </div>
                @endif
                
                @if($maid->video_path)
                    <div class="mt-3">
                        <video controls class="w-100 rounded" style="max-height: 200px;">
                            <source src="{{ url('/storage/' . $maid->video_path) }}" type="video/mp4">
                            متصفحك لا يدعم تشغيل الفيديو.
                        </video>
                    </div>
                @else
                    <p class="text-muted mt-3">لا يوجد فيديو متوفر</p>
                @endif
            </div>
        </div>
    </div>
    
    <!-- المعلومات الشخصية -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-lines-fill"></i>
                    المعلومات الشخصية
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">الاسم الكامل:</label>
                            <p class="form-control-plaintext">{{ $maid->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">الجنسية:</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-info">{{ $maid->nationality ?? 'غير محدد' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">العمر:</label>
                            <p class="form-control-plaintext">{{ $maid->age }} سنة</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">تاريخ الميلاد:</label>
                            <p class="form-control-plaintext">{{ $maid->birth_date ? $maid->birth_date->format('Y-m-d') : 'غير محدد' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">تاريخ الميلاد:</label>
                            <p class="form-control-plaintext">{{ $maid->birth_date ? $maid->birth_date->format('Y-m-d') : 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">الديانة:</label>
                            <p class="form-control-plaintext">{{ $maid->religion }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">اللغة:</label>
                            <p class="form-control-plaintext">{{ $maid->language }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">التعليم:</label>
                            <p class="form-control-plaintext">{{ $maid->education }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">الحالة الاجتماعية:</label>
                            <p class="form-control-plaintext">{{ $maid->marital_status ?? 'غير محدد' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">عدد الأطفال:</label>
                            <p class="form-control-plaintext">{{ $maid->children_count ?? '0' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">سنوات الخبرة:</label>
                            <p class="form-control-plaintext">
                                <strong class="text-primary fs-5">{{ $maid->experience_years ?? '0' }} سنة</strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">الطول:</label>
                            <p class="form-control-plaintext">{{ $maid->height ? $maid->height . ' سم' : 'غير محدد' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">الوزن:</label>
                            <p class="form-control-plaintext">{{ $maid->weight ? $maid->weight . ' كجم' : 'غير محدد' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
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
                    <label class="form-label fw-bold">نوع الباقة:</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-primary">{{ $maid->package_type }}</span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الوظيفة:</label>
                    <p class="form-control-plaintext">{{ $maid->job_title }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">نوع العقد:</label>
                    <p class="form-control-plaintext">{{ $maid->contract_type }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">رسوم العقد:</label>
                    <p class="form-control-plaintext">
                        <strong class="text-success fs-5">{{ number_format($maid->contract_fees, 2) }} درهم إماراتي</strong>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">الراتب الشهري:</label>
                    <p class="form-control-plaintext">
                        <strong class="text-primary fs-5">{{ number_format($maid->monthly_salary, 2) }} درهم إماراتي</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- معلومات إضافية -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات إضافية
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">تاريخ الإضافة:</label>
                    <p class="form-control-plaintext">{{ $maid->created_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">آخر تحديث:</label>
                    <p class="form-control-plaintext">{{ $maid->updated_at->format('Y-m-d H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">عدد المهارات:</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-info">{{ $maid->skills()->count() }} مهارة</span>
                    </p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">خبرات العمل:</label>
                    <p class="form-control-plaintext">
                        <span class="badge bg-warning">{{ $maid->workExperiences()->count() }} خبرة</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- المهارات -->
@if($maid->skills()->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-award"></i>
                    المهارات
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($maid->skills() as $skill)
                        <div class="col-md-6 mb-3">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">{{ $skill->skill_name }}</h6>
                                    @if($skill->description)
                                        <p class="card-text">{{ $skill->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- خبرات العمل السابقة -->
@if($maid->workExperiences()->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-briefcase"></i>
                    خبرات العمل السابقة
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>اسم الشركة</th>
                                <th>المنصب</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>الوصف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maid->workExperiences() as $work)
                                <tr>
                                    <td><strong>{{ $work->company_name }}</strong></td>
                                    <td>{{ $work->position }}</td>
                                    <td>{{ $work->start_date ? $work->start_date->format('Y-m-d') : 'غير محدد' }}</td>
                                    <td>{{ $work->end_date ? $work->end_date->format('Y-m-d') : 'حتى الآن' }}</td>
                                    <td>{{ $work->description ?: 'لا يوجد وصف' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- أزرار الإجراءات -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ route('admin.maids.edit', $maid->id) }}" class="btn btn-warning btn-lg me-3">
                    <i class="bi bi-pencil"></i>
                    تعديل الخادمة
                </a>
                <form action="{{ route('admin.maids.destroy', $maid->id) }}" 
                      method="POST" 
                      class="d-inline"
                      onsubmit="return confirm('هل أنت متأكد من حذف هذه الخادمة؟ لا يمكن التراجع عن هذا الإجراء.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg me-3">
                        <i class="bi bi-trash"></i>
                        حذف الخادمة
                    </button>
                </form>
                <a href="{{ route('admin.maids.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-right"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
