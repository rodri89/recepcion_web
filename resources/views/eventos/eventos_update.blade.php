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
			@if($errors->has('error_mensaje'))
							<div class="alert alert-danger" role="alert"><span class="text-danger"><strong>Error! </strong>{{ $errors->first('error_mensaje') }}</span></div>					
			@endif
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading"><h4>Evento</h4></div>
						<div class="panel-body">
							@if(count($errors) > 0)
								<div class="alert alert-danger" role="alert">
									
									@foreach($errors->all() as $error)
										
											<strong>Error! </strong>{{ $error }}<br>
										
									@endforeach
									
								</div>
							@endif

							{!! Form::open(['url' => '/eventos/update/update_evento', 'method' => 'post']) !!}
							{!! Form::token() !!}
							
							{{ Form::input('hidden', 'id', $eventos->eve_id) }} <!--ID DEL EVENTO-->
							
							<div class="form-group">
							{!!	Form::label('text', 'Descripción') !!}
							{{ Form::input('text', 'eve_descripcion', $eventos->eve_descripcion, ['class' => 'form-control', 'required' => 'required']) }}
							</div>
							<div class="form-group">
							{!!	Form::label('date', 'Fecha') !!}
							<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
							<input id="fecha" name="fecha" type="date" class="form-control" value="{{$eventos->eve_fecha}}">
							</div>
							</div>
							<div class="form-group">
							{!!	Form::label('text', 'Lugar') !!}
							{{ Form::input('text', 'lugar', $eventos->eve_lugar, ['class' => 'form-control', 'required' => 'required']) }}
							</div>
							<div class="form-group">
							{!!	Form::label('text', 'DNI Cliente') !!}
							  {{ Form::input('text', 'cli_dni_show', $eventos->cli_dni, ['id' => 'cli_dni_show', 'class' => 'form-control', 'readonly' => 'readonly', 'required' => 'required']) }}
							</div>
							<div class="form-group">
							{!!	Form::label('text', 'Cantidad de Mesas') !!}
							{{ Form::input('text', 'mesas', $eventos->eve_mesas, ['class' => 'form-control', 'readonly' => 'readonly']) }}
							</div>
							<div class="form-group">
							{!!	Form::label('text', 'Lugares por Mesa') !!}
							{{ Form::input('text', 'lugares', $eventos->lugares, ['class' => 'form-control', 'readonly' => 'readonly']) }}
							</div>
							{{ Form::submit('Confirmar Modificacion', array('class' => 'btn btn-primary btn-confirmar-evento')) }}
							{!! Form::close() !!}
						
						</div>
					</div>
				</div>
				<div class="col-md-8">
						<div class="panel panel-default">
						  <div class="panel-body">
							<h5><strong>EVENTO:</strong> {{$eventos->eve_descripcion}}</h5>
							<h6><strong>- Fecha:</strong> {{$eventos->eve_fecha}}</h6>
							<h6><strong>- Lugar:</strong> {{$eventos->eve_lugar}}</h6>
							<h6><strong>- Cliente:</strong> {{$eventos->cli_nombre.' '.$eventos->cli_apellido}}</h6>
							<h6><strong>- Cantidad de Mesas:</strong> {{$eventos->eve_mesas}}</h6>
							<h6><strong>- Cantidad de lugares por Mesas:</strong> {{$eventos->lugares}}</h6>
						  </div>
						</div>
				</div>
				<!--
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">
						<h4>Buscar Cliente</h4>
					
						<form class="form-inline">
								<div class="form-group">
								<div class="input-group">
								<div class="input-group-addon"><span class="fa fa-search" aria-hidden="true"></span></div>
								<input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Nombre/Apellido">
								</div>
								</div>
								<button type="button" name="texto" class="btn btn-default btn-md btn-buscar-cli-update" id="btn_buscar" value="1">Buscar</button>
						</form>
						<hr>
						<div class="table-responsive">
						<table class="table" id="tabla_clientes" name="tabla_clientes">
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
                            </tbody>
                        </table>
						</div>						
						</div>
					</div>
				</div>-->
		</div>
    <!-- Scripts -->

		<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
@endsection
