<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cancha_id',
        'fecha_inicio',
        'hora_inicio',
        'fecha_fin',
        'hora_fin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cancha()
    {
        return $this->belongsTo(Cancha::class);
    }
}
