@extends('layouts.app')

@section('title', 'Detalles de la Reserva')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-ticket-alt me-2"></i>
                        Detalles de la Reserva #{{ $reservation->id }}
                    </h5>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Estado de la Reserva</h6>
                        <span class="badge bg-{{ $reservation->status_color }} fs-6">
                            {{ $reservation->status_text }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Detalles del Viaje</h6>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-2">
                                <strong>Ruta:</strong>
                                {{ $reservation->route->origen }} - {{ $reservation->route->destino }}
                            </p>
                            <p class="mb-2">
                                <strong>Fecha de Salida:</strong>
                                {{ $reservation->route->fecha_salida->format('d/m/Y g:i A') }}
                            </p>
                            <p class="mb-0">
                                <strong>Duración Estimada:</strong>
                                {{ $reservation->route->duracion }} horas
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Detalles de la Reserva</h6>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-2">
                                <strong>Número de Pasajeros:</strong>
                                {{ $reservation->num_pasajeros }}
                            </p>
                            <p class="mb-2">
                                <strong>Precio por Persona:</strong>
                                {{ $reservation->route->getFormattedPrice() }}
                            </p>
                            <p class="mb-2">
                                <strong>Total:</strong>
                                S/ {{ number_format($reservation->total, 2) }}
                            </p>
                            @if($reservation->notas)
                                <p class="mb-0">
                                    <strong>Notas:</strong><br>
                                    {{ $reservation->notas }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Volver
                        </a>

                        @if($reservation->estado === 'pendiente')
                            <form action="{{ route('reservations.destroy', $reservation) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('¿Está seguro de cancelar esta reserva?')">
                                    <i class="fas fa-times me-2"></i>
                                    Cancelar Reserva
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
