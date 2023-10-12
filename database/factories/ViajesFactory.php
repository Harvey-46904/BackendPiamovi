<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Viajes;
use App\Models\Conductores;
use App\Models\Usuarios;
class ViajesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Viajes::class;
    public function definition()
    {
        return [
            'conductor_id' => function () {
                return Conductores::factory()->create()->id;
            },
            'pasajero_id' => function () {
                return Usuarios::factory()->create()->id;
            },
            'ubicacion_recogida' => $this->faker->address,
            'ubicacion_destino' => $this->faker->address,
            'hora_inicio' => $this->faker->dateTimeThisDecade(),
            'hora_finalizacion' => $this->faker->optional()->dateTimeThisDecade(),
            'costo' => $this->faker->randomFloat(2, 5, 100),
            'distancia' => $this->faker->randomFloat(2, 1, 50),
            'estado' => $this->faker->randomElement(['pendiente', 'completado', 'cancelado']),
        ];
    }
}
