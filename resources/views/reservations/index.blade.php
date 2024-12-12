@extends('layouts.app')

@section('title', 'Mis Reservaciones')

@section('content')
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-ticket-alt text-primary me-3 fa-2x"></i>
        <h1 class="mb-0">Mis Reservaciones</h1>
    </div>

    @if($reservations->isEmpty())
        <div class="alert alert-info d-flex align-items-center">
            <i class="fas fa-info-circle me-3 fa-lg"></i>
            <div>No tienes reservaciones activas.</div>
        </div>
    @else
        <div class="row g-4">
            @foreach($reservations as $reservation)
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm hover-card">
                        <div class="card-header bg-primary bg-opacity-10 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-route me-2"></i>
                                    {{ $reservation->route->origen }} → {{ $reservation->route->destino }}
                                </h5>
                                <span class="badge bg-{{ $reservation->status_color }} rounded-pill">
                                    {{ $reservation->status_text }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="route-info">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Fecha de Salida</small>
                                        <strong>{{ $reservation->route->fecha_salida->format('d/m/Y H:i') }}</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Duración</small>
                                        <strong>{{ number_format($reservation->route->duracion, 1) }} horas</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Pasajeros</small>
                                        <strong>{{ $reservation->num_pasajeros }}</strong>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Total</small>
                                        <strong class="text-primary">S/ {{ number_format($reservation->total, 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 p-4">
                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <a href="{{ route('reservations.show', $reservation) }}"
                                   class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center">
                                    <i class="fas fa-eye me-2"></i>Ver Detalles
                                </a>
                                <a href="{{ route('reservations.ticket', $reservation) }}"
                                   class="btn btn-primary btn-sm d-flex align-items-center justify-content-center"
                                   target="_blank">
                                    <i class="fas fa-download me-2"></i>Descargar Ticket
                                </a>
                                @if($reservation->estado === 'pendiente')
                                    <form action="{{ route('reservations.destroy', $reservation) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm d-flex align-items-center justify-content-center w-100"
                                                onclick="return confirm('¿Estás seguro de que deseas cancelar esta reservación?')">
                                            <i class="fas fa-times me-2"></i>Cancelar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('styles')
<style>
    .hover-card {
        transition: transform 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
    }
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .route-info > div {
        transition: transform 0.2s ease;
    }
    .route-info > div:hover {
        transform: translateX(5px);
    }
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
    }
    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    @media (max-width: 576px) {
        .d-flex.flex-column.flex-sm-row {
            gap: 0.5rem !important;
        }
        .btn-sm {
            width: 100%;
        }
    }
</style>
@endpush
