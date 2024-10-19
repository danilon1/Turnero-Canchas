<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'turno_id',
        'monto',
        'estado',
    ];

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
