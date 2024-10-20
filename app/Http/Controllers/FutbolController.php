<?php

namespace App\Http\Controllers;

use App\Models\Cancha;
use Illuminate\Http\Request;

class FutbolController extends Controller
{
    public function canchasDisponibles()
    {
        return Cancha::where('deporte', 'Fútbol')
            ->where('estado', 'disponible',)
            ->get();
    }

    public function futbol()
    {
        $canchas_disponibles = $this->canchasDisponibles();

        return view('futbol', compact('canchas_disponibles'));
    }
}
