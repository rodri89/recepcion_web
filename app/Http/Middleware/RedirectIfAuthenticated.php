<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
           $usuario_actual=\Auth::user();
            $us_tipo = $usuario_actual->us_tipo;
			
			switch($us_tipo)
				{
					case '1': //Administrador
						return redirect('/administrador');
						break;
					case '2': //Empresa
                        return redirect('/eventos');
						break;
					case '3': //Cliente
						return redirect('/clientes/eventos_clientes');
						break;
				}
        }
        return $next($request);
    }
}
