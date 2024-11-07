<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Contenedor para las cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($turnos as $turno)
                        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 relative">
                            <p class="text-lg text-gray-600 mt-4">Detalles del turno</p>
                            <p class="text-sm text-gray-600 mt-4"><strong>Deporte:</strong> {{ $turno->cancha->deporte }}</p>
                            <p class="text-sm text-gray-600"><strong>Nombre de la cancha:</strong> {{ $turno->cancha->nombre }}</p>
                            <p class="text-sm text-gray-600"><strong>Ubicación:</strong> {{ $turno->cancha->ubicacion }}</p>

                            <p class="text-sm text-gray-800"><strong>Fecha de inicio:</strong> {{ $turno->fecha_inicio }}</p>
                            <p class="text-sm text-gray-600"><strong>Hora de inicio:</strong> {{ $turno->hora_inicio }}</p>
                            <p class="text-sm text-gray-600"><strong>Hora de fin:</strong> {{ $turno->hora_fin }}</p>



                            <form action="{{ route('turnos.eliminar', $turno->id) }}" method="POST" class="absolute bottom-4 right-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                    Cancelar Turno
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>