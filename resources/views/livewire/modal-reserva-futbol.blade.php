<div>
    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-4 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4">Reserva</h2>
            <p>Elegiste el día {{$nombreDia}} {{$dia}} y la hora {{$hora}}</p>

            <!-- Botón para cerrar el modal -->
            <button
                type="button"
                class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                wire:click="toggleModal">
                Cerrar Modal
            </button>
            <button
                type="button"
                class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-800"
                wire:click="reservar">
                Confirmar
            </button>
        </div>
    </div>
    @endif
</div>