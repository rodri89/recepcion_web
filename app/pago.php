<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class pago extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'pagos';
	
	public $timestamps = true;
	
	
    protected $fillable = [
        'monto', 'fecha_desde', 'fecha_hasta', 'empresa_id'
    ];
	
}
