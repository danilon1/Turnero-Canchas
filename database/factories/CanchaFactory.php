<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cancha>
 */
class CanchaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'deporte' => $this->faker->randomElement(['fútbol', 'tenis', 'pádel', 'básquet', 'vóley']),
            'estado' => $this->faker->randomElement(['disponible', 'mantenimiento']),
        ];
    }
}
