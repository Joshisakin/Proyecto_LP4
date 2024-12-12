@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="register-wrapper min-vh-100 d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <div class="logo-wrapper mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-ship fa-3x text-primary"></i>
                        </div>
                    </div>
                    <h1 class="display-6 fw-bold text-primary mb-2 animate__animated animate__fadeInUp">
                        Únete a AmazonRiver
                    </h1>
                    <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s">
                        Crea tu cuenta y comienza a explorar la Amazonía
                    </p>
                </div>

                <div class="card border-0 shadow-lg hover-card">
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                            @csrf

                            <!-- Name -->
                            <div class="form-floating mb-4">
                                <input type="text"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       placeholder="Tu nombre"
                                       value="{{ old('name') }}"
                                       required
                                       autofocus>
                                <label for="name">
                                    <i class="fas fa-user text-primary me-2"></i>Nombre completo
                                </label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="form-floating mb-4">
                                <input type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       placeholder="nombre@ejemplo.com"
                                       value="{{ old('email') }}"
                                       required>
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
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle me-2"></i>La contraseña debe tener al menos 8 caracteres
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-floating mb-4">
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Confirmar contraseña"
                                       required>
                                <label for="password_confirmation">
                                    <i class="fas fa-lock text-primary me-2"></i>Confirmar contraseña
                                </label>
                            </div>

                            <!-- Terms -->
                            <div class="form-check mb-4">
                                <input class="form-check-input @error('terms') is-invalid @enderror"
                                       type="checkbox"
                                       id="terms"
                                       name="terms"
                                       required>
                                <label class="form-check-label" for="terms">
                                    He leído y acepto los <a href="#" class="text-primary text-decoration-none hover-link">términos y condiciones</a>
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 hover-btn">
                                <i class="fas fa-user-plus me-2"></i>Crear cuenta
                            </button>

                            <div class="text-center">
                                <p class="text-muted mb-4">O regístrate con</p>
                                <div class="d-flex justify-content-center gap-3 mb-4">
                                    <a href="#" class="btn btn-outline-primary hover-btn">
                                        <i class="fab fa-google me-2"></i>Google
                                    </a>
                                    <a href="#" class="btn btn-outline-primary hover-btn">
                                        <i class="fab fa-facebook-f me-2"></i>Facebook
                                    </a>
                                </div>

                                <p class="text-muted mb-0">
                                    ¿Ya tienes una cuenta?
                                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none hover-link">
                                        Inicia sesión aquí
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .register-wrapper {
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
