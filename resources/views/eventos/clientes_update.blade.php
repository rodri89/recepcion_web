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
						<div class="panel-heading"><h4>Cliente</h4></div>
						<div class="panel-body">
							
							
							{!! Form::open(['url' => '/clientes/update/update_cliente', 'method' => 'post']) !!}
							{!! Form::token() !!}
							
							{{ Form::input('hidden', 'id', $clientes->id) }} <!--ID DEL CLIENTE-->
							
							<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
							{!!	Form::label('text', 'Nombre', ['class'=>$errors->has('nombre') ? 'has-error' : '']) !!}
							{{ Form::input('text', 'nombre', $clientes->cli_nombre, ['class' => 'form-control', 'required' => 'required']) }}
							<span class="text-danger">{{ $errors->first('nombre') }}</span>
							</div>
							<div class="form-group {{ $errors->has('apellido') ? 'has-error' : '' }}">
							{!!	Form::label('text', 'Apellido') !!}
							{{ Form::input('text', 'apellido', $clientes->cli_apellido, ['class' => 'form-control', 'required' => 'required']) }}
							<span class="text-danger">{{ $errors->first('epellido') }}</span>
							</div>
							<div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
							{!!	Form::label('text', 'DNI') !!}
							{{ Form::input('number', 'cli_dni', $clientes->cli_dni, ['class' => 'form-control', 'required' => 'required']) }}
							<span class="text-danger">{{ $errors->first('cli_dni') }}</span>
							</div>
							<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
							{!!	Form::label('text', 'Telefono') !!}
							{{ Form::input('text', 'telefono', $clientes->cli_telefono, ['class' => 'form-control', 'required' => 'required']) }}
							<span class="text-danger">{{ $errors->first('telefono') }}</span>
							</div>
							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							{!!	Form::label('text', 'Email') !!}
							{{ Form::input('text', 'email', $clientes->email, ['class' => 'form-control', 'required' => 'required']) }}
							<span class="text-danger">{{ $errors->first('email') }}</span>
							</div>
							{{ Form::submit('Confirmar Modificacion', array('class' => 'btn btn-default btn-confirmar-evento')) }}
							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="col-md-8">
						<div class="panel panel-default">
						  <div class="panel-body">
							<h4><strong>- Nombre: </strong> {{$clientes->cli_nombre}}</h4>
							<h4><strong>- Apellido: </strong> {{$clientes->cli_apellido}}</h4>
							<h4><strong>- DNI: </strong> {{$clientes->cli_dni}}</h4>
							<h4><strong>- Telefono: </strong> {{$clientes->cli_telefono}}</h4>
							<h4><strong>- Email: </strong> {{$clientes->email}}</h4>
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
