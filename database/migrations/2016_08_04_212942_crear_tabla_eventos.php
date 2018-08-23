<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function($tabla){
            $tabla->increments('id');
            $tabla->string('eve_descripcion',100)->unique();
            $tabla->date('eve_fecha',50);
            $tabla->string('eve_lugar',250);
            $tabla->integer('eve_mesas');
            $tabla->integer('eve_cliente_id')->unsigned();
            $tabla->foreign('eve_cliente_id')->references('id')->on('Clientes');
			$tabla->integer('eve_empresa_id')->unsigned();
            $tabla->foreign('eve_empresa_id')->references('id')->on('Empresas');
			$tabla->boolean('eve_activo');
			$tabla->boolean('eve_habilitado');
			$tabla->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Shema::drop('eventos');
    }
}
