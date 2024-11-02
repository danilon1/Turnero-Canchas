<div class="bg-white p-4 rounded-lg">

    <form>
        <div class="mb-3">
            <label for="tamanioCancha" class="form-label">Tamaño de la cancha</label>
            <select id="tamanioCancha" class="form-control" name="tamanioCancha" wire:model="tamanioCancha" wire:change="showNombreCancha($event.target.value)">
                <option value="" selected disabled>Elegir</option>
                @if($canchasDisponibles)
                @foreach($canchasDisponibles as $canchas)
                <option value="{{$canchas->tipo}}">{{$canchas->tipo}}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="idCanchaSeleccionada" class="form-label">Nombre de la cancha</label>
            <select id="idCanchaSeleccionada" class="form-control" name="idCanchaSeleccionada" wire:model="idCanchaSeleccionada" wire:change="showFechasCancha($event.target.value)">


                @if(count($this->nombreCancha) === 0)
                <option value="" selected disabled>Elegir</option>
                @endif

                @foreach($nombreCancha as $canchas)
                @if($canchas['nombre'] === 'Elegir')
                <option value="" selected>Elegir</option>
                @else
                <option value="{{ $canchas['id'] }}">{{ $canchas['nombre'] }}</option>
                @endif
                @endforeach
            </select>
        </div>

        <div class="flex justify-center space-x-4 mt-4">
            <!-- Botón de página anterior -->
            <button
                type="button"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 disabled:bg-gray-100 disabled:text-gray-400"
                wire:click="anteriorSemana('{{ $lunesEnVista }}')">
                Anterior semana
            </button>
            <p>Estás viendo la semana {{$lunesEnVista}}</p>
            <!-- Botón de siguiente página -->
            <button
                type="button"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 disabled:bg-gray-100 disabled:text-gray-400"
                wire:click="proximaSemana('{{ $lunesEnVista }}')">
                Próxima semana
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Lunes</th>
                        <th class="border border-gray-300 px-4 py-2">Martes</th>
                        <th class="border border-gray-300 px-4 py-2">Miércoles</th>
                        <th class="border border-gray-300 px-4 py-2">Jueves</th>
                        <th class="border border-gray-300 px-4 py-2">Viernes</th>
                        <th class="border border-gray-300 px-4 py-2">Sábado</th>
                        <th class="border border-gray-300 px-4 py-2">Domingo</th>
                    </tr>
                </thead>
                <tbody>
                    @if($turnosEnUso)
                    @php
                    $turnosOcupados = [];
                    foreach ($turnosEnUso as $turno) {
                    $turnosOcupados[$turno->fecha_inicio][$turno->hora_inicio] = true;
                    }
                    @endphp

                    @foreach($horariosDeTrabajo as $hora)
                    <tr>
                        @foreach($proximasFechas as $dia)
                        @if(isset($turnosOcupados[$dia][$hora]))
                        <td class="border border-gray-300 px-4 py-2 bg-red-400">{{ $hora }}</td>
                        @else
                        <td class="border border-gray-300 px-4 py-2">{{ $hora }}</td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </form>
</div>