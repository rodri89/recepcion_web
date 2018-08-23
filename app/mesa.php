<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class mesa extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'mesas';
	
	public $timestamps = false;
	
	
    protected $fillable = [
        'descripcion', 'fecha', 'lugar', 'dni', 'mesas', 'lugares'
    ];
	
	protected $hidden = [
        'dni'
    ];
}
