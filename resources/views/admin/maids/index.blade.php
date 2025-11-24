@extends('admin.layout')

@section('title', 'إدارة الخادمات')
@section('page-title', 'إدارة الخادمات')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>
                <i class="bi bi-people"></i>
                إدارة الخادمات
            </h2>
            <a href="{{ route('admin.maids.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i>
                إضافة خادمة جديدة
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-list"></i>
                    قائمة الخادمات
                </h5>
            </div>
            <div class="card-body">
                @if($maids->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>الصورة</th>
                                    <th>الاسم</th>
                                    <th>العمر</th>
                                    <th>الديانة</th>
                                    <th>اللغة</th>
                                    <th>نوع الباقة</th>
                                    <th>الوظيفة</th>
                                    <th>رسوم العقد</th>
                                    <th>الراتب الشهري</th>
                                    <th>المهارات</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($maids as $maid)
                                    <tr>
                                        <td>
                                            @if($maid->image_path)
                                                <img src="{{ asset('storage/' . $maid->image_path) }}?v={{ strtotime($maid->updated_at) }}" 
                                                     alt="{{ $maid->name }}" 
                                                     class="rounded" 
                                                     width="80" 
                                                     style="height: auto; max-height: 100px; object-fit: contain; display: block;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 100px; display: none;">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 80px; height: 100px;">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $maid->name }}</strong>
                                            @if($maid->video_path)
                                                <br><small class="text-success">
                                                    <i class="bi bi-play-circle"></i> فيديو متوفر
                                                </small>
                                            @endif
                                        </td>
                                        <td>{{ $maid->age }} سنة</td>
                                        <td>{{ $maid->religion }}</td>
                                        <td>{{ $maid->language }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $maid->package_type }}</span>
                                        </td>
                                        <td>{{ $maid->job_title }}</td>
                                        <td>
                                            <strong class="text-success">{{ number_format($maid->contract_fees, 2) }} درهم إماراتي</strong>
                                        </td>
                                        <td>
                                            <strong class="text-primary">{{ number_format($maid->monthly_salary, 2) }} درهم إماراتي</strong>
                                        </td>
                                        <td>
                                            @if($maid->skills()->count() > 0)
                                                <span class="badge bg-info">{{ $maid->skills()->count() }} مهارة</span>
                                            @else
                                                <span class="text-muted">لا توجد مهارات</span>
                                            @endif
                                        </td>
                                        <td>{{ $maid->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.maids.show', $maid->id) }}" 
                                                   class="btn btn-outline-info" 
                                                   title="عرض التفاصيل">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.maids.edit', $maid->id) }}" 
                                                   class="btn btn-outline-warning" 
                                                   title="تعديل">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.maids.destroy', $maid->id) }}" 
                                                      method="POST" 
                                                      class="d-inline btn-delete"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذه الخادمة؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="حذف">
                                                        <i class="bi bi-trash"></i>
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
                        <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                        <h4 class="text-muted mt-3">لا توجد خادمات مسجلة</h4>
                        <p class="text-muted">ابدأ بإضافة أول خادمة إلى النظام</p>
                        <a href="{{ route('admin.maids.create') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-person-plus"></i>
                            إضافة خادمة جديدة
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // تأكيد الحذف
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.btn-delete');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('هل أنت متأكد من حذف هذه الخادمة؟ لا يمكن التراجع عن هذا الإجراء.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
