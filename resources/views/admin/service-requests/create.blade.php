@extends('admin.layout')

@section('title', 'إضافة طلب جديد')
@section('page-title', 'إضافة طلب جديد')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>
                <i class="bi bi-plus-circle"></i>
                إضافة طلب جديد
            </h2>
            <a href="{{ route('admin.service-requests.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-right"></i>
                العودة للطلبات
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-info-circle"></i>
                    معلومات الطلب
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.service-requests.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">التليفون <span class="text-danger">*</span></label>
                                <input type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="مثال: 0501234567"
                                       required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="service_type" class="form-label">نوع الخدمة <span class="text-danger">*</span></label>
                                <select class="form-select @error('service_type') is-invalid @enderror" 
                                        id="service_type" 
                                        name="service_type" 
                                        required>
                                    <option value="">اختر نوع الخدمة</option>
                                    @foreach(App\Models\ServiceRequest::getServiceTypes() as $key => $value)
                                        <option value="{{ $key }}" {{ old('service_type') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="nationality" class="form-label">الجنسية <span class="text-danger">*</span></label>
                                <select class="form-select @error('nationality') is-invalid @enderror" 
                                        id="nationality" 
                                        name="nationality" 
                                        required>
                                    <option value="">اختر الجنسية</option>
                                    @foreach(App\Models\ServiceRequest::getNationalities() as $key => $value)
                                        <option value="{{ $key }}" {{ old('nationality') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="emirate" class="form-label">الإمارة <span class="text-danger">*</span></label>
                                <select class="form-select @error('emirate') is-invalid @enderror" 
                                        id="emirate" 
                                        name="emirate" 
                                        required>
                                    <option value="">اختر الإمارة</option>
                                    @foreach(App\Models\ServiceRequest::getEmirates() as $key => $value)
                                        <option value="{{ $key }}" {{ old('emirate') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('emirate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">حالة الطلب <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    @foreach(App\Models\ServiceRequest::getStatuses() as $key => $value)
                                        <option value="{{ $key }}" {{ old('status', 'تحت المراجعه') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_active" 
                                           name="is_active" 
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        الطلب نشط
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" 
                                  name="notes" 
                                  rows="4" 
                                  placeholder="أي ملاحظات إضافية حول الطلب...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.service-requests.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i>
                            حفظ الطلب
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
