<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.profile') }} | Miss Helpers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            line-height: 1.6;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        html {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        
        /* Header Styles */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .header-inner {
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .brand img {
            height: 34px;
        }
        
        .brand .title {
            font-weight: 800;
            color: #1c1c1c;
            letter-spacing: .5px;
        }
        
        .nav-links a {
            color: #1c1c1c;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 12px;
            font-weight: 600;
        }
        
        .nav-links a:hover {
            background: #f6f7fb;
        }
        
        .cta-btn {
            background: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 18px;
            padding: 10px 18px;
            font-weight: 800;
        }
        
        /* Main Content */
        .main-content {
            width: 100%;
            padding: 2rem 0;
        }
        
        .main-content .container {
            width: 100%;
            max-width: none;
            padding: 0 15px;
        }
        
        /* Profile Styles */
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .avatar-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
            font-size: 3rem;
        }
        
        /* Navigation Tabs */
        .nav-tabs {
            border-bottom: 2px solid #e9ecef;
        }
        
        .nav-tabs .nav-link {
            border: none;
            border-bottom: 2px solid transparent;
            color: #6c757d;
            font-weight: 500;
            padding: 1rem 1.5rem;
        }
        
        .nav-tabs .nav-link.active {
            color: #007bff;
            border-bottom-color: #007bff;
            background: none;
        }
        
        .nav-tabs .nav-link:hover {
            border-bottom-color: #007bff;
            color: #007bff;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            border-radius: 15px 15px 0 0 !important;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            padding: 0.5rem 1.5rem;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            border-radius: 10px;
            padding: 0.5rem 1.5rem;
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
        
        /* Form Controls */
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 0.75rem 1rem;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        /* Alerts */
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        /* Stats */
        .stat-item {
            padding: 1rem 0;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Footer Styles */
        .footer-section {
            background: #2c3e50;
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }
        
        .footer-section .container {
            width: 100%;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .logo-text {
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
        }
        
        .footer-links h4 {
            color: #ecf0f1;
            margin-bottom: 1rem;
        }
        
        .footer-links ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-links ul li {
            margin-bottom: 0.5rem;
        }
        
        .footer-links ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links ul li a:hover {
            color: #007bff;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .brand .title {
                font-size: 1.2rem;
            }
            
            .main-content {
                padding: 1rem 15px;
            }
            
            .avatar-circle {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .avatar-circle {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.header')
    
    <div class="main-content">
        <div class="container">
    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        <div class="avatar-circle">
                            <i class="bi bi-person-circle"></i>
                        </div>
                    </div>
                    <h4 class="card-title">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>
                    @if($user->phone)
                        <p class="text-muted"><i class="bi bi-telephone"></i> {{ $user->phone }}</p>
                    @endif
                    <p class="text-muted">
                        <small>{{ __('messages.member_since') }} {{ $user->created_at->format('M Y') }}</small>
                    </p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ __('messages.quick_stats') }}</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-number text-primary">0</div>
                                <div class="stat-label">{{ __('messages.orders') }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-number text-success">0</div>
                                <div class="stat-label">{{ __('messages.conversations') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                        <i class="bi bi-person"></i> {{ __('messages.personal_information') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">
                        <i class="bi bi-bag"></i> {{ __('messages.my_orders') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                        <i class="bi bi-star"></i> {{ __('messages.my_reviews') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab">
                        <i class="bi bi-lock"></i> {{ __('messages.change_password') }}
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Personal Information Tab -->
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('messages.update_profile') }}</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('user.profile.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">{{ __('messages.email') }} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> {{ __('messages.save_changes') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Orders Tab -->
                <div class="tab-pane fade" id="orders" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('messages.my_orders') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center py-5">
                                <i class="bi bi-bag display-1 text-muted"></i>
                                <h5 class="mt-3 text-muted">{{ __('messages.no_orders_yet') }}</h5>
                                <p class="text-muted">{{ __('messages.when_you_request_service') }}</p>
                                <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> {{ __('messages.request_new_service') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ __('messages.my_reviews') }}</h5>
                            @if($userMaids && $userMaids->count() > 0)
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                                    <i class="bi bi-plus-circle"></i> {{ __('messages.add_review') }}
                                </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if($userMaids && $userMaids->count() > 0)
                                <!-- Display Maids -->
                                <div class="mb-4">
                                    <h6 class="mb-3">{{ __('messages.maids_you_worked_with') }}</h6>
                                    <div class="row">
                                        @foreach($userMaids as $maid)
                                            <div class="col-md-6 mb-3">
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-2">
                                                            @if($maid->image_path)
                                                                <img src="{{ asset('storage/' . $maid->image_path) }}" 
                                                                     alt="{{ $maid->name }}" 
                                                                     class="rounded-circle me-3" 
                                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="rounded-circle bg-secondary me-3 d-flex align-items-center justify-content-center" 
                                                                     style="width: 50px; height: 50px;">
                                                                    <i class="bi bi-person text-white"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <h6 class="mb-0">{{ $maid->name }}</h6>
                                                                <small class="text-muted">{{ $maid->job_title }}</small>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted small mb-2">{{ Str::limit($maid->description, 100) }}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">{{ $maid->age }} {{ __('messages.years_old') }}</small>
                                                            <a href="{{ route('maid.profile', $maid->id) }}" class="btn btn-sm btn-outline-primary">
                                                                {{ __('messages.view_profile') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Display Reviews -->
                            @if($userReviews && $userReviews->count() > 0)
                                <div class="mb-4">
                                    <h6 class="mb-3">{{ __('messages.your_reviews') }}</h6>
                                    <div class="row">
                                        @foreach($userReviews as $review)
                                            <div class="col-md-6 mb-3">
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <h6 class="card-title mb-0">{{ $review->title }}</h6>
                                                            <div class="rating">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $review->rating)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                    @else
                                                                        <i class="bi bi-star text-muted"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        @if($review->maid)
                                                            <p class="text-primary small mb-2">
                                                                <i class="bi bi-person"></i> {{ $review->maid->name }}
                                                            </p>
                                                        @endif
                                                        <p class="card-text text-muted small">{{ $review->comment }}</p>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                                            <span class="badge bg-{{ $review->status === 'approved' ? 'success' : ($review->status === 'pending' ? 'warning' : 'danger') }}">
                                                                {{ __('messages.' . $review->status) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-star display-1 text-muted"></i>
                                    <h5 class="mt-3 text-muted">{{ __('messages.no_reviews_yet') }}</h5>
                                    <p class="text-muted">{{ __('messages.share_your_experience') }}</p>
                                    @if($userMaids && $userMaids->count() > 0)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                                            <i class="bi bi-plus-circle"></i> {{ __('messages.add_review') }}
                                        </button>
                                    @else
                                        <p class="text-muted">{{ __('messages.work_with_maid_first') }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Password Tab -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('messages.change_password') }}</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('user.profile.password') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">{{ __('messages.current_password') }} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                           id="current_password" name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('messages.new_password') }} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-key"></i> {{ __('messages.update_password') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Add Review Modal -->
    <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReviewModalLabel">{{ __('messages.add_review') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('user.reviews.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="maid_id" class="form-label">{{ __('messages.select_maid') }} <span class="text-danger">*</span></label>
                            <select class="form-control @error('maid_id') is-invalid @enderror" 
                                    id="maid_id" name="maid_id" required>
                                <option value="">{{ __('messages.choose_maid') }}</option>
                                @if($userMaids && $userMaids->count() > 0)
                                    @foreach($userMaids as $maid)
                                        <option value="{{ $maid->id }}" {{ old('maid_id') == $maid->id ? 'selected' : '' }}>
                                            {{ $maid->name }} - {{ $maid->job_title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('maid_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.review_title') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="rating" class="form-label">{{ __('messages.rating') }} <span class="text-danger">*</span></label>
                            <div class="rating-input">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                    <label for="star{{ $i }}" class="star-label">
                                        <i class="bi bi-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="comment" class="form-label">{{ __('messages.comment') }} <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" 
                                      id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('messages.submit_review') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .rating-input {
            display: flex;
            gap: 5px;
        }
        
        .rating-input input[type="radio"] {
            display: none;
        }
        
        .rating-input .star-label {
            font-size: 1.5rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .rating-input .star-label:hover,
        .rating-input .star-label:hover ~ .star-label {
            color: #ffc107;
        }
        
        .rating-input input[type="radio"]:checked ~ .star-label {
            color: #ffc107;
        }
        
        .rating-input input[type="radio"]:checked + .star-label {
            color: #ffc107;
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@include('partials.footer')

</body>
</html>
