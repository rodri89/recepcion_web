<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Closure;

class MDusuarioEmpresa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
	use AuthenticatesUsers; 
    public function handle($request, Closure $next)
    {
        $usuario_actual=\Auth::user();
        $us_id = $usuario_actual->id;

        if($usuario_actual->us_tipo!=2){ //si no es usuario Empresa lo redirecciono al login
         // Cerramos la sesión
        return $this->logout($request);
        }
        else{
            $empresa = DB::table('empresas') //obtengo los datos de la empresa del usuario en sesion
                ->select('empresas.emp_deBaja')
                ->where('empresas.emp_usuario', '=', $us_id)
                ->first();
                        
                $Esta_de_Baja = $empresa->emp_deBaja;

                If ($Esta_de_Baja) {
                    $errors = ["Su periodo a caducado. Comuniquece con el administrador."];
                    return $this->logout($request)->withErrors($errors);
                }
                else {
                    return $next($request);
                }
        }
    }
}
