<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function($tabla){
            $tabla->increments('id');
            $tabla->string('emp_nombre',30);
            $tabla->string('emp_localidad',50);
            $tabla->string('emp_telefono',50);
            $tabla->integer('emp_usuario')->unsigned();
            $tabla->foreign('emp_usuario')->references('id')->on('users'); 
			$tabla->boolean('emp_deBaja');
            $tabla->boolean('emp_activo');
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
        Shema::drop('empresas');
    }
}