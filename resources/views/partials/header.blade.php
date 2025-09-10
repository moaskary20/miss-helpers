<!-- Header -->
<header class="site-header">
    <div class="container header-inner">
        <a href="{{ url('/') }}" class="brand">
            <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
            <span class="title">Miss Helpers</span>
        </a>
        <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
            <a href="{{ route('welcome') }}">{{ __('messages.home') }}</a>
            <a href="{{ route('about.index') }}">{{ __('messages.about') }}</a>
            <a href="{{ route('service.index') }}">{{ __('messages.services') }}</a>
            <a href="{{ route('contact.index') }}">{{ __('messages.contact') }}</a>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('contact.index') }}" class="cta-btn d-none d-md-inline">{{ __('messages.get_maid_now') }}</a>
            <form method="POST" action="{{ route('language.switch') }}" class="d-inline">
                @csrf
                <input type="hidden" name="locale" value="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}">
                <button type="submit" class="btn btn-link text-decoration-none p-0">{{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}</button>
            </form>
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
        <div class="container py-2 nav-links">
            <a href="{{ route('welcome') }}">{{ __('messages.home') }}</a>
            <a href="{{ route('about.index') }}">{{ __('messages.about') }}</a>
            <a href="{{ route('service.index') }}">{{ __('messages.services') }}</a>
            <a href="{{ route('contact.index') }}">{{ __('messages.contact') }}</a>
            <form method="POST" action="{{ route('language.switch') }}" class="d-inline">
                @csrf
                <input type="hidden" name="locale" value="{{ app()->getLocale() === 'ar' ? 'en' : 'ar' }}">
                <button type="submit" class="btn btn-link text-decoration-none p-0">{{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}</button>
            </form>
            @guest
                <button type="button" class="btn btn-outline-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('messages.login') }}</button>
                <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#registerModal">{{ __('messages.register') }}</button>
            @else
                <a href="{{ route('user.profile') }}" class="d-block py-2 text-decoration-none text-primary fw-bold">{{ Auth::user()->name }}</a>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">{{ __('messages.logout') }}</button>
                </form>
            @endguest
            <a href="{{ route('contact.index') }}" class="cta-btn mt-2 w-100">{{ __('messages.get_maid_now') }}</a>
        </div>
    </div>
</header>
