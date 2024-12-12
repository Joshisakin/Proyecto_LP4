@extends('layouts.app')

@section('title', 'Nueva Reserva')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card title="Nueva Reserva" icon="ticket-alt" headerClass="bg-primary text-white">
                <x-alert type="info" class="mb-4">
                    <h6 class="alert-heading">
                        <i class="fas fa-info-circle me-2"></i>
                        Detalles de la Ruta
                    </h6>
                    <p class="mb-0">
                        <strong>Origen:</strong> {{ $ruta->origen }}<br>
                        <strong>Destino:</strong> {{ $ruta->destino }}<br>
                        <strong>Fecha de Salida:</strong> {{ $ruta->fecha_salida->format('d/m/Y g:i A') }}<br>
                        <strong>Precio por Persona:</strong> {{ $ruta->getFormattedPrice() }}
                    </p>
                </x-alert>

                <form method="POST" action="{{ route('reservations.store') }}">
                    @csrf
                    <input type="hidden" name="ruta_id" value="{{ $ruta->id }}">

                    <x-form-group name="cantidad_pasajeros" label="Número de Pasajeros" icon="users"
                        help="Máximo {{ min($ruta->asientos_disponibles, 10) }} pasajeros por reserva">
                        <select name="cantidad_pasajeros" 
                            class="form-select @error('cantidad_pasajeros') is-invalid @enderror"
                            required>
                            <option value="">Seleccione cantidad</option>
                            @for($i = 1; $i <= min($ruta->asientos_disponibles, 10); $i++)
                                <option value="{{ $i }}" {{ old('cantidad_pasajeros') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ Str::plural('pasajero', $i) }}
                                </option>
                            @endfor
                        </select>
                    </x-form-group>

                    <x-form-group name="comentarios" label="Comentarios o Requerimientos Especiales" icon="comment">
                        <textarea name="comentarios" 
                            class="form-control @error('comentarios') is-invalid @enderror"
                            rows="3"
                            placeholder="Ingrese cualquier comentario o requerimiento especial">{{ old('comentarios') }}</textarea>
                    </x-form-group>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <x-button variant="outline-secondary" icon="arrow-left"
                            onclick="window.history.back()">
                            Volver
                        </x-button>
                        
                        <x-button type="submit" variant="primary" icon="check">
                            Crear Reserva
                        </x-button>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</div>
@endsection
