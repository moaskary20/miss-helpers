<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">{{ __('messages.login') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="loginForm" method="POST" action="{{ route('auth.login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="modal_login_email" class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="modal_login_email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="{{ __('messages.enter_your_email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="modal_login_password" class="form-label">{{ __('messages.password') }}</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="modal_login_password" 
                               name="password" 
                               required 
                               placeholder="{{ __('messages.enter_password') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('messages.login') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mb-0">{{ __('messages.dont_have_account') }} <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">{{ __('messages.create_account') }}</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">{{ __('messages.create_account') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="registerForm" method="POST" action="{{ route('auth.register') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="modal_name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="modal_name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="{{ __('messages.enter_your_name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="modal_email" class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="modal_email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="{{ __('messages.enter_your_email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="modal_phone" class="form-label">{{ __('messages.phone') }}</label>
                        <input type="tel" 
                               class="form-control @error('phone') is-invalid @enderror" 
                               id="modal_phone" 
                               name="phone" 
                               value="{{ old('phone') }}" 
                               required 
                               placeholder="{{ __('messages.enter_your_phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="modal_password" class="form-label">{{ __('messages.password') }}</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="modal_password" 
                               name="password" 
                               required 
                               placeholder="{{ __('messages.enter_password') }}">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="modal_password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                        <input type="password" 
                               class="form-control" 
                               id="modal_password_confirmation" 
                               name="password_confirmation" 
                               required 
                               placeholder="{{ __('messages.re_enter_password') }}">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i> {{ __('messages.create_account') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mb-0">{{ __('messages.already_have_account') }} <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">{{ __('messages.login') }}</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle register form submission and modal behavior
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('{{ route("auth.register") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                const modalBody = document.querySelector('#registerModal .modal-body');
                modalBody.innerHTML = `
                    <div class="alert alert-success text-center">
                        <i class="bi bi-check-circle-fill fs-1 text-success"></i>
                        <h5 class="mt-3">{{ __('messages.register_success') }}</h5>
                        <p>{{ __('messages.welcome_to_miss_helpers') }}</p>
                    </div>
                `;
                
                // Reload page after 2 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                // Show error message
                const modalBody = document.querySelector('#registerModal .modal-body');
                const form = document.getElementById('registerForm');
                modalBody.insertBefore(
                    document.createElement('div').innerHTML = `
                        <div class="alert alert-danger">
                            ${data.message || '{{ __('messages.error_occurred') }}'}
                        </div>
                    `,
                    form
                );
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const modalBody = document.querySelector('#registerModal .modal-body');
            const form = document.getElementById('registerForm');
            modalBody.insertBefore(
                document.createElement('div').innerHTML = `
                    <div class="alert alert-danger">
                        {{ __('messages.error_occurred') }}
                    </div>
                `,
                form
            );
        });
    });

    // Handle login form submission and modal behavior
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('{{ route("auth.login") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.redirected) {
                // Redirect to the intended page
                window.location.href = response.url;
            } else {
                return response.json();
            }
        })
        .then(data => {
            if (data && !data.success) {
                // Show error message
                const modalBody = document.querySelector('#loginModal .modal-body');
                const form = document.getElementById('loginForm');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger';
                errorDiv.innerHTML = data.message || '{{ __('messages.invalid_credentials') }}';
                modalBody.insertBefore(errorDiv, form);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const modalBody = document.querySelector('#loginModal .modal-body');
            const form = document.getElementById('loginForm');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger';
            errorDiv.innerHTML = '{{ __('messages.error_occurred') }}';
            modalBody.insertBefore(errorDiv, form);
        });
    });

    // Clear error messages when modals are opened
    document.getElementById('loginModal').addEventListener('show.bs.modal', function() {
        const alerts = this.querySelectorAll('.alert');
        alerts.forEach(alert => alert.remove());
    });

    document.getElementById('registerModal').addEventListener('show.bs.modal', function() {
        const alerts = this.querySelectorAll('.alert');
        alerts.forEach(alert => alert.remove());
    });
</script>
