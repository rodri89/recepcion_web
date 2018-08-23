<!DOCTYPE html>

<?php  
//include("matrizMesas.php");
$matriz12[0][0]=0;$matriz12[0][1]=1;$matriz12[0][2]=0;$matriz12[0][3]=1; $matriz12[0][4]=0; $matriz12[0][5]=0; 
$matriz12[1][0]=0;$matriz12[1][1]=0;$matriz12[1][2]=0;$matriz12[1][3]=0; $matriz12[1][4]=1; $matriz12[1][5]=0; 
$matriz12[2][0]=0;$matriz12[2][1]=0;$matriz12[2][2]=0;$matriz12[2][3]=0; $matriz12[2][4]=0; $matriz12[2][5]=0; 
$matriz12[3][0]=1;$matriz12[3][1]=0;$matriz12[3][2]=0;$matriz12[3][3]=0; $matriz12[3][4]=0; $matriz12[3][5]=0; 
$matriz12[4][0]=0;$matriz12[4][1]=0;$matriz12[4][2]=0;$matriz12[4][3]=0; $matriz12[4][4]=0; $matriz12[4][5]=0; 
$matriz12[5][0]=0;$matriz12[5][1]=0;$matriz12[5][2]=0;$matriz12[5][3]=0; $matriz12[5][4]=0; $matriz12[5][5]=1; 
$matriz12[6][0]=0;$matriz12[6][1]=0;$matriz12[6][2]=0;$matriz12[6][3]=0;$matriz12[6][4]=0; $matriz12[6][5]=0; 
$matriz12[7][0]=0;$matriz12[7][1]=0;$matriz12[7][2]=0;$matriz12[7][3]=0;$matriz12[7][4]=0; $matriz12[7][5]=0; 
$matriz12[8][0]=1;$matriz12[8][1]=0;$matriz12[8][2]=0;$matriz12[8][3]=0;$matriz12[8][4]=0; $matriz12[8][5]=0; 
$matriz12[9][0]=0;$matriz12[9][1]=0;$matriz12[9][2]=0;$matriz12[9][3]=0;$matriz12[9][4]=0; $matriz12[9][5]=1; 
$matriz12[10][0]=0;$matriz12[10][1]=0;$matriz12[10][2]=0;$matriz12[10][3]=0;$matriz12[10][4]=0; $matriz12[10][5]=0; 
$matriz12[11][0]=0;$matriz12[11][1]=0;$matriz12[11][2]=0;$matriz12[11][3]=0;$matriz12[11][4]=0; $matriz12[11][5]=0; 
$matriz12[12][0]=0;$matriz12[12][1]=1;$matriz12[12][2]=0;$matriz12[12][3]=0;$matriz12[12][4]=1; $matriz12[12][5]=0; 
$matriz12[13][0]=0;$matriz12[13][1]=0;$matriz12[13][2]=0;$matriz12[13][3]=1;$matriz12[13][4]=0; $matriz12[13][5]=0; 



$matriz10[0][0]=1;$matriz10[0][1]=1;$matriz10[0][2]=1;$matriz10[0][3]=1; 
$matriz10[1][0]=1;$matriz10[1][1]=1;$matriz10[1][2]=1;$matriz10[1][3]=1;
$matriz10[2][0]=1;$matriz10[2][1]=1;$matriz10[2][2]=1;$matriz10[2][3]=1;
$matriz10[3][0]=1;$matriz10[3][1]=1;$matriz10[3][2]=1;$matriz10[3][3]=1;
$matriz10[4][0]=1;$matriz10[4][1]=1;$matriz10[4][2]=1;$matriz10[4][3]=1;

$matriz8[0][0]=0;$matriz8[0][1]=1;$matriz8[0][2]=1;$matriz8[0][3]=0;
$matriz8[1][0]=1;$matriz8[1][1]=0;$matriz8[1][2]=0;$matriz8[1][3]=1;
$matriz8[2][0]=1;$matriz8[2][1]=0;$matriz8[2][2]=0;$matriz8[2][3]=1; 
$matriz8[3][0]=0;$matriz8[3][1]=1;$matriz8[3][2]=1;$matriz8[3][3]=0;

