<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMesas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function($tabla){
            $tabla->increments('id');
            $tabla->integer('mesa_numero');
            $tabla->integer('mesa_capacidad');
            $tabla->integer('mesa_tipo')->unsigned();
            $tabla->foreign('mesa_tipo')->references('id')->on('tipo_mesa');
            $tabla->integer('mesa_evento')->unsigned();
            $tabla->foreign('mesa_evento')->references('id')->on('eventos');
            $tabla->boolean('mesa_activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Shema::drop('mesas');
    }
}
