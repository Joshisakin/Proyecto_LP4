<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">¿A dónde quieres viajar hoy?</h2>
                    
                    @if($routes->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-route text-gray-400 text-5xl mb-4"></i>
                            <p class="text-gray-600">No hay rutas disponibles en este momento.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($routes as $route)
                                <div class="border rounded-lg p-6 hover:shadow-lg transition duration-300">
                                    <div class="flex items-center mb-4">
                                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                        <h3 class="font-bold text-lg">{{ $route->origin }}</h3>
                                        <i class="fas fa-arrow-right text-gray-400 mx-2"></i>
                                        <h3 class="font-bold text-lg">{{ $route->destination }}</h3>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-gray-600">
                                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                                            {{ count($route->schedules) }} horarios disponibles
                                        </p>
                                        <p class="text-gray-600">
                                            <i class="fas fa-tag text-green-500 mr-2"></i>
                                            Desde S/{{ number_format($route->price, 2) }}
                                        </p>
                                    </div>

                                    <a href="{{ route('reservations.create', $route) }}" 
                                       class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                                        <i class="fas fa-ticket-alt mr-2"></i>Reservar Ahora
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
