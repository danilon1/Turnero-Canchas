<div>
    @if($paso == 1)
    <div class="grid grid-cols-2 gap-5">
        @foreach($canchasDisponibles as $cancha)
        <div wire:click="seleccionarTipoCancha({{ $cancha->tipo }})" class=" flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
            <div class="w-24 h-24 rounded-full overflow-hidden">
                <img src="images/futbol.jpg" alt="Imagen" class="w-full h-full object-cover">
            </div>
            <div class="ml-4">
                <h5 class="text-xl font-bold tracking-tight text-gray-900">Cancha de {{$cancha->tipo}}</h5>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($paso == 2)
    <div class="grid grid-cols-2 gap-5">
        @foreach($rango_fecha as $dia)
        <div wire:click="seleccionarDiaCancha('{{ $dia['fecha'] }}')" class=" flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
            <div class="w-24 h-24 rounded-full overflow-hidden">
                <img src="images/futbol.jpg" alt="Imagen" class="w-full h-full object-cover">
            </div>
            <div class="ml-4">
                <h5 class="text-xl font-bold tracking-tight text-gray-900">{{$dia['dia'] . " - " . $dia['fecha']}}</h5>
            </div>
        </div>
        @endforeach
    </div>
    @endif


    @if($paso == 3)
    <div class="grid grid-cols-2 gap-5">
        @foreach($horas_disponibles as $hora)
        <div wire:click="seleccionarHoraCancha('{{$hora}}')" class=" flex items-center justify-center p-4 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 transition transform hover:scale-105">
            <div class="w-24 h-24 rounded-full overflow-hidden">
                <img src="images/futbol.jpg" alt="Imagen" class="w-full h-full object-cover">
            </div>
            <div class="ml-4">
                <h5 class="text-xl font-bold tracking-tight text-gray-900">{{$hora}}</h5>
            </div>
        </div>
        @endforeach
    </div>
    @endif



</div>