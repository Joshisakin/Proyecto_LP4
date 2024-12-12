@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row g-4">
        <!-- Perfil del Usuario -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <h2 class="mb-1">{{ $stats['active_reservations'] }}</h2>
                            <p class="text-muted mb-0">Reservas Activas</p>
                        </div>
                        <div class="col-6 text-center">
                            <h2 class="mb-1">{{ $stats['completed_reservations'] }}</h2>
                            <p class="text-muted mb-0">Reservas Completadas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Próximas Reservas -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Próximas Reservas</h5>
                        <div>
                            <a href="{{ route('reservations.index') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-list me-1"></i>Ver todas las reservas
                            </a>
                            <a href="{{ route('rutas.index') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Nueva Reserva
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($upcomingReservations->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No tienes reservas</h6>
                            <p class="text-muted mb-3">¡Es un buen momento para planear tu próxima aventura!</p>
                            <a href="{{ route('rutas.index') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Explorar Rutas
                            </a>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($upcomingReservations as $reservation)
                                <div class="list-group-item px-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $reservation->route->origen }} - {{ $reservation->route->destino }}</h6>
                                            <div class="text-muted small">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $reservation->route->fecha_salida->format('d/m/Y g:i A') }}
                                                <span class="mx-2">•</span>
                                                <i class="fas fa-users me-1"></i>
                                                {{ $reservation->num_pasajeros }} pasajeros
                                            </div>
                                        </div>
                                        <span class="badge bg-warning">Pendiente</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Rutas Recomendadas -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Rutas Recomendadas</h5>
                        <a href="{{ route('rutas.index') }}" class="text-primary text-decoration-none">Ver Todas</a>
                    </div>
                </div>
                <div class="card-body">
                    @if($recommendedRoutes->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-route fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No hay rutas disponibles en este momento</h6>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach($recommendedRoutes as $route)
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title mb-3">
                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                {{ $route->origen }} - {{ $route->destino }}
                                            </h6>
                                            <div class="mb-3">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ $route->fecha_salida->format('d/m/Y g:i A') }}
                                                </small>
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-users me-1"></i>
                                                    {{ $route->asientos_disponibles }} asientos disponibles
                                                </small>
                                                <small class="text-muted d-block">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $route->duracion }} horas de viaje
                                                </small>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-5 fw-bold text-primary">
                                                    {{ $route->getFormattedPrice() }}
                                                </span>
                                                <a href="{{ route('reservations.create', ['ruta_id' => $route->id]) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-ticket-alt me-1"></i>Reservar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
