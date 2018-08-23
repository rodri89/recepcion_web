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
    <script src="{{asset('js/ajax-crud-clientes.js')}}"></script>
	<script src="{{asset('js/ajax-crud-eventos.js')}}"></script>
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
		
		
		<!--content-->
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
						<div class="panel-heading"><h4>Estos son los eventos de {{$clientes->cli_nombre}} {{$clientes->cli_apellido}}</h4></div>
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
                    		
	                    		<tr>                    			
	                            	<td><h6>{{$i}}</h6></td>
	                                <td><h6>{{$evento->eve_descripcion}}</h6></td>
	                                <td><h6>{{$evento->eve_fecha}}</h6></td>
	                                <td><h6>{{$evento->eve_lugar}}</h6></td>                                                                                
	                                <td><a href="{{ route ('mesa_del_cliente',[$evento->eveId])}}" class="btn btn-info"><span class="fa fa-eye" aria-hidden="true"></span>Ver</a></td>	
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


