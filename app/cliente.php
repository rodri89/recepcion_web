<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class cliente extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'clientes';
	
	public $timestamps = true;
	
    protected $fillable = [
        'dni', 'nombre', 'apellido', 'telefono', 'usuario'
    ];
	
}
