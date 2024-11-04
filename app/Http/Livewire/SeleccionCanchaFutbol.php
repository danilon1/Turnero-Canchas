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
    public $hoy;
    public $proximasFechas = [];
    public $turnosEnUso = [];
    public $horariosDeTrabajo = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00', '20:00:00', '21:00:00', '22:00:00'];
    public $diasDeTrabajo = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    public $lunesActual;
    public $lunesEnVista = null;
    public $semanaActual;
    public $isOpen = false;
    public $refresh;

    protected $listeners = ['reservaFinalizada' => 'reservaFinalizada'];

    public function mount($canchas_disponibles)
    {
        $this->canchasDisponibles = $canchas_disponibles;
        $this->nombreCancha = collect();
        // Obtiene el día de hoy
        $this->hoy = Carbon::today();
        // Encuentra el lunes de esta semana
        $this->lunesActual = $this->hoy->copy()->startOfWeek(Carbon::MONDAY);
        $this->semanaActual = $this->hoy->copy()->startOfWeek(Carbon::MONDAY);
    }

    public function showNombreCancha($tamanioCancha)
    {

        //Este if es para resetear la variable cuando el usuario cambia de tamaño de cancha.
        if ($this->idCanchaSeleccionada != '') {
            $this->idCanchaSeleccionada = '';
        }

        //Consulta a la base el listado de canchas disponibles de acuerdo al tamaño elegido.
        $this->tamanioCancha = $tamanioCancha;
        $this->nombreCancha = Cancha::where('tipo', $tamanioCancha)->where('estado', 'disponible')->get()->toArray();

        // Agrega un primer item vacío al array para evitar que en el select 2 se autoseleccione el primer resultado del array
        array_unshift($this->nombreCancha, [
            'id' => '',
            'nombre' => 'Elegir',
            'deporte' => '',
            'tipo' => '',
            'ubicacion' => '',
            'estado' => '',
            'created_at' => '',
            'updated_at' => ''
        ]);

        $this->turnosEnUso = false;  //Se limpia la variable para resetear la vista de la tabla de horarios cuando el usuario cambia de tamaño de cancha.
    }

    public function showFechasCancha($idCanchaSeleccionada)
    {

        //Este if es por si el usuario selecciona "Elegir" en el select 2
        if ($idCanchaSeleccionada === '') {
            return;
        }

        $this->proximasFechas = [];
        $this->turnosEnUso = [];
        $this->lunesEnVista = null;

        $this->idCanchaSeleccionada = $idCanchaSeleccionada;

        $domingoActual = $this->lunesActual->copy()->addDays(6);
        // Bucle para agregar 7 días a partir del lunes de la semana
        for ($i = 0; $i < 7; $i++) {
            $this->proximasFechas[$i] = $this->lunesActual->copy()->addDays($i)->format('Y-m-d');
        }

        //Consulta los turnos de la cancha seleccionada del lunes de la semana en adelante
        $this->idCancha = Cancha::find($idCanchaSeleccionada);
        $this->turnosEnUso = Turno::where('cancha_id', $this->idCancha->id)
            ->where('fecha_inicio', '>=', $this->lunesActual)
            ->where('fecha_inicio', '<=', $domingoActual)
            ->get();
    }

    public function anteriorSemana($lunesEnVista)
    {
        $this->turnosEnUso = [];
        $this->proximasFechas = [];

        if (is_null($this->lunesEnVista)) {
            $crearProximoLunes = $this->lunesActual->copy()->addDays(-7);
            $this->lunesEnVista = $crearProximoLunes;
        } else {
            $lunesEnVista = $this->lunesEnVista->copy()->addDays(-7);
            $this->lunesEnVista = $lunesEnVista;
        }

        $fechaInicio = $this->lunesEnVista->format('Y-m-d');
        $fechaFin = $this->lunesEnVista->copy()->addDays(7)->format('Y-m-d');

        // Bucle para agregar 7 días a partir del lunes de la semana
        for ($i = 0; $i < 7; $i++) {
            $this->proximasFechas[$i] = $this->lunesEnVista->copy()->addDays($i)->format('Y-m-d');
        }

        $this->turnosEnUso = Turno::where('cancha_id', $this->idCancha->id)
            ->where('fecha_inicio', '>=', $fechaInicio)
            ->where('fecha_inicio', '<=', $fechaFin)
            ->get();
    }

    public function proximaSemana($lunesEnVista)
    {
        $this->turnosEnUso = [];
        $this->proximasFechas = [];

        if (is_null($this->lunesEnVista)) {
            $crearProximoLunes = $this->lunesActual->copy()->addDays(7);
            $this->lunesEnVista = $crearProximoLunes;
        } else {
            $lunesEnVista = $this->lunesEnVista->copy()->addDays(7);
            $this->lunesEnVista = $lunesEnVista;
        }

        $fechaInicio = $this->lunesEnVista->format('Y-m-d');
        $fechaFin = $this->lunesEnVista->copy()->addDays(7)->format('Y-m-d');

        // Bucle para agregar 7 días a partir del lunes de la semana
        for ($i = 0; $i < 7; $i++) {
            $this->proximasFechas[$i] = $this->lunesEnVista->copy()->addDays($i)->format('Y-m-d');
        }

        $this->turnosEnUso = Turno::where('cancha_id', $this->idCancha->id)
            ->where('fecha_inicio', '>=', $fechaInicio)
            ->where('fecha_inicio', '<=', $fechaFin)
            ->get();
    }

    public function modal($dia, $hora)
    {
        $idCancha = $this->idCancha->id;
        $this->emit('abrirModal', $dia, $hora, $idCancha);
    }

    public function reservaFinalizada()
    {
        if (is_null($this->lunesEnVista)) {
            $this->lunesEnVista = $this->lunesActual->copy()->addDays(-7);
            $this->proximaSemana($this->lunesEnVista);
        } else {
            $this->lunesEnVista = $this->lunesEnVista->copy()->addDays(-7);
            $this->proximaSemana($this->lunesEnVista);
        }
    }

    public function render()
    {
        return view('livewire.seleccion-cancha-futbol');
    }
}
