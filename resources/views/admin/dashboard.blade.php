<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Sección de Usuarios -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold mb-4">Usuarios Registrados</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Nombre</th>
                                        <th class="px-4 py-2">Email</th>
                                        <th class="px-4 py-2">Fecha de Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $user->id }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">{{ $user->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sección de Rutas -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold mb-4">Rutas Disponibles</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Origen</th>
                                        <th class="px-4 py-2">Destino</th>
                                        <th class="px-4 py-2">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($routes as $route)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $route->id }}</td>
                                        <td class="border px-4 py-2">{{ $route->origin }}</td>
                                        <td class="border px-4 py-2">{{ $route->destination }}</td>
                                        <td class="border px-4 py-2">{{ $route->price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sección de Reservas -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Reservas Realizadas</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">ID</th>
                                        <th class="px-4 py-2">Usuario</th>
                                        <th class="px-4 py-2">Ruta</th>
                                        <th class="px-4 py-2">Fecha</th>
                                        <th class="px-4 py-2">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $booking->id }}</td>
                                        <td class="border px-4 py-2">{{ $booking->user_id }}</td>
                                        <td class="border px-4 py-2">{{ $booking->route_id }}</td>
                                        <td class="border px-4 py-2">{{ $booking->date }}</td>
                                        <td class="border px-4 py-2">{{ $booking->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
