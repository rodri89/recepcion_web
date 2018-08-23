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
							<h4><span class="fa fa-envelope" aria-hidden="true"></span> Contactanos</h4><hr>

								@if($errors->has('error_mensaje'))
								<div class="alert alert-danger" role="alert"><span class="text-danger"><strong>Error! </strong>{{ $errors->first('error_mensaje') }}</span></div>					
								@endif
								
								{!! Form::open(['url' => '/DatosEmpresa/contraseña/update', 'method' => 'post']) !!}
								{!! Form::token() !!}
								<div class="form-group">
								{!!	Form::label('text', 'Mensaje', ['class'=>$errors->has('mensaje') ? 'has-error' : '']) !!}
								{{ Form::textarea('mensaje', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('mensaje') }}</span>
								</div>
								{{ Form::submit('Enviar', array('class' => 'btn btn-primary btn-confirmar-evento')) }}
								{!! Form::close() !!}
								
								<br>
								
								<h4><span class="fa fa-info" aria-hidden="true"></span> Informacion</h4><hr>
								
								<h4><span class="fa fa-envelope-square" aria-hidden="true"></span>  ignaciomerlano@hotmail.com</h4>
								<h4><span class="fa fa-envelope-square" aria-hidden="true"></span>  rodri@gmail.com</h4>
								<h4><span class="fa fa-phone-square" aria-hidden="true"></span>  Ignacio Merlano - 2923409938</h4>
								<h4><span class="fa fa-phone-square" aria-hidden="true"></span>  Rodrigo Banegas - 9999999999</h4>

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
