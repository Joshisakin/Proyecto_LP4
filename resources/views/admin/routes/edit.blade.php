@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editar Ruta</h1>
        <a href="{{ route('admin.rutas.index') }}" class="btn btn-secondary btn-icon-split">
            <span class="icon">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Volver a Rutas</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Información de la Ruta</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.rutas.update', $ruta) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Origen y Destino -->
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Ubicación
                                </h5>
                                <div class="mb-3">
                                    <label for="origen" class="form-label">Origen</label>
                                    <input type="text"
                                           class="form-control @error('origen') is-invalid @enderror"
                                           id="origen"
                                           name="origen"
                                           value="{{ old('origen', $ruta->origen) }}"
                                           required>
                                    @error('origen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label for="destino" class="form-label">Destino</label>
                                    <input type="text"
                                           class="form-control @error('destino') is-invalid @enderror"
                                           id="destino"
                                           name="destino"
                                           value="{{ old('destino', $ruta->destino) }}"
                                           required>
                                    @error('destino')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fecha y Hora -->
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>Horario
                                </h5>
                                <div class="mb-3">
                                    <label for="fecha_salida" class="form-label">Fecha de Salida</label>
                                    <input type="date"
                                           class="form-control @error('fecha_salida') is-invalid @enderror"
                                           id="fecha_salida"
                                           name="fecha_salida"
                                           value="{{ old('fecha_salida', $ruta->fecha_salida->format('Y-m-d')) }}"
                                           required>
                                    @error('fecha_salida')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label for="hora_salida" class="form-label">Hora de Salida</label>
                                    <input type="time"
                                           class="form-control @error('hora_salida') is-invalid @enderror"
                                           id="hora_salida"
                                           name="hora_salida"
                                           value="{{ old('hora_salida', $ruta->fecha_salida->format('H:i')) }}"
                                           required>
                                    @error('hora_salida')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Capacidad y Precio -->
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>Detalles
                                </h5>
                                <div class="mb-3">
                                    <label for="capacidad" class="form-label">Capacidad</label>
                                    <div class="input-group">
                                        <input type="number"
                                               class="form-control @error('capacidad') is-invalid @enderror"
                                               id="capacidad"
                                               name="capacidad"
                                               value="{{ old('capacidad', $ruta->capacidad) }}"
                                               min="1"
                                               required>
                                        <span class="input-group-text">pasajeros</span>
                                        @error('capacidad')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="duracion" class="form-label">Duración</label>
                                    <div class="input-group">
                                        <input type="number"
                                               class="form-control @error('duracion') is-invalid @enderror"
                                               id="duracion"
                                               name="duracion"
                                               value="{{ old('duracion', $ruta->duracion) }}"
                                               step="0.5"
                                               min="0.5"
                                               required>
                                        <span class="input-group-text">horas</span>
                                        @error('duracion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label for="precio" class="form-label">Precio</label>
                                    <div class="input-group">
                                        <span class="input-group-text">S/.</span>
                                        <input type="number"
                                               class="form-control @error('precio') is-invalid @enderror"
                                               id="precio"
                                               name="precio"
                                               value="{{ old('precio', $ruta->precio) }}"
                                               step="0.01"
                                               min="0"
                                               required>
                                        @error('precio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Descripción y Estado -->
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    <i class="fas fa-cog text-primary me-2"></i>Configuración Adicional
                                </h5>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                              id="descripcion"
                                              name="descripcion"
                                              rows="4">{{ old('descripcion', $ruta->descripcion) }}</textarea>
                                    @error('descripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           role="switch"
                                           id="estado"
                                           name="estado"
                                           value="1"
                                           {{ old('estado', $ruta->estado) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="estado">Ruta Activa</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="button"
                            class="btn btn-secondary me-2"
                            onclick="window.location='{{ route('admin.rutas.index') }}'">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Actualizar Ruta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-ticket-alt me-2"></i>
                    <h6 class="m-0 font-weight-bold text-primary">Reservaciones</h6>
                </div>
                <div class="card-body">
                    @if($ruta->reservations->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-ticket-alt fa-3x text-gray-300 mb-3"></i>
                            <p class="text-gray-500 mb-0">No hay reservaciones para esta ruta</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ruta->reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->user->name }}</td>
                                            <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge {{ $reservation->estado == 'confirmada' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($reservation->estado) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.reservations.show', $reservation) }}"
                                                   class="btn btn-sm btn-info">
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

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-chart-bar me-2"></i>
                    <h6 class="m-0 font-weight-bold text-primary">Estadísticas</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-primary text-uppercase mb-1">RESERVACIONES TOTALES</h6>
                                            <h2 class="mb-0">{{ $ruta->reservations->count() }}</h2>
                                        </div>
                                        <div class="text-primary">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-success text-uppercase mb-1">INGRESOS TOTALES</h6>
                                            <h2 class="mb-0">S/. {{ number_format($ruta->reservations->sum('total'), 2) }}</h2>
                                        </div>
                                        <div class="text-success">
                                            <i class="fas fa-dollar-sign fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-info text-uppercase mb-1">ASIENTOS DISPONIBLES</h6>
                                            <h2 class="mb-0">{{ $ruta->asientos_disponibles }}</h2>
                                        </div>
                                        <div class="text-info">
                                            <i class="fas fa-chair fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-warning text-uppercase mb-1">OCUPACIÓN</h6>
                                            @php
                                                $ocupacion = $ruta->capacidad > 0
                                                    ? round(($ruta->capacidad - $ruta->asientos_disponibles) / $ruta->capacidad * 100)
                                                    : 0;
                                            @endphp
                                            <h2 class="mb-0">{{ $ocupacion }}%</h2>
                                            <div class="progress mt-2" style="height: 4px;">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                     style="width: {{ $ocupacion }}%"
                                                     aria-valuenow="{{ $ocupacion }}"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-warning">
                                            <i class="fas fa-percentage fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
