@extends('admin.layout')

@section('title', 'معاينة SEO - ' . ucfirst($pageType))

@section('content')
<style>
.preview-container {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    margin: 1rem 0;
}
.seo-preview {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.meta-tag {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 4px;
    padding: 0.5rem;
    margin: 0.5rem 0;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
}
.meta-tag strong {
    color: #0066cc;
}
.social-preview {
    border: 1px solid #e1e5e9;
    border-radius: 8px;
    overflow: hidden;
    max-width: 500px;
    margin: 1rem 0;
}
.social-preview img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.social-preview-content {
    padding: 1rem;
}
.social-preview h4 {
    margin: 0 0 0.5rem 0;
    color: #1a1a1a;
    font-size: 1.1rem;
}
.social-preview p {
    margin: 0;
    color: #606770;
    font-size: 0.9rem;
    line-height: 1.4;
}
.social-preview .url {
    color: #606770;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="bi bi-eye"></i>
                        معاينة SEO - {{ ucfirst(str_replace('_', ' ', $pageType)) }}
                    </h3>
                    <div>
                        <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            العودة للقائمة
                        </a>
                        <a href="{{ route('admin.seo.edit', $metaData['id'] ?? 1) }}" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                            تعديل
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Page Title Preview -->
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-tag"></i>
                            معاينة العنوان
                        </h4>
                        <div class="seo-preview">
                            <h2 style="color: #1a0dab; margin: 0; font-size: 1.5rem;">
                                {{ $metaData['title'] }}
                            </h2>
                            <div class="meta-tag">
                                <strong>&lt;title&gt;</strong>{{ $metaData['title'] }}<strong>&lt;/title&gt;</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Meta Description Preview -->
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-file-text"></i>
                            معاينة الوصف
                        </h4>
                        <div class="seo-preview">
                            <p style="color: #545454; margin: 0; font-size: 0.9rem;">
                                {{ $metaData['description'] }}
                            </p>
                            <div class="meta-tag">
                                <strong>&lt;meta name="description" content="</strong>{{ $metaData['description'] }}<strong>"&gt;</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Keywords Preview -->
                    @if(!empty($metaData['keywords']))
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-tags"></i>
                            معاينة الكلمات المفتاحية
                        </h4>
                        <div class="seo-preview">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode(',', $metaData['keywords']) as $keyword)
                                    <span class="badge bg-light text-dark border">{{ trim($keyword) }}</span>
                                @endforeach
                            </div>
                            <div class="meta-tag">
                                <strong>&lt;meta name="keywords" content="</strong>{{ $metaData['keywords'] }}<strong>"&gt;</strong>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Open Graph Preview -->
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-facebook"></i>
                            معاينة مشاركة فيسبوك
                        </h4>
                        <div class="social-preview">
                            <img src="{{ $metaData['og_image'] }}" alt="Preview Image" onerror="this.src='{{ asset('images/logo.png') }}'">
                            <div class="social-preview-content">
                                <h4>{{ $metaData['og_title'] ?: $metaData['title'] }}</h4>
                                <p>{{ $metaData['og_description'] ?: $metaData['description'] }}</p>
                                <div class="url">{{ $metaData['canonical_url'] }}</div>
                            </div>
                        </div>
                        <div class="meta-tag">
                            <strong>&lt;meta property="og:title" content="</strong>{{ $metaData['og_title'] ?: $metaData['title'] }}<strong>"&gt;</strong><br>
                            <strong>&lt;meta property="og:description" content="</strong>{{ $metaData['og_description'] ?: $metaData['description'] }}<strong>"&gt;</strong><br>
                            <strong>&lt;meta property="og:image" content="</strong>{{ $metaData['og_image'] }}<strong>"&gt;</strong>
                        </div>
                    </div>

                    <!-- Twitter Card Preview -->
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-twitter"></i>
                            معاينة مشاركة تويتر
                        </h4>
                        <div class="social-preview">
                            <img src="{{ $metaData['twitter_image'] ?: $metaData['og_image'] }}" alt="Preview Image" onerror="this.src='{{ asset('images/logo.png') }}'">
                            <div class="social-preview-content">
                                <h4>{{ $metaData['twitter_title'] ?: $metaData['title'] }}</h4>
                                <p>{{ $metaData['twitter_description'] ?: $metaData['description'] }}</p>
                                <div class="url">{{ $metaData['canonical_url'] }}</div>
                            </div>
                        </div>
                        <div class="meta-tag">
                            <strong>&lt;meta name="twitter:title" content="</strong>{{ $metaData['twitter_title'] ?: $metaData['title'] }}<strong>"&gt;</strong><br>
                            <strong>&lt;meta name="twitter:description" content="</strong>{{ $metaData['twitter_description'] ?: $metaData['description'] }}<strong>"&gt;</strong><br>
                            <strong>&lt;meta name="twitter:image" content="</strong>{{ $metaData['twitter_image'] ?: $metaData['og_image'] }}<strong>"&gt;</strong>
                        </div>
                    </div>

                    <!-- Schema Markup Preview -->
                    @if(!empty($metaData['schema_markup']))
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-code-square"></i>
                            معاينة Schema Markup
                        </h4>
                        <div class="seo-preview">
                            <pre style="background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; font-size: 0.8rem;">{{ json_encode($metaData['schema_markup'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                    </div>
                    @endif

                    <!-- Canonical URL -->
                    <div class="preview-container">
                        <h4 class="mb-3">
                            <i class="bi bi-link-45deg"></i>
                            معلومات إضافية
                        </h4>
                        <div class="seo-preview">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>الرابط الأساسي:</strong><br>
                                    <code>{{ $metaData['canonical_url'] }}</code>
                                </div>
                                <div class="col-md-6">
                                    <strong>اللغة:</strong><br>
                                    <span class="badge bg-{{ $metaData['locale'] === 'ar' ? 'warning' : 'primary' }}">
                                        {{ $metaData['locale'] === 'ar' ? 'عربي' : 'English' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
