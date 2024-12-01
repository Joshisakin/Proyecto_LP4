<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Mis Reservas</h2>

                    @if($reservations->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-ticket-alt text-gray-400 text-5xl mb-4"></i>
                            <p class="text-gray-600">No tienes reservas activas.</p>
                            <a href="{{ route('routes.index') }}" 
                               class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                <i class="fas fa-search mr-2"></i>Buscar Rutas Disponibles
                            </a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($reservations as $reservation)
                                <div class="border rounded-lg overflow-hidden">
                                    <!-- Encabezado -->
                                    <div class="bg-gray-50 p-4 flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div @class([
                                                'px-3 py-1 rounded-full text-sm font-semibold',
                                                'bg-green-100 text-green-800' => $reservation->status === 'confirmed',
                                                'bg-red-100 text-red-800' => $reservation->status === 'cancelled',
                                            ])>
                                                {{ ucfirst($reservation->status) }}
                                            </div>
                                            <span class="text-gray-500">
                                                Reserva #{{ $reservation->id }}
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Reservado el</p>
                                            <p class="font-semibold">
                                                {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Contenido -->
                                    <div class="p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Detalles del Viaje -->
                                            <div>
                                                <h3 class="font-semibold text-lg mb-2">Detalles del Viaje</h3>
                                                <div class="space-y-2">
                                                    <p>
                                                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                                        <span class="font-medium">{{ $reservation->route->origin }}</span>
                                                        <i class="fas fa-arrow-right text-gray-400 mx-2"></i>
                                                        <span class="font-medium">{{ $reservation->route->destination }}</span>
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-calendar text-blue-500 mr-2"></i>
                                                        {{ \Carbon\Carbon::parse($reservation->travel_date)->isoFormat('dddd D [de] MMMM, YYYY') }}
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-clock text-blue-500 mr-2"></i>
                                                        Salida: {{ \Carbon\Carbon::parse($reservation->schedule->departure_time)->format('h:i A') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Detalles de la Reserva -->
                                            <div>
                                                <h3 class="font-semibold text-lg mb-2">Detalles de la Reserva</h3>
                                                <div class="space-y-2">
                                                    <p>
                                                        <i class="fas fa-users text-green-500 mr-2"></i>
                                                        {{ $reservation->passenger_count }} pasajero(s)
                                                    </p>
                                                    <p>
                                                        <i class="fas fa-tag text-green-500 mr-2"></i>
                                                        Total: S/{{ number_format($reservation->total_price, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Acciones -->
                                        @if($reservation->status === 'confirmed' && \Carbon\Carbon::parse($reservation->travel_date)->isFuture())
                                            <div class="mt-4 flex justify-end">
                                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-800"
                                                            onclick="return confirm('¿Estás seguro de que deseas cancelar esta reserva?')">
                                                        <i class="fas fa-times-circle mr-2"></i>Cancelar Reserva
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
