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
    <title>قائمة الخادمات</title>
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
                        <i class="fas fa-users me-2"></i>
                        قائمة الخادمات
                    </h1>
                    <a href="{{ route('maids.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        إضافة خادمة جديدة
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        @if($maids->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>الصورة</th>
                                            <th>الاسم</th>
                                            <th>العمر</th>
                                            <th>الديانة</th>
                                            <th>اللغة</th>
                                            <th>نوع الباقة</th>
                                            <th>رسوم العقد</th>
                                            <th>الراتب الشهري</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($maids as $maid)
                                            <tr>
                                                <td>
                                                    @if($maid->image_path)
                                                        <img src="{{ asset('storage/' . $maid->image_path) }}" 
                                                             alt="{{ $maid->name }}" 
                                                             class="rounded-circle" 
                                                             width="50" height="50" 
                                                             style="object-fit: cover;"
                                                             onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                                                    @else
                                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                                             style="width: 50px; height: 50px;">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="fw-bold">{{ $maid->name }}</td>
                                                <td>{{ $maid->age }} سنة</td>
                                                <td>{{ $maid->religion }}</td>
                                                <td>{{ $maid->language }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $maid->package_type }}</span>
                                                </td>
                                                <td class="text-success fw-bold">{{ number_format($maid->contract_fees) }} درهم إماراتي</td>
                                                <td class="text-primary fw-bold">{{ number_format($maid->monthly_salary) }} درهم إماراتي</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('maids.show', $maid) }}" 
                                                           class="btn btn-sm btn-outline-info" 
                                                           title="عرض التفاصيل">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('maids.edit', $maid) }}" 
                                                           class="btn btn-sm btn-outline-warning" 
                                                           title="تعديل">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('maids.destroy', $maid) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الخادمة؟')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-sm btn-outline-danger" 
                                                                    title="حذف">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $maids->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">لا توجد خادمات مسجلة</h4>
                                <p class="text-muted">ابدأ بإضافة خادمة جديدة</p>
                                <a href="{{ route('maids.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>
                                    إضافة خادمة جديدة
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
