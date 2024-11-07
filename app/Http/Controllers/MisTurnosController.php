<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;

class MisTurnosController extends Controller
{
    public function verMisTurnos() {}

    public function eliminar($turnoId)
    {
        $turno = Turno::findOrFail($turnoId);
        $turno->delete();
        return redirect()->route('misturnos')->with('success', 'Turno eliminado exitosamente');
    }

    public function misturnos()
    {
        $userId = auth()->id();
        $turnos = Turno::with('cancha')
            ->where('user_id', $userId)
            ->orderBy('fecha_inicio', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();
        return view('misturnos', compact('turnos'));
    }
}
