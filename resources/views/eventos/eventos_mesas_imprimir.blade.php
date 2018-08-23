@extends('layouts.encabezadoYpie')

@section('content')		

				<div class="container">
		
		<nav class="navbar navbar-default hidden-print">
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
		
			<div class="row hidden-print">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">Opciones</div>
						<div class="panel-body">
							
							<a  href="javascript:window.print()" class="btn btn-info">IMPRIMIR</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">INVITADOS</div>
						<div class="panel-body">
						<div class="table-responsive">
						<table class="table table-bordered table-imprimir">
							<thead>
                        	<tr>
                            <th>#</th>
                            <th>Nombre y Apellido</th>
                            <th>Numero de Mesa</th>
                            <th>Asistio</th>
                        	</tr>
                    		</thead>
                    		<tbody>
								<?php $i=0; ?>	
                    			@foreach($invitados as $inv) 
                    			<?php $i=$i+1; ?>
								<tr>
								<td><h6><?php echo $i ?></h6></td>
								<td><h6>{{$inv->inv_apellido.' '.$inv->inv_nombre}}</h6></td>
								@if (($inv->mesa_numero) === 0)
									<td><h6>NO ASIGNADO</h6></td>
								@else 
									<td><h6>{{$inv->mesa_numero}}</h6></td>							
                                @endif
                                <td>{{ Form::checkbox('agree', 1, null, ['class' => 'field']) }}</td>
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
@endsection