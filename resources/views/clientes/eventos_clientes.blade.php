@extends('layouts.encabezado')

@section('content')		

		<!--content-->
		<div class="container">
			<div class="col-md-12">
				<div class="panel panel-default">
						<div class="panel-heading"><h4><i class="fa fa-star" aria-hidden="true"></i> Estos son tus eventos, {{$clientes->cli_nombre}}!</h4></div>
						<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
                        	<tr>
                            <th><h4>#</h4></th>
                            <th><h4>Evento</h4></th>
                            <th><h4>Fecha</h4></th>
                            <th><h4>Lugar</h4></th>                                                        
                            <th></th>
                        	</tr>
                    		</thead>
                    		<tbody>

                    		<?php $i=0; ?>	
                    		@foreach($eventos as $evento)
                    		<?php $i=$i+1; ?>
                    		{!! Form::open(['url' => '/mesas/mesaCliente', 'method' => 'post']) !!}                    		
                    		<input type="hidden" name="_token" value="{{ Session::token() }}">		
                    		<input type="hidden" name="eventoId" value="{{$evento->eveId}}">
                    		<input type="hidden" name="clienteId" value="{{$clientes->id}}">
	                    		<tr>                    			
	                            	<td><h6>{{$i}}</h6></td>
	                                <td><h6>{{$evento->eve_descripcion}}</h6></td>
	                                <td><h6>{{$evento->eve_fecha}}</h6></td>
	                                <td><h6>{{$evento->eve_lugar}}</h6></td>                                                                                
	                                <td><button type="submit" class="btn btn-success"><span class="fa fa-eye" aria-hidden="true"></span>  Ver</button></td>	
	                            </tr> 	                            
                        	{!! Form::close() !!}
                            @endforeach  

                            </tbody>
                        </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

