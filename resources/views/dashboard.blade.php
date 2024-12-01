<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Bienvenida -->
                    <div class="text-center mb-12">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">¡Bienvenido a nuestro Sistema de Reservas!</h1>
                        <p class="text-gray-600 max-w-2xl mx-auto">
                            Viaja con comodidad y seguridad. Encuentra las mejores rutas y horarios para tu próximo viaje.
                        </p>
                    </div>

                    <!-- Acciones Rápidas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        <a href="{{ route('routes.index') }}" 
                           class="flex items-center p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-300">
                            <div class="rounded-full bg-blue-500 p-3 mr-4">
                                <i class="fas fa-search text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800">Buscar Rutas</h3>
                                <p class="text-gray-600 text-sm">Explora nuestros destinos disponibles</p>
                            </div>
                        </a>

                        <a href="{{ route('reservations.index') }}" 
                           class="flex items-center p-6 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                            <div class="rounded-full bg-green-500 p-3 mr-4">
                                <i class="fas fa-ticket-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800">Mis Reservas</h3>
                                <p class="text-gray-600 text-sm">Gestiona tus reservas actuales</p>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                            <div class="rounded-full bg-purple-500 p-3 mr-4">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800">Mi Perfil</h3>
                                <p class="text-gray-600 text-sm">Actualiza tu información personal</p>
                            </div>
                        </a>
                    </div>

                    <!-- Información Adicional -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-gray-800 mb-4">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>Información Importante
                            </h3>
                            <ul class="space-y-2 text-gray-600">
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Llega 30 minutos antes de tu viaje</li>
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Documento de identidad obligatorio</li>
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Equipaje permitido: 20kg por persona</li>
                            </ul>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="font-semibold text-lg text-gray-800 mb-4">
                                <i class="fas fa-phone text-blue-500 mr-2"></i>Contacto y Soporte
                            </h3>
                            <ul class="space-y-2 text-gray-600">
                                <li><i class="fas fa-envelope mr-2"></i>soporte@empresa.com</li>
                                <li><i class="fas fa-phone-alt mr-2"></i>(01) 555-0123</li>
                                <li><i class="fas fa-clock mr-2"></i>Lunes a Domingo: 7:00 AM - 10:00 PM</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
