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
				<li class="active"><a href="{{ URL::to('/eventos/clientes')}}">CLIENTES</a></li>
				<li><a href="{{ URL::to('/eventos/pagos')}}">PAGOS</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">Nuevo Cliente</div>
						<div class="panel-body">


							{!! Form::open(['url' => '/clientes/nuevo_cliente', 'method' => 'post']) !!}
								{!! Form::token() !!}
								<input type="hidden" id="contador2" name="contador2" value="">

								<div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
								{!!	Form::label('text', 'DNI') !!}
								{{ Form::input('number', 'dni', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('dni') }}</span>
								</div>

								<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
								{!!	Form::label('text', 'Nombre', ['class'=>$errors->has('nombre') ? 'has-error' : '']) !!}
								{{ Form::input('text', 'nombre', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('nombre') }}</span>
								</div>

								<div class="form-group {{ $errors->has('apellido') ? 'has-error' : '' }}">
								{!!	Form::label('text', 'Apellido') !!}
								{{ Form::input('text', 'apellido', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('epellido') }}</span>
								</div>

								<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
								{!!	Form::label('text', 'Telefono') !!}
								{{ Form::input('text', 'telefono', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('telefono') }}</span>
								</div>

								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
								{!!	Form::label('text', 'Email') !!}
								{{ Form::input('text', 'email', null, ['class' => 'form-control', 'required' => 'required']) }}
								<span class="text-danger">{{ $errors->first('email') }}</span>
								</div>
								{{ Form::submit('Confirmar Cliente', array('class' => 'btn btn-primary btn-confirmar-evento')) }}
							{!! Form::close() !!}
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">CLIENTES</div>
						<div class="panel-body">
                    	<form class="form-inline">
							<div class="form-group">
							<input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Nombre/Apellido">
							</div>
							<button type="button" name="texto" class="btn btn-info btn-md btn-buscar-cli" id="btn_buscars" value="2"><span class="fa fa-search" aria-hidden="true"></span></button>
							<button type="button" name="todo" class="btn btn-info btn-md btn-buscar-cli" id="btn_traertodo" value="2" data-toggle="tooltip" data-placement="left" title="Mostrar Todos"><span class="fa fa-list-alt" aria-hidden="true"></span></button>
						</form>

                    	<hr>
						<div class="table-responsive" style="height:600px; overflow-y: scroll;">
						<table class="table table-condensed table-fixed" id="tabla_clientes" name="tabla_clientes">
							<thead>
                        	<tr>
                            <th></th>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th></th>
							<th></th>
                        	</tr>
                    		</thead>
                    		<tbody id="clientes-list" name="clientes-list">

                    			<?php $i=0; ?>	
                    			@foreach($clientes as $cli) 
                    			<?php $i=$i+1; ?>
                                    <tr id="cli{{$cli->id}}">
                                    	<td><h6><span class="fa fa-user" aria-hidden="true"></span></h6></td>
                                    	<td><h6>{{$cli->cli_dni}}</h6></td>
                                        <td><h6>{{$cli->cli_nombre.' '.$cli->cli_apellido}}</h6></td>
                                        <td><h6>{{$cli->cli_telefono}}</h6></td>
                                        <td><h6>{{$cli->email}}</h6></td>
                                       
                                        <td><a href=" {{ route ('listarEventos',[$cli->id])}} " class="btn btn-primary"><span class="fa fa-star" aria-hidden="true"></span>  Eventos</a></td>
										
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
@endsection