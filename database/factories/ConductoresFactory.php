<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Conductores;
class ConductoresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Conductores::class;
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'modelo_vehiculo' => $this->faker->word,
            'placa_vehiculo' => $this->faker->unique()->regexify('[A-Z0-9]{7}'),
            'calificaciones' => $this->faker->numberBetween(1, 5),
        ];
    }
}
