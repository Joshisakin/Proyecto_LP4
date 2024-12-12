@extends('components.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Pago Exitoso</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title text-success">Su pago ha sido procesado correctamente</h4>
                    
                    @if(isset($reservation))
                    <div class="alert alert-info">
                        <p><strong>Detalles de la Reserva:</strong></p>
                        <ul>
                            <li>Número de Reserva: {{ $reservation->id }}</li>
                            <li>Ruta: {{ $reservation->ruta->origen }} - {{ $reservation->ruta->destino }}</li>
                            <li>Fecha de Salida: {{ $reservation->ruta->fecha_salida }}</li>
                            <li>Monto Pagado: ${{ number_format($reservation->precio_total, 2) }}</li>
                        </ul>
                    </div>
                    @endif

                    <div class="text-center">
                        <a href="{{ route('reservations.index') }}" class="btn btn-primary">
                            Ver Mis Reservas
                        </a>
                        <a href="{{ route('rutas.index') }}" class="btn btn-secondary ml-2">
                            Explorar Más Rutas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
