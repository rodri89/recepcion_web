<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Recepcion</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link  rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css" media="all" />
	

    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{asset('js/jquery.min.js')}}"> </script>
	<script src="{{asset('js/bootstrap.js')}}"> </script>
	<script src="{{asset('js/ajax-crud-admin.js')}}"> </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Recepcion
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            SALIR
                        </a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                        </form>
						</li>
                    </ul>
                </div>
            </div>
        </nav>
		

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
				<li><a href="{{ URL::to('/administrador')}}">INICIO</a></li>
				<li><a href="{{ URL::to('/administrador/empresas')}}">EMPRESAS</a></li>
				<li><a href="{{ URL::to('/administrador/usuarios')}}">USUARIOS</a></li>
				<li class="active"><a href="{{ URL::to('/administrador/pagos')}}">PAGOS</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
		<div class="row">
				<div class="col-md-9">
					<div class="panel panel-default">
					<div class="panel-heading"><h4>NUEVO PAGO</h4></div>
							<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
											<?php
											$dt = new DateTime();	
											?>
											{!! Form::open(['url' => '/administrador/nuevo_pago', 'method' => 'post']) !!}
											{!! Form::token() !!}
											{!!	Form::label('text', 'Insertar NUEVO Pago') !!}
											<div class="form-group">
											<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i>  Desde</div>
											<input type="date" class="form-control" name="fecha_desde" id="fecha_desde" value="{{$dt->format('Y-m-d')}}">
											</div>
											</div>
											<div class="form-group">
											<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i>  Hasta</div>
											<input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" value="{{$dt->format('Y-m-d')}}">
											</div>
											</div>
											<div class="form-group">
											<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></div>
											{{ Form::input('text', 'monto', null, ['class' => 'form-control', 'required' => 'required']) }}
											</div>
											</div>
											{{ Form::submit('Confirmar', array('class' => 'btn btn-success btn-confirmar-evento', 'id' => 'boton_confirmar_pago', 'disabled' => 'disabled')) }}
											
								</div>
							
								<div class="col-md-7">
											{!!	Form::label('text', 'Pago ACTUAL') !!}
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
													<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></div>
													{{ Form::input('text', 'empresa_nombre', null, ['class' => 'form-control is-valid', 'readonly' => 'readonly', 'id'=>'empresa_nombre']) }}
													</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i> ID</div>
													{{ Form::input('text', 'empresa_id', null, ['class' => 'form-control is-valid', 'required' => 'required', 'id'=>'empresa_id', 'readonly' => 'readonly']) }}
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
													<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-paypal" aria-hidden="true"></i> ID</div>
													{{ Form::input('text', 'pago_id', null, ['class' => 'form-control is-valid', 'required' => 'required', 'id'=>'pago_id', 'readonly' => 'readonly']) }}
													</div>
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
													<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
													{{ Form::input('text', 'email', null, ['class' => 'form-control is-valid', 'required' => 'required', 'id'=>'email', 'readonly' => 'readonly']) }}
													</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
													<input type="date" class="form-control" name="fecha_desde_no" id="fecha_desde_no" value="{{$dt->format('Y-m-d')}}" readonly >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
													<input type="date" class="form-control" name="fecha_hasta_no" id="fecha_hasta_no" value="{{$dt->format('Y-m-d')}}" readonly >
													</div>
												</div>
											</div>
											
											{!! Form::close() !!}
								</div>				
							</div>
					</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
							<div class="panel-body">
								{!! Form::open(['url' => '/administrador/expirar_pago', 'method' => 'post']) !!}
								{!! Form::token() !!}
								{!!	Form::label('text', 'Caducar Pagos:') !!}
								{!! Form::input('hidden', 'email_2', null, ['id' => 'email_2']) !!}
								{!! Form::input('hidden', 'pago_id_2', null, ['id' => 'pago_id_2']) !!}
								{!! Form::input('hidden', 'empresa_id_2', null, ['id' => 'empresa_id_2']) !!}
								{!! Form::submit('CADUCAR SELECCIONADO', array('class' => 'btn btn-danger btn-block', 'id' => 'boton_caducar_seleccionado', 'disabled' => 'disabled')) !!}
								{!! Form::close() !!}
								<br>
								{!! Form::open(['url' => '/administrador/expirar_todos_pagos', 'method' => 'post']) !!}
								{!! Form::token() !!}
								{{ Form::submit('CADUCAR TODOS', array('class' => 'btn btn-danger btn-block')) }}
								{!! Form::close() !!}
							</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
							<div class="panel-body">
							<h4><strong>- TOTAL: </strong><span class="badge">{{$TotalEmp->TotalEmp}}</span></h4>
							<h5><strong>- Empresas con Pago Activo: </strong><span class="badge"> {{$TotalEmpActivas->TotalEmpActivas}}</h5>
							<h5><strong>- Empresas con Pago Expirado: </strong><span class="badge"> {{$TotalEmpExpiradas->TotalEmpExpiradas}}</h5>
							</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><h4>EMPRESAS</h4><h6>(se muestra el ultimo pago cargado en el sistema de cada Empresa)</h6></div>
						<div class="panel-body">
							<form class="form-inline">
								<div class="form-group">
								<div class="input-group">
									<input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Descripcion">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button"><span class="fa fa-search" aria-hidden="true"></span></button>
									</span>
								</div>
								</div>
								
								<a href="{{ URL::to('/administrador/pagos')}}" type="button" name="todo" class="btn btn-default btn-md btn-buscar-cli" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left">Mostrar Todos</a>
								<a href="{{ URL::to('/administrador/pagos/Caducados_Activos')}}" type="button" name="todo" class="btn btn-default btn-md btn-buscar-cli" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left" title="Muestra los pagos que Caducaron de fecha pero aun estan activos">Caducados Activos</a>
								<a href="{{ URL::to('/administrador/pagos/Caducados_Expirados')}}" type="button" name="todo" class="btn btn-default btn-md btn-buscar-cli" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left" title="Muestra los pagos que Caducaron en fecha y ya estan Expirados en el sitema">Caducados Expirados</a>
							</form>
							<hr>
							<div class="table-responsive" style="height:600px; overflow-y: scroll;">
								<table class="table table-condensed" id="tabla_clientes" name="tabla_clientes">
									<thead>
									<tr>
									<th>#</th>
									<th class='hidden'>pago_id</th>
									<th>Nombre</th>
									<th>Localidad</th>
									<th>Telefono</th>
									<th>Email</th>
									<th>UsID</th>
									<th>Pago desde</th>
									<th>Pago Hasta</th>
									<th>Estado</th>
									<th>Monto</th>
									<th></th>
									</tr>
									</thead>
									<tbody id="clientes-list" name="clientes-list">

										<?php $i=0;?> 	
										@foreach($empresas as $emp)
										
										<?php
										
										$dt = new DateTime();	
										
										$fecha_hoy = $dt->format('Y-m-d');
										$fecha_limite = $emp->pago_fecha_hasta;
										$estado = $emp->est_descripcion;
										
										if($estado == 'Expirado'){
											echo '<tr class="bg-danger">'; 
										}
										else {
											if($fecha_hoy < $fecha_limite){
												echo '<tr class="bg-success">';
											}
											else
											{
												echo '<tr class="bg-danger">';
											}											
									    }
										
			
										?>
										<?php $i=$i+1; ?>
												<td><h6>{{$i}}</h6></td>
												<td class='hidden'><h6>{{$emp->pago_id}}</h6></td>
												<td><h6>{{$emp->emp_nombre}}</h6></td>
												<td><h6>{{$emp->emp_localidad}}</h6></td>
												<td><h6>{{$emp->emp_telefono}}</h6></td>
												<td><h6>{{$emp->email}}</h6></td>	
												<td><h6>{{$emp->emp_usuario}}</h6></td>
												<td><h6>{{$emp->pago_fecha_desde}}</h6></td>
												<td><h6>{{$emp->pago_fecha_hasta}}</h6></td>
												<td><h6>{{$emp->est_descripcion}}</h6></td>
												<td><h6>$ {{$emp->pago_monto}}</h6></td>
												<td><button type="button" class="btn btn-default btn-xs btn-edit copiar_empresa" value="{{$emp->id}}"
														><span class="fa fa-usd" aria-hidden="true"></span> Pago
													</button>
												</td>
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
    <!-- Scripts -->
</body>
</html>
