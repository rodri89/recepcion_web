<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class evento extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'eventos';
	
	public $timestamps = true;
	
    protected $fillable = [
        'descripcion', 'fecha', 'lugar', 'dni', 'empresa', 'mesas', 'lugares'
    ];
	
	protected $hidden = [
        'dni'
    ];
}