$cantidadSillasMesa12=12; $cantidadSillasMesa10=10; $cantidadSillasMesa8=8; 
$filasMatriz12=14; $filasMatriz10=5; $filasMatriz8=4;
$columnasMatriz12=6; $columnasMatriz10=4; $columnasMatriz8=4;
?>
<html>
<style>
.columna_invitado{
border: 1px solid #000;
cursor:move;
}
.columna_invitado.over {  
  border: 2px solid #FF0000;
}

.columna{
float: left;
width: 120px;
height: 35px;
cursor:move;
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
		<link  rel="stylesheet" href="{{asset('css/mesas/bootstrap.css')}}" type="text/css" media="all" />
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
							<li><a href="{{ URL::to('/clientes/eventos_clientes')}}" class="scroll">SALIR</a></li>
							<li><a role="button" onclick="guardarDatosInvitados()" class="scroll">GUARDAR</a></li>								
							<li>
							{!! Form::open(['url' => '/mesas/listar_resumen', 'method' => 'post']) !!}
							{{ Form::input('hidden', 'evento_id', $evento_id, ['id' => '$evento_id']) }}
							{{ Form::input('hidden', 'cliente_id', $cliente_id, ['id' => '$cliente_id']) }}							
							{{ Form::submit('Listar Resumen', array('class' => 'scroll')) }}
							{!! Form::close() !!}														
							</li>
							<!--<form action={{ URL::to('/mesas/listar_resumen')}} method="POST">
								<input type="hidden" name="evento_id" id="evento_id" value="{{$evento_id}}">
								<li><a role="button"  class="scroll">LISTA RESUMEN</a></li>
							</form>															-->
							<li><a role="button" onclick="test()" class="scroll">TEST</a></li>	
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
					<input type="hidden" name="cantidadSillasMesa" id="cantidadSillasMesa" value="{{$cantidadSillas}}">
					
					<input type="hidden" name="cantidad_sillas_matriz" id="cantidad_sillas_matriz" value="{{$cantidadSillas}}">
					  <input type="hidden" class="form-control" id="input_cero" 
					  name="input_cero" value="0">					
					  <div class="form-group">
						<label for="text" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="input_nombre" id="input_nombre" placeholder="Nombre">
						</div>
					  </div>
					  <div class="form-group">
						<label for="text" class="col-sm-2 control-label">Apellido</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="input_apellido" id="input_apellido" placeholder="Apellido">
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">							
							<label class="radio-inline"><input type="radio" name="optradio_sexo" id="optradio_sexo" value="M">M</label>
							<label class="radio-inline"><input type="radio" name="optradio_sexo" id="optradio_sexo" value="F" >F</label>							
						</div>
						<div class="col-sm-offset-2 col-sm-10">							
						<label class="radio-inline"><input type="radio" name="optradio_edad" id="optradio_edad" value="1">Niño</label>
							<label class="radio-inline"><input type="radio" name="optradio_edad" id="optradio_edad" value="2">Joven</label>
							<label class="radio-inline"><input type="radio" name="optradio_edad" id="optradio_edad" value="3">Mayor</label>								
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-default" id="agregar">Invitar</button>
						</div>
					  </div>
					</form>
					</div>
				</div>
				
				
				
			</div>
			
			<div class="row">
				<div class="col-md-2 col-md-offset-1"> <!-- columna de la izq al panel principal -->
					
					<div class="well well-lg" >
					<div class="caption">
						 
						 <div id="panel">
							<h5>Lista Invitados</h5>
							<br>
							<ul class="list-group-nuevos" id="listaInvitados">
							@foreach($inv as $i)
								@if($i->mesa_numero==0)
							  		<li id="l{{$i->id}}" class="list-group-item columna_invitado" draggable="true"><h6 id="i{{$i->id}}" name="m0">{{$i->inv_nombre}}</h6></li>
							 	@endif
							@endforeach						
							</ul>
						</div>

						
					</div>

					</div>
					<div class="well well-lg" >
							<div class="caption">								
								<div id="panel">
									<li id="tarrito" class="list-group-item columna_invitado" draggable="true"><h6 id="tarrito" name="mtarrito">Trash</h6></li>
								</div>

							</div>
						</div>
				</div> <!-- fin columna izq contenedor principal -->

				
				<div class="col-md-8"> <!-- contenedor principal -->
				<div class="well well-lg" >
				
				<?php
				$eventoId=$evento_id;    // esta informacion me la enviara el controlador al crear la pagina, lo mismo que la cantidad de mesas
				
				$cantidadSillasMatriz=$cantidadSillas;
				
				if($cantidadSillas==8){
					$matriz=$matriz8;
					$filasMatriz=$filasMatriz8;
					$columnasMatriz=$columnasMatriz8;
				}
				if($cantidadSillas==10){
					$matriz=$matriz12;
					$filasMatriz=$filasMatriz12;
					$columnasMatriz=$columnasMatriz12;
				}
				if($cantidadSillas==12){
					$matriz=$matriz12;
					$filasMatriz=$filasMatriz12;
					$columnasMatriz=$columnasMatriz12;
				}
				
				$mesaNum=1;											
				$silla=1000;						  									  								
				?>
					<div class="row">  <!--  Este row representa una fila  -->					  
					  <div class="col-md-12">  <!-- col-md-6 lo que hace es que el div sea 6 columnas de ancho, bootstrap -->							  
					  <h5 id="ll{{$mesaNum}}">Lugares Libres: 10</h5>
					  <div class="well well-lg" >												  	  
							<div id="panel">
							<div class="table-responsive">
							<table class="table table2 tablaMesas">
							
							<tbody>							

					<?php			
							
							
							for($fila=0;$fila<$filasMatriz;$fila++){   ?>
							<tr>																							
				<?php			for($columna=0;$columna<$columnasMatriz;$columna++){			
								
									if($matriz[$fila][$columna]==0){	?>

										<td><div class="columna_vacia"><h6 visible="false"></h6></li> </div></td>
							<?php		}								   
								    if($matriz[$fila][$columna]==1){
								       ?>
										<td><li id="l{{$silla}}" draggable="true" class="list-group-item columna fondoSilla"><h6 id="i{{$silla}}" name="m{{$mesaNum}}" class="fondoSilla">LIBRE</h6></li></td>											
							<?php									
									$silla++;
									}
								}  ?>	<!--  fin de la primer fila para armar la mesa -->							  
								    </tr>
				<?php		}
							
							
				  ?> <!--  fin de la primer mesa -->	
								
								
								
								</tbody>
							</table>
						</div>
						</div>
					</div>
				</div>
				
			  						
				</div>
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
		
			<script type="text/javascript">
			
			var dragSrcEl = null;
			var cols = document.querySelectorAll('#panel .columna');
			var cols_invitado = document.querySelectorAll('#panel .columna_invitado');

			//guardamos el contenido que queremos cambiar para la transferencia al dejar de arrastrar
			function handleDragStart(e) {
			  dragSrcEl = this;
			  e.dataTransfer.effectAllowed = 'move';
			  e.dataTransfer.setData('text/html', this.innerHTML);
			}

			function handleDragOver(e) {
			  if (e.preventDefault) {
				e.preventDefault();
			  }

			  e.dataTransfer.dropEffect = 'move';  //efecto al mover

			  return false;
			}

			function handleDragEnter(e) {
			  this.classList.add('over');//agregamos borde rojo en el estilo css
			}

			function handleDragLeave(e) {
			  this.classList.remove('over'); //eliminamos borde rojo en el estilo css
			}

			function handleDrop(e) {
			  if (e.stopPropagation) {
				e.stopPropagation(); //evitamos abrir contenido en otra pagina al soltar
			  }
				//hacemos el intercambio de contenido html de el elemento origne y destino 
				if (dragSrcEl != this) {					
					var mesaIDOrigen=getMesaId(e.dataTransfer.getData('text/html')); //obtnego el numero de la mesa origen					
					var mesaIDDestino=getMesaId(this.innerHTML); // obtengo el numero de mesa del destino
					//alert("Origen:"+mesaIDOrigen+" Destino:"+ mesaIDDestino);
					if(mesaIDDestino.localeCompare("tarrito")!=0){
						var intercambioDestinoPorOrigen=intercambioMesa(this.innerHTML,mesaIDOrigen); // hago el intercambio logico de mesas
						dragSrcEl.innerHTML = intercambioDestinoPorOrigen;          // this.innerHTML es el destino									
						var intercambioOrigenPorDestino=intercambioMesa(e.dataTransfer.getData('text/html'),mesaIDDestino);						
						this.innerHTML = intercambioOrigenPorDestino;														
						//alert(intercambioOrigenPorDestino+" "+intercambioDestinoPorOrigen);		
						//alert(e.dataTransfer.getData('text/html'));
						this.classList.remove('over');						
						eliminarLibres(e);	
					}
					else
					{	
					    // Eliminar (tarrito)					
						// Hay que ver si...
						// si viene de la lista de invitados simplemente elimino (si el id=0 viene de la lista sino viene con el numero de la mesa)
						var nom=getInvitadoNombre(e.dataTransfer.getData('text/html'));
						var idInvitado=getInvitado(e.dataTransfer.getData('text/html'));
						if(mesaIDOrigen=='0'){							
							if(nom!=="LIBRE"){
								eliminarListaInvitados(nom);
								actualizarBaseEliminar(idInvitado);
							}

						}							
						// si viene de una mesa...debo eliminar y poner un libre en ese lugar vacio
						if(mesaIDOrigen!=='0'){							
							//alert(e.dataTransfer.getData('text/html'));
							dragSrcEl.innerHTML=cambiarPorLibre(e.dataTransfer.getData('text/html'));
							actualizarBaseEliminar(idInvitado);
						}							
					}					
					controlarExisteLibre();		
					// cuenta la cantidad de libres que hay en cada mesa y actualiza ese valor encima de la mesa.
					actualizarLugaresLibres();
				}

			  return false;
			}
			

			
			function handleDragEnd(e) {
			  [].forEach.call(cols, function (col) {
				col.classList.remove('over');//eliminamos el borde rojo de todas las columnas
			  });
			}

			function handleDragEndInv(e) {
			  [].forEach.call(cols, function (col) {
				col.classList.remove('over');//eliminamos el borde rojo de todas las columnas
			  });
			}

			//agregamos todos los eventos anteriores a cada columna mediante un ciclo
			[].forEach.call(cols, function(col) {			
			  col.addEventListener('dragstart', handleDragStart, false);
			  col.addEventListener('dragenter', handleDragEnter, false);
			  col.addEventListener('dragover', handleDragOver, false);
			  col.addEventListener('dragleave', handleDragLeave, false);
			  col.addEventListener('drop', handleDrop, false);
			  col.addEventListener('dragend', handleDragEnd, false);
			});

			[].forEach.call(cols_invitado, function(col) {
			  col.addEventListener('dragstart', handleDragStart, false);
			  col.addEventListener('dragenter', handleDragEnter, false);
			  col.addEventListener('dragover', handleDragOver, false);
			  col.addEventListener('dragleave', handleDragLeave, false);
			  col.addEventListener('drop', handleDrop, false);
			  col.addEventListener('dragend', handleDragEndInv, false);
			});

			//esta funcion la necesito para agregarle el efecto cuando agrego un 
			// nuevo hijo en la lista de invitados, para que tenga el efecto de moverse
			 function cargarEfectos(col){
			  col.addEventListener('dragstart', handleDragStart, false);
			  col.addEventListener('dragenter', handleDragEnter, false);
			  col.addEventListener('dragover', handleDragOver, false);
			  col.addEventListener('dragleave', handleDragLeave, false);
			  col.addEventListener('drop', handleDrop, false);
			  col.addEventListener('dragend', handleDragEndInv, false);
			 }

			 // Cambia el nombre/valor de la etiqueta h6 por la palabra LIBRE
			 function cambiarPorLibre(texto){			 	
			 	var nombreActual=getInvitadoNombre(texto);
			 	var aux=texto.replace(nombreActual,"LIBRE");
			 	return aux;
			 }


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
			
			// <h6 id="i15" name="m1">Flor</h6>
			function intercambioMesa(texto,mesa){				
				var m1=getMesaId(texto);				
				var aux = texto.replace("m"+m1, "m"+mesa);				
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


			// Elimina de la base de datos un invitado
			function actualizarBaseEliminar(idInvitado){				
				$.ajax({
			      url: '/mesas/mesas_base_eliminar',   // mesas_base_eliminar esta definido en routes.php
			      type: "POST",
			      dataType:'JSON',
			      data: {'invId':idInvitado},			      
			      success: function(data){			      	
			      	// el invitado ah sido eliminado de la base
			      	//alert("actualizarBaseEliminar ->"+data.msj);
			      }
			  	});

			}		

			// ##############################################################################################################
			// a partir de aca la parte de agregar un invitado.
			
			function vaciarCampos(){
				document.getElementById("input_nombre").value='';
				document.getElementById("input_apellido").value='';				
			}

			
			$.ajaxSetup({
			   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
			});

			// agregar un nuevo invitado a la fiesta ;)
			$(document).ready(function(){
			  $('#agregar').click(function(e){ 
			  	e.preventDefault();
			  	var nombre=$("#input_nombre").val();
			  	//alert("nombre "+nombre);
			    var data=$("#postRequest").serialize();   // #postRequest es un form, se envia todo lo que esta en el.
			    console.log(data);			    
			    $.ajax({
			      url: '/mesas/mesasGuardar',
			      type: "POST",
			      dataType:'JSON',
			      data: data,			      
			      success: function(data){			      	
			      	vaciarCampos();
			      	var lista=document.getElementById("listaInvitados");
			      	var li = document.createElement("li");				

				    li.id=data.sms;
				    li.className="list-group-item columna_invitado";
				    li.draggable="true";
				    var h6 = document.createElement("h6");				  
				    cargarEfectos(li);
				    h6.innerHTML=nombre;
				    h6.id="i"+data.sms;
				    
				    h6.setAttribute("name","m0");
				    li.appendChild(h6);
				    lista.appendChild(li);
			        

			      	//alert(data.sms); este id lo devuelvo del controlador
					//col.innerHTML="<h6 id='m00' name='i'"+data.sms+">"+nombre+"</h6>";			      				      				    			  		
			      }
			    });
			  }); 
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
			

			function eliminarLibres(event){				
				event.preventDefault();
				var lista = document.getElementById("listaInvitados");												
				var cantLibres=0;
				var borrarLibre=null;				
				for (i = 0; i < lista.childNodes.length; i++) {					
					var aux=lista.childNodes[i].innerHTML;				
					if(aux!=null){						
						if((getInvitadoNombre(aux)=="LIBRE")){							
							cantLibres++;
							borrarLibre=lista.childNodes[i];		
						//	alert(borrarLibre.innerHTML);
						}														
					}
				}
				if(cantLibres>1){										
					var idli=borrarLibre.getAttribute("id");	
					//alert("Eliminar -> "+borrarLibre.parentNode.innerHTML); // <h6 id="i003" name="m0">LIBRE</h6>
					
					var elemento = document.getElementById(idli);													
					var id=elemento.getAttribute("id");					
					//alert(id);
					node=document.getElementById(id);
					node.parentNode.removeChild(node);
				}
			}
			
			function buscarLibre(){
				var lista = document.getElementById("listaInvitados");
				//alert("buscarLibre -> "+texto);
				var buscarLibre=0;				
				for (i = 0; i < lista.childNodes.length; i++) {										
					var aux=lista.childNodes[i].innerHTML;				
					if(aux!=null){									
						if((getInvitadoNombre(aux)=="LIBRE")){																					
							buscarLibre=lista.childNodes[i];		
						}														
					}
				}				
				//alert(buscarLibre.innerHTML);
				return buscarLibre;
			}


			// se fija si en la lista de invitados hay al menos un LIBRE en caso de que no agrega uno.
			function controlarExisteLibre(){						
				if(buscarLibre()==0){
					var lista=document.getElementById('listaInvitados');
			      	var li = document.createElement("li");				

				    li.id=856; //data.sms; // necesito esta info de la base
				    li.className="list-group-item columna_invitado";
				    li.draggable="true";
				    var h6 = document.createElement("h6");				  
				    cargarEfectos(li);
				    h6.innerHTML="LIBRE";
				    h6.id="i"+856; //data.sms;
				    
				    h6.setAttribute("name","m0");
				    li.appendChild(h6);
				    lista.appendChild(li);
				}						
			}



			function eliminarListaInvitados(nombre){
				event.preventDefault();
				var lista = document.getElementById("listaInvitados");												
				var cantLibres=0;
				var borrarLibre=null;				
				for (i = 0; i < lista.childNodes.length; i++) {					
					var aux=lista.childNodes[i].innerHTML;				
					if(aux!=null){						
						if((getInvitadoNombre(aux)==nombre)){							
							cantLibres++;
							borrarLibre=lista.childNodes[i];		
						//	alert(borrarLibre.innerHTML);
						}														
					}
				}
				if(cantLibres>0){										
					var idli=borrarLibre.getAttribute("id");	
					//alert("Eliminar -> "+borrarLibre.parentNode.innerHTML); // <h6 id="i003" name="m0">LIBRE</h6>
					
					var elemento = document.getElementById(idli);													
					var id=elemento.getAttribute("id");					
					//alert(id);
					node=document.getElementById(id);
					node.parentNode.removeChild(node);
				}

			}		

			//Si el invitado ya tiene un lugar asignado, debo cargarlo en su mesa.			
			  function cargarDatosInvitados(){			  				  			  				     			  		  			  
			    var eventoId=$("#evento_id").val();			    
			    $.ajax({
			      url: '/mesas/obtener_listaInvitados',
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

			// Busca una lugar libre en la mesa pasada por parametro y setea el nombre pasado por parametro
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
			
				
			
			// Recorro todas las mesas armo un texto y lo envio al controlador para actualizar la mesa de cada invitado.
			// en el texto envio idInvitado;nombreInvitado;mesaNumero;evento;
			function guardarDatosInvitados(){			
				var eventoId=$("#evento_id").val();				
				var cantSillasMesa=$("#cantidadSillasMesa").val();				
				var x=0;
				var texto="";
				var cantidadSillas=$("#cantidad_mesas").val()*cantSillasMesa;					
				var silla=1000;   // numero que decidi poner para manejar las sillas.
				var id,nombre,mesa;id=nombre=mesa="";
				var mesaNum=1;var contAumentarMesa=1;
				var jsonAux="";
				while(x<cantidadSillas){
					auxLinea=document.getElementById("l"+silla);										
					id=getInvitado(auxLinea.innerHTML);
					nombre=getInvitadoNombre(auxLinea.innerHTML);
					mesa=mesaNum;
					x++;
					silla++;					
					jsonAux=jsonAux+id+";"+nombre+";"+mesa+";"+eventoId+";";
									
					if(contAumentarMesa==cantSillasMesa){
						mesaNum+=1;
						contAumentarMesa=1;
						texto=texto+"\n"
					}
					else
						contAumentarMesa++;
				}
				jsonAux=jsonAux+obtenerListaInvitadosUpdate(eventoId);
				jsonAux=jsonAux.substring(0,jsonAux.length-1);	// con esto elimino el ultimo caracter que es un ';'							
				$.ajax({
			      url: '/mesas/guardar_datos',  
			      type: "POST",
			      dataType:'JSON',
			      data: {'datos':jsonAux},			      
			      success: function(data){			      				      	
			      	alert(data.msj);
			      }
			  	});				
				//alert(jsonAux);
			}

			// Cuenta los lugares libres que hay en cada mesa y actualiza este valor encima de la mesa.
			function actualizarLugaresLibres(){
				var cantidadMesas=$("#cantidad_mesas").val();	
				mesaNum=1;
				while(mesaNum<=cantidadMesas){
					var mesa = document.getElementsByName("m"+mesaNum);
					var x=0;
					var cont=0;
					while(x<mesa.length){				
						if(mesa[x].innerHTML=="LIBRE")
							cont++;    					    				    			
						x=x+1;										
					}				
					auxLinea=document.getElementById("ll"+mesaNum);										
					auxLinea.innerHTML="Lugares Libres "+cont;
					mesaNum++;
				}			
			}
			
			// Me arma una cadena para actualizar en la base de datos con los invitados que todavia no tienen mesa. 
			function obtenerListaInvitadosUpdate(eventoId){
				var lista = document.getElementById("listaInvitados");																
				var cadena="";
				for (i = 0; i < lista.childNodes.length; i++) {					
					var aux=lista.childNodes[i].innerHTML;				
					if(aux!=null){							
						id=getInvitado(aux);
						nombre=getInvitadoNombre(aux);
						if(nombre!=="LIBRE"){											
							cadena=cadena+id+";"+nombre+";0;"+eventoId+";";
						}
					}
				}
				return cadena;
			}					
			
			
			function test(){									
				alert(obtenerListaInvitadosUpdate(1));
			}					
			
			//llama la funcion cargarDatosInvitados una vez finalizada la carga de la pagina!
			$(document).ready(function() {
  			cargarDatosInvitados();			
			controlarExisteLibre();
			});	
			
			</script>		
			
		</script>	
<!-- //here ends scrolling icon -->
	</body>
