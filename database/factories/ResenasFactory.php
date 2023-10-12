<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resenas;
use App\Models\Conductores;
use App\Models\Usuarios;
class ResenasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Resenas::class;
    public function definition()
    {
        return [
            'usuario_id' => function () {
                return Usuarios::factory()->create()->id;
            },
            'conductor_id' => function () {
                return Conductores::factory()->create()->id;
            },
            'calificacion' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->sentence,
        ];
    }
}
