<?php

namespace Database\Factories;

use App\Models\Turno;
use App\Models\User;
use App\Models\Cancha;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TurnoFactory extends Factory
{
    protected $model = Turno::class;

    public function definition()
    {
        $startDateTime = $this->getValidStartDateTime();
        $endDateTime = (clone $startDateTime)->addHour();

        return [
            'user_id' => User::factory(),
            'cancha_id' => Cancha::factory(),
            'fecha_inicio' => $startDateTime->toDateString(),
            'hora_inicio' => $startDateTime->toTimeString(),
            'fecha_fin' => $endDateTime->toDateString(),
            'hora_fin' => $endDateTime->toTimeString(),
        ];
    }

    private function getValidStartDateTime()
    {
        $openingHour = Carbon::createFromTime(8, 0);
        $closingHour = Carbon::createFromTime(21, 0);

        // Genera una fecha aleatoria dentro de los próximos 7 días
        $date = Carbon::now()->addDays(rand(0, 7))->toDateString();

        // Genera una hora aleatoria dentro del horario de atención
        $hour = rand(8, 20); // Horas de 08:00 a 20:00 para bloques de 1 hora
        $minute = 0; // Solo bloques completos de 1 hora

        // Devuelve el objeto DateTime
        return Carbon::createFromDate($date)->setTime($hour, $minute);
    }
}
