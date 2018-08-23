<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Closure;

class MDusuarioCliente
{

	use AuthenticatesUsers;
	
    public function handle($request, Closure $next)
    {
        $usuario_actual=\Auth::user();
        if($usuario_actual->us_tipo!=3){ //si no es usuario Cliente lo redirecciono al login
         // Cerramos la sesión
        return $this->logout($request);
        }
        return $next($request);
    }
}
