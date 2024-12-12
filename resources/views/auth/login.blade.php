@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="login-wrapper min-vh-100 d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="text-center mb-4">
                    <div class="logo-wrapper mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-ship fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h1 class="display-6 fw-bold text-primary mb-2 animate__animated animate__fadeInUp">
                        ¡Bienvenido a AmazonRiver!
                    </h1>
                    <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s">
                        Ingresa tus credenciales para continuar
                    </p>
                </div>

                <div class="card border-0 shadow-lg hover-card">
                    <div class="card-body p-4 p-md-5">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Tipo de Usuario -->
                            <div class="mb-4">
                                <label class="form-label fw-bold mb-3">¿Cómo deseas ingresar?</label>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="login_type" id="user" value="user"
                                               {{ old('login_type', 'user') === 'user' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2" for="user">
                                            <i class="fas fa-user"></i>Usuario
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="login_type" id="admin" value="admin"
                                               {{ old('login_type') === 'admin' ? 'checked' : '' }}>
                                        <label class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2" for="admin">
                                            <i class="fas fa-user-shield"></i>Admin
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="form-floating mb-4">
                                <input type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       placeholder="nombre@ejemplo.com"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus>
                                <label for="email">
                                    <i class="fas fa-envelope text-primary me-2"></i>Correo electrónico
                                </label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-4">
                                <input type="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       id="password"
                                       name="password"
                                       placeholder="Contraseña"
                                       required>
                                <label for="password">
                                    <i class="fas fa-lock text-primary me-2"></i>Contraseña
                                </label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-primary text-decoration-none hover-link" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 hover-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>

                            <div class="text-center">
                                <p class="text-muted mb-4">O inicia sesión con</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="#" class="btn btn-outline-primary hover-btn">
                                        <i class="fab fa-google me-2"></i>Google
                                    </a>
                                    <a href="#" class="btn btn-outline-primary hover-btn">
                                        <i class="fab fa-facebook-f me-2"></i>Facebook
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted mb-0">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none hover-link">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .login-wrapper {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .hover-btn {
        transition: all 0.3s ease;
    }

    .hover-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .hover-link {
        transition: all 0.3s ease;
    }

    .hover-link:hover {
        color: var(--bs-primary) !important;
        text-decoration: underline !important;
    }

    .form-floating > label {
        padding-left: 1.75rem;
    }

    .form-floating > .form-control {
        padding-left: 1.75rem;
    }

    .form-check-input:checked {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    .btn-check:checked + .btn-outline-primary {
        box-shadow: 0 5px 15px rgba(var(--bs-primary-rgb), 0.15);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 2rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush
@endsection
