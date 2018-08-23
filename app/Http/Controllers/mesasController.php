<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\invitado;
use App\mesa;
use App\eventos;
//use Request;


class mesasController extends Controller
{					
    //
    public function index(){
    	$inv= DB::table('invitados')->get();
    	return View('mesas.mesa')->with('inv',$inv);    	        
    }

    public function mesaCliente(Request $request){
        $eventoId=$request->eventoId;
        $cliente=$request->clienteId;        
        $eventoMesas=DB::table('mesas')->selectRaw("count(mesas.id) as count_row")->where('mesa_evento','=',$eventoId)->get();
        $cantidadMesas=$eventoMesas[0]->count_row-1; // resto uno porque existe la mesa 0
		
		$eventoMesasSillas=DB::table('mesas')->where('mesa_evento','=',$eventoId)->get();
        $cantidadSillas=$eventoMesasSillas[1]->mesa_capacidad; // resto uno porque existe la mesa 0
		
        $inv= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')->join('eventos as e','e.id','=','m.mesa_evento')->select('invitados.*','m.mesa_numero')->where('e.id','=',$eventoId)->get();
        return View('mesas.mesa')->with('evento_id',$eventoId)->with('cliente_id',$cliente)->with('cantidad_mesas',$cantidadMesas)->with('inv',$inv)->with('cantidadSillas',$cantidadSillas);        
    }


     public function cargarUnaMesa(){
        $eventoId=1;
        $cliente=1;        
        $mesaId=1;        
        
        $eventoMesasSillas=DB::table('mesas')->where('mesa_evento','=',$eventoId)->get();
        $cantidadSillas=$eventoMesasSillas[1]->mesa_capacidad; // resto uno porque existe la mesa 0
        
        $inv= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')->join('eventos as e','e.id','=','m.mesa_evento')->select('invitados.*','m.mesa_numero')->where('e.id','=',$eventoId)->get();
        
        return View('mesas.unaMesa')->with('evento_id',$eventoId)->with('cliente_id',$cliente)->with('mesaId',$mesaId)->with('inv',$inv)->with('cantidadSillas',$cantidadSillas);
    }

	// Para que funcione tiene que existir una mesa con numero 0, es decir un campo mesa_numero=0 para el evento
      public function save(Request $request) {
        try{            
			$evento=$request->evento_id;
            $inv=new Invitado;            
            $inv->inv_nombre=$request->input_nombre;
            $inv->inv_apellido=$request->input_apellido;
            //$inv->inv_sexo=$request->optradio_sexo;
            $inv->inv_sexo="N";
            $inv->inv_tipo=$request->optradio_edad;            
            $aux = DB::table('mesas')->where('mesa_numero','=',0)->where('mesa_evento','=',$evento)->get();						
            $inv->inv_mesa=$aux[0]->id;
            $inv->inv_activo=1;
            $inv->inv_asistencia=0;
            $inv->save();                   			
			//return response()->json(array('sms'=>$aux[0]->id));            debug
            return response()->json(array('sms'=>$inv->id));            
        }
        catch(Excetion $e){        
            return response()->json(array('err'=>'Error'));
        }
    }
	
	// Necesito cantidad de mesas, lista de invitados y el evento
	public function listarResumen(Request $request){
        $eventoId=$request->evento_id;
		$clienteId=$request->cliente_id;
        //$eventoId=1;
        $eventoMesas=DB::table('mesas')->selectRaw("count(mesas.id) as count_row")->where('mesa_evento','=',$eventoId)->get();
        $cantidadMesas=$eventoMesas[0]->count_row-1; // resto uno porque existe la mesa 0
						
        $eventoMesasSillas=DB::table('mesas')->where('mesa_evento','=',$eventoId)->get();
        $cantidadSillas=$eventoMesasSillas[1]->mesa_capacidad; // resto uno porque existe la mesa 0

        $inv= DB::table('invitados')->join('mesas as m','m.id','=','invitados.inv_mesa')->join('eventos as e','e.id','=','m.mesa_evento')->select('invitados.*','m.mesa_numero')->where('e.id','=',$eventoId)->get();
        //return response()->json(array('sms'=>$eventoId));
		return View('mesas.listaResumen')->with('evento_id',$eventoId)->with('cantidad_mesas',$cantidadMesas)->with('inv',$inv)->with('cliente_id',$clienteId)->with('cantidadSillas',$cantidadSillas);    
    }
    

    // El invitado ha sido eliminado de la base
    public function actualizarBaseEliminar(Request $request){
        //ya esta controlado que no sea un libre
        $inv= Invitado::find($request->invId);
        $inv->delete();
        return response()->json(array('msj'=>$inv->id));
    }

       public function prueba(){     
        return View('welcome');
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
	
	
	public function guardarDatos(Request $request){  
		$info=explode(";",$request->datos);				
		$cantidadElementosExplode=count($info);
		$i=0; $texto='';
		while($i<$cantidadElementosExplode){
			$id=$info[$i++];
			$nombre=$info[$i++];
			$mesa=$info[$i++];
			$evento=$info[$i++];
			if(strcmp($nombre,"LIBRE")!==0){ // si es distinto de libre       
				$inv = Invitado::find($id);        
				$mesas = Mesa::where('mesa_evento',$evento)->Where('mesa_numero',$mesa)->first();         
				$inv->inv_mesa = $mesas->id;
				$inv->save();
				
				$texto=$texto.$id.' '.$nombre.' '.$mesa.' '.$evento.' - ';
				//$texto=$request->invNombre1.' '.$request->invId1.' '.$request->mesa1.' '.$request->eventoId;  //parece estar bien
				
				//$me=$mesas->id;$texto=$inv->inv_nombre.' id:'.$inv->id.' mesa:'.$me;      lo que escribo en la base
				//return response()->json(array('msj'=>$texto));   prueba
				//return response()->json(array('msj'=>$request->mesa1));    prueba                
			}				
		}		
		return response()->json(array('msj'=>'Los datos han sido guardados')); 
        //return response()->json(array('msj'=>$texto));     //  
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



    public function test(Request $request){  
        $info=explode(";",$request->datos);             
        $cantidadElementosExplode=count($info);
        $i=0; $texto='';
        while($i<$cantidadElementosExplode){
            $id=$info[$i++];
            $nombre=$info[$i++];
            $mesa=$info[$i++];
            $evento=$info[$i++];
            if(strcmp($nombre,"LIBRE")!==0){        
                $inv = Invitado::find($id);        
                $mesas = Mesa::where('mesa_evento',$evento)->Where('mesa_numero',$mesa)->first();         
                $inv->inv_mesa = $mesas->id;
                //$inv->save();
                
                $texto=$texto.$id.' '.$nombre.' '.$mesa.' '.$evento.' - ';
                //$texto=$request->invNombre1.' '.$request->invId1.' '.$request->mesa1.' '.$request->eventoId;  //parece estar bien
                
                //$me=$mesas->id;$texto=$inv->inv_nombre.' id:'.$inv->id.' mesa:'.$me;      lo que escribo en la base
                //return response()->json(array('msj'=>$texto));   prueba
                //return response()->json(array('msj'=>$request->mesa1));    prueba                
            }               
        }       
        //return response()->json(array('msj'=>'Los datos han sido guardados')); 
        return response()->json(array('msj'=>$request->datos));     //  
    }



}


