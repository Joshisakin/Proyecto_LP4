<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-2xl mx-auto">
                        <h2 class="text-2xl font-bold mb-6">Reserva tu Viaje</h2>
                        
                        <!-- Detalles de la Ruta -->
                        <div class="bg-blue-50 rounded-lg p-6 mb-8">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-map-marker-alt text-red-500 text-xl mr-2"></i>
                                <h3 class="font-bold text-xl">{{ $route->origin }}</h3>
                                <i class="fas fa-arrow-right text-gray-400 mx-4"></i>
                                <h3 class="font-bold text-xl">{{ $route->destination }}</h3>
                            </div>
                            <p class="text-gray-600">
                                <i class="fas fa-tag text-green-500 mr-2"></i>
                                Precio base: S/{{ number_format($route->price, 2) }} por persona
                            </p>
                        </div>

                        <form method="POST" action="{{ route('reservations.store') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="route_id" value="{{ $route->id }}">
                            
                            <!-- Horario -->
                            <div>
                                <label for="schedule_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-clock text-blue-500 mr-2"></i>Selecciona el Horario
                                </label>
                                <select name="schedule_id" id="schedule_id" required 
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}">
                                            Salida: {{ \Carbon\Carbon::parse($schedule->departure_time)->format('h:i A') }} - 
                                            Llegada: {{ \Carbon\Carbon::parse($schedule->arrival_time)->format('h:i A') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('schedule_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha -->
                            <div>
                                <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar text-blue-500 mr-2"></i>Fecha de Viaje
                                </label>
                                <input type="date" name="travel_date" id="travel_date" required
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('travel_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pasajeros -->
                            <div>
                                <label for="passenger_count" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-users text-blue-500 mr-2"></i>Número de Pasajeros
                                </label>
                                <input type="number" name="passenger_count" id="passenger_count" 
                                       min="1" max="10" value="1" required
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('passenger_count')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Máximo 10 pasajeros por reserva</p>
                            </div>

                            <!-- Resumen -->
                            <div class="bg-gray-50 rounded-lg p-4 mt-6">
                                <h4 class="font-semibold text-gray-800 mb-2">Resumen de la Reserva</h4>
                                <div class="text-sm text-gray-600">
                                    <p>Precio base: S/{{ number_format($route->price, 2) }} x <span id="passengerCount">1</span> pasajero(s)</p>
                                    <p class="font-semibold mt-2">Total: S/<span id="totalPrice">{{ number_format($route->price, 2) }}</span></p>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="{{ route('routes.index') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-arrow-left mr-2"></i>Volver
                                </a>
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600">
                                    <i class="fas fa-check mr-2"></i>Confirmar Reserva
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const passengerInput = document.getElementById('passenger_count');
        const passengerCount = document.getElementById('passengerCount');
        const totalPrice = document.getElementById('totalPrice');
        const basePrice = {{ $route->price }};

        passengerInput.addEventListener('change', function() {
            const count = this.value;
            passengerCount.textContent = count;
            totalPrice.textContent = (basePrice * count).toFixed(2);
        });
    </script>
    @endpush
</x-app-layout>
