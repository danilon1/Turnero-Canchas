<?php

namespace Database\Factories;

use App\Models\Turno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'monto' => $this->faker->randomFloat(2, 50, 1000),
            'estado' => $this->faker->randomElement(['pendiente', 'pagado']),
            'turno_id' => Turno::factory(), // Asocia el pago a un turno existente
        ];
    }
}
