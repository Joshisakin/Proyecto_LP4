@extends('layouts.app')

@section('title', 'Mis Reservas')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Mis Reservas</h1>
        <a href="{{ route('rutas.index') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nueva Reserva
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <img src="/images/empty-reservations.svg" alt="No hay reservas" class="mb-3" style="max-width: 200px">
                <h3 class="h5 text-muted">No tienes reservas activas</h3>
                <p class="text-muted mb-3">¡Comienza reservando tu primer viaje!</p>
                <a href="{{ route('rutas.index') }}" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i>Explorar Rutas
                </a>
            </div>
        </div>
    @else
        <div class="row">
            @foreach($reservations as $reservation)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    {{ $reservation->route->origen }} - {{ $reservation->route->destino }}
                                </h5>
                                <span class="badge bg-{{ $reservation->status_color }}">
                                    {{ $reservation->status_text }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted d-block">Fecha de Salida</small>
                                <strong>{{ $reservation->route->fecha_salida->format('d/m/Y g:i A') }}</strong>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Pasajeros</small>
                                <strong>{{ $reservation->num_pasajeros }}</strong>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Total</small>
                                <strong>S/ {{ number_format($reservation->total, 2) }}</strong>
                            </div>
                            @if($reservation->notas)
                                <div class="mb-3">
                                    <small class="text-muted d-block">Notas</small>
                                    <p class="mb-0">{{ $reservation->notas }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    Reservado el {{ $reservation->created_at->format('d/m/Y') }}
                                </small>
                                <div>
                                    <a href="{{ route('reservations.show', $reservation) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>Ver Detalles
                                    </a>
                                    @if($reservation->estado === 'pendiente')
                                        <form action="{{ route('reservations.destroy', $reservation) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('¿Está seguro de cancelar esta reserva?')">
                                                <i class="fas fa-times me-1"></i>Cancelar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
