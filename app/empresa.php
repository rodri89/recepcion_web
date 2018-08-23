<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class empresa extends Authenticatable
{
	use Notifiable;
	
	protected $table = 'empresas';
	
	public $timestamps = true;
	
    protected $fillable = [
        'nombre', 'localidad', 'telefono', 'usuario'
    ];
	
}
