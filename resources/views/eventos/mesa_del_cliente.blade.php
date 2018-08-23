<!DOCTYPE html>

<?php  
//include("matrizMesas.php");  ignacio.merlano@globant.com yPAFei (cliente)   rodrigo.banegas@globant.com bcZWph (sportiva)
$matriz12[0][0]=0;$matriz12[0][1]=1;$matriz12[0][2]=1;$matriz12[0][3]=0; $matriz10[0][0]=0;$matriz10[0][1]=1;$matriz10[0][2]=1;$matriz10[0][3]=0; 
$matriz12[1][0]=1;$matriz12[1][1]=0;$matriz12[1][2]=0;$matriz12[1][3]=1; $matriz10[1][0]=1;$matriz10[1][1]=0;$matriz10[1][2]=0;$matriz10[1][3]=1;
$matriz12[2][0]=1;$matriz12[2][1]=0;$matriz12[2][2]=0;$matriz12[2][3]=1; $matriz10[2][0]=1;$matriz10[2][1]=0;$matriz10[2][2]=0;$matriz10[2][3]=1;
$matriz12[3][0]=1;$matriz12[3][1]=0;$matriz12[3][2]=0;$matriz12[3][3]=1; $matriz10[3][0]=1;$matriz10[3][1]=0;$matriz10[3][2]=0;$matriz10[3][3]=1;
$matriz12[4][0]=1;$matriz12[4][1]=0;$matriz12[4][2]=0;$matriz12[4][3]=1; $matriz10[4][0]=0;$matriz10[4][1]=1;$matriz10[4][2]=1;$matriz10[4][3]=0;
$matriz12[5][0]=0;$matriz12[5][1]=1;$matriz12[5][2]=1;$matriz12[5][3]=0; 

$matriz8[0][0]=0;$matriz8[0][1]=1;$matriz8[0][2]=1;$matriz8[0][3]=0;
$matriz8[1][0]=1;$matriz8[1][1]=0;$matriz8[1][2]=0;$matriz8[1][3]=1;
$matriz8[2][0]=1;$matriz8[2][1]=0;$matriz8[2][2]=0;$matriz8[2][3]=1; 
$matriz8[3][0]=0;$matriz8[3][1]=1;$matriz8[3][2]=1;$matriz8[3][3]=0;

$cantidadSillasMesa12=12; $cantidadSillasMesa10=10; $cantidadSillasMesa8=8; 
$filasMatriz12=6; $filasMatriz10=5; $filasMatriz8=4;
$columnasMatriz12=4; $columnasMatriz10=4; $columnasMatriz8=4;
?>
<html>
<style>

.menu-fixed {
  position:fixed;
  z-index:1000;
  top:0;
  /*max-width:1000px;*/
  /*left:0; */
  width:12.85%; 
  /*box-shadow:0px 4px 3px rgba(0,0,0,.5);*/
}

.columna_invitado{
border: 1px solid #000;
}
.columna_invitado.over {  
  border: 2px solid #FF0000;
}

.columna{
float: left;
margin-top: 8px;
margin-bottom: 8px;
width: 80px;
height: 30px;
}

.columna_vacia{
float: left;
width: 80px;
height: 30px;	
}

.columna.over {  
  border: 2px solid #FF0000;
}

