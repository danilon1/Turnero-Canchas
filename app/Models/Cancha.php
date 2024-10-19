<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancha extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'deporte',
        'estado',
    ];

    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}
