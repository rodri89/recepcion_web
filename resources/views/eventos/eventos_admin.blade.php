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
			<li class="active"><a href="{{ URL::to('/eventos')}}"><strong>EVENTOS</strong> <span class="sr-only">(current)</span></a></li>
			<li><a href="{{ URL::to('/eventos/clientes')}}"><strong>CLIENTES</strong></a></li>
			<li><a href="{{ URL::to('/eventos/pagos')}}"><strong>PAGOS</strong></a></li>
			
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
		  <li><a>Bienvenido  <strong>{{$empresa_nombre->emp_nombre}}!</strong></a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Buscar Evento</div>
                <div class="panel-body">
						
						<?php
						$dt = new DateTime();	
						?>
					
                    	<form>
							<div class="form-group">
							<label>Descripcion</label>
							<input type="text" class="form-control" id="descripcion_b" value="n/a">
							</div>
							<div class="form-group">
							<label>Fecha rango</label>
							<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
							<input type="date" class="form-control" id="fecha_desde_b" value="2017-01-01">
							</div>
							</div>
							<div class="form-group">
							<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
							<input type="date" class="form-control" id="fecha_hasta_b" value="{{$dt->format('Y-m-d')}}">
							</div>
							</div>
							<div class="form-group">
							<label>DNI Organzador</label>
							<input type="text" class="form-control" id="dni_b" value="n/a">
							</div>
							<button type="button" class="btn btn-primary btn-block btn-buscar"><span class="fa fa-search" aria-hidden="true"></span></button>
						</form>	
                </div>
            </div>
        </div>
		<div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
						<div class="row">
							<div class="col-md-9">
							<h4>Mis Eventos</h4>
							</div>
							<div class="col-md-3">
							<!--
								<div class="btn-group pull-right" role="group" aria-label="...">
								  <button type="button" class="btn btn-default"><span class="fa fa-list-ul" aria-hidden="true"></span></button>
								  <button type="button" class="btn btn-default"><span class="fa fa-table" aria-hidden="true"></span></button>
								</div>
							-->
							</div>
						</div>
				</div>
                <div class="panel-body" style="height:600px; overflow-y: scroll;">
				
                    <a type="button" href="{{ URL::to('/eventos')}}" class="btn btn-info btn-md btn-traer-todos" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left" title="Mostrar Todos"><span class="fa fa-list-alt" aria-hidden="true"></span>  Mostrar todos</a>
					<a type="button" href="{{ URL::to('/eventos/inhabilitados')}}" class="btn btn-info btn-md" id="btn_traertodo" value="1" data-toggle="tooltip" data-placement="left"><span class="fa fa-ban" aria-hidden="true"></span>  Ver Inhabilitados</a>
                    <a  href="{{ URL::to('/eventos/nuevo')}}" type="button" class="btn btn-info btn-lg pull-right">
						<span class="fa fa-plus" aria-hidden="true"></span> Nuevo
						</a>
						<br>
                    	<hr>
						@if($errors->has('error_mensaje'))
							<div class="alert alert-danger" role="alert"><span class="text-danger"><strong>Error! </strong>{{ $errors->first('error_mensaje') }}</span></div>					
						@endif
						<div id="btn-info-cont">
						<div class="table-responsive">
						<table class="table" id="tabla_eve" name="tabla_clientes" hidden>
							<thead>
                        	<tr>
                            <th></th>
							<th></th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th>Lugar</th>
                            <th>Organizador</th>
							<th>DNI</th>
                            <th></th>
							<th></th>
                        	</tr>
                    		</thead>
                    		<tbody id="clientes-list" name="clientes-list">
							</tbody>
                        </table>
						</div>
						
						<?php $i=0; ?>	
						<div id="panel_2">
						
						@if (count($eventos) > 0)
							@foreach($eventos as $evento)
							<?php $i=$i+1; 
							
							$dt = new DateTime();	
											
							$fecha_hoy = $dt->format('Y-m-d');
							$fecha_evento = $evento->eve_fecha;

							if($fecha_hoy <= $fecha_evento){
								echo '<div class="panel panel-default">
								<div class="panel-body" id="panel-body">
								<h5 class="list-group-item-heading"><strong>'.$evento->eve_descripcion.'</strong></h5>';
								$habilitado = $evento->eve_habilitado;
								if($habilitado==0){
									echo '<span class="label label-danger">Inhabilitado</span>';
								}												
							}
							else
							{
								echo '<div class="panel panel-danger" style="background:#F6CFCF;">
									<div class="panel-body" id="panel-body">
									<h5 class="list-group-item-heading"><strong>'.$evento->eve_descripcion.' <h4>(FINALIZADO)<h4></strong></h5>';
									$habilitado = $evento->eve_habilitado;
									if($habilitado==0){
										echo '<span class="label label-danger">Inhabilitado</span>';
									}
							}													
							?>
							  
								<h6><strong><span class="fa fa-user" aria-hidden="true"></span>&nbsp;&nbsp;Fecha:</strong> {{$evento->eve_fecha}}</h6>
								<h6><strong><span class="fa fa-map-marker" aria-hidden="true"></span>&nbsp;&nbsp;Lugar:</strong> {{$evento->eve_lugar}}</h6>
								<h6><strong><span class="fa fa-user" aria-hidden="true"></span>&nbsp;&nbsp;Cliente:</strong> {{$evento->cli_nombre.' '.$evento->cli_apellido}} - <strong>DNI:</strong> {{$evento->cli_dni}}</h6>
									<a href="{{ route ('mostrar_pantalla_update',[$evento->eve_id])}}" class="btn btn-primary"><span class="fa fa-pencil-square-o" aria-hidden="true"></span>  Editar</a>
									<a href="{{ route ('mesa_del_cliente',[$evento->eve_id])}}" class="btn btn-primary"><span class="fa fa-circle" aria-hidden="true"></span>  Mesas</a>
									<button type="button" class="btn btn-default btn-info" value="{{$evento->eve_id}}"><span class="fa fa-info" aria-hidden="true"></span>  Info</button>
									
									<?php
									$habilitado = $evento->eve_habilitado;
									if($habilitado==1){
										echo "{!! Form::open(['url' => '/eventos/inhabilitar/inhabilitar_evento', 'method' => 'post']) !!}
											  {{ Form::input('hidden', 'id', $evento->eve_id,  ['id' => 'hidden-eve']) }} <!--ID DEL EVENTO-->
											  {!! Form::submit(trans('categories.delete'), ['class' => 'btn btn-danger pull-right inhabilitar', 'name' => 'delete_modal']) !!}
											  
											  {!! Form::close() !!}";	
https://gist.github.com/milon/030f12aaaf54dd178657											  
									}						
									?>
																
																
							  </div>
							</div>
							@endforeach 
							
								<div class="modal fade bs-example-modal-lg"  id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h3 class="modal-title" id="titulo">Datos</h3>
										</div>
										<div class="modal-body">
										<div class="row">
											<div class="col-md-6">	
											<div class="panel panel-default">
												<div class="panel-heading"><h4>Evento</h4></div>
													<div class="panel-body">
														<form role="form" novalidate="" id="frmClientes" name="frmClientes" novalidate="">

																<div class="form-group">
																	<label>Descripcion</label>
																	<input type="text" class="form-control" id="Descripcion" name="Descripcion" value="">
																</div>

																<div class="form-group">
																	<label>Fecha</label>
																	<input type="text" class="form-control" id="Fecha" name="Fecha"  value="">
																</div>

																<div class="form-group">
																	<label>Lugar</label>
																	<input type="text" class="form-control" id="Lugar" name="Lugar" value="">
																</div>
																<div class="form-group">
																<a href="{{ route ('mesa_del_cliente',[$evento->eve_id])}}" class="btn btn-primary btn-block"><span class="fa fa-circle" aria-hidden="true"></span>  Mesas</a>
																</div>
														</form>
													</div>
											</div>
											</div>
											<div class="col-md-6">	
											<div class="panel panel-default">
													<div class="panel-heading"><h4>Cliente</h4></div>
														<div class="panel-body">
															<form role="form" novalidate="" id="frmClientes" name="frmClientes" novalidate="">
																	<div class="form-group">
																	<label>Nombre</label>
																		<input type="text" class="form-control" id="Nombre" name="Nombre" value="">
																	</div>
																	<div class="form-group">
																		<label>Apellido</label>
																		<input type="text" class="form-control" id="Apellido" name="Apellido" value="">
																	</div>
																	<div class="form-group">
																		<label>DNI</label>
																		<input type="text" class="form-control" id="DNI" name="DNI" value="">
																	</div>
																	<div class="form-group">
																		<label>Telefono</label>
																		<input type="text" class="form-control" id="Telefono" name="Telefono" value="">
																	</div>
																	<div class="form-group">
																		<label>Mail</label>
																		<input type="text" class="form-control" id="Mail" name="Mail" value="">
																	</div>
															</form>
														</div>
											</div>
											</div>
										</div> 
									</div>
								</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							
								<div class="modal fade bs-example-modal-lg"  id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h3 class="modal-title" id="titulo">Comfirmacion</h3>
										</div>
										<div class="modal-body">
										<div class="row">
											<div class="col-md-12">	
														<div class="panel-body">
															<h3>Esta seguro que desea inhabilitar este evento?</h3>
															<h4>(si lo hace, el cliente no podra verlo.)</h4>
															<br>
															<button type="button" class="btn btn-danger" id="inhabilitar-si"><span class="fa fa-check" aria-hidden="true"></span>   SI</button>
															<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close"><span class="fa fa-times" aria-hidden="true"></span>  NO</button>
															
														</div>
											</div>
										</div> 
									</div>
								</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
	
						@endif
						</div>
				</div>
            </div>
			</div>
        </div>
		<div class="col-md-3">
		<div style="overflow:hidden;">
			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<div id="datetimepicker12"></div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(function () {
					$('#datetimepicker12').datetimepicker({
						inline: true,
						sideBySide: true
					});
				});
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
			</script>
		</div>
		</div>
    </div>
</div>
    </div>


	
@endsection

