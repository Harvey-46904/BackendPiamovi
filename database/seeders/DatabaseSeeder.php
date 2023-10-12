<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Conductores;
use App\Models\Pagos;
use App\Models\Resenas;
use App\Models\Usuarios;
use App\Models\Vehiculos;
use App\Models\Viajes;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Usuarios::factory()->count(10)->create();
        Conductores::factory()->count(10)->create();
        Vehiculos::factory()->count(10)->create();
        Viajes::factory()->count(10)->create();
      
        Pagos::factory()->count(10)->create();
        Resenas::factory()->count(10)->create();
        // \App\Models\User::factory(10)->create();
    }
}
