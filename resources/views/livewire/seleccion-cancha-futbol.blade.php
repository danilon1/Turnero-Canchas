<div class="bg-white p-4 rounded-lg">

    <form>

        <div class="mb-3">


            @livewire('modal-reserva-futbol', ['isOpen' => $isOpen])
            <label for="tamanioCancha" class="form-label"></label>
            <select id="tamanioCancha" class="form-control" name="tamanioCancha" wire:model="tamanioCancha" wire:change="showNombreCancha($event.target.value)">
                <option value="" selected disabled>Seleccionar tamaño de cancha</option>
                @if($canchasDisponibles)
                @foreach($canchasDisponibles as $canchas)
                <option value="{{$canchas->tipo}}">{{$canchas->tipo}}</option>
                @endforeach
                @endif
            </select>
            <label for="idCanchaSeleccionada" class="form-label"></label>

            <select id="idCanchaSeleccionada" class="form-control" name="idCanchaSeleccionada" wire:model="idCanchaSeleccionada" wire:change="showFechasCancha($event.target.value)">
                @if(count($this->nombreCancha) === 0)
                <option value="" selected disabled>Seleccionar nombre de cancha</option>
                @endif

                @foreach($nombreCancha as $canchas)
                @if($canchas['nombre'] === 'Elegir')
                <option value="" selected>Seleccionar nombre de cancha</option>
                @else
                <option value="{{ $canchas['id'] }}">{{ $canchas['nombre'] }}</option>
                @endif
                @endforeach
            </select>
        </div>
        @if($turnosEnUso)
        <div class="flex justify-center items-center space-x-4 m-4">
            <!-- Botón de página anterior -->
            <button
                type="button"
                class="px-4 py-2 bg-blue-200 rounded hover:bg-blue-500 hover:text-white disabled:bg-gray-100 disabled:text-gray-400"
                wire:click="anteriorSemana('{{ $lunesEnVista }}')">
                Anterior semana
            </button>
            <p><b>Estás viendo la semana @if(is_null($lunesEnVista)) {{$semanaActual->format('d-m-Y')}}@else {{$lunesEnVista->format('d-m-Y')}} @endif</b></p>
            <!-- Botón de siguiente página -->
            <button
                type="button"
                class="px-4 py-2 bg-blue-200 rounded hover:bg-blue-500 hover:text-white disabled:bg-gray-100 disabled:text-gray-400"
                wire:click="proximaSemana('{{ $lunesEnVista }}')">
                Próxima semana
            </button>
        </div>
        @endif

        <div class="overflow-x-auto">
            @if($turnosEnUso)
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
                    $key = 0;
                    $turnosOcupados = [];
                    foreach ($turnosEnUso as $turno) {
                    $turnosOcupados[$turno->fecha_inicio][$turno->hora_inicio] = true;
                    }
                    @endphp

                    @foreach($horariosDeTrabajo as $hora)
                    <tr>
                        @foreach($proximasFechas as $dia)
                        @php $key++; @endphp
                        @if(isset($turnosOcupados[$dia][$hora]))
                        <td wire:key="'{{$key}}-{{$dia}}'" class="cursor-not-allowed border border-gray-300 px-4 py-2 bg-red-400">{{ $hora }}</td>
                        @else
                        <td wire:key="'{{$key}}-{{$dia}}'" wire:click="modal('{{$dia}}','{{$hora}}')" class="cursor-pointer border border-gray-300 px-4 py-2">
                            {{ $hora }}
                        </td>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @endif
        </div>
    </form>
</div>