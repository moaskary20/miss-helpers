@extends('admin.layout')

@section('title', 'SEO Settings Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">SEO Settings Management</h3>
                    <div>
                        <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New SEO Setting
                        </a>
                        <a href="{{ route('admin.seo.generate-sitemap') }}" class="btn btn-success">
                            <i class="fas fa-sitemap"></i> Generate Sitemap
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Page Type</th>
                                    <th>Locale</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($seoSettings as $setting)
                                    <tr>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst($setting->page_type) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $setting->locale === 'ar' ? 'warning' : 'primary' }}">
                                                {{ strtoupper($setting->locale) }}
                                            </span>
                                        </td>
                                        <td>{{ Str::limit($setting->title, 50) }}</td>
                                        <td>{{ Str::limit($setting->description, 80) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $setting->is_active ? 'success' : 'danger' }}">
                                                {{ $setting->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.seo.edit', $setting->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.seo.preview', ['pageType' => $setting->page_type, 'locale' => $setting->locale]) }}" 
                                                   class="btn btn-sm btn-outline-info" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.seo.destroy', $setting->id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this SEO setting?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No SEO settings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
