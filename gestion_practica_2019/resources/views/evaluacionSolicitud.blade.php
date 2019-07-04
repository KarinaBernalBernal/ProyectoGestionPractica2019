@extends('layouts.mainlayout')

@section('content')
   <div class="container-fluid">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
		  	<li class="nav-item">
		    	<a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes</a>
		  	</li>
		  	<li class="nav-item">
		    	<a class="nav-link" id="evaluadas-tab" data-toggle="tab" href="#evaluadas" role="tab" aria-controls="evaluadas" aria-selected="false">Evaluadas</a>
			</li>
		</ul>

		<br>

		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
				<div class="container-fluid">
				  	<div class="row">
					   <h2>Solicitudes pendientes</h2>
					</div>

					<br>

					<div class="row d-flex justify-content-center">	
						<table class="table table-sm table-hover">
							<thead class="thead-dark">
								<tr class='text-center'>
									<th scope="col">Rut</th>
									<th scope="col">Nombre</th>
									<th scope="col">Apellido Paterno</th>
									<th scope="col">Apellido Materno</th>
									<th scope="col">Año de Ingreso</th>
									<th scope="col">Carrera</th>
									<th scope="col">Proyecto de Titulo </th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($solicitudes as $solicitud)
									<tr>
										<td>{{ $solicitud->rut }} </td>
										<td>{{ $solicitud->nombre }}</td>
										<td>{{ $solicitud->apellido_paterno }}</td>
										<td>{{ $solicitud->apellido_materno }}</td>
										<td>{{ $solicitud->anno_ingreso }}</td>
										<td>{{ $solicitud->carrera }}</td>
										<td><strong>Semestre:</strong> {{ $solicitud->semestre_proyecto }} <br>
											<strong>Año:</strong>	{{ $solicitud->anno_proyecto }}</td>

									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="evaluadas" role="tabpanel" aria-labelledby="evaluadas-tab">
				<div class="container-fluid">
				  	<div class="row">
					   <h2>Solicitudes evaluadas</h2>
					</div>

					<br>

					<div class="row d-flex justify-content-center">	
						<table class="table table-sm table-hover">
							<thead class="thead-dark">
								<tr class='text-center'>
									<th scope="col">Rut</th>
									<th scope="col">Nombre</th>
									<th scope="col">Apellido Paterno</th>
									<th scope="col">Apellido Materno</th>
									<th scope="col">Año de Ingreso</th>
									<th scope="col">Carrera</th>
									<th scope="col">Proyecto de Titulo </th>
									<th scope="col">Resolución</th>
									<th scope="col">Observación</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($solicitudes as $solicitud)
									@if($solicitud->resolucion_solicitud != null)
										<tr>
											<td>{{ $solicitud->rut }} </td>
											<td>{{ $solicitud->nombre }}</td>
											<td>{{ $solicitud->apellido_paterno }}</td>
											<td>{{ $solicitud->apellido_materno }}</td>
											<td>{{ $solicitud->anno_ingreso }}</td>
											<td>{{ $solicitud->carrera }}</td>
											<td><strong>Semestre:</strong> {{ $solicitud->semestre_proyecto }} <br>
												<strong>Año:</strong>	{{ $solicitud->anno_proyecto }}</td>
											<td>{{ $solicitud->resolucion_solicitud }}</td>
											<td>{{ $solicitud->observacion_solicitud }}</td>
              

										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
   </div>

   <div class="modal" id="modal-evaluarSolicitud"></div>
   <div class="modal" id="modal-modificarSolicitud"></div>

@endsection