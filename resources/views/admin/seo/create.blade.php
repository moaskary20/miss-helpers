@extends('admin.layout')

@section('title', 'Create SEO Setting')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New SEO Setting</h3>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.seo.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="page_type" class="form-label">Page Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="page_type" name="page_type" required>
                                        <option value="">Select Page Type</option>
                                        @foreach($pageTypes as $type)
                                            <option value="{{ $type }}" {{ old('page_type') === $type ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('page_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="locale" class="form-label">Locale <span class="text-danger">*</span></label>
                                    <select class="form-select" id="locale" name="locale" required>
                                        <option value="">Select Locale</option>
                                        @foreach($locales as $locale)
                                            <option value="{{ $locale }}" {{ old('locale') === $locale ? 'selected' : '' }}>
                                                {{ strtoupper($locale) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('locale')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title') }}" required maxlength="255">
                            <div class="form-text">Maximum 255 characters</div>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" required maxlength="500">{{ old('description') }}</textarea>
                            <div class="form-text">Maximum 500 characters</div>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" 
                                   value="{{ old('keywords') }}" maxlength="500">
                            <div class="form-text">Comma-separated keywords (Maximum 500 characters)</div>
                            @error('keywords')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mt-4 mb-3">Open Graph Settings</h5>
                        
                        <div class="mb-3">
                            <label for="og_title" class="form-label">OG Title</label>
                            <input type="text" class="form-control" id="og_title" name="og_title" 
                                   value="{{ old('og_title') }}" maxlength="255">
                            <div class="form-text">Leave empty to use main title</div>
                            @error('og_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="og_description" class="form-label">OG Description</label>
                            <textarea class="form-control" id="og_description" name="og_description" 
                                      rows="3" maxlength="500">{{ old('og_description') }}</textarea>
                            <div class="form-text">Leave empty to use main description</div>
                            @error('og_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="og_image" class="form-label">OG Image URL</label>
                            <input type="url" class="form-control" id="og_image" name="og_image" 
                                   value="{{ old('og_image') }}" maxlength="500">
                            <div class="form-text">Full URL to the image</div>
                            @error('og_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="mt-4 mb-3">Twitter Card Settings</h5>
                        
                        <div class="mb-3">
                            <label for="twitter_title" class="form-label">Twitter Title</label>
                            <input type="text" class="form-control" id="twitter_title" name="twitter_title" 
                                   value="{{ old('twitter_title') }}" maxlength="255">
                            <div class="form-text">Leave empty to use main title</div>
                            @error('twitter_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="twitter_description" class="form-label">Twitter Description</label>
                            <textarea class="form-control" id="twitter_description" name="twitter_description" 
                                      rows="3" maxlength="500">{{ old('twitter_description') }}</textarea>
                            <div class="form-text">Leave empty to use main description</div>
                            @error('twitter_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="twitter_image" class="form-label">Twitter Image URL</label>
                            <input type="url" class="form-control" id="twitter_image" name="twitter_image" 
                                   value="{{ old('twitter_image') }}" maxlength="500">
                            <div class="form-text">Full URL to the image</div>
                            @error('twitter_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save SEO Setting
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
