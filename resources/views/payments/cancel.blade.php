@extends('components.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning mb-3">
                <div class="card-header bg-warning text-white">
                    <h3 class="mb-0">Pago Cancelado</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title text-warning">Su pago ha sido cancelado</h4>
                    
                    @if(isset($reservation))
                    <div class="alert alert-secondary">
                        <p><strong>Detalles de la Reserva:</strong></p>
                        <ul>
                            <li>Número de Reserva: {{ $reservation->id }}</li>
                            <li>Ruta: {{ $reservation->ruta->origen }} - {{ $reservation->ruta->destino }}</li>
                            <li>Fecha de Salida: {{ $reservation->ruta->fecha_salida }}</li>
                        </ul>
                    </div>
                    @endif

                    <p class="text-muted">
                        Si desea continuar con su reserva, puede intentar el pago nuevamente o contactar a soporte.
                    </p>

                    <div class="text-center">
                        <a href="{{ route('reservations.index') }}" class="btn btn-primary">
                            Mis Reservas
                        </a>
                        <a href="{{ route('rutas.index') }}" class="btn btn-secondary ml-2">
                            Explorar Rutas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
