@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Usuario</h1>
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
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

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
                                           value="{{ old('name', $user->name) }}"
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
                                           value="{{ old('email', $user->email) }}"
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
                                    <label for="password" class="form-label">Nueva Contraseña</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password">
                                    <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirmation"
                                           name="password_confirmation">
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
                                            required
                                            {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                        <option value="">Seleccionar rol</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Usuario</option>
                                    </select>
                                    @if($user->id === auth()->id())
                                        <small class="text-muted">No puedes cambiar tu propio rol</small>
                                    @endif
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
                        <i class="fas fa-save me-1"></i>Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Información Adicional -->
    <div class="row">
        <!-- Reservaciones -->
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reservaciones</h6>
                </div>
                <div class="card-body">
                    @if($user->reservations->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-ticket-alt fa-3x mb-3"></i>
                            <p class="mb-0">No hay reservaciones para este usuario</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Ruta</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->route->origen }} → {{ $reservation->route->destino }}</td>
                                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge {{ $reservation->estado == 'confirmada' ? 'bg-success' : 'bg-warning' }}">
                                                {{ ucfirst($reservation->estado) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.reservations.show', $reservation) }}"
                                               class="btn btn-sm btn-info"
                                               data-bs-toggle="tooltip"
                                               title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Estadísticas</h6>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="border rounded p-3 text-center">
                                <div class="text-primary mb-2">
                                    <i class="fas fa-ticket-alt fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-0">{{ $user->reservations->count() }}</h3>
                                <p class="small text-muted mb-0">Reservaciones Totales</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 text-center">
                                <div class="text-success mb-2">
                                    <i class="fas fa-dollar-sign fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-0">S/. {{ number_format($user->reservations->sum('total'), 2) }}</h3>
                                <p class="small text-muted mb-0">Gastos Totales</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 text-center">
                                <div class="text-info mb-2">
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-0">{{ $user->reservations->where('estado', 'confirmada')->count() }}</h3>
                                <p class="small text-muted mb-0">Reservas Confirmadas</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 text-center">
                                <div class="text-warning mb-2">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                                <h3 class="h5 mb-0">{{ $user->reservations->where('estado', 'pendiente')->count() }}</h3>
                                <p class="small text-muted mb-0">Reservas Pendientes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    /* Stats styles */
    .border {
        border-color: #e3e6f0 !important;
    }

    .border:hover {
        border-color: var(--primary-color) !important;
        background-color: #f8f9fc;
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

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