div#panel{
	
}
</style>

	<head>
		<title>Recepcion</title>
		<!-- For-Mobile-Apps -->			
		<link  rel="stylesheet" href="{{asset('css/mesas_even/app.css')}}" type="text/css" media="all" />		
		<link  rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css" media="all" />
		<link  rel="stylesheet" href="{{asset('css/mesas_even/mesas.css')}}" type="text/css" media="all" />

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
                        Recepcion</h3>
                    </a>
                </div>

                <div class="collapse navbar-collapse dropdown" id="app-navbar-collapse">
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
		  		<li><a href="{{ URL::to('/eventos')}}">EVENTOS</a></li>
				<li><a href="{{ URL::to('/eventos/clientes')}}">CLIENTES</a></li>
				<li><a href="{{ URL::to('/eventos/pagos')}}">PAGOS</a></li>
		  	<!--<input type="text" id="hola" value="{{Auth::user()->id}}"> -->
				<li><a href=" {{ route ('listarEventos',[$cliente_id->id])}} ">VOLVER</a></li>
				<li><a class="classbtn btn-primary" href=" {{ route ('imprimir',[$evento_id])}} ">IMPRIMIR</a></li>
			<!--<button type="submit" class="btn btn-default">Volver</button>			-->
			
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>		
			
	<div class="row">		
		<div class="col-md-2">
			<div class="panel panel-default">
                <div class="fondoMarron">Resumen</div>
	                <div class="panel-body fondoAmarillo">
	                	<h5 class="texto" style="text-decoration: underline">Cantidad Invitados</h5>              	
	                	<h5 class="texto" id="cantNinos" name="0">Niños: 0</h5>
	                	<h5 class="texto" id="cantAdultos" name="0">Adultos: 0</h5>
	                	<h5 class="texto" id="cantInvitados" name="0">Total: 0</h5>
	                	<h5 class="texto" id="conUbicacion" name="0">Con Ubicación: 0</h5>
	                	<h5 class="texto" id="sinUbicacion" name="0">Sin Ubicación: 0</h5>
	                </div>		                
            </div>		

            <input type="hidden" name="evento_id" id="evento_id" value="{{$evento_id}}">
            <input type="hidden" name="cantidad_mesas" id="cantidad_mesas" value="{{$cantidad_mesas}}">

            <div class="menu">
            <div class="panel panel-default">
            <div class="fondoMarron" id="cantidadInvitados" name="0">Invitados (0)</div>
            <!--<div class="panel-body fondoAmarillo"> -->
            	<div class="panel-body" style="height:300px; overflow-y: scroll;">
					<div id="panel">
							<br>
							<ul class="nav nav-pills nav-stacked list-group-nuevos" id="listaInvitados">
							@foreach($inv as $i)
								@if($i->mesa_numero==0)
				 
							  		<li id="l{{$i->id}}" class="list-group-item columna_invitado cssLibre"><h6 id="i{{$i->id}}" name="m0" class="fondoSilla">{{$i->inv_nombre}}</h6></li>
							 	@endif
							@endforeach						
							</ul>
					</div>
			</div>
			<!--</div>-->
			</div>
			</div>
		</div>				
				
		<div class="col-md-10"> <!-- contenedor principal -->
			<div class="panel panel-default fondoPiso">
			<div class="panel-body">
				
				<?php
				$eventoId=$evento_id;    // esta informacion me la enviara el controlador al crear la pagina, lo mismo que la cantidad de mesas
				$cantidadMesas=$cantidad_mesas; 
				$cantidadSillasMatriz=$cantidadSillas;
				
				if($cantidadSillas==8){
					$matriz=$matriz8;
					$filasMatriz=$filasMatriz8;
					$columnasMatriz=$columnasMatriz8;
					$op='table8';
				}
				if($cantidadSillas==10){
					$matriz=$matriz10;
					$filasMatriz=$filasMatriz10;
					$columnasMatriz=$columnasMatriz10;
					$op='table10';
				}
				if($cantidadSillas==12){
					$matriz=$matriz12;
					$filasMatriz=$filasMatriz12;
					$columnasMatriz=$columnasMatriz12;
					$op='table12';
				}
				
				$mesaNum=1;
				$totalMesas=0;
				$dos=2; 				
				$impar=false;
				$silla=1000;			
			  	if($cantidadMesas!=1){
                    if($cantidadMesas%2==1){                    
                        $cantidadMesas=round(($cantidadMesas/2));
                        $impar=true;
                    }
                    else{
                        $cantidadMesas=$cantidadMesas/2;
                    }
                }				
				while($totalMesas<$cantidadMesas){					   
					if($totalMesas==$cantidadMesas-1){
						if($impar){
							$dos=1;
						}
					}
					$totalMesas++;					
				    for($mesaEnfila=0;$mesaEnfila<$dos; $mesaEnfila++){    ?>
					  <!--  Este row representa una fila  -->					  
						<div class="col-md-6">  <!-- col-md-6 lo que hace es que el div sea 6 columnas de ancho, bootstrap -->							  						
						  <h5 id="ll{{$mesaNum}}" class="tituloh5">Lugares Libres: 10</h5>
							<div class="panel panel-default transparent removerBorde">
							<div class="panel-body">												  	  
								
								<div class="table-responsive">									
									<table class="table table-bordered <?php echo $op;?>">
									<tbody>
									<?php				
									for($fila=0;$fila<$filasMatriz;$fila++){   ?>
									<tr>																							
									<?php			for($columna=0;$columna<$columnasMatriz;$columna++){			
										
											if($matriz[$fila][$columna]==0){	?>

												<td class="table2"><div class="columna_vacia"><h6 visible="false"></h6></li> </div></td>
									<?php		}								   
											if($matriz[$fila][$columna]==1){
											   ?>
												<td class="table2"><li id="l{{$silla}}" class="list-group-item columna cssLibre"><h6 id="i{{$silla}}" name="m{{$mesaNum}}" class="fondoSilla">LIBRE</h6></li></td>											
									<?php									
											$silla++;
											}
										}  ?>	<!--  fin de la primer fila para armar la mesa -->							  
									</tr>
									<?php		}
									$mesaNum++;
									?> <!--  fin de la primer mesa -->	
									</tbody>
									</table>
								</div>
								
							</div>
							</div>
						</div>
								<?php }   ?>   <!--   fin de las primeras dos mesas    -->			  										
				
								<?php }   ?>   <!--   fin del total de las mesas    -->
								</div>
			</div>	
			</div>
		</div>
	</div>
		
	</div>
