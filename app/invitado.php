<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class invitado extends Authenticatable
{
    protected $table = 'invitados';

	public $timestamps = false;
	
    protected $fillable = [
        'inv_nombre', 'inv_apellido', 'inv_sexo', 'inv_tipo', 'inv_mesa', 'inv_asistencia','inv_activo'
    ];
	
}
