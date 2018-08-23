<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Clientes', function($tabla){
            $tabla->increments('id');
            $tabla->string('cli_dni',30)->unique();
            $tabla->string('cli_nombre',50);
            $tabla->string('cli_apellido',50);
            $tabla->string('cli_telefono',20);
            $tabla->integer('cli_usuario')->unsigned();
            $tabla->foreign('cli_usuario')->references('id')->on('users'); 
			$tabla->integer('cli_empresa')->unsigned();
            $tabla->foreign('cli_empresa')->references('id')->on('empresas'); 
            $tabla->boolean('cli_activo');
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
        Shema::drop('Clientes');
    }
}
