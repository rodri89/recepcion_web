<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo_PosLogOut = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    //Esta funcion la sobreescribimos de vendor\laravel\framework\src\Illuminate\Foundation\Auth.
    //Esto para poder dirigir al user segun su tipo.


    public function redirectPath()
    {

        if (Auth::check()) { 
			
            $usuario_actual=\Auth::user();
            $us_tipo = $usuario_actual->us_tipo;
			
			switch($us_tipo)
				{
					case '1': //Administrador
						return '/administrador';
						break;
					case '2': //Empresa
                        return '/eventos';
						break;
					case '3': //Cliente
						return '/clientes/eventos_clientes';
						break;
				}	
        }
        else 
        {
            return redirect('/login');
        }    
    }
}
