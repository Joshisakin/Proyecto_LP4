@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear Nuevo Usuario</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Volver a Usuarios</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Información del Usuario</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row g-4">
                    <!-- Información Personal -->
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-user text-primary me-2"></i>Información Personal
                                </h5>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-lock text-primary me-2"></i>Contraseña
                                </h5>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rol y Configuración -->
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-cog text-primary me-2"></i>Configuración
                                </h5>
                                <div class="mb-0">
                                    <label for="role" class="form-label">Rol</label>
                                    <select class="form-select @error('role') is-invalid @enderror"
                                            id="role"
                                            name="role"
                                            required>
                                        <option value="">Seleccionar rol</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Usuario</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="button"
                            class="btn btn-secondary me-2"
                            onclick="window.location='{{ route('admin.users.index') }}'">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Form styles */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control {
        padding: 0.75rem;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    /* Card styles */
    .card {
        border: none;
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
    }

    /* Validation styles */
    .was-validated .form-control:valid, .form-control.is-valid {
        border-color: var(--success-color);
    }

    .was-validated .form-control:invalid, .form-control.is-invalid {
        border-color: var(--danger-color);
    }
</style>
@endpush

@push('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
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
