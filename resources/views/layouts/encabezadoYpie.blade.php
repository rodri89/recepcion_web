<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="shortcut icon" href="http://www.recepciondigital.com/Recepcion5_4/public/images/logo_web.ico">
    <title>Recepcion</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link  rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css" media="all" />
	
	<script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/bootstrap.js')}}"> </script>
    <script src="{{asset('js/jquery.min.js')}}"> </script>
	<script src="{{asset('js/bootstrap.min.js')}}"> </script>
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
                     <a class="navbar-brand" href="{{ url('/eventos') }}"><img id="brand-image" src="{{asset('images/logo blanco.png')}}" /> </a>
                </div>

                <div class="collapse navbar-collapse dropdown" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
					
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CUENTA  <span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="{{ URL::to('/DatosEmpresa')}}">Mis datos</a></li>
							<li><a href="{{ URL::to('/Contacto')}}">Contacto</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a></li>
													<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                        </form>
						  </ul>
						</li>
                        <li>
						</li>
					</ul>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <footer class="footer-bs hidden-print">
        <div class="row">
        	<div class="col-md-3 footer-brand animated fadeInLeft">
            	<a href=""><img id="logo-image-footer" src="{{asset('images/logo chico.png')}}"/></a>
            </div>
    </footer>
</body>
</html>
