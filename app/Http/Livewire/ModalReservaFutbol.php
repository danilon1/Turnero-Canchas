<?php

namespace App\Http\Livewire;

use App\Mail\TurnoCreado;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Turno;

class ModalReservaFutbol extends Component
{
    public $isOpen;
    public $nombreDia;
    public $dia;
    public $hora;
    public $idCancha;
    protected $listeners = ['toggleModal' => 'toggleModal', 'abrirModal' => 'openModal'];

    public function mount($isOpen)
    {
        $this->isOpen = $isOpen;
    }

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function openModal($dia, $hora, $idCancha)
    {
        $this->dia = Carbon::parse($dia);
        $this->nombreDia = $this->dia->copy()->locale('es')->translatedFormat('l');
        $this->dia = $this->dia->format('d-m-Y');
        $this->hora = $hora;
        $this->idCancha = $idCancha;
        $this->isOpen = true;
    }

    public function reservar()
    {

        // Verifica si el usuario está autenticado
        if (!auth()->check()) {
            // Redirige al usuario a la página de login
            return redirect()->route('login')->with('error', 'Debes estar autenticado para agregar un turno.');
        }

        // Obtén el ID del usuario autenticado
        $userId = auth()->id();
        $this->dia = Carbon::parse($this->dia);
        $this->dia = $this->dia->format('Y-m-d');
        $fechaInicio = $this->dia;

        $horaString = $this->hora;
        $horaCarbon = Carbon::createFromFormat('H:i:s', $horaString);
        $horaCarbon->addHour();
        $horaFin = $horaCarbon->format('H:i:s'); // "09:00:00"

        // Crea un nuevo turno
        Turno::create([
            'user_id' => $userId,
            'cancha_id' => $this->idCancha,
            'fecha_inicio' => $fechaInicio,
            'hora_inicio' => $this->hora,
            'fecha_fin' => $fechaInicio,
            'hora_fin' => $horaFin,
        ]);

        Mail::to(env('MAIL_TO'))->send(new TurnoCreado($this->dia, $horaString));

        $this->isOpen = false;
        return redirect()->route('misturnos');
    }

    public function render()
    {
        return view('livewire.modal-reserva-futbol');
    }
}
