<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\cliente;
use App\user;
use App\empresa;
use Illuminate\Http\Response;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
	
      public function add(ClienteRequest $request) {
			
			$pass_autogenerada = str_random(6);
		
			$usuario=new user; 

			$usuario->email = $request->email;
            $usuario->password = bcrypt($pass_autogenerada);//autogenerado
            $usuario->us_tipo = '3';
            $usuario->us_activo = '1';

            $usuario->save();//inserto el nuevo usuario
			
			$cli=new Cliente; 

			$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
			$usuario_id=$usuario_actual->id;
			
			$empresa = DB::table('empresas') //obtengo los datos de la empresa del usuario en sesion
            ->join('users', 'users.id', '=', 'empresas.emp_usuario')
            ->select('empresas.id')
			->where('users.id', '=', $usuario_id)
            ->first();			

            $cli->cli_dni = $request->dni;
            $cli->cli_nombre = $request->nombre;
            $cli->cli_apellido = $request->apellido;
            $cli->cli_telefono = $request->telefono;
			$cli->cli_usuario = $usuario->id;
			$cli->cli_empresa = $empresa->id;
            $cli->cli_activo = '1';

            $cli->save();//inserto el nuevo cliente
			
			$data['nombre'] = $cli->cli_nombre;
			$data['usuario'] = $usuario->email;
			$data['password'] = $pass_autogenerada;
			$data['email'] = $usuario->email;
			Mail::send('emails.clientes', $data, function ($message) use ($data){
				$message->subject('Su cuenta :)');
				$message->to($data['email']);//aca iria el mail del cliente
			});

            return redirect('/eventos/clientes'); 
    }


	public function mostrar($cli_id)
	{
    	$cliente = Cliente::find($cli_id);

    	return response()->json($cliente);
	}
	
	public function actualizar_cliente ($id)
	{
		$clientes = DB::table('clientes')
			->join('users', 'users.id', '=', 'clientes.cli_usuario')
            ->select('clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id', 'clientes.cli_dni', 'clientes.cli_telefono', 'users.email', 'users.id as usid')
			->where('clientes.id', '=', $id)
            ->first();
		
		return View('eventos.clientes_update')->with('clientes',$clientes);
	}
	
	public function update(Request $request)//aca hago el update de los datos del cliente
	{
		$cliente = Cliente::find($request->id);//busco el cliente a modificar
		
		//obtengo el ID de la empresa en sesion
		$us_empresa_id=\Auth::id();
		$empresa = DB::table('empresas')
					->join('users', 'users.id', '=', 'empresas.emp_usuario')
					->select('empresas.id')
					->where('empresas.emp_usuario', '=', $us_empresa_id)
					->first();
	
		//Aca verifico que el cliente y el usuario a modificar pertenezca a la empresa.
		if ($cliente->cli_empresa !== $empresa->id)
		{
			$clientes = new cliente;
			
			return View('eventos.clientes_update')->with('clientes',$clientes)->withErrors(array('error_mensaje' => 'No puede modificar un cliente que no pertenezca a su empresa.'));
		}
		
		//------VALIDACION DE FORMULARIO-------
		$v = Validator::make($request->all(), [
			'cli_dni' => [
					  'required',
					  Rule::unique('clientes')->ignore($cliente->id),
					 ],
            'nombre' => 'string|max:25|required',
            'apellido' => 'string|max:30|required',
            'telefono' => 'numeric|required',
            'email' => [
						'required','max:50','min:1','email',
						Rule::unique('users')->ignore($cliente->cli_usuario),
					   ],
		],
		[
            'cli_dni.max' => 'El campo DNI debe contener menos caracteres.',
            'cli_dni.required' => 'El campo DNI es obligatorio.',
            'cli_dni.numeric' => 'El DNI solo puede contener numeros.',
			'cli_dni.unique' => 'El DNI ya existe.',
            'nombre.max' => 'El campo Nombre debe contener menos caracteres.',
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'apellido.max' => 'El campo Nombre debe contener menos caracteres.',
            'apellido.required' => 'El campo Nombre es obligatorio.',
            'telefono.numeric' => 'El Telefono solo puede contener numeros.',
            'telefono.required' => 'El campo Telefono es obligatorio.',
			'email.min' => 'El campo Email debe contener mas caracteres.',
			'email.max' => 'El campo Email debe contener menos caracteres.',
			'email.required' => 'El campo Email es obligatorio.',
			'email.email' => 'El campo Email tiene un formato invalido',
			'email.unique' => 'El Email ya existe',
		]);
		if ($v->fails())
		{
			$clientes = DB::table('clientes')
			->join('users', 'users.id', '=', 'clientes.cli_usuario')
            ->select('clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id', 'clientes.cli_dni', 'clientes.cli_telefono', 'users.email', 'users.id as usid')
			->where('clientes.id', '=', $request->id)
            ->first();
			return View('eventos.clientes_update')->with('clientes',$clientes)->withErrors($v);
		}	
		//------FIN VALIDACION DE FORMULARIO-------
		
		//Si pasa las validacion...
		
		//actualizo el cliente
		$cliente->cli_dni = $request->cli_dni;
        $cliente->cli_nombre = $request->nombre;
        $cliente->cli_apellido = $request->apellido;
        $cliente->cli_telefono = $request->telefono;
		$cliente->save();
		
		//actualizo el ususario
		$userID = $cliente->cli_usuario;
		$usuario = User::find($userID);
		$usuario->email = $request->email;
		$usuario->save();

		$clientes = DB::table('clientes')
			->join('users', 'users.id', '=', 'clientes.cli_usuario')
            ->select('clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id', 'clientes.cli_dni', 'clientes.cli_telefono', 'users.email', 'users.id as usid')
			->where('clientes.id', '=', $request->id)
            ->first();
		
    	return View('eventos.clientes_update')->with('clientes',$clientes);
	}

    public function buscar_cliente(Request $request)
    {
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$busqueda = $request->busqueda;
		
        if ($busqueda == 'todo')
        {
            $clientes = DB::table('clientes')
				->join('empresas', 'clientes.cli_empresa', '=', 'empresas.id')
				->join('users as ue', 'ue.id', '=', 'empresas.emp_usuario')
				->join('users as uc', 'uc.id', '=', 'clientes.cli_usuario')
				->select('clientes.id', 'clientes.cli_dni', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono' ,'uc.email')
				->where('ue.id', '=', $usuario_id)
				->groupBy('clientes.id', 'clientes.cli_dni', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono' ,'uc.email')
				->get();
        }
        else
        {

				
			$clientes = DB::select(DB::raw("select c.id, c.cli_dni, c.cli_nombre, c.cli_apellido, c.cli_telefono, uc.email
									from clientes c
									join empresas e on e.id=c.cli_empresa
									join users ue on ue.id=e.emp_usuario
									join users uc on uc.id=c.cli_usuario
									where (ue.id=$usuario_id) and (concat_ws(' ', c.cli_nombre, c.cli_apellido) like '%$busqueda%')
									group by c.id, c.cli_dni, c.cli_nombre, c.cli_apellido, c.cli_telefono, uc.email"));
        }
		
        return response()->json($clientes);
    }


	 public function mesaClientes(){
		 
      	$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
    	$eventos= DB::table('eventos')
		->join('clientes', 'clientes.id','=','eventos.eve_cliente_id')
		->join('users', 'users.id', '=', 'clientes.cli_usuario')
		->select('eventos.id as eveId','eventos.eve_descripcion','eventos.eve_lugar','eventos.eve_fecha')
		->where('users.id', '=', $usuario_id)
		->where('eventos.eve_activo', '=', '1')
		->where('eventos.eve_habilitado', '=', '1')
		->OrderBy('eventos.eve_fecha', 'desc')
		->get();    	
		
		$clientes = DB::table('clientes')
		->join('users', 'users.id', '=', 'clientes.cli_usuario')
		->select('clientes.id', 'clientes.cli_nombre', 'clientes.cli_apellido', 'users.email')
		->where('users.id', '=', $usuario_id)
		->first();
		
    	return View('clientes.eventos_clientes')->with('eventos',$eventos)->with('clientes',$clientes);    	        
    }

}


    