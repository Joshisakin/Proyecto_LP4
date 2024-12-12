@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Procesar Pago</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Detalles de la Reserva</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600">Ruta:</p>
                <p class="font-medium">{{ $reservation->ruta->origen }} - {{ $reservation->ruta->destino }}</p>
            </div>
            <div>
                <p class="text-gray-600">Fecha de Viaje:</p>
                <p class="font-medium">{{ $reservation->fecha_viaje->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-600">Pasajeros:</p>
                <p class="font-medium">{{ $reservation->cantidad_pasajeros }}</p>
            </div>
            <div>
                <p class="text-gray-600">Total a Pagar:</p>
                <p class="font-medium text-lg text-green-600">S/ {{ number_format($reservation->precio_total, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Método de Pago</h2>
        
        <form action="{{ route('payments.process', $reservation) }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
                    <img src="{{ asset('images/paypal.png') }}" alt="PayPal" class="h-6 mr-2">
                    Pagar con PayPal
                </button>
                
                <a href="{{ route('reservations.show', $reservation) }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
