<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pagos;
use App\Models\Usuarios;
class PagosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Pagos::class;
    public function definition()
    {
        return [
            'usuario_id' => function () {
                return Usuarios::factory()->create()->id;
            },
            'metodo_pago' => $this->faker->creditCardType,
            'saldo' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
