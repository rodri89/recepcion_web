<!DOCTYPE html>
<html>
	<head>
		<title>Recepcion</title>
		<!-- For-Mobile-Apps -->			
		<link  rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css" media="all" />
			<link  rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all" />
			<link  rel="stylesheet" href="{{asset('css/swipebox.css')}}" type="text/css" media="all" />
			<link  rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css" media="all" />

			<meta name="_token" content="{!! csrf_token() !!}"/>
			<script src="{{asset('js/jquery.min.js')}}"> </script>
			<script src="{{asset('js/bootstrap.js')}}"> </script>
    		<script src="{{asset('js/ajax-crud-clientes.js')}}"></script>
    		<script src="{{asset('js/ajax-crud-eventos.js')}}"></script>
		<!-- //Custom-Stylesheet-Links -->
			
			<script src="{{asset('js/jquery.min.js')}}"> </script>
			<script src="{{asset('js/bootstrap.js')}}"></script>
		
	</head>
	<body>
		<!-- Header -->
		<div class="header">
			<!-- Top-Bar -->
			<div class="top-bar">
				<div class="container">
					<div class="logo">
						<a href="#"><h2>RECEPCIÓN</h2></a>
					</div>
					<div class="header-right">
						<div class="phone">
							<ul>
								<li><span class="glyphicon glyphicon-earphone phone" aria-hidden="true"></span></li>
								<li>+8044261150</li>
							</ul>
						</div>
						<div class="social-icons-top">
							<ul>
								<li><a class="linkedin" href="#"></a></li>
								<li><a class="google" href="#"></a></li>
								<li><a class="twitter" href="#"></a></li>
								<li><a class="facebook" href="#"></a></li>
								
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- //Top-Bar -->

			<!-- Navbar -->
			<div class="total-navbar">
				<div class="container">
				<nav class="navbar navbar-default">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<div id="navbar" class="navbar-collapse navbar-right collapse hover-effect">

						<ul class="nav navbar-nav">
							<li>
							{!! Form::open(['url' => '/mesas/mesaCliente', 'method' => 'post']) !!}
							{{ Form::input('hidden', 'eventoId', $evento_id, ['id' => '$eventoId']) }}
							{{ Form::input('hidden', 'clienteId', $cliente_id, ['id' => '$clienteId']) }}
							{{ Form::submit('VOLVER', array('class' => 'scroll')) }}
							{!! Form::close() !!}	
							</li>
							<!--<li ><a href="{{ URL::to('/clientes/eventos_clientes')}}" class="scroll">VOLVER</a></li>	-->						
							<li ><a role="button" onclick="test()" class="scroll">TEST</a></li>	
						</ul>
						
					</div>
						</nav>
						</div>
						</div>
			<!-- //Navbar -->
		</div>
		<!-- //Header -->
		
	<div class="container_1">
			<div class="row">
				<div class="col-md-10  col-md-offset-1">
					<br>
					<div class="well well-lg" >
					
					<form class="form-horizontal" id="postRequest" method="POST">		
					<input type="hidden" name="_token" value="{{ Session::token() }}">	
					<input type="hidden" name="evento_id" id="evento_id" value="{{$evento_id}}">						
					<input type="hidden" name="cantidad_mesas" id="cantidad_mesas" value="{{$cantidad_mesas}}">					
					  <input type="hidden" class="form-control" id="input_cero" 
					  name="input_cero" value="0">					
					  <div class="form-group">
						<label for="text" class="col-sm-7 control-label">RESUMEN DE LOS INVITADOS</label>						
					  </div>					
					</form>
					</div>
				</div>										
			</div>
			
			<div class="row">
				<div class="col-md-2 col-md-offset-1"> <!-- columna de la izq al panel principal -->
					
					<div class="well well-lg fondoMesa2" >
					<div class="caption ">
						 
						 <div id="panel">
							<h5>Invitados sin ubicacion</h5>
							<br>
							<ul class="list-group-nuevos" id="listaInvitados">
							@foreach($inv as $i)
								@if($i->mesa_numero==0)
							  		<li><h6>{{$i->inv_nombre}}</h6></li>
							 	@endif
							@endforeach						
							</ul>
						</div>

						
					</div>

					</div>					
				</div> <!-- fin columna izq contenedor principal -->

				
				<div class="col-md-8 fondoMesa2"> <!-- contenedor principal -->
					<div class="well well-lg fondoMesa2 removerBordes" >
					
					<?php
					$eventoId=$evento_id;    // esta informacion me la enviara el controlador al crear la pagina, lo mismo que la cantidad de mesas
					$cantidadMesas=$cantidad_mesas; 
												
					$mesaNum=1;
					$totalMesas=0;				
								
					while($totalMesas<$cantidadMesas){					   					
								?>				
						
						<div class="row ">  <!--  Este row representa una fila  -->					  
							<div class="col-md-6 ">  <!-- col-md-6 lo que hace es que el div sea 6 columnas de ancho, bootstrap -->							  
								<?php $cantLibres=0; ?>
								@foreach($inv as $i)								
								@if($i->mesa_numero==$mesaNum)
							  		<?php $cantLibres++; ?>
							 	@endif
								@endforeach										
								<h5 id="ll{{$mesaNum}}">Lugares Libres: {{$cantidadSillas-$cantLibres}}</h5>
								<div class="well well-lg fondoMesa removerBordes" >																				  	 
								@foreach($inv as $i)
								@if($i->mesa_numero==$mesaNum)
							  		<h6>{{$i->inv_nombre}}</h6>
							 	@endif
								@endforeach		
								</div>
							</div>							
							<?php 
							$totalMesas++;	$mesaNum++;
							if($totalMesas<$cantidadMesas){	
							?>
							<?php $cantLibres=0; ?>
								@foreach($inv as $i)								
								@if($i->mesa_numero==$mesaNum)
							  		<?php $cantLibres++; ?>
							 	@endif
								@endforeach													
							<div class="col-md-6">  <!-- col-md-6 lo que hace es que el div sea 6 columnas de ancho, bootstrap -->							  
								<h5 id="ll{{$mesaNum}}">Lugares Libres: {{$cantidadSillas-$cantLibres}}</h5>
								<div class="well well-lg fondoMesa removerBordes" >												  	  
								@foreach($inv as $i)
								@if($i->mesa_numero==$mesaNum)
							  		<h6>{{$i->inv_nombre}}</h6>
							 	@endif
								@endforeach		
								</div>
							</div>														
							<?php 
							} 
							$totalMesas++;	$mesaNum++;
							?>
						</div>
						<?php }   ?> <!--   fin del total de las mesas    -->
					</div>	
					  
				</div>	
		</div>		
</div>



		<!--Footer-->
			<div class="footer">
				<div class="container">
						<p> &copy; 2017 Bahia Blanca. All Rights Reserved | Lushi Group <a href="http://w3layouts.com">LG</a></p>
				</div>
			</div>
		<!--//Footer-->
	




		<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
		<!-- Smooth-Scrolling-JavaScript -->		
		<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
		<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll, .navbar li a, .footer li a").click(function(event){
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});		

		</script>			
		<!-- //Smooth-Scrolling-JavaScript -->
			
			
		
<!-- //here ends scrolling icon -->
	</body>
