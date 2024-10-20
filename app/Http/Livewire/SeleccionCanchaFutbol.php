<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Monolog\Processor\HostnameProcessor;

class SeleccionCanchaFutbol extends Component
{
    public $tipo;
    public $rango_fecha = [];
    public $dia;
    public $hora;
    public $horas_disponibles = [];
    public $paso = 1;
    public $canchasDisponibles;

    public function mount($canchas_disponibles)
    {
        $this->canchasDisponibles = $canchas_disponibles;
    }


    public function seleccionarTipoCancha($tipo)
    {
        $this->tipo = $tipo;

        Carbon::setLocale('es');
        for ($i = 0; $i <= 14; $i++) {
            $fecha = Carbon::now()->addDays($i);
            $this->rango_fecha[] = [
                'dia' => $fecha->dayName,
                'fecha' => $fecha->format('d-m-Y')
            ];
        }
        $this->paso = 2;
    }

    public function seleccionarDiaCancha($dia)
    {

        $this->dia = $dia;
        $this->horas_disponibles = ['08:00', '09:00', '11:00', '12:00', '14:00', '16:00', '20:00', '21:00'];
        $this->paso = 3;
    }

    public function seleccionarHoraCancha($hora)
    {
        $this->hora = $hora;
    }

    public function render()
    {
        return view('livewire.seleccion-cancha-futbol');
    }
}
