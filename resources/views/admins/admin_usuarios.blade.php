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
				<li class="active"><a href="{{ URL::to('/administrador/empresas')}}">USUARIOS</a></li>
				<li><a href="{{ URL::to('/administrador/pagos')}}">PAGOS</a></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
		<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><h4>USUARIOS</h4></div>
						<div class="panel-body">
							<form class="form-inline">
								<div class="form-group">
								<input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Nombre/Apellido">
								</div>
								
								<button type="button" name="texto" class="btn btn-default btn-md btn-buscar-cli" id="btn_buscar" value="1"><span class="fa fa-search" aria-hidden="true"></span></button>
								<button type="button" name="todo" class="btn btn-default btn-md btn-buscar-cli" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left" title="Mostrar Todos"><span class="fa fa-list-alt" aria-hidden="true"></span></button>
							</form>
							<hr>
							<div class="table-responsive">
							<table class="table table-condensed" id="tabla_clientes" name="tabla_clientes">
								<thead>
								<tr>
								<th>#</th>
								<th>Us ID</th>
								<th>Email</th>
								<th>Tipo</th>
								</tr>
								</thead>
								<tbody id="clientes-list" name="clientes-list">

									<?php $i=0; ?>	
									@foreach($usuarios as $us) 
									<?php $i=$i+1; ?>
										<tr>
											<td><h6>{{$i}}</h6></td>
											<td><h6>{{$us->user_id}}</h6></td>
											<td><h6>{{$us->email}}</h6></td>
											<td><h6>{{$us->tu_descripcion}}</h6></td>
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
