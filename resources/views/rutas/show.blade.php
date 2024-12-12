@extends('layouts.app')

@section('title', 'Detalles de la Ruta')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title h3 mb-4">
                        <i class="fas fa-route text-primary me-2"></i>
                        {{ $ruta->origen }} → {{ $ruta->destino }}
                    </h1>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        Información del Viaje
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <strong>Salida:</strong><br>
                                            {{ $ruta->fecha_salida->format('d/m/Y H:i') }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Llegada:</strong><br>
                                            {{ $ruta->fecha_llegada->format('d/m/Y H:i') }}
                                        </li>
                                        <li>
                                            <strong>Duración:</strong><br>
                                            {{ number_format($ruta->duracion, 1) }} horas
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                        Detalles
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <strong>Tipo de Embarcación:</strong><br>
                                            {{ $ruta->boat_type ?? 'No especificado' }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Capacidad Total:</strong><br>
                                            {{ $ruta->capacidad }} pasajeros
                                        </li>
                                        <li>
                                            <strong>Asientos Disponibles:</strong><br>
                                            {{ $ruta->asientos_disponibles }} asientos
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($ruta->descripcion)
                        <div class="mt-4">
                            <h5 class="card-title">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Descripción
                            </h5>
                            <p class="card-text">{{ $ruta->descripcion }}</p>
                        </div>
                    @endif

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">{{ $ruta->getFormattedPrice() }}</h4>
                                <small class="text-muted">por persona</small>
                            </div>
                            @if($ruta->isAvailable())
                                <a href="{{ route('reservations.create', ['ruta_id' => $ruta->id]) }}" 
                                   class="btn btn-primary btn-lg">
                                    <i class="fas fa-ticket-alt me-2"></i>
                                    Reservar Ahora
                                </a>
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>
                                    <i class="fas fa-ban me-2"></i>
                                    No Disponible
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('rutas.index') }}" class="btn btn-link">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver a la lista de rutas
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
