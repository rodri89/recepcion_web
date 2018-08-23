<!DOCTYPE html>
<html>
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
		
			<div class="row">
				<div class="col-md-12">

					<br>
					<div class="well well-lg">
					<h3 class="pull-left">Eventos {{$cliente->cli_apellido}}, {{$cliente->cli_nombre}}</h3>						
						<br>
                    	<hr>
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
                    		<input type="hidden" name="clienteId" value="{{$cliente->id}}">
	                    		<tr>                    			
	                            	<td><h6>{{$i}}</h6></td>
	                                <td><h6>{{$evento->eve_descripcion}}</h6></td>
	                                <td><h6>{{$evento->eve_fecha}}</h6></td>
	                                <td><h6>{{$evento->eve_lugar}}</h6></td>                                                                                
	                                <td><button type="submit" class="btn btn-success btn-xs"><span class="fa fa-eye" aria-hidden="true"></span>  Ver</button></td>	
	                            </tr> 	                            
                        	{!! Form::close() !!}
                            @endforeach  

                            </tbody>
                        </table>
						</div>
				</div>
				 <div class="clearfix"> </div>
				</div>

			</div>
			
		</div>
		<div class="clearfix"> </div>
		</div>

		<!--//content-->


	 
		
		<div class="footer">
				<div class="container">
						<p> &copy; 2017 Bahia Blanca. All Rights Reserved | Lushi Group <a href="http://w3layouts.com">LG</a></p>
				</div>
		</div>
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>

