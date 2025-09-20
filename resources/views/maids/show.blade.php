<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
    new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
    "https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,"script","dataLayer","GTM-TB5M9MCD");</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تفاصيل الخادمة - {{ $maid->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB5M9MCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 text-primary">
                        <i class="fas fa-user me-2"></i>
                        تفاصيل الخادمة
                    </h1>
                    <div>
                        <a href="{{ route('maids.edit', $maid) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-1"></i>
                            تعديل
                        </a>
                        <a href="{{ route('maids.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-right me-1"></i>
                            العودة للقائمة
                        </a>
                    </div>
                </div>

                <div class="row">
                    <!-- الصورة والفيديو -->
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-images me-2"></i>
                                    الصور والفيديوهات
                                </h5>
                            </div>
                            <div class="card-body text-center">
                                @if($maid->image_path)
                                    <img src="{{ asset('storage/' . $maid->image_path) }}" 
                                         alt="{{ $maid->name }}" 
                                         class="img-fluid rounded mb-3" 
                                         style="max-height: 300px; object-fit: cover;"
                                         onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center mb-3" 
                                         style="height: 300px;">
                                        <i class="fas fa-user fa-5x text-white"></i>
                                    </div>
                                @endif

                                @if($maid->video_path)
                                    <div class="mt-3">
                                        <h6 class="text-muted mb-2">
                                            <i class="fas fa-video me-2"></i>
                                            فيديو الخادمة
                                        </h6>
                                        <video controls class="w-100 rounded shadow" style="max-height: 250px;">
                                            <source src="{{ asset('storage/' . $maid->video_path) }}" type="video/mp4">
                                            متصفحك لا يدعم تشغيل الفيديو.
                                        </video>
                                    </div>
                                @else
                                    <div class="mt-3 text-center">
                                        <p class="text-muted">
                                            <i class="fas fa-video-slash me-2"></i>
                                            لا يوجد فيديو متاح
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- المعلومات الشخصية -->
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    المعلومات الشخصية
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>الاسم:</strong>
                                        <p class="text-muted">{{ $maid->name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>الجنسية:</strong>
                                        <p class="text-muted">
                                            <span class="badge bg-info">{{ $maid->nationality ?? 'غير محدد' }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>العمر:</strong>
                                        <p class="text-muted">{{ $maid->age }} سنة</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>تاريخ الميلاد:</strong>
                                        <p class="text-muted">{{ $maid->birth_date->format('Y-m-d') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>الديانة:</strong>
                                        <p class="text-muted">{{ $maid->religion }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>اللغة:</strong>
                                        <p class="text-muted">{{ $maid->language }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>التعليم:</strong>
                                        <p class="text-muted">{{ $maid->education }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>الحالة الاجتماعية:</strong>
                                        <p class="text-muted">{{ $maid->marital_status ?? 'غير محدد' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>عدد الأطفال:</strong>
                                        <p class="text-muted">{{ $maid->children_count ?? '0' }}</p>
                                    </div>
                                    @if($maid->height)
                                        <div class="col-md-6 mb-3">
                                            <strong>الطول:</strong>
                                            <p class="text-muted">{{ $maid->height }} سم</p>
                                        </div>
                                    @endif
                                    @if($maid->weight)
                                        <div class="col-md-6 mb-3">
                                            <strong>الوزن:</strong>
                                            <p class="text-muted">{{ $maid->weight }} كجم</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- فيديو الخادمة -->
                @if($maid->video_path)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-video me-2"></i>
                                        فيديو الخادمة
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <video controls class="w-100 rounded shadow" style="max-height: 400px;">
                                        <source src="{{ asset('storage/' . $maid->video_path) }}" type="video/mp4">
                                        متصفحك لا يدعم تشغيل الفيديو.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- معلومات العقد -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0">
                                    <i class="fas fa-file-contract me-2"></i>
                                    معلومات العقد
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <strong>نوع الباقة:</strong>
                                        <p class="text-muted">
                                            <span class="badge bg-info">{{ $maid->package_type }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>الوظيفة:</strong>
                                        <p class="text-muted">{{ $maid->job_title }}</p>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>نوع العقد:</strong>
                                        <p class="text-muted">{{ $maid->contract_type }}</p>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>رسوم العقد:</strong>
                                        <p class="text-success fw-bold fs-5">{{ number_format($maid->contract_fees) }} درهم إماراتي</p>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <strong>الراتب الشهري:</strong>
                                        <p class="text-primary fw-bold fs-5">{{ number_format($maid->monthly_salary) }} درهم إماراتي</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- المهارات -->
                @if($maid->skills()->count() > 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-tools me-2"></i>
                                        المهارات
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($maid->skills() as $skill)
                                            <div class="col-md-6 mb-3">
                                                <div class="border rounded p-3">
                                                    <h6 class="text-primary mb-2">
                                                        <i class="fas fa-star me-1"></i>
                                                        {{ $skill->skill_name }}
                                                    </h6>
                                                    @if($skill->description)
                                                        <p class="text-muted mb-0">{{ $skill->description }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- الخبرات العملية -->
                @if($maid->workExperiences()->count() > 0)
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-briefcase me-2"></i>
                                        الخبرات العملية
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @foreach($maid->workExperiences() as $experience)
                                        <div class="border rounded p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>اسم الشركة/المكان:</strong>
                                                    <p class="text-muted">{{ $experience->company_name }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>المنصب:</strong>
                                                    <p class="text-muted">{{ $experience->position }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>البلد:</strong>
                                                    <p class="text-muted">{{ $experience->country ?? 'غير محدد' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>نوع العمل:</strong>
                                                    <p class="text-muted">{{ $experience->work_type ?? 'غير محدد' }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>المدة:</strong>
                                                    <p class="text-muted">{{ $experience->duration ?? 'غير محدد' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>فترة العمل:</strong>
                                                    <p class="text-muted">
                                                        @if($experience->start_date)
                                                            {{ $experience->start_date->format('Y-m-d') }}
                                                            @if($experience->end_date)
                                                                - {{ $experience->end_date->format('Y-m-d') }}
                                                            @else
                                                                - حتى الآن
                                                            @endif
                                                        @else
                                                            غير محدد
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    @if($experience->description)
                                                        <strong>الوصف:</strong>
                                                        <p class="text-muted">{{ $experience->description }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
