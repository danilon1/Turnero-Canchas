<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cancha;
use App\Models\Turno;
use Carbon\Carbon;


class SeleccionCanchaFutbol extends Component
{
    public $canchasDisponibles;
    public $idCancha;
    public $nombreCancha;
    public $idCanchaSeleccionada = '';
    public $tamanioCancha = '';
    public $proximasFechas = [];
    public $turnosEnUso;
    public $ocupacion;
    public $horariosDeTrabajo = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00', '20:00:00', '21:00:00', '22:00:00'];
    public $diasDeTrabajo = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

    public function mount($canchas_disponibles)
    {
        $this->canchasDisponibles = $canchas_disponibles;
        $this->nombreCancha = collect();
    }

    public function showNombreCancha($tamanioCancha)
    {

        $this->tamanioCancha = $tamanioCancha;
        $this->nombreCancha = Cancha::where('tipo', $tamanioCancha)->where('estado', 'disponible')->get();
    }

    public function showFechasCancha($idCanchaSeleccionada)
    {
        $this->idCanchaSeleccionada = $idCanchaSeleccionada;

        //Crea un array desde mañana hasta los próximo 14 días
        for ($i = 0; $i < 14; $i++) {
            $fecha = Carbon::today()->addDays($i)->format('Y-m-d');
            $this->proximasFechas[$i] = $fecha;
        }

        //Consulta los turnos de la cancha seleccionada de hoy en adelante
        $fecha = Carbon::today();
        $fecha->format('Y-m-d');
        $this->idCancha = Cancha::find($idCanchaSeleccionada);
        $this->turnosEnUso = Turno::where('cancha_id', $this->idCancha->id)->where('fecha_inicio', '>', $fecha)->get();
    }

    public function render()
    {
        return view('livewire.seleccion-cancha-futbol');
    }
}
