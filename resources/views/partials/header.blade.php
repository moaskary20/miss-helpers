<!-- Header CSS -->
<link href="{{ asset('css/header.css') }}" rel="stylesheet">

<!-- Header -->
<header class="site-header">
    <div class="container header-inner">
        <a href="/{{ app()->getLocale() }}" class="brand">
            <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
        </a>
        <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
            <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
            <a href="/{{ app()->getLocale() }}/about">{{ __('messages.about') }}</a>
            <a href="/{{ app()->getLocale() }}/service">{{ __('messages.services') }}</a>
            <a href="/{{ app()->getLocale() }}/contact">{{ __('messages.contact') }}</a>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn d-none d-md-inline">{{ __('messages.get_maid_now') }}</a>
            <a href="/{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}" class="btn btn-link text-decoration-none p-0">
                {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
            </a>
            <div class="auth d-none d-md-inline">
                @guest
                    <button type="button" class="btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('messages.login') }}</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#registerModal">{{ __('messages.register') }}</button>
                @else
                    <a href="{{ route('user.profile') }}" class="me-3 text-decoration-none text-primary fw-bold">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('messages.logout') }}</button>
                    </form>
                @endguest
            </div>
            <button class="btn btn-outline-secondary d-md-none" data-bs-toggle="collapse" data-bs-target="#mnav"><i class="bi bi-list"></i></button>
        </div>
    </div>
    <div id="mnav" class="collapse border-top d-md-none">
        <div class="container py-2">
            <!-- Navigation links in one row -->
            <div class="nav-links text-center mb-3">
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="/{{ app()->getLocale() }}/about">{{ __('messages.about') }}</a>
                <a href="/{{ app()->getLocale() }}/service">{{ __('messages.services') }}</a>
                <a href="/{{ app()->getLocale() }}/contact">{{ __('messages.contact') }}</a>
                <a href="/{{ app()->getLocale() == 'ar' ? 'en' : 'ar' }}" class="btn btn-link text-decoration-none p-0">
                    {{ app()->getLocale() == 'ar' ? __('messages.english') : __('messages.arabic') }}
                </a>
            </div>
            
            <!-- Login/Register buttons in one row -->
            <div class="text-center mb-3">
                @guest
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('messages.login') }}</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#registerModal">{{ __('messages.register') }}</button>
                @else
                    <a href="{{ route('user.profile') }}" class="d-block py-2 text-decoration-none text-primary fw-bold">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('messages.logout') }}</button>
                    </form>
                @endguest
            </div>
            
            <!-- CTA button -->
            <div class="text-center">
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn">{{ __('messages.get_maid_now') }}</a>
            </div>
        </div>
    </div>
</header>
