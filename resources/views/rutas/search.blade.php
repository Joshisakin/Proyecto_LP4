@extends('layouts.app')

@section('title', 'Buscar Rutas')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Resultados de Búsqueda</h1>

    {{-- Formulario de Búsqueda --}}
    <form action="{{ route('rutas.search') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="origen" class="form-control" placeholder="Origen" value="{{ request('origen') }}">
            </div>
            <div class="col-md-5">
                <input type="text" name="destino" class="form-control" placeholder="Destino" value="{{ request('destino') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    {{-- Listado de Rutas --}}
    @forelse($rutas as $ruta)
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-title">
                        {{ $ruta->punto_partida ?? 'No especificado' }} - 
                        {{ $ruta->punto_llegada ?? 'No especificado' }}
                    </h5>
                    <p class="card-text">
                        <strong>Ruta:</strong> 
                        {{ $ruta->punto_partida ?? 'No especificado' }} - 
                        {{ $ruta->punto_llegada ?? 'No especificado' }}
                    </p>
                    <p class="card-text">
                        <strong>Salida:</strong> 
                        {{ $ruta->departure_time ? $ruta->departure_time->format('d/m/Y H:i') : '04/01/2025 13:10' }}
                    </p>
                    <p class="card-text">
                        <strong>Duración:</strong> 
                        {{ $ruta->duracion ?? 'No especificado' }}
                    </p>
                    <p class="card-text">
                        <strong>Precio:</strong> 
                        S/. {{ number_format($ruta->precio ?? 0, 2) }}
                    </p>
                    <p class="card-text">
                        <strong>Asientos disponibles:</strong> 
                        {{ $ruta->available_seats ?? 50 }}/{{ $ruta->total_seats ?? 50 }}
                    </p>
                    <p class="card-text">
                        <strong>Estado:</strong> 
                        <span class="badge {{ $ruta->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $ruta->estado == 'activo' ? 'Disponible' : 'No disponible' }}
                        </span>
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    @if($ruta->estado == 'activo' && $ruta->available_seats > 0)
                        <a href="{{ route('reservations.create', $ruta) }}" class="btn btn-primary">
                            Reservar Ahora
                        </a>
                    @else
                        <button class="btn btn-secondary" disabled>
                            No Disponible
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        No se encontraron rutas que coincidan con su búsqueda.
    </div>
    @endforelse

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $rutas->appends(request()->input())->links() }}
    </div>
</div>
@endsection
