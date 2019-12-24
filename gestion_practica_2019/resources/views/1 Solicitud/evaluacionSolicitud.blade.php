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
                    <div class="py-3">
                        {!! Form::open(['route'=> ['solicitudesPFiltrada', $carrera] , 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])!!}
                        <div class="col-2">
                            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                        </div>
                        <div class="col-2">
                            {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                        </div>
                        <div class="col-2">
                            {!! Form::text('rut', null, ['class' => 'form-control', 'placeholder' => 'Rut']) !!}
                        </div>
                        <div class="col-2">
                            {!! Form::text('anno_ingreso', null, ['class' => 'form-control', 'placeholder' => 'Año de ingreso']) !!}
                        </div>
                        <button type="submit" class="btn btn-info form-group col-1">Buscar</button>
                        {!! Form::close() !!}
						<p class="col-2">Hay {{ $contadorP }} Solicitudes</p></a>
                    </div>
                    <div class="row">
					   <h2>Solicitudes pendientes</h2>
					</div>
					@if (count($solicitudesP)>0)
					<br>
					<div class="row d-flex justify-content-center">	
						<table class="table table-bordered bg-light table-hover table-responsive">
        					<thead class="bg-dark" style="color: white">							
								<tr class='text-center'>
									<th style="vertical-align: middle" scope="col">Rut</th>
									<th style="vertical-align: middle" scope="col">Nombre</th>
									<th style="vertical-align: middle" scope="col">Año de Ingreso</th>
									<th style="vertical-align: middle" scope="col">Carrera</th>
									<th style="vertical-align: middle" scope="col">Segunda Práctica</th>
									<th style="vertical-align: middle" scope="col">Proyecto de Titulo </th>
									<th style="vertical-align: middle" scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($solicitudesP as $solicitudP)
									<tr>
										<td>{{ $solicitudP->rut }} </td>
										<td class="text-truncate text-center">
											{{ $solicitudP->nombre }}
											{{ $solicitudP->apellido_paterno }}
											{{ $solicitudP->apellido_materno }}
										</td>
										<td>{{ $solicitudP->anno_ingreso }}</td>
										<td>{{ $solicitudP->carrera }}</td>
										<td>{{ $solicitudP->practica }}</td>
										<td><strong>Semestre:</strong> {{ $solicitudP->semestre_proyecto }} <br>
											<strong>Año:</strong>	{{ $solicitudP->anno_proyecto }}</td>

										<td><a class='botonModalEvaluarSolicitud btn btn-primary btn-sm' href="" data-toggle="modal" data-form="{{ route('evaluarSolicitudModal',['id'=>$solicitudP->id_solicitud])}}" data-target="#modal-evaluarSolicitud">Evaluar</a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
						<br>
						<div class="container-fluid text-center">
						<p>No existen solicitudes en este momento!</p>
						</div>
					@endif
				</div>
				<div class="row d-flex justify-content-center">
					{{ $solicitudesP->links( "pagination::bootstrap-4") }}
				</div>
			</div>

			<div class="tab-pane fade" id="evaluadas" role="tabpanel" aria-labelledby="evaluadas-tab">
				<div class="container-fluid">
					<div class="py-3">
						{!! Form::open([ 'route'=> ['solicitudesEFiltrada', $carrera], 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
						<div class="col-2">
							{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
						</div>
						<div class="col-2">
							{!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
						</div>
						<div class="col-2">
							{!! Form::text('rut', null, ['class' => 'form-control', 'placeholder' => 'Rut']) !!}
						</div>
						<div class="col-2">
							{!! Form::text('anno_ingreso', null, ['class' => 'form-control', 'placeholder' => 'Año de ingreso']) !!}
						</div>
						<button type="submit" class="btn btn-info form-group col-1">Buscar</button>
						{!! Form::close() !!}
						<p class="col-2">Hay {{ $contadorE }} Solicitudes</p>
					</div>
				  	<div class="row">
					   <h2>Solicitudes evaluadas</h2>
					</div>
					@if (count($solicitudesE)>0)
					<br>
					<div class="row d-flex justify-content-center">	
						<table class="table table-bordered bg-light table-hover table-responsive">
        					<thead class="bg-dark" style="color: white">
								<tr class='text-center'>
									<th style="vertical-align: middle" scope="col">Rut</th>
									<th style="vertical-align: middle" scope="col">Nombre</th>
									<th style="vertical-align: middle" scope="col">Año de Ingreso</th>
									<th style="vertical-align: middle" scope="col">Carrera</th>
									<th style="vertical-align: middle" scope="col">Proyecto de Titulo </th>
									<th style="vertical-align: middle" scope="col">Resolución</th>
									<th style="vertical-align: middle" scope="col">Observación</th>
									<th style="vertical-align: middle" scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($solicitudesE as $solicitudE)
									<tr>
										<td>{{ $solicitudE->rut }}</td>
										<td>
											{{ $solicitudE->nombre }}
											{{ $solicitudE->apellido_paterno }}
											{{ $solicitudE->apellido_materno }}
										</td>
										<td>{{ $solicitudE->anno_ingreso }}</td>
										<td>{{ $solicitudE->carrera }}</td>
										<td><strong>Semestre:</strong> {{ $solicitudE->semestre_proyecto }} <br>
											<strong>Año:</strong>	{{ $solicitudE->anno_proyecto }}</td>
										<td>{{ $solicitudE->resolucion_solicitud }}</td>
										<td>{{ $solicitudE->observacion_solicitud }}</td>
										<td><a href="" class="botonModalmodificarEvaluacionSolicitud" data-toggle="modal" data-form="{{route('modificarEvaluacionSolicitudModal',['id'=>$solicitudE->id_solicitud])}}" data-target="#modal-modificarEvaluacionSolicitud"><span><i class="fas fa-edit"></i></span></a>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="row d-flex justify-content-center">
							{{ $solicitudesE->links( "pagination::bootstrap-4") }}
						</div>
					</div>
					@else
						<br>
						<div class="container-fluid text-center">
							<p>No existen solicitudes en este momento!</p>
						</div>
					@endif
				</div>
			</div>

		</div>
   	</div>

	
   <div class="modal" id="modal-evaluarSolicitud"></div>
   <div class="modal" id="modal-modificarEvaluacionSolicitud"></div>

   <script>
   $(document).ready(function () {

    	//modal-evaluarSolicitud
    	$(".botonModalEvaluarSolicitud").click(function (ev) { // for each edit contact url
        	ev.preventDefault(); // prevent navigation
        	var url = $(this).data("form"); // get the contact form url
        	console.log(url);
        	$("#modal-evaluarSolicitud").load(url, function () { // load the url into the modal
            $(this).modal('show'); // display the modal on url load
        	});
    	});
	   	$('.evaluarSolicitud-form').on('submit', function () {
	        $.ajax({
	            type: $(this).attr('method'),
	            url: $(this).attr('action'),
	            data: $(this).serialize(),
	            context: this,
	            success: function (data, status) {
	               $('#modal-evaluarSolicitud').html(data);
	            }
	        });
	    });
	    
	    //modal-modificarEvaluacionSolicitud
	   	$(".botonModalmodificarEvaluacionSolicitud").click(function (ev) { // for each edit contact url
	        	ev.preventDefault(); // prevent navigation
	        	var url = $(this).data("form"); // get the contact form url
	        	console.log(url);
	        	$("#modal-modificarEvaluacionSolicitud").load(url, function () { // load the url into the modal
	            $(this).modal('show'); // display the modal on url load
	        	});
	    	});
	   	$('.modificarEvaluacionSolicitud-form').on('submit', function () {
	        $.ajax({
	            type: $(this).attr('method'),
	            url: $(this).attr('action'),
	            data: $(this).serialize(),
	            context: this,
	            success: function (data, status) {
	               $('#modal-modificarEvaluacionSolicitud').html(data);
	            }
	        });
	    });

     	$('#modal-evaluarSolicitud').on('hidden.bs.modal', function (e) {
	        $(this).find('.modal-content').empty();
	    });

	    $('#modal-modificarEvaluacionSolicitud').on('hidden.bs.modal', function (e) {
	        $(this).find('.modal-content').empty();
	    });
	});
	</script>
@endsection