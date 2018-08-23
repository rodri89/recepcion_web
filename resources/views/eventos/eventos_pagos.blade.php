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
			<li><a href="{{ URL::to('/eventos/clientes')}}">CLIENTES</a></li>
			<li class="active"><a href="{{ URL::to('/eventos/pagos')}}">PAGOS</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	
    <div class="row">
		<div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Ultimo Pago</div>
						<div class="panel-body">
							<h5><strong>- MONTO: $ </strong> {{$ultimo_pago->pago_monto}}</h5>
							<h5><strong>- Valido Desde:</strong> {{$ultimo_pago->pago_fecha_desde}}</h5>
							<h5><strong>- Valido Hasta:</strong> {{$ultimo_pago->pago_fecha_hasta}}</h5>
							<h5><strong>- Estado:</strong> {{$ultimo_pago->est_descripcion}}</h5>
						</div>
			</div>
        </div>
		<div class="col-md-8">
			<div class="panel panel-default">
                <div class="panel-heading">Mis Pagos</div>
						<div class="panel-body">
							<div class="table-responsive">
								<div class="table-responsive" style="height:600px; overflow-y: scroll;">
								<table class="table table-condensed table-fixed">
									<thead>
									<tr>
									<th></th>
									<th>Monto</th>
									<th>Valido Desde</th>
									<th>Valido Hasta</th>
									<th>Estado</th>
									</tr>
									</thead>
									<tbody>
										<?php $i=0; ?>	
										@foreach($pagos as $pag) 
										<?php
											$estado_pago = $pag->est_descripcion;
												
											if($estado_pago == 'Activo'){
												echo '<tr class="bg-success">'; 
											}
											else {
												echo '<tr class="bg-danger">';
											}
										?>
										<?php $i=$i+1; ?>
									
											<td><h6><span class="fa fa-usd" aria-hidden="true"></span></h6></td>
											<td><h6>{{$pag->pago_monto}}</h6></td>
											<td><h6>{{$pag->pago_fecha_desde}}</h6></td>
											<td><h6>{{$pag->pago_fecha_hasta}}</h6></td>
											<td><h6>{{$pag->est_descripcion}}</h6></td>		
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
</div>
@endsection