<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehiculos;
use App\Models\Conductores;
class VehiculosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Vehiculos::class;
    public function definition()
    {
        return [
            'tipo' => $this->faker->word,
            'capacidad' => $this->faker->randomDigitNotNull,
            'conductor_id' => function () {
                return Conductores::factory()->create()->id;
            },
        ];
    }
}
