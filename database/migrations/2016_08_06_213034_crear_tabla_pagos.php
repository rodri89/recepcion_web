<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function($tabla){
            $tabla->increments('id');
			$tabla->integer('pago_empresa')->unsigned();
            $tabla->foreign('pago_empresa')->references('id')->on('Empresas');
            $tabla->float('pago_monto',8,2);
            $tabla->date('pago_fecha_desde',50);
            $tabla->date('pago_fecha_hasta',50);
			$tabla->integer('pago_estado')->unsigned();
            $tabla->foreign('pago_estado')->references('id')->on('estados_pago');
            $tabla->boolean('pago_activo');
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
        Shema::drop('pagos');
    }
}
