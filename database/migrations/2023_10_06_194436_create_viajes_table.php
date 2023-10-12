<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conductor_id');
            $table->unsignedBigInteger('pasajero_id');
            $table->string('ubicacion_recogida');
            $table->string('ubicacion_destino');
            $table->timestamp('hora_inicio');
            $table->timestamp('hora_finalizacion')->nullable();
            $table->decimal('costo', 10, 2);
            $table->decimal('distancia', 10, 2);
            $table->string('estado');
            $table->timestamps();

            $table->foreign('conductor_id')->references('id')->on('conductores');
            $table->foreign('pasajero_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viajes');
    }
}
