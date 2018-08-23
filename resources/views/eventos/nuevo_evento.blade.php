@extends('layouts.encabezadoYpie')

@section('content')

		

		<div class="container">
		
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav">
				<li><a href="{{ URL::to('/eventos')}}">EVENTOS</a></li>
				<li><a href="{{ URL::to('/eventos/clientes')}}">CLIENTES</a></li>
				<li><a href="{{ URL::to('/eventos/pagos')}}">PAGOS</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
			<div class="row">
				<div class="col-md-5">

					<div class="panel panel-default">
						<div class="panel-heading"><h4>Crear evento</h4></div>
						<div class="panel-body">

						<?php
						$dt = new DateTime();	
						?>
                    	
						@if($errors->has('error_mensaje'))
							<div class="alert alert-danger" role="alert"><span class="text-danger"><strong>Error! </strong>{{ $errors->first('error_mensaje') }}</span></div>					
						@endif
						
						{!! Form::open(['url' => '/eventos/nuevo/nuevo_evento', 'method' => 'post']) !!}
						{!! Form::token() !!}
						
						<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
						{!!	Form::label('text', 'Descripción') !!}
						{{ Form::input('text', 'descripcion', null, ['class' => 'form-control', 'required' => 'required']) }}
						<span class="text-danger">{{ $errors->first('descripcion') }}</span>
						</div>
						
						<div class="form-group {{ $errors->has('fecha') ? 'has-error' : '' }}">
						{!!	Form::label('date', 'Fecha') !!}
						<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
						<input id="fecha" name="fecha" type="date" class="form-control" value="{{$dt->format('Y-m-d')}}">
						</div>
						<span class="text-danger">{{ $errors->first('fecha') }}</span>
						</div>
						
						<div class="form-group {{ $errors->has('lugar') ? 'has-error' : '' }}">
						{!!	Form::label('text', 'Lugar') !!}
						{{ Form::input('text', 'lugar', null, ['class' => 'form-control', 'required' => 'required']) }}
						<span class="text-danger">{{ $errors->first('lugar') }}</span>
						</div>
						
						<div class="form-group {{ $errors->has('cli_dni_show') ? 'has-error' : '' }}">
						{!!	Form::label('text', 'DNI Cliente') !!}
						<div class="input-group">
						  {{ Form::input('text', 'cli_dni', null, ['id' => 'cli_dni', 'class' => 'form-control', 'readonly' => 'readonly', 'required' => 'required']) }}
						  <span class="input-group-btn">
							<button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="Debe seleccionar el DNI desde el listado de clientes a la derecha."><i class="fa fa-question-circle" aria-hidden="true"></i></button>
						  </span>
						</div>
						<span class="text-danger">{{ $errors->first('cli_dni_show') }}</span>
						</div>
						
						<div class="form-group {{ $errors->has('mesas') ? 'has-error' : '' }}">
						{!!	Form::label('text', 'Cantidad de Mesas') !!}
						{{ Form::input('text', 'mesas', null, ['class' => 'form-control', 'required' => 'required']) }}
						<span class="text-danger">{{ $errors->first('mesas') }}</span>
						</div>
						
						<div class="form-group {{ $errors->has('lugares') ? 'has-error' : '' }}">
						{!!	Form::label('text', 'Lugares por Mesa') !!}
						{{ Form::select('lugares', ['8' => '8', '10' => '10', '12' => '12'], null,['class' => 'form-control', 'required' => 'required']) }}
						<span class="text-danger">{{ $errors->first('lugares') }}</span>
						</div>
						
						{{ Form::submit('Confirmar Evento', array('class' => 'btn btn-primary btn-confirmar-evento')) }}
						{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="panel panel-default">
						<div class="panel-heading"><h4>Mis clientes</h4></div>
						<div class="panel-body">
							<form class="form-inline">
								<div class="form-group">
								<input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Nombre/Apellido">
								</div>
								
								<button type="button" name="texto" class="btn btn-info btn-md btn-buscar-cli" id="btn_buscar" value="1"><span class="fa fa-search" aria-hidden="true"></span></button>
								<button type="button" name="todo" class="btn btn-info btn-md btn-buscar-cli" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left" title="Mostrar Todos"><span class="fa fa-list-alt" aria-hidden="true"></span></button>
								<a class="btn btn-info btn-md pull-right btn-insert" href="{{ URL::to('/eventos/clientes')}}"><span class="fa fa-plus" aria-hidden="true"></span>  Nuevo</a>
							</form>
							<hr>
							<div id="btn-copiar_dni-cont">
							<div class="table-responsive" style="height:600px; overflow-y: scroll;">
							<table class="table table-condensed table-fixed" id="tabla_clientes" name="tabla_clientes">
								<thead>
								<tr>
								<th>#</th>
								<th>DNI</th>
								<th>Nombre</th>
								<th>Telefono</th>
								<th>Email</th>
								<th></th>
								</tr>
								</thead>
								
								<tbody id="clientes-list" name="clientes-list">

									<?php $i=0; ?>	
									@foreach($clientes as $cli) 
									<?php $i=$i+1; ?>
										<tr id="cli{{$cli->id}}">
											<td><h6><span class='fa fa-user' aria-hidden='true'></span></h6></td>
											<td><h6><button type="button" class="btn btn-primary btn-xs copiar_dni" id="datos_cli" value="{{$cli->cli_dni}}">{{$cli->cli_dni}}</button></h6></td>
											<td><h6>{{$cli->cli_nombre.' '.$cli->cli_apellido}}</h6></td>
											<td><h6>{{$cli->cli_telefono}}</h6></td>
											<td><h6>{{$cli->email}}</h6></td>
											<td><a href=" {{ route ('update_cliente',[$cli->id])}} " class="btn btn-info btn-edit"><span class="fa fa-pencil-square-o" aria-hidden="true"></span>  Editar</a></td>
												
										</tr>
									@endforeach  
								</tbody>
							</table>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <!-- Scripts -->

	<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
	
@endsection
