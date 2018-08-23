<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventoRequest;
use App\evento;
use App\empresa;
use App\mesa;
use App\user;
use App\invitado;
use Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Rhumsaa\Uuid\Uuid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventosController extends Controller
{
	
	
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	//esto me lleva a la pantalla que muestra todos los eventos habilitados
	public function getIndex()
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$eventos = DB::table('eventos')
            ->join('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
			->join('empresas', 'eventos.eve_empresa_id', '=', 'empresas.id')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
            ->select('eventos.id as eve_id', 'eventos.eve_descripcion','eventos.eve_fecha','eventos.eve_lugar', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id', 'clientes.cli_dni', 'empresas.emp_nombre', 'eventos.eve_habilitado')
			->where('users.id', '=', $usuario_id)
			->where('eventos.eve_activo', '=', 1)
			->where('eventos.eve_habilitado', '=', 1)
            ->orderBy('eventos.eve_fecha', 'desc') 
			->get();
			
		$empresa_nombre = DB::table('empresas')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
			->where('users.id', '=', $usuario_id)
			->first();
		
		return view('eventos.eventos_admin')->with('eventos',$eventos)->with('empresa_nombre',$empresa_nombre);
	}
	
	//igual al anterior pero me muestra solo los inhabilitados
	public function getInhabilitados()
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$eventos = DB::table('eventos')
            ->join('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
			->join('empresas', 'eventos.eve_empresa_id', '=', 'empresas.id')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
            ->select('eventos.id as eve_id', 'eventos.eve_descripcion','eventos.eve_fecha','eventos.eve_lugar', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id', 'clientes.cli_dni', 'empresas.emp_nombre', 'eventos.eve_habilitado')
			->where('users.id', '=', $usuario_id)
			->where('eventos.eve_activo', '=', 1)
			->where('eventos.eve_habilitado', '=', 0)
            ->orderBy('eventos.eve_fecha', 'desc') 
			->get();
			
		$empresa_nombre = DB::table('empresas')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
			->where('users.id', '=', $usuario_id)
			->first();
		
		return view('eventos.eventos_admin')->with('eventos',$eventos)->with('empresa_nombre',$empresa_nombre);
	}

	//esto me manda a la pantalla para que la empresa actualice sus datos
	public function ActualizarDatosEmpresa()
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$datos = DB::table('empresas')
				->join('users as uc', 'uc.id', '=', 'empresas.emp_usuario')
				->select('empresas.id', 'empresas.emp_nombre', 'empresas.emp_localidad', 'empresas.emp_telefono', 'uc.email')
				->where('uc.id', '=', $usuario_id)
				->first();

		return view('eventos.DatosEmpresa')->with('datos',$datos);
	}
	
	public function DatosEmpresaUpdate(Request $request)//aca hago el update de los datos de la empresa
	{
		//obtengo el ID de la empresa en sesion
		$us_empresa_id=\Auth::id();
		
		$empresa = Empresa::find($request->id);//busco la empresa a modificar
		
		//Aca verifico que el evento a eliminar pertenezca a la empresa.
		if ($empresa->emp_usuario !== $us_empresa_id)
		{
			return back()->withErrors(array('error_mensaje' => 'No puede inhabilitar un evento que no pertenezca a su empresa.')); 
		}
		
		//------VALIDACION DE FORMULARIO-------
		$v = Validator::make($request->all(), [
            'emp_nombre' => 'min:1|max:30|required|string',
            'emp_localidad' => 'min:1|max:30|required|string',
            'emp_telefono' => 'numeric|required',
		],
		[
            'emp_nombre.min' => 'El campo Nombre debe ser significativo.',
            'emp_nombre.max' => 'El campo Nombre debe contener menos caracteres.',
            'emp_nombre.required' => 'El campo Nombre es obligatorio.',
			'emp_localidad.min' => 'El campo Localidad debe ser significativo.',
            'emp_localidad.max' => 'El campo Localidad debe contener menos caracteres.',
            'emp_localidad.required' => 'El campo Localidad es obligatorio.',
            'fecha.date' => 'Debe ingresar una fecha valida.',
            'emp_telefono.numeric' => 'El campo Telefono debe contener solo numeros.',
            'emp_telefono.required' => 'El campo Telefono es obligatorio.',
		]);
		if ($v->fails())
		{
			$datos = DB::table('empresas')
				->join('users as uc', 'uc.id', '=', 'empresas.emp_usuario')
				->select('empresas.id', 'empresas.emp_nombre', 'empresas.emp_localidad', 'empresas.emp_telefono', 'uc.email')
				->where('uc.id', '=', $us_empresa_id)
				->first();
		
			return view('eventos.DatosEmpresa')->with('datos',$datos)->withErrors($v);
		}	
		//------FIN VALIDACION DE FORMULARIO-------
		
		//Si pasa las validacion...
		
		//actualizo los datos
		$empresa->emp_nombre = $request->emp_nombre;
		$empresa->emp_localidad = $request->emp_localidad;
		$empresa->emp_telefono = $request->emp_telefono;
		$empresa->save();
		
			
		$datos = DB::table('empresas')
				->join('users as uc', 'uc.id', '=', 'empresas.emp_usuario')
				->select('empresas.id', 'empresas.emp_nombre', 'empresas.emp_localidad', 'empresas.emp_telefono', 'uc.email')
				->where('uc.id', '=', $us_empresa_id)
				->first();
		
		return view('eventos.DatosEmpresa')->with('datos',$datos);
	}
	
	public function DatosEmpresaContraseñaUpdate(Request $request)//aca hago el update de la contrasenia de la empresa
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$us_empresa_id=$usuario_actual->id;
		$user_pass=$usuario_actual->password;
		
		if (!(Hash::check($request->get('actual_pass'), $user_pass))) {
            return back()->withErrors(array('error_mensaje' => 'La contraseña actual ingresada no es la correcta.')); 
        }
		
		if(strcmp($request->get('actual_pass'), $request->get('nueva_pass')) == 0){
            //Current password and new password are same
             return back()->withErrors(array('error_mensaje' => 'La nueva contraseña no puede ser igual a la antigua. Por favor elija otra contraseña.'));
        }
		
		//------VALIDACION DE FORMULARIO-------
		$v = Validator::make($request->all(), [
            'nueva_pass' => 'min:6|max:15|required',
            'nueva_pass_repetida' => 'min:6|max:15|required',
		],
		[
			'nueva_pass.min' => 'La nueva contraseña debe tener como minimo 6 caracteres.',
            'nueva_pass.max' => 'La nueva contraseña debe tener como maximo 15 caracteres.',
            'nueva_pass.required' => 'Este campo es obligatorio.',
            'nueva_pass_repetida.min' => 'La nueva contraseña debe tener como minimo 6 caracteres.',
            'nueva_pass_repetida.max' => 'La nueva contraseña debe tener como maximo 15 caracteres.',
            'nueva_pass_repetida.required' => 'Este campo es obligatorio.',
		]);
		if ($v->fails())
		{
			$datos = DB::table('empresas')
				->join('users as uc', 'uc.id', '=', 'empresas.emp_usuario')
				->select('empresas.id', 'empresas.emp_nombre', 'empresas.emp_localidad', 'empresas.emp_telefono', 'uc.email')
				->where('uc.id', '=', $us_empresa_id)
				->first();
		
			return view('eventos.DatosEmpresa')->with('datos',$datos)->withErrors($v);
		}	
		//------FIN VALIDACION DE FORMULARIO-------
		
		//actualizo los datos
		$user = \Auth::user();
        $user->password = bcrypt($request->get('nueva_pass'));
        $user->save();
			
		$datos = DB::table('empresas')
				->join('users as uc', 'uc.id', '=', 'empresas.emp_usuario')
				->select('empresas.id', 'empresas.emp_nombre', 'empresas.emp_localidad', 'empresas.emp_telefono', 'uc.email')
				->where('uc.id', '=', $us_empresa_id)
				->first();
		
		return view('eventos.DatosEmpresa')->with('datos',$datos);
	}
	
	//esto me manda a la pantalla para crear un nuevo evento
	public function nuevo()
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$clientes = DB::table('clientes')
				->join('empresas', 'clientes.cli_empresa', '=', 'empresas.id')
				->join('users as ue', 'ue.id', '=', 'empresas.emp_usuario')
				->join('users as uc', 'uc.id', '=', 'clientes.cli_usuario')
				->select('clientes.id', 'clientes.cli_dni', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono' ,'uc.email')
				->where('ue.id', '=', $usuario_id)
				->groupBy('clientes.id', 'clientes.cli_dni', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono' ,'uc.email')
				->get();

		return view('eventos.nuevo_evento')->with('clientes',$clientes);
	}

	//inserta un nuevo evento
	public function add(EventoRequest $request)
	{
		$nuevo_evento = new Evento;

		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;

		$empresa = DB::table('empresas') //obtengo los datos de la empresa del usuario en sesion
            ->join('users', 'users.id', '=', 'empresas.emp_usuario')
            ->select('empresas.id')
			->where('users.id', '=', $usuario_id)
            ->first();
			
		$cliente = DB::table('clientes') //obtengo los datos de la empresa del usuario en sesion
            ->select('clientes.id', 'clientes.cli_empresa')
			->where('clientes.cli_dni', '=', $request->cli_dni)
            ->first();	
			
		//Aca verifico que el cliente pertenezca a la empresa en sesion.
		if ($cliente->cli_empresa !== $empresa->id)
		{
			$eventos = new evento;
			
			return View('eventos.eventos_update')->with('eventos',$eventos)->withErrors(array('error_mensaje' => 'No puede crear un evento para un cliente que no pertenezca a su empresa.'));
		}	

		$nuevo_evento->eve_descripcion = $request->descripcion;
		$nuevo_evento->eve_fecha = $request->fecha;
		$nuevo_evento->eve_lugar = $request->lugar;
		$nuevo_evento->eve_mesas = $request->mesas;
		$nuevo_evento->eve_empresa_id = $empresa->id;
		$nuevo_evento->eve_cliente_id = $cliente->id;
		$nuevo_evento->eve_activo = 1;
		$nuevo_evento->eve_habilitado=1;

		$nuevo_evento->save(); //CARGO EL EVENTO

		$Cant_mesas = $request->mesas;
		$Cant_lugares_x_mesa = $request->input('lugares');

		for ($i = 0; $i <= $Cant_mesas; $i++) //INSERTO LAS MESAS
		{
		    $nueva_mesa = new Mesa;

		    $nueva_mesa->mesa_numero = $i;
		    $nueva_mesa->mesa_capacidad = $Cant_lugares_x_mesa;
		    $nueva_mesa->mesa_tipo = 1; //REDONDA
		    $nueva_mesa->mesa_evento = $nuevo_evento->id;
			$nueva_mesa->mesa_activo = 1;
			
		    $nueva_mesa->save();
		}
		
		return redirect('/eventos'); 
	}


	//Muestra los datos del Evento en el Modal.
	public function mostrar(Request $request)
	{
		$eve_id = $request->evento_id;
    	$evento_info = DB::table('eventos')
            ->leftjoin('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
            ->join ('users', 'users.id', '=', 'clientes.cli_usuario')
            ->select('eventos.*', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono', 'clientes.cli_dni', 'users.email')
            ->where('eventos.id', '=', $eve_id)	
            ->first();

    	return response()->json($evento_info);
	}

	//esto me manda a la pantalla para dar de alta un nuevo cliente
	public function clientes()
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$clientes = DB::table('clientes')
				->join('empresas', 'clientes.cli_empresa', '=', 'empresas.id')
				->join('users as ue', 'ue.id', '=', 'empresas.emp_usuario')
				->join('users as uc', 'uc.id', 'clientes.cli_usuario')
				->select('clientes.id', 'clientes.cli_dni', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono' ,'uc.email')
				->where('ue.id', '=', $usuario_id)
				->groupBy('clientes.id', 'clientes.cli_dni', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.cli_telefono' ,'uc.email','clientes.created_at')
				->orderBy('clientes.created_at', 'desc') 
				->get();
				
		return view('eventos.clientes')->with('clientes',$clientes);
	}

	public function imprimir($id)
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$invitados= DB::table('invitados')
		->join('mesas','mesas.id','=','invitados.inv_mesa')
		->join('eventos','eventos.id','=','mesas.mesa_evento')
		->select('invitados.*', 'mesas.mesa_numero')
		->where('invitados.inv_activo','=','1')
		->where('eventos.id','=',$id)
		->orderBy('invitados.inv_apellido')
		->get();
				
		return view('eventos.eventos_mesas_imprimir')->with('invitados',$invitados);
	}

	public function verEventosCliente(Request $request){      					
		
      	$cliente= DB::table('clientes')->find($request->clienteId);
    	$eventos= DB::table('eventos')->join('clientes as cli','cli.id','=','eventos.eve_cliente_id')
		->select('eventos.id as eveId','eventos.eve_descripcion','eventos.eve_lugar','eventos.eve_fecha')
		->where('eventos.eve_cliente_id','=',$request->clienteId)
		->get();    	
		
    	return View('eventos.eventos_del_cliente')->with('eventos',$eventos)->with('clientes',$cliente);    	            	
    }

    public function listarEventos($cli_id){      					
		$usuario_actual=\Auth::user(); 

      	$cliente= DB::table('clientes')->find($cli_id);
    	$eventos= DB::table('eventos')->join('clientes as cli','cli.id','=','eventos.eve_cliente_id')
		->select('eventos.id as eveId','eventos.eve_descripcion','eventos.eve_lugar','eventos.eve_fecha')
		->where('eventos.eve_cliente_id','=',$cli_id)
		->where ('eventos.eve_activo','=','1')
		->orderBy('eventos.eve_fecha', 'desc')
		->get();    	
		
    	return View('eventos.eventos_del_cliente')->with('eventos',$eventos)->with('clientes',$cliente);    	            	
    }

    public function mesaDelCliente($eveId){
    	$usuario_id=\Auth::id();
        $eventoId=$eveId;
        //$cliente=$request->clienteId;     

        $cliente= DB::table('clientes')
        ->join('eventos as eve','clientes.id','=','eve.eve_cliente_id')
		->select('clientes.id')
		->where('eve.id','=',$eveId)
		->first(); 

        $eventoMesas=DB::table('mesas')
		->selectRaw("count(mesas.id) as count_row")
		->where('mesa_evento','=',$eventoId)
		->where('mesa_activo','=','1')
		->get();
		
        $cantidadMesas=$eventoMesas[0]->count_row-1; // resto uno porque existe la mesa 0
		
		$eventoMesasSillas=DB::table('mesas')
		->where('mesa_evento','=',$eventoId)
		->where('mesa_activo','=','1')
		->get();
        
		$cantidadSillas=$eventoMesasSillas[1]->mesa_capacidad; // resto uno porque existe la mesa 0
		
        $inv= DB::table('invitados')
		->join('mesas as m','m.id','=','invitados.inv_mesa')
		->join('eventos as e','e.id','=','m.mesa_evento')
		->select('invitados.*','m.mesa_numero')
		->where('e.id','=',$eventoId)
		->where('invitados.inv_activo','=','1')
		->get();
        
		return View('eventos.mesa_del_cliente')->with('evento_id',$eventoId)->with('cliente_id',$cliente)->with('cantidad_mesas',$cantidadMesas)->with('inv',$inv)->with('cantidadSillas',$cantidadSillas);        
    }


	public function buscar_evento(Request $request)
    {
		$usuario_id=\Auth::id();
		
		$descripcion = $request->descripcion;
    	$fechadesde = $request->fecha_desde;
		$fechahasta = $request->fecha_hasta;
    	$dni = $request->dni;

    	if ($descripcion == 'n/a') {$descripcion = ""; }
    	if ($dni == 'n/a') {$dni = ""; } 
		
		$evento_info = DB::table('eventos')
            ->join('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
			->join('empresas', 'eventos.eve_empresa_id', '=', 'empresas.id')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
            ->select('eventos.id as eve_id','eventos.eve_descripcion','eventos.eve_fecha','eventos.eve_lugar', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id', 'clientes.cli_dni')
			->where('eventos.eve_activo', '=', '1')
			->where('eventos.eve_habilitado', '=', '1')
			->where('users.id', '=', $usuario_id)
   			->where('eventos.eve_descripcion', 'like', "%".$descripcion."%")
   			->where('clientes.cli_dni', 'like', "%".$dni."%") 
			->whereBetween('eventos.eve_fecha', array($fechadesde,$fechahasta))
			->orderBy('eventos.eve_fecha', 'desc') 
            ->get();
			
		return response()->json($evento_info);
    }
	
	public function actualizar_evento ($id)
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;

		$eventos = DB::table('eventos')
            ->join('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
			->join('empresas', 'eventos.eve_empresa_id', '=', 'empresas.id')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
			->join('mesas', 'mesas.mesa_evento', '=', 'eventos.id')
            ->select('eventos.id as eve_id','eventos.eve_descripcion','eventos.eve_fecha','eventos.eve_lugar', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id as cli_id', 'clientes.cli_dni', 'mesas.mesa_capacidad as lugares', 'eventos.eve_mesas')
			->where('users.id', '=', $usuario_id)
   			->where('eventos.id', '=', $id)
            ->first();
		
		return View('eventos.eventos_update')->with('eventos',$eventos);
	}
	
	//inhabilita un evento
	public function inhabilitar (Request $request)
	{
		$evento = Evento::find($request->id);//busco el evento a eliminar

		//obtengo el ID de la empresa en sesion
		$us_empresa_id=\Auth::id();
		$empresa = DB::table('empresas')
					->join('users', 'users.id', '=', 'empresas.emp_usuario')
					->select('empresas.id')
					->where('empresas.emp_usuario', '=', $us_empresa_id)
					->first();
	
		//Aca verifico que el evento a eliminar pertenezca a la empresa.
		if ($evento->eve_empresa_id !== $empresa->id)
		{
			$eventos = new evento;
			return back()->withErrors(array('error_mensaje' => 'No puede inhabilitar un evento que no pertenezca a su empresa.')); 
		}
		
		$evento->eve_habilitado = 0;
		$evento->save();
		
		//Inactivo todas las mesas del evento a eliminar
		//DB::table('mesas')
		//	->where('mesa_evento', $request->id)
		//	->update(['mesa_activo' => "0"]);
		
		//busco todas las mesas del evento a eliminar
		//$mesas_to_delete = DB::select('select m.*
		//								from mesas m
		//								join eventos e on e.id=m.mesa_evento
		//								where e.id= :id', ['id' => $request->id]);
										
		//Inactivo todos los invitados de las mesas anteriores	
		//foreach ($mesas_to_delete as $mesa)
		//{
		//	DB::table('invitados')
		//		->where('inv_mesa', $mesa->id)
		//		->update(['inv_activo' => "0"]);
		//}
		
		return redirect('/eventos');  
	}
	
	public function update(Request $request)//aca hago el update de los datos del evento
	{
		$evento = Evento::find($request->id);//busco el evento a modificar
		
		//obtengo el ID de la empresa en sesion
		$us_empresa_id=\Auth::id();
		$empresa = DB::table('empresas')
					->join('users', 'users.id', '=', 'empresas.emp_usuario')
					->select('empresas.id')
					->where('empresas.emp_usuario', '=', $us_empresa_id)
					->first();
	
		//Aca verifico que el evento y el usuario a modificar pertenezca a la empresa.
		if ($evento->eve_empresa_id !== $empresa->id)
		{
			$eventos = new evento;
			
			return View('eventos.eventos_update')->with('eventos',$eventos)->withErrors(array('error_mensaje' => 'No puede modificar un evento que no pertenezca a su empresa.'));
		}
		
		//------VALIDACION DE FORMULARIO-------
		$v = Validator::make($request->all(), [
			'eve_descripcion' => [
								'required','max:100','min:1','string',
								Rule::unique('eventos')->ignore($evento->id),
							 ],
            'fecha' => 'date',
            'lugar' => 'min:1|max:250|required|string',
            //'cli_dni_show' => 'numeric|exists:clientes,cli_dni|required',
            //'mesas' => 'numeric',
            //'lugares' => 'numeric'
		],
		[
            'eve_descripcion.min' => 'El campo Descripcion debe ser significativo.',
            'eve_descripcion.max' => 'El campo Descripcion debe contener menos caracteres.',
            'eve_descripcion.required' => 'El campo Descripcion es obligatorio.',
            'eve_descripcion.unique' => 'Ya existe un evento con la misma Descrpcion.',
            'fecha.date' => 'Debe ingresar una fecha valida.',
            'lugar.max' => 'El campo Lugar debe contener menos caracteres.',
            'lugar.required' => 'El campo Lugar es obligatorio.',
            //'mesas.numeric' => 'El campo Cantidad de Mesas solo permite numeros.',
		]);
		if ($v->fails())
		{
			$eventos = DB::table('eventos')
            ->join('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
			->join('empresas', 'eventos.eve_empresa_id', '=', 'empresas.id')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
			->join('mesas', 'mesas.mesa_evento', '=', 'eventos.id')
            ->select('eventos.id as eve_id','eventos.eve_descripcion','eventos.eve_fecha','eventos.eve_lugar', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id as cli_id', 'clientes.cli_dni', 'mesas.mesa_capacidad as lugares', 'eventos.eve_mesas')
			->where('users.id', '=', $us_empresa_id)
   			->where('eventos.id', '=', $evento->id)
            ->first();
		
			return View('eventos.eventos_update')->with('eventos',$eventos)->withErrors($v);
		}	
		//------FIN VALIDACION DE FORMULARIO-------
		
		//Si pasa las validacion...
		
		//actualizo el cliente
		$evento->eve_descripcion = $request->eve_descripcion;
		$evento->eve_fecha = $request->fecha;
		$evento->eve_lugar = $request->lugar;
		$evento->save();

		$eventos = DB::table('eventos')
            ->join('clientes', 'eventos.eve_cliente_id', '=', 'clientes.id')
			->join('empresas', 'eventos.eve_empresa_id', '=', 'empresas.id')
			->join('users', 'users.id', '=', 'empresas.emp_usuario')
			->join('mesas', 'mesas.mesa_evento', '=', 'eventos.id')
            ->select('eventos.id as eve_id','eventos.eve_descripcion','eventos.eve_fecha','eventos.eve_lugar', 'clientes.cli_nombre', 'clientes.cli_apellido', 'clientes.id as cli_id', 'clientes.cli_dni', 'mesas.mesa_capacidad as lugares', 'eventos.eve_mesas')
			->where('users.id', '=', $us_empresa_id)
   			->where('eventos.id', '=', $evento->id)
            ->first();
		
		return View('eventos.eventos_update')->with('eventos',$eventos);
	}


	
	public function pagos()
	{
		$usuario_actual=\Auth::user(); //obtengo los datos del usuario en sesion
		$usuario_id=$usuario_actual->id;
		
		$pagos = DB::table('pagos')
			->join('empresas', 'pagos.pago_empresa', '=', 'empresas.id')
			->join('users', 'users.id', '=' ,'empresas.emp_usuario')
			->join('estados_pago', 'estados_pago.id', '=', 'pagos.pago_estado')
            ->select('users.email', 'empresas.emp_nombre', 'empresas.emp_localidad' ,'empresas.emp_telefono', 'empresas.emp_usuario', 'pagos.pago_monto', 'pagos.pago_fecha_desde', 'pagos.pago_fecha_hasta', 'estados_pago.est_descripcion')
			->where('users.id', '=', $usuario_id)
			->where('empresas.emp_activo', '=', '1')
			->where('pagos.pago_activo', '=', '1')
			->orderby('pagos.created_at', 'desc')
			->get();
			
		$ultimo_pago = DB::table('pagos')
			->join('empresas', 'pagos.pago_empresa', '=', 'empresas.id')
			->join('users', 'users.id', '=' ,'empresas.emp_usuario')
			->join('estados_pago', 'estados_pago.id', '=', 'pagos.pago_estado')
            ->select('users.email', 'empresas.emp_nombre', 'empresas.emp_localidad' ,'empresas.emp_telefono', 'empresas.emp_usuario', 'pagos.pago_monto', 'pagos.pago_fecha_desde', 'pagos.pago_fecha_hasta', 'estados_pago.est_descripcion')
			->where('users.id', '=', $usuario_id)
			->where('empresas.emp_activo', '=', '1')
			->where('pagos.pago_activo', '=', '1')
			->orderby('pagos.created_at', 'desc')
			->first();	
			
		return view('eventos.eventos_pagos')->with('pagos',$pagos)->with('ultimo_pago',$ultimo_pago);
	}



	 public function listaInvitados(Request $request){
        $eventoId=$request->eventoId;                    
        $inv= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')
        ->join('eventos as e','e.id','=','m.mesa_evento')
        ->select('invitados.id as inv_id','invitados.inv_nombre','m.mesa_numero')
        ->where('e.id','=',$eventoId)->get();
        

        $count= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')
        ->join('eventos as e','e.id','=','m.mesa_evento')
        ->selectRaw("count(invitados.id) as count_row")
        ->where('e.id','=',$eventoId)->get();

        $cantInvitados=$count[0]->count_row;
        $i=0;
        //$lista=$inv[5]->inv_nombre.' '.$inv[5]->mesa_numero;        
        $lista="";
        while($i<$cantInvitados){
			$id=$inv[$i]->inv_id;
            $nombreInvitado=$inv[$i]->inv_nombre;
            $mesa=$inv[$i]->mesa_numero;
            if($mesa!=0){
				$lista=$lista.''.$id.';';
                $lista=$lista.''.$nombreInvitado.';';
                $lista=$lista.''.$mesa.';';
            }                       
            $i=$i+1;
        }
        return response()->json(array('sms'=>$lista));  
    }


    public function resumenCantidadInvitados(Request $request){                              
        $eventoId=$request->eventoId;                    
        
        $countAdultos= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')
        ->join('eventos as e','e.id','=','m.mesa_evento')
        ->selectRaw("count(invitados.id) as count_row")
        ->where('e.id','=',$eventoId)->where('invitados.inv_tipo','=','3')->get();

        $countNinos= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')
        ->join('eventos as e','e.id','=','m.mesa_evento')
        ->selectRaw("count(invitados.id) as count_row")
        ->where('e.id','=',$eventoId)->where('invitados.inv_tipo','=','1')->get();

        $cantNinos=$countNinos[0]->count_row;
        $cantAdultos=$countAdultos[0]->count_row;
        $cantTotal=$cantNinos+$cantAdultos;

        return response()->json(array('adultos'=>$cantAdultos,'ninos'=>$cantNinos,'total'=>$cantTotal));         
        //return response()->json(array('msj'=>'Los datos han sido guardados'));         
    }
	

	public function Contacto()
	{
		return view('eventos.Contacto');
	}
}
