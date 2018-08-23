<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\cliente;
use App\user;
use App\empresa;
use App\pago;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Mail;

class AdminsController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function getIndex()
	{

			
		return view('admins.admin_home');
	}
	
	public function empresas()
	{
		$empresas = DB::table('empresas')
			->join('users', 'users.id', '=' ,'empresas.emp_usuario')
            ->select('users.email', 'empresas.emp_nombre', 'empresas.emp_localidad' ,'empresas.emp_telefono', 'empresas.emp_usuario')
			->where('empresas.emp_activo', '=', '1')
			->orderby('empresas.created_at')
			->get();	
			
		return view('admins.admin_empresas')->with('empresas',$empresas);
	}
	
	public function usuarios()
	{
		$usuarios = DB::table('users')
			->join('tipo_usuario', 'tipo_usuario.id', '=', 'users.us_tipo')
            ->select('users.id as user_id','users.email as email','tipo_usuario.tu_descripcion as tu_descripcion')
			->where('users.us_activo', '=', '1')
			->orderby('users.created_at')
			->get();
			
		return view('admins.admin_usuarios')->with('usuarios',$usuarios);
	}
	
	public function pagos()
	{		
		$empresas = DB::select('select e.id, e.emp_nombre, e.emp_localidad, e.emp_telefono, u.email, e.emp_usuario, 
		(select p.pago_fecha_desde from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as pago_fecha_desde,
		(select p.pago_fecha_hasta from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as pago_fecha_hasta,
		(select ep.est_descripcion from pagos p join estados_pago ep on p.pago_estado=ep.id where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as est_descripcion,
		(select p.pago_monto from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id)) as pago_monto,
        (select p.id from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id)) as pago_id
		from empresas e join users u on u.id=e.emp_usuario
    					join pagos p on p.pago_empresa=e.id
		where e.emp_activo=1 and u.us_activo=1 
        group by e.id, e.emp_nombre, e.emp_localidad, e.emp_telefono, u.email, e.emp_usuario
        Order by p.pago_fecha_hasta desc');

	
		$TotalEmp = collect(\DB::select('select count(e.id) as TotalEmp
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and e.emp_activo=1'))->first();
		
		
		$TotalEmpActivas = collect(\DB::select('select count(e.id) as TotalEmpActivas
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and (p.pago_estado=1) and e.emp_activo=1'))->first();
				
		$TotalEmpExpiradas = collect(\DB::select('select count(e.id) as TotalEmpExpiradas
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and (p.pago_estado=2) and e.emp_activo=1'))->first();
				
		return view('admins.admin_pagos')->with('empresas',$empresas)->with('TotalEmp',$TotalEmp)->with('TotalEmpActivas',$TotalEmpActivas)->with('TotalEmpExpiradas',$TotalEmpExpiradas);
	}
	
	public function agregar_empresa(Request $request) {
		
			$pass_autogenerada = str_random(6);
			$usuario=new user; 

			$usuario->email = $request->mail;
            $usuario->password = bcrypt($pass_autogenerada);//autogenerado
            $usuario->us_tipo = '2';
            $usuario->us_activo = '1';

            $usuario->save();//inserto el nuevo usuario
			
			$emp=new empresa; 	

            $emp->emp_nombre = $request->nombre;
            $emp->emp_localidad = $request->localidad;
            $emp->emp_telefono= $request->telefono;
			$emp->emp_usuario = $usuario->id;
			$emp->emp_deBaja = '0';
            $emp->emp_activo = '1';

            $emp->save();//inserto la nueva empresa
			
			$pago=new pago;
			
			$pago->pago_empresa = $emp->id;
			$pago->pago_fecha_desde = $request->fecha_desde;
			$pago->pago_fecha_hasta = $request->fecha_hasta;
			$pago->pago_monto = $request->monto;
			$pago->pago_estado = 1;
			$pago->pago_activo = '1';
			
			$pago->save();//inserto el pago
			
			//envio mail con credenciales
			$data['nombre'] = $emp->emp_nombre;
			$data['usuario'] = $usuario->email;
			$data['password'] = $pass_autogenerada;
			$data['email'] = $usuario->email;
			Mail::send('emails.clientes', $data, function ($message) use ($data){
				$message->subject('Su cuenta :)');
				$message->to($data['email']);
			});
			
            return redirect('/administrador/empresas'); 
    }

	public function nuevo_pago(Request $request) {
		
			//Chequeo que si hay Pagos Activos los marco como Expirados
			$pagos_activos = DB::select('select p.*
										 from empresas e join pagos p on e.id=p.pago_empresa
										 where e.id= :id and p.pago_estado=1', ['id' => $request->empresa_id]);
			
			foreach ($pagos_activos as $pagos)
			{
				DB::table('pagos')
					->where('id', $pagos->id)
					->update(['pago_estado' => "2"]);
			}
			///////
			
			//Vuelvo a activar a la empresa
			DB::table('empresas')
					->where('id', $request->empresa_id)
					->update(['emp_deBaja' => "0"]);
			/////////
			
			$pago=new pago;
			
			$pago->pago_empresa = $request->empresa_id;
			$pago->pago_fecha_desde = $request->fecha_desde;
			$pago->pago_fecha_hasta = $request->fecha_hasta;
			$pago->pago_monto = $request->monto;
			$pago->pago_estado = 1;
			$pago->pago_activo = '1';
			
			$pago->save();//inserto el pago
			
			
			$data['nombre'] = $request->empresa_nombre;
			$data['fecha_desde'] = $request->fecha_desde;
			$data['fecha_hasta'] = $request->fecha_hasta;
			$data['email'] = $request->email;
			Mail::send('emails.pago', $data, function ($message) use ($data){
				$message->subject('Su nuevo periodo :)');
				$message->to($data['email']);
			});
			
            return redirect('/administrador/pagos'); 
    }
	
	public function expirar_pago(Request $request) {
		
			$id_pago = $request->pago_id_2;
			$id_empresa = $request->empresa_id_2;
			
			DB::table('pagos')
					->where('id', $id_pago)
					->update(['pago_estado' => "2"]);
			
			DB::table('empresas')
					->where('id', $id_empresa)
					->update(['emp_debaja' => "1"]);
			
			$data['email'] = $request->email_2;
			Mail::send('emails.pagoexpirado', $data, function ($message) use ($data){
				$message->subject('Periodo Expirado');
				$message->to($data['email']);
			});
			
            return redirect('/administrador/pagos'); 
    }
	
	public function expirar_todos_pagos(Request $request) {
		
			//Chequeo que si hay Pagos Activos los marco como Expirados
			$pagos_activos = DB::select('select p.*, u.email, e.id as e_id
											from pagos p
											join empresas e on e.id=p.pago_empresa
											join users u on u.id=e.emp_usuario
											where p.pago_activo=1 and p.pago_estado=1 and p.pago_fecha_hasta<NOW()');
			
			foreach ($pagos_activos as $pagos)
			{
				DB::table('pagos')
					->where('id', $pagos->id)
					->update(['pago_estado' => "2"]);
					
				DB::table('empresas')
					->where('id', $pagos->e_id)
					->update(['emp_debaja' => "1"]);
					
				$data['email'] = $pagos->email;
					Mail::send('emails.pagoexpirado', $data, function ($message) use ($data){
					$message->subject('Periodo Expirado');
					$message->to($data['email']);
				});
			}
			//////
		
            return redirect('/administrador/pagos'); 
    }
	
	public function Caducados_Expirados() {
		
		$empresas = DB::select('select e.id, e.emp_nombre, e.emp_localidad, e.emp_telefono, u.email, e.emp_usuario, 
		(select p.pago_fecha_desde from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as pago_fecha_desde,
		(select p.pago_fecha_hasta from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as pago_fecha_hasta,
		(select ep.est_descripcion from pagos p join estados_pago ep on p.pago_estado=ep.id where p.created_at =			(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as est_descripcion,
		(select p.pago_monto from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id)) as pago_monto,
        (select p.id from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id)) as pago_id
		from empresas e join users u on u.id=e.emp_usuario
    					join pagos p on p.pago_empresa=e.id
		where e.emp_activo=1 and u.us_activo=1 and p.pago_estado=2 and p.pago_activo=1 and p.pago_fecha_hasta<NOW()
        group by e.id, e.emp_nombre, e.emp_localidad, e.emp_telefono, u.email, e.emp_usuario
        Order by p.pago_fecha_hasta desc');
			
		$TotalEmp = collect(\DB::select('select count(e.id) as TotalEmp
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and e.emp_activo=1'))->first();
		
		
		$TotalEmpActivas = collect(\DB::select('select count(e.id) as TotalEmpActivas
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and (p.pago_estado=1) and e.emp_activo=1'))->first();
				
		$TotalEmpExpiradas = collect(\DB::select('select count(e.id) as TotalEmpExpiradas
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and (p.pago_estado=2) and e.emp_activo=1'))->first();
				
		return view('admins.admin_pagos')->with('empresas',$empresas)->with('TotalEmp',$TotalEmp)->with('TotalEmpActivas',$TotalEmpActivas)->with('TotalEmpExpiradas',$TotalEmpExpiradas);
	}
	
	public function Caducados_Activos() {
		
		$empresas = DB::select('select e.id, e.emp_nombre, e.emp_localidad, e.emp_telefono, u.email, e.emp_usuario, 
		(select p.pago_fecha_desde from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as pago_fecha_desde,
		(select p.pago_fecha_hasta from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as pago_fecha_hasta,
		(select ep.est_descripcion from pagos p join estados_pago ep on p.pago_estado=ep.id where p.created_at =			(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1)) as est_descripcion,
		(select p.pago_monto from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id)) as pago_monto,
        (select p.id from pagos p where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id)) as pago_id
		from empresas e join users u on u.id=e.emp_usuario
    					join pagos p on p.pago_empresa=e.id
		where e.emp_activo=1 and u.us_activo=1 and p.pago_estado=1 and p.pago_fecha_hasta<NOW()
        group by e.id, e.emp_nombre, e.emp_localidad, e.emp_telefono, u.email, e.emp_usuario
        Order by p.pago_fecha_hasta desc');
		
		$TotalEmp = collect(\DB::select('select count(e.id) as TotalEmp
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and e.emp_activo=1'))->first();
		
		
		$TotalEmpActivas = collect(\DB::select('select count(e.id) as TotalEmpActivas
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and (p.pago_estado=1) and e.emp_activo=1'))->first();
				
		$TotalEmpExpiradas = collect(\DB::select('select count(e.id) as TotalEmpExpiradas
		from empresas e join pagos p on p.pago_empresa=e.id
		where p.created_at =(select max(p.created_at) from pagos p where p.pago_empresa = e.id and p.pago_activo=1) and (p.pago_estado=2) and e.emp_activo=1'))->first();
				
		return view('admins.admin_pagos')->with('empresas',$empresas)->with('TotalEmp',$TotalEmp)->with('TotalEmpActivas',$TotalEmpActivas)->with('TotalEmpExpiradas',$TotalEmpExpiradas);
	}

}


    