</div>





		<!--Footer-->
		<div class="container">
			<div class="center-block">
				<p class="text-center"> &copy; 2017 Bahia Blanca. All Rights Reserved | Lushi Group <a href="http://w3layouts.com">LG</a></p>
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
		
			<script type="text/javascript">
			
			


			// pre requisitos debe haber un id en el texto ingresado y debe tener el formato m00
			// Ingreso el texto <h6 id="85" name="m0"> Rodrigo </h6> m0 representa lista invitados
			// y me devuelve 0		
			function getMesaId(texto){	//				
				var aux="";					
				var i=texto.search("name=");
				while(texto.charAt(i)!='"'){i++;}i++;i++;
				while(texto.charAt(i)!='"'){				
					aux=aux+texto.charAt(i);
					i++;
				}				
				return aux;
			}

			//<h6 id="i4" name="m1" class="fondoSilla">Lionel</h6>								
			function pintarSillas(silla1,silla2){
				//alert(silla1+" "+silla2);
				var m1=getMesaId(silla1);
				if(m1!=0){
					var nombreInvitado=getInvitadoNombre(silla1);
					var auxId="i"+getInvitado(silla1);
					var padre=document.getElementById(auxId).parentNode.parentNode;
					var auxIdPadre=getIdLI(padre.innerHTML);					
					if(nombreInvitado=="LIBRE"){
						document.getElementById(auxIdPadre).className="list-group-item columna cssLibre";											
					}
					else{						
						document.getElementById(auxIdPadre).className="list-group-item columna cssOcupado";					
					}
					//alert(padre.innerHTML);
				}
				else{ // significa que viene de lista de invitados y su padre es un "ul" por tanto no puedo hacer parent parent

				}										
				var m2=getMesaId(silla2);
				if(m2!=0){
					var nombreInvitado=getInvitadoNombre(silla2);
					var auxId="i"+getInvitado(silla2);
					var padre=document.getElementById(auxId).parentNode.parentNode;
					var auxIdPadre=getIdLI(padre.innerHTML);					
					if(nombreInvitado=="LIBRE"){
						document.getElementById(auxIdPadre).className="list-group-item columna cssLibre";											
					}
					else{						
						document.getElementById(auxIdPadre).className="list-group-item columna cssOcupado";					
					}
					//alert(padre.innerHTML);
				}
				else{ // significa que viene de lista de invitados y su padre es un "ul" por tanto no puedo hacer parent parent

				}										
			}

			//<h6 id="i4" name="m1" class="fondoSilla">Lionel</h6>					
			//<h6 id="i1" name="m0">Juan Roman</h6>

			//<h6 id="i4" name="m1" class="fondoSilla">Lionel</h6>
			function intercambioMesa(texto,mesa){															
				var m1=getMesaId(texto);
				var aux = texto.replace("m"+m1, "m"+mesa);	
				/*if(m1!=0){
					var auxId="i"+getInvitado(texto);
					var padre=document.getElementById(auxId).parentNode.parentNode;
					var auxIdPadre=getIdLI(padre.innerHTML);					
					document.getElementById(auxIdPadre).className="list-group-item columna cssOcupado";					
					alert(padre.innerHTML);
				}
				else{ // significa que viene de lista de invitados y su padre es un "ul" por tanto no puedo hacer parent parent

				}							*/
				//alert("intercambioMesa"+texto+"-->"+aux);				
				return aux;
			}

			// pre requisito dentro del h1 debe haber 
			// <h6 id="m1" name="i62">Luchi</h6>
			// me devuelve 001 
			function getInvitado(texto){
				//alert(texto);
				var aux="";				
				var i=texto.search("h6")+8;				
				while(texto.charAt(i)!='"'){aux=aux+texto.charAt(i++);}										
				return aux;				
			}	


				

			// ##############################################################################################################
						
			$.ajaxSetup({
			   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
			});

			// pre requisito dentro del h1 debe haber un id con el formato id="i001"
			// le paso el texto --> <h6 id="m1" name="i63">RODRIGO</h6> 
			// me devuelve RODRIGO
			function getInvitadoNombre(texto){
				var aux="";				
				var i=texto.search("h6");				
				while(texto.charAt(i)!=">"){i++;}
				i++;				
				while(texto.charAt(i)!="<"){
					aux=aux+texto.charAt(i);
					i++;
				}									
				
				return aux;				
			}
			
			//Si el invitado ya tiene un lugar asignado, debo cargarlo en su mesa.			
			  function cargarDatosInvitados(){			  				  			  				     			  		  			  
			    var eventoId=$("#evento_id").val();			    			    
			    $.ajax({
			      url: '/clientes/mesas/obtener_listaInvitados',
			      type: "POST",
			      dataType:'JSON',
			      data: {'eventoId':eventoId},			      	      
			      success: function(data){			      				      	
					var id="";
			      	var mesa="";
			      	var invitado="";
			      	var invitadosLista=data.sms.split(";");   //sms va porque es la variable que devuelve el controlador
			      	//alert(invitadosLista.length);
			      	var i=0;					
			      	while(i<=invitadosLista.length){
						id=invitadosLista[i++];
			      		invitado=invitadosLista[i++];
			      		mesa=invitadosLista[i++];
			      		//alert();
			      		sentarInvitadoMesa(id,invitado,mesa);			      	
			      	}
					actualizarLugaresLibres();
			      	//sentarInvitadoMesa("pepe",1);			      	
			      }
			    });
			}

			// Busca un lugar libre en la mesa pasada por parametro y setea el nombre pasado por parametro
			function sentarInvitadoMesa(id,invitado,mesa){
				var mesa = document.getElementsByName("m"+mesa);
				var texto="";
				var lugarLibre=-1;
				var x=0;
				while((lugarLibre==-1)&&(x<mesa.length)){				
    				if(mesa[x].innerHTML=="LIBRE"){												
						var mesaId=mesa[x].getAttribute("id");
    					lugarLibre=x;    					
    				}
    				else{
    					x=x+1;					
					}
    			}
    			if(lugarLibre!=-1){														
    				//mesa[lugarLibre].innerHTML=invitado;
					var iii=mesa[lugarLibre].getAttribute("id");
					var lll=iii.replace("i","l");
					var auxLi=document.getElementById(lll).parentNode;					
					var auxId=getIdLI(auxLi.innerHTML);					
					document.getElementById(auxId).className="list-group-item columna cssOcupado";
					var sss=document.getElementById(lll); // <h6 id="i1000" name="m1">Juan Roman</h6>
					if(sss!=null){
						var invitadoAux=cambiarSilla(sss.innerHTML,iii,"i"+id,invitado);
						//alert(invitadoAux); 
						sss.innerHTML=invitadoAux;
					}
					//alert("lugarLibre "+aaa);
				}  			
			}

			function cambiarSilla(texto,id,nuevoId,nombre){
				//alert(texto+" "+id+" "+nuevoId);
				texto=texto.replace(id,nuevoId);
				texto=texto.replace("LIBRE",nombre);				
				return texto;
			}
			
						

			// Cuenta la cantidad de invitados que estan en la lista de invitados y que todavia no tienen lugar.
			function actualizarInvitadosSinSilla(){
				var lista = document.getElementById("listaInvitados");																
				var cantidad=0;
				for (i = 0; i < lista.childNodes.length; i++) {					
					var aux=lista.childNodes[i].innerHTML;				
					if(aux!=null){							
						//id=getInvitado(aux);
						nombre=getInvitadoNombre(aux);
						if(nombre!=="LIBRE"){																		
							cantidad=cantidad+1;
						}
					}
				}
				var cantInvitados = document.getElementById("cantidadInvitados");	
				cantInvitados.innerHTML="Invitados ("+cantidad+")";
				cantInvitados.setAttribute("name",cantidad);
				return cantidad;
			}

			// Cuenta los lugares libres que hay en cada mesa y actualiza este valor encima de la mesa.
			// y me devulve la cantidad de personas sentadas.
			function actualizarLugaresLibres(){
				var cantidadMesas=$("#cantidad_mesas").val();	
				mesaNum=1;
				cantSentados=0;
				while(mesaNum<=cantidadMesas){
					var mesa = document.getElementsByName("m"+mesaNum);
					var x=0;
					var cont=0;
					while(x<mesa.length){				
						if(mesa[x].innerHTML=="LIBRE"){
							cont++;
						}    					    				    			
						else{cantSentados++;}
						x=x+1;										
					}				
					auxLinea=document.getElementById("ll"+mesaNum);										
					auxLinea.innerHTML="Lugares Libres "+cont;
					mesaNum++;
				}			
				return cantSentados;
			}
							
			
			// Busca en la base de datos la cantidad de invitados y lo setea en el panel resumen.
			function resumenCantidadInvitados(){
				var eventoId=$("#evento_id").val();						
				$.ajax({
			   		url:'/clientes/mesas/resumenCantidadInvitados',
			      	type: "POST",
			      	dataType:'JSON',
			      	data: {'eventoId':eventoId},			      
			      	success: function(data){			      				      	
			      		//alert(data.adultos+" "+data.ninos+" "+data.total);
			      		var cantInvitados = document.getElementById("cantInvitados");			      		
			      		cantInvitados.innerHTML="Total: "+data.total;
			      		cantInvitados.setAttribute("name",data.total);
			      		var cantNinos = document.getElementById("cantNinos");
			      		cantNinos.innerHTML="Niños: "+data.ninos;
			      		cantNinos.setAttribute("name",data.ninos);
			      		var cantAdultos = document.getElementById("cantAdultos");
			      		cantAdultos.innerHTML="Adultos: "+data.adultos;	
			      		cantAdultos.setAttribute("name",data.adultos);
			      		//alert(data.adultos);
			      }
			  	});	
			}
			

			// reveer...
			function resumenConSinUbicacion(){				
				var cantidadInvitados = document.getElementById("cantidadInvitados"); // invitados sin sentar
				var cantConUbicacion = document.getElementById("conUbicacion"); // cant con ubicacion
				var cantSinUbicacion = document.getElementById("sinUbicacion"); // cant sin ubicacion
				var sinUbicacionNum=parseInt(cantidadInvitados.getAttribute("name"));
				var cantInvitadosNum=parseInt(cantInvitados.getAttribute("name"));

				auxCuenta=actualizarLugaresLibres();

				cantSinUbicacion.setAttribute("name",cantidadInvitados.getAttribute("name"));
				cantSinUbicacion.innerHTML="Sin Ubicación: "+cantidadInvitados.getAttribute("name");
			
				cantConUbicacion.setAttribute("name",auxCuenta);
				cantConUbicacion.innerHTML="Con Ubicacion: "+auxCuenta;
				//alert(cantSinUbicacion.getAttribute("name"));

			}


			function test(){									
//				pintarSillas();		
				resumenConSinUbicacion();
				
			}					
			
			// Me devuelve el id del LI
			//<li id="l1005" draggable="true" class="list-group-item columna cssLibre"><h6 id="i1005" name="m1" class="fondoSilla">LIBRE</h6></li>
			function getIdLI(text){
				var texto="";
				var i=text.search("=")+2;
				while(text.charAt(i)!='"'){
					texto=texto+text.charAt(i++);					
				}	
//				alert(texto);
				return texto;
			}



			//llama la funcion cargarDatosInvitados una vez finalizada la carga de la pagina!
			$(document).ready(function() {
  				cargarDatosInvitados();							
				actualizarInvitadosSinSilla();
				resumenCantidadInvitados();
				resumenConSinUbicacion();				
			});	
			
			
			// Con esta fucnion hacemos que un div baje junto con el scroll
			//Para que funcione necesitamos
			//1).menu-fixed --> el stylo declarado en esta misma pagina.
			//2)  <div class="menu"> --> el div que queremos que baje junto con el scroll debe estar dentro de ese div mencionado.
			//3) La funcion declarado abajo.
			$(document).ready(function(){
				var altura = $('.menu').offset().top;				
				$(window).on('scroll', function(){
					if ( $(window).scrollTop() > altura ){
						$('.menu').addClass('menu-fixed');
						
					} else {
						$('.menu').removeClass('menu-fixed');
					}
				});
			 
			});		
				
				
		</script>	
<!-- //here ends scrolling icon -->
	</body>
