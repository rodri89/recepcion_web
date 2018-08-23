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
				<div class="col-md-12">
						<div class="panel panel-default">
						  <div class="panel-body">
							<h4><span class="fa fa-edit" aria-hidden="true"></span> Mis Datos</h4><hr>

								{!! Form::open(['url' => '/DatosEmpresa/update', 'method' => 'post']) !!}
								{!! Form::token() !!}
								
								{{ Form::input('hidden', 'id', $datos->id) }} <!--ID DEL EVENTO-->
							
								
								<div class="form-group">
								{!!	Form::label('text', 'Email', ['class'=>$errors->has('email') ? 'has-error' : '']) !!}
								{{ Form::input('text', 'email', $datos->email, ['class' => 'form-control', 'readonly' => 'readonly']) }}
								<span class="text-danger">{{ $errors->first('email') }}</span>
								</div>
								<div class="form-group">
								{!!	Form::label('text', 'Nombre Empresa', ['class'=>$errors->has('emp_nombre') ? 'has-error' : '']) !!}
								{{ Form::input('text', 'emp_nombre', $datos->emp_nombre, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('emp_nombre') }}</span>
								</div>
								<div class="form-group">
								{!!	Form::label('text', 'Localidad', ['class'=>$errors->has('emp_localidad') ? 'has-error' : '']) !!}
								{{ Form::input('text', 'emp_localidad', $datos->emp_localidad, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('emp_localidad') }}</span>
								</div>
								<div class="form-group">
								{!!	Form::label('text', 'Telefono', ['class'=>$errors->has('emp_telefono') ? 'has-error' : '']) !!}
								{{ Form::input('text', 'emp_telefono', $datos->emp_telefono, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('emp_telefono') }}</span>
								</div>
								{{ Form::submit('Confirmar Modificacion', array('class' => 'btn btn-primary btn-confirmar-evento')) }}
								{!! Form::close() !!}
							<br>
							<h4><span class="fa fa-key" aria-hidden="true"></span> Cambiar Contraseña</h4><hr>

								@if($errors->has('error_mensaje'))
								<div class="alert alert-danger" role="alert"><span class="text-danger"><strong>Error! </strong>{{ $errors->first('error_mensaje') }}</span></div>					
								@endif
								
								{!! Form::open(['url' => '/DatosEmpresa/contraseña/update', 'method' => 'post']) !!}
								{!! Form::token() !!}
								<div class="form-group">
								{!!	Form::label('text', 'Actual Contraseña', ['class'=>$errors->has('actual_pass') ? 'has-error' : '']) !!}
								{{ Form::input('password', 'actual_pass', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('actual_pass') }}</span>
								</div>
								<div class="form-group">
								{!!	Form::label('text', 'Nueva Contraseña', ['class'=>$errors->has('nueva_pass') ? 'has-error' : '']) !!}
								{{ Form::input('password', 'nueva_pass', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('nueva_pass') }}</span>
								</div>
								<div class="form-group">
								{!!	Form::label('text', 'Repita nueva Contraseña', ['class'=>$errors->has('nueva_pass_repetida') ? 'has-error' : '']) !!}
								{{ Form::input('password', 'nueva_pass_repetida', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('nueva_pass_repetida') }}</span>
								</div>
								{{ Form::submit('Confirmar Modificacion', array('class' => 'btn btn-primary btn-confirmar-evento')) }}
								{!! Form::close() !!}
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
