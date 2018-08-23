<!DOCTYPE html>

<?php  
$matriz[0][0]=0;$matriz[0][1]=1;$matriz[0][2]=1;$matriz[0][3]=0;
$matriz[1][0]=1;$matriz[1][1]=0;$matriz[1][2]=0;$matriz[1][3]=1;
$matriz[2][0]=1;$matriz[2][1]=0;$matriz[2][2]=0;$matriz[2][3]=1;
$matriz[3][0]=1;$matriz[3][1]=0;$matriz[3][2]=0;$matriz[3][3]=1;
$matriz[4][0]=0;$matriz[4][1]=1;$matriz[4][2]=1;$matriz[4][3]=0; 
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

width: 80px;
height: 30px;
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
			
			<script src="js/jquery.min.js"> </script>
			<script src="js/bootstrap.js"></script>
		
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
							<li ><a href="eventos_clientes" class="scroll">SALIR</a></li>
							<li ><a role="button" onclick="cargarDatos()" class="scroll">CARGAR</a></li>							
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
				$cantidadMesas=$cantidad_mesas; 
				
				$mesaNum=1;
				$totalMesas=0;
				$dos=2; 				
				$impar=false;
				$silla=1;			
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
					<div class="row">  <!--  Este row representa una fila  -->					  
					  <div class="col-md-6">  <!-- col-md-6 lo que hace es que el div sea 6 columnas de ancho, bootstrap -->		
					  <div class="well well-lg" >												  	  
							<div id="panel">
							<div class="table-responsive">
							<table class="table">
							<tbody>
							

					<?php									
							for($fila=0;$fila<5;$fila++){   ?>
							<tr>																							
				<?php			for($columna=0;$columna<4;$columna++){			
								
									if($matriz[$fila][$columna]==0){	?>

										<td><div class="columna_vacia"><h6 visible="false"></h6></li> </div></td>
							<?php		}								   
								    if($matriz[$fila][$columna]==1){
								       ?>
										<td><li id="l{{$silla}}" draggable="true" class="list-group-item columna"><h6 id="i{{$silla}}" name="m{{$mesaNum}}">LIBRE</h6></li></td>											
							<?php									
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
			  						
				</div>
				</div>	
				<?php }   ?>   <!--   fin del total de las mesas    -->
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
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
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
					alert("Origen:"+mesaIDOrigen+" Destino:"+ mesaIDDestino);
					if(mesaIDDestino.localeCompare("tarrito")!=0){
						var intercambioDestinoPorOrigen=intercambioMesa(this.innerHTML,mesaIDOrigen); // hago el intercambio logico de mesas
						dragSrcEl.innerHTML = intercambioDestinoPorOrigen;          // this.innerHTML es el destino									
						var intercambioOrigenPorDestino=intercambioMesa(e.dataTransfer.getData('text/html'),mesaIDDestino);
						
						this.innerHTML = intercambioOrigenPorDestino;										
						
						this.classList.remove('over');
						actualizarBase(intercambioOrigenPorDestino,mesaIDDestino,intercambioDestinoPorOrigen,mesaIDOrigen);
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
					//seteo el valor de la nueva mesa que va a tener el invitado, en la tabla invitados.		
					controlarExisteLibre();					
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
			

			function intercambioMesa(texto,mesa){								
				var m1=getMesaId(texto);				
				var aux = texto.replace(m1, mesa);								
				//alert("intercambioMesa"+texto+"-->"+aux);				
				return aux;
			}

			// pre requisito dentro del h1 debe haber 
			// <h6 id="m1" name="i62">Luchi</h6>
			// me devuelve 001 
			function getInvitado(texto){
				var aux="";				
				var i=texto.search("h6")+8;
				var to=i+3;
				while(i<to){				
					aux=aux+texto.charAt(i);
					i++;
				}			
				//alert(texto+" --> "+aux);
				return aux;				
			}

			// invitado1= 
			// mesa1= es a donde va a ir a sentarse el invitado1
			// debo acutalizar tanto el origen como el destino de los invitados, en caso de haber un libre, lo debe controlar
			// el controller.
			function actualizarBase(invitado1,mesa1,invitado2,mesa2){				
				invNombre1=getInvitadoNombre(invitado1);
				invId1=getInvitado(invitado1);				
				invNombre2=getInvitadoNombre(invitado2);
				invId2=getInvitado(invitado2);				
				var eventoId=$("#evento_id").val();;  // este valor debe tenerlo en algun lado				
				alert("actualizarBase "+invNombre1+" -> "+invId1+" -> "+mesa1 +" / "+ invNombre2+" -> "+invId2+" -> "+mesa2);
				$.ajax({
			      url: '/mesas/mesas_base',   // mesas_blade es una ruta
			      type: "POST",
			      dataType:'JSON',
			      data: {'invNombre1':invNombre1,'invId1':invId1,'mesa1':mesa1,'invNombre2':invNombre2,'invId2':invId2,'mesa2':mesa2,'eventoId':eventoId},			      
			      success: function(data){			      	
			      	// el cambio fue realizado en la base
			      	//contarLibres();
			      	alert("actualizarBase -> M1 "+data.mesa1);
			      }
			  	});
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


			$(document).ready(function(){
			  $('#agregar').click(function(e){ 
			  	e.preventDefault();
			  	var nombre=$("#input_nombre").val();
			  	//alert("nombre "+nombre);
			    var data=$("#postRequest").serialize();   // #postRequest es un form, se envia todo lo que esta en el.
			    console.log(data);			    
			    $.ajax({
			      url: '/mesasGuardar/mesas',
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

			
			function cargarDatos(){				
				
			}

			</script>		
			
		</script>	
<!-- //here ends scrolling icon -->
	</body>
