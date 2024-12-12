@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="profile-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Information -->
                <div class="card border-0 shadow-lg hover-card mb-4">
                    <div class="card-header bg-gradient border-0 py-3">
                        <h4 class="mb-0 text-white">
                            <i class="fas fa-user-edit me-2"></i>Editar Perfil
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('patch')

                            <div class="row g-4">
                                <!-- Profile Photo -->
                                <div class="col-12 text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                             class="rounded-circle border border-4 border-white shadow"
                                             style="width: 150px; height: 150px; object-fit: cover;"
                                             alt="{{ $user->name }}">
                                        <label for="profile_photo" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 cursor-pointer">
                                            <i class="fas fa-camera"></i>
                                            <input type="file"
                                                   id="profile_photo"
                                                   name="profile_photo"
                                                   class="d-none"
                                                   accept="image/*">
                                        </label>
                                    </div>
                                    @error('profile_photo')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{ old('name', $user->name) }}"
                                               placeholder="Tu nombre"
                                               required>
                                        <label for="name">
                                            <i class="fas fa-user text-primary me-2"></i>Nombre
                                        </label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{ old('email', $user->email) }}"
                                               placeholder="tu@email.com"
                                               required>
                                        <label for="email">
                                            <i class="fas fa-envelope text-primary me-2"></i>Correo Electrónico
                                        </label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email Verification Notice -->
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="col-12">
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            <div>
                                                Su correo electrónico no está verificado.
                                                <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-warning text-decoration-none">
                                                        Reenviar correo de verificación
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 hover-btn py-3">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="card border-0 shadow-lg hover-card mb-4">
                    <div class="card-header bg-gradient border-0 py-3">
                        <h4 class="mb-0 text-white">
                            <i class="fas fa-lock me-2"></i>Cambiar Contraseña
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                            @csrf
                            @method('put')

                            <div class="row g-4">
                                <!-- Current Password -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password"
                                               class="form-control @error('current_password') is-invalid @enderror"
                                               id="current_password"
                                               name="current_password"
                                               placeholder="Contraseña actual"
                                               required>
                                        <label for="current_password">
                                            <i class="fas fa-key text-primary me-2"></i>Contraseña Actual
                                        </label>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- New Password -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password"
                                               name="password"
                                               placeholder="Nueva contraseña"
                                               required>
                                        <label for="password">
                                            <i class="fas fa-lock text-primary me-2"></i>Nueva Contraseña
                                        </label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password"
                                               class="form-control"
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               placeholder="Confirmar contraseña"
                                               required>
                                        <label for="password_confirmation">
                                            <i class="fas fa-check text-primary me-2"></i>Confirmar Contraseña
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 hover-btn py-3">
                                        <i class="fas fa-key me-2"></i>Actualizar Contraseña
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card border-0 shadow-lg hover-card border-danger">
                    <div class="card-header bg-danger bg-gradient border-0 py-3">
                        <h4 class="mb-0 text-white">
                            <i class="fas fa-exclamation-triangle me-2"></i>Eliminar Cuenta
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-danger mb-4">
                            <strong>¡Advertencia!</strong> Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente.
                            Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.
                        </p>

                        <button type="button"
                                class="btn btn-outline-danger w-100 hover-btn py-3"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal">
                            <i class="fas fa-trash-alt me-2"></i>Eliminar Cuenta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('profile.destroy') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('delete')

                    <p class="text-danger mb-4">
                        Esta acción no se puede deshacer. Por favor, confirme que desea eliminar permanentemente su cuenta.
                    </p>

                    <div class="form-floating mb-4">
                        <input type="password"
                               class="form-control"
                               id="password_confirmation_delete"
                               name="password"
                               placeholder="Contraseña"
                               required>
                        <label for="password_confirmation_delete">
                            <i class="fas fa-lock text-danger me-2"></i>Confirmar con Contraseña
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger hover-btn py-3">
                            <i class="fas fa-trash-alt me-2"></i>Eliminar Cuenta Permanentemente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .profile-wrapper {
        background-color: #f8f9fa;
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .bg-gradient {
        background: linear-gradient(45deg, var(--bs-primary), #2196f3);
    }

    .hover-btn {
        transition: all 0.3s ease;
    }

    .hover-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .form-floating > label {
        padding-left: 2.5rem;
    }

    .form-floating > .form-control {
        padding: 1rem 1rem 1rem 2.5rem;
    }

    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Preview profile photo
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('img.rounded-circle').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

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
