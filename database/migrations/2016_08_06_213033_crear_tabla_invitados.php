<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaInvitados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitados', function($tabla){
            $tabla->increments('id');
            $tabla->string('inv_nombre',50);
            $tabla->string('inv_apellido',50);
            $tabla->string('inv_sexo',20);
            $tabla->integer('inv_tipo')->unsigned();
            $tabla->foreign('inv_tipo')->references('id')->on('tipo_invitado');
            $tabla->integer('inv_mesa')->unsigned();
            $tabla->foreign('inv_mesa')->references('id')->on('mesas');
            $tabla->boolean('inv_asistencia');
            $tabla->boolean('inv_activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Shema::drop('invitados');
    }
}
