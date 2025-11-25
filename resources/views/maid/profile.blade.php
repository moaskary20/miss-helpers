<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
    new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
    "https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,"script","dataLayer","GTM-TB5M9MCD");</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $additionalData = [
            'title' => $maid->name . ' - ' . __('messages.maid_profile') . ' | Miss Helpers',
            'description' => $maid->description ?: __('messages.maid_profile_description', ['name' => $maid->name, 'nationality' => $maid->nationality]),
            'keywords' => $maid->nationality . ', ' . $maid->service_type . ', ' . __('messages.maid_profile') . ', Miss Helpers'
        ];
        $seoData = \App\Helpers\SeoHelper::generateMetaTags('maid_profile', app()->getLocale(), $additionalData);
        $schemaMarkup = \App\Helpers\SeoHelper::generateSchemaMarkup('maid_profile', ['maid' => $maid]);
        $seoData['schema_markup'] = $schemaMarkup;
    @endphp
    
    @include('partials.seo-meta', ['metaData' => $seoData])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        /* Header Styles */
        .site-header{position:sticky;top:0;z-index:1000;background:#fff;border-bottom:1px solid #f1f1f1}
        .header-inner{height:64px;display:flex;align-items:center;justify-content:space-between}
        .brand{display:flex;align-items:center;gap:10px;text-decoration:none}
        .brand img{height:34px}
        .brand .title{font-weight:800;color:#1c1c1c;letter-spacing:.5px}
        .nav-links a{color:#1c1c1c;text-decoration:none;padding:10px 14px;border-radius:12px;font-weight:600}
        .nav-links a:hover{background:#f6f7fb}
        .cta-btn{background:#ffa19c;color:#fff;border:none;border-radius:18px;padding:10px 18px;font-weight:800}
        .auth a{color:#1c1c1c;text-decoration:none;margin-inline-start:14px}
        
        .profile-header {
            background: linear-gradient(135deg, #23336b 0%, #1a2533 100%);
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        
        .profile-avatar {
            width: 240px;
            height: 240px;
            border-radius: 12px; /* square with slight rounding */
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            object-fit: cover;
        }
        
        /* Mobile View - Larger Profile Image */
        @media (max-width: 768px) {
            .profile-avatar {
                width: 360px;
                height: 360px;
                border-radius: 16px;
                border: 8px solid white;
                box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            }
            
            /* Keep stats in one row on tablet */
            .profile-stats .row {
                flex-direction: row !important;
            }
            
            .profile-stats .col-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
                padding: 15px 10px;
            }
            
            .profile-stats .stat-item {
                padding: 15px 10px;
            }
        }
        
        @media (max-width: 576px) {
            .profile-avatar {
                width: 352px;
                height: 352px;
                border-radius: 18px;
                border: 10px solid white;
                box-shadow: 0 25px 60px rgba(0,0,0,0.6);
            }
            
            /* Adjust profile header for larger image */
            .profile-header {
                padding: 40px 0;
            }
            
            .profile-header .row {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-header .col-lg-3 {
                margin-bottom: 20px;
            }
            
            .profile-header .col-lg-6 {
                margin-bottom: 20px;
            }
            
            /* Keep stats in one row on mobile */
            .profile-stats .row {
                flex-direction: row !important;
            }
            
            .profile-stats .col-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
                padding: 10px 5px;
            }
            
            .profile-stats .stat-item {
                padding: 10px 5px;
            }
            
            .profile-stats .stat-number {
                font-size: 1.5rem;
            }
            
            .profile-stats .stat-label {
                font-size: 0.8rem;
            }
        }
        
        .profile-stats {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(10px);
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #ffc107;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .main-content {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .section-title {
            color: #23336b;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: #e91e63;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #23336b;
        }
        
        .info-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #23336b;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .skill-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 10px 15px;
            border-radius: 20px;
            text-align: center;
            font-weight: 500;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .skill-tag:hover {
            background: #1976d2;
            color: white;
            transform: translateY(-2px);
        }
        
        .contact-btn {
            background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(233, 30, 99, 0.3);
        }
        
        .back-btn {
            background: #6c757d;
            border: none;
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .rating-stars {
            color: #ffc107;
            font-size: 1.5rem;
        }
        
        .reviews-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }
        
        .review-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #e91e63;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .reviewer-name {
            font-weight: 600;
            color: #23336b;
        }
        
        .review-date {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        /* Image Modal Styles */
        .profile-avatar:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
        
        #imageModal .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        
        #imageModal .modal-header {
            background: #ffa19c;
            color: white;
            border: none;
        }
        
        #imageModal .modal-body {
            background: #f8f9fa;
        }
        
        #imageModal .modal-footer {
            background: #f8f9fa;
            border: none;
        }
        
        /* Mobile Modal Improvements */
        @media (max-width: 768px) {
            #imageModal .modal-dialog {
                margin: 10px;
                max-width: calc(100% - 20px);
            }
            
            #imageModal .modal-body img {
                max-height: 70vh;
            }
            
            #imageModal .modal-header h5 {
                font-size: 1.1rem;
            }
        }
        
        @media (max-width: 576px) {
            #imageModal .modal-dialog {
                margin: 5px;
                max-width: calc(100% - 10px);
            }
            
            #imageModal .modal-body img {
                max-height: 60vh;
            }
            
            #imageModal .modal-header h5 {
                font-size: 1rem;
            }
        }
        
        .review-text {
            color: #495057;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            /* keep large avatar on mobile; no override for size here */
            .profile-avatar { border-radius: 10px; }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .skills-grid {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }
        }

        /* Button Styles */
        .contact-btn {
            background: linear-gradient(135deg, #e91e63 0%, #ff6b9d 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(233, 30, 99, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, #23336b 0%, #4a5fc1 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
            padding: 20px 25px;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 20px 25px;
            text-align: center;
        }

        .modal-footer a {
            color: #23336b;
            text-decoration: none;
            font-weight: 600;
        }

        .modal-footer a:hover {
            text-decoration: underline;
        }

        .form-label {
            font-weight: 600;
            color: #23336b;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #23336b;
            box-shadow: 0 0 0 0.2rem rgba(35, 51, 107, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #23336b 0%, #4a5fc1 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(35, 51, 107, 0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Work Experience Styles */
        .work-experience-container {
            padding: 10px 0;
        }

        .experience-item {
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 20px;
            background: white;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .experience-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-color: #e91e63;
        }

        .experience-company {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .experience-position {
            font-size: 1rem;
            font-weight: 600;
        }

        .experience-location {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .experience-dates {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .description-content {
            position: relative;
            overflow: hidden;
        }

        .description-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
        }

        /* Responsive Design for Work Experience */
        @media (max-width: 768px) {
            .experience-item {
                padding: 15px;
                margin-bottom: 15px;
            }

            .experience-company {
                font-size: 1.1rem;
            }

            .experience-position {
                font-size: 0.95rem;
            }

            .experience-dates {
                font-size: 0.8rem;
                margin-top: 10px;
            }

            .description-content {
                padding: 15px !important;
            }
        }
    </style>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB5M9MCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('partials.header')
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 text-center">
                    <img src="{{ $maid->image_path ? asset('storage/' . $maid->image_path) : asset('/images/default-maid.jpg') }}" 
                         alt="{{ $maid->name }}" class="profile-avatar" 
                         style="cursor: pointer;"
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal"
                         onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                    
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">{{ $maid->name }}</h1>
                    <p class="lead mb-4">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->nationality) }} • {{ $maid->age ?? __('messages.not_specified') }} {{ __('messages.years') }}</p>
                    <div class="rating-stars mb-3">
                        @php($averageRating = round($maid->average_rating))
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $averageRating)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                        <span class="ms-2">({{ $maid->approvedReviews()->count() }} {{ __('messages.ratings') }})</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="profile-stats">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $maid->views_count ?? rand(100, 500) }}</div>
                                    <div class="stat-label">{{ __('messages.views') }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $maid->approvedReviews()->count() }}</div>
                                    <div class="stat-label">{{ __('messages.reviews') }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="stat-number">{{ $maid->experience_years ?? rand(2, 8) }}</div>
                                    <div class="stat-label">{{ __('messages.years_experience') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container main-content">
        <div class="row">
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-person-circle"></i>
                        {{ __('messages.personal_information') }}
                    </h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.full_name') }}</div>
                            <div class="info-value">{{ $maid->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.nationality') }}</div>
                            <div class="info-value">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->nationality) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.age') }}</div>
                            <div class="info-value">{{ $maid->age ?? __('messages.not_specified') }} {{ __('messages.years') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.marital_status') }}</div>
                            <div class="info-value">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->marital_status) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.children_count') }}</div>
                            <div class="info-value">{{ $maid->children_count ?? '0' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.experience_years') }}</div>
                            <div class="info-value">{{ $maid->experience_years ?? __('messages.not_specified') }} {{ __('messages.years') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Skills -->
                @if($maid->skills && $maid->skills->count() > 0)
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-award"></i>
                            {{ __('messages.skills') }}
                        </h3>
                        <div class="skills-grid">
                            @foreach($maid->skills as $skill)
                                <div class="skill-tag">
                                    {{ $skill->translated_skill_name }}
                                    @if($skill->description)
                                        <small class="d-block text-muted">{{ $skill->translated_description }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Work Experience -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-briefcase"></i>
                        {{ __('messages.work_experience') }}
                    </h3>
                    @if($maid->workExperiences()->count() > 0)
                        <div class="work-experience-container">
                            @foreach($maid->workExperiences()->get() as $index => $experience)
                                @php($translatedExperience = \App\Helpers\TranslationHelper::translateWorkExperience($experience))
                                <div class="experience-item mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <h6 class="experience-position mb-0" style="color: #e91e63; font-weight: 600;">
                                                {{ $translatedExperience->position }}
                                            </h6>
                                        </div>
                                        <div class="col-md-4">
                                            @if($translatedExperience->country)
                                                <p class="experience-location mb-0" style="color: #6c757d;">
                                                    <i class="bi bi-geo-alt-fill me-1"></i>
                                                    {{ $translatedExperience->country }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($translatedExperience->duration)
                                                <span class="badge bg-success">{{ $translatedExperience->duration }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($index < $maid->workExperiences()->count() - 1)
                                    <hr class="my-4" style="border-color: #e9ecef;">
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="no-experience-icon mb-3">
                                <i class="bi bi-briefcase" style="font-size: 3rem; color: #dee2e6;"></i>
                            </div>
                            <h5 class="text-muted mb-2">{{ __('messages.no_work_experience_yet') }}</h5>
                            <p class="text-muted">{{ __('messages.work_experience_coming_soon') }}</p>
                        </div>
                    @endif
                </div>

                <!-- فيديو الخادمة -->
                @if($maid->video_path)
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-camera-video"></i>
                            {{ __('messages.maid_video') }}
                        </h3>
                        <div class="text-center">
                            <video controls class="w-100 rounded shadow" style="max-height: 400px;">
                                <source src="{{ asset('storage/' . $maid->video_path) }}" type="video/mp4">
                                {{ __('messages.browser_not_support_video') }}
                            </video>
                        </div>
                    </div>
                @endif

                <!-- Reviews -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-star"></i>
                        {{ __('messages.reviews_ratings') }}
                    </h3>
                    <div class="reviews-section">
                        @if($maid->approvedReviews()->count() > 0)
                            @foreach($maid->approvedReviews()->latest()->take(3)->get() as $review)
                                @php($translatedReview = \App\Helpers\TranslationHelper::translateReview($review))
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-name">{{ $translatedReview->customer_name }}</div>
                                        <div class="review-date">{{ $translatedReview->created_at->format('Y-m-d') }}</div>
                                    </div>
                                    <div class="rating-stars mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $translatedReview->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="review-text">
                                        <strong>{{ $translatedReview->title }}</strong><br>
                                        {{ $translatedReview->comment }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted text-center py-4">{{ __('messages.no_reviews_yet') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Contact & Actions -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-calendar-check"></i>
                        {{ __('messages.contact_booking') }}
                    </h3>
                    
                    <div class="d-grid gap-3 mb-4">
                        <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="btn contact-btn">
                            <i class="bi bi-calendar-check me-2"></i>
                            {{ __('messages.call_now') }}
                        </a>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('maids.all.' . app()->getLocale()) }}" class="btn back-btn">
                            <i class="bi bi-arrow-right me-2"></i>
                            {{ __('messages.back_to_maids_list') }}
                        </a>
                    </div>
                </div>

                <!-- Contract Information -->
                <div class="profile-card">
                    <h3 class="section-title">
                        <i class="bi bi-file-earmark-text"></i>
                        {{ __('messages.contract_information') }}
                    </h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.package_type') }}</div>
                            <div class="info-value">
                                <span class="badge bg-primary">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->package_type) }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.job_title') }}</div>
                            <div class="info-value">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->job_title) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.contract_type') }}</div>
                            <div class="info-value">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->contract_type) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.contract_fees') }}</div>
                            <div class="info-value">
                                <span class="text-success fw-bold">{{ number_format($maid->contract_fees ?? 0) }} {{ __('messages.riyal') }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.monthly_salary') }}</div>
                            <div class="info-value">
                                <span class="text-primary fw-bold">{{ number_format($maid->monthly_salary ?? 0) }} {{ __('messages.riyal') }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.language') }}</div>
                            <div class="info-value">{{ $maid->language ?? __('messages.not_specified') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">{{ __('messages.status') }}</div>
                            <div class="info-value">
                                <span class="badge bg-success">{{ \App\Helpers\TranslationHelper::translateMaidValue($maid->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

@include('partials.modals')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chat Widget -->
    <link rel="stylesheet" href="{{ asset('css/chat-widget.css') }}">
    <script src="{{ asset('js/chat-widget.js') }}"></script>


    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ $maid->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="{{ $maid->image_path ? asset('storage/' . $maid->image_path) : asset('/images/default-maid.jpg') }}" 
                         alt="{{ $maid->name }}" 
                         class="img-fluid rounded"
                         style="max-height: 80vh; width: 100%; object-fit: contain;"
                         onerror="this.src='{{ asset('images/default-maid.jpg') }}'">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
