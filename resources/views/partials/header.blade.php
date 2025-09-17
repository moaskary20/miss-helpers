<!-- Header -->
<header class="site-header">
    <div class="container header-inner">
        <a href="/{{ app()->getLocale() }}" class="brand">
            <img src="/images/logo.png" alt="Miss Helpers" onerror="this.style.display='none'">
        </a>
        <nav class="d-none d-md-flex align-items-center gap-1 nav-links">
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about') }}</a>
                <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.services') }}</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.contact') }}</a>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn d-none d-md-inline">{{ __('messages.get_maid_now') }}</a>
            @php
                $newLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
                $segments = request()->segments();
                if (count($segments) > 0) {
                    $segments[0] = $newLocale; // استبدال أول جزء باللغة الأخرى
                } else {
                    $segments = [$newLocale];
                }
                $toggleUrl = '/'.implode('/', $segments);
                $qs = request()->getQueryString();
                if ($qs) { $toggleUrl .= '?'.$qs; }
            @endphp
            <a href="{{ $toggleUrl }}" class="btn btn-link text-decoration-none p-0">{{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}</a>
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
                <a href="/{{ app()->getLocale() }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.about') }}</a>
                <a href="{{ route('service.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.services') }}</a>
                <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}">{{ __('messages.contact') }}</a>
            @php
                $newLocale = app()->getLocale() === 'ar' ? 'en' : 'ar';
                $segments = request()->segments();
                if (count($segments) > 0) {
                    $segments[0] = $newLocale;
                } else {
                    $segments = [$newLocale];
                }
                $toggleUrl = '/'.implode('/', $segments);
                $qs = request()->getQueryString();
                if ($qs) { $toggleUrl .= '?'.$qs; }
            @endphp
            <a href="{{ $toggleUrl }}" class="btn btn-link text-decoration-none p-0">{{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}</a>
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
            <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}" class="cta-btn mt-2 w-100">{{ __('messages.get_maid_now') }}</a>
        </div>
    </div>
</header>
