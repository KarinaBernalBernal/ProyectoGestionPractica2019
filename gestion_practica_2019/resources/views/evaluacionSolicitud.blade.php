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
						<table class="table table-bordered bg-light table-hover">
        					<thead class="bg-dark" style="color: white">							
								<tr class='text-center'>
									<th style="vertical-align: middle" scope="col">Rut</th>
									<th style="vertical-align: middle" scope="col">Nombre</th>
									<th style="vertical-align: middle" scope="col">Apellido Paterno</th>
									<th style="vertical-align: middle" scope="col">Apellido Materno</th>
									<th style="vertical-align: middle" scope="col">Año de Ingreso</th>
									<th style="vertical-align: middle" scope="col">Carrera</th>
									<th style="vertical-align: middle" scope="col">Proyecto de Titulo </th>
									<th style="vertical-align: middle" scope="col"></th>
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

										<td><a class='botonModalEvaluarSolicitud btn btn-primary btn-sm' href="" data-toggle="modal" data-form="{{ route('evaluarSolicitudModal',['id'=>$solicitud->id_solicitud])}}" data-target="#modal-evaluarSolicitud">Evaluar</a></td>

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
						<table class="table table-bordered bg-light table-hover">
        					<thead class="bg-dark" style="color: white">
								<tr class='text-center'>
									<th style="vertical-align: middle" scope="col">Rut</th>
									<th style="vertical-align: middle" scope="col">Nombre</th>
									<th style="vertical-align: middle" scope="col">Apellido Paterno</th>
									<th style="vertical-align: middle" scope="col">Apellido Materno</th>
									<th style="vertical-align: middle" scope="col">Año de Ingreso</th>
									<th style="vertical-align: middle" scope="col">Carrera</th>
									<th style="vertical-align: middle" scope="col">Proyecto de Titulo </th>
									<th style="vertical-align: middle" scope="col">Resolución</th>
									<th style="vertical-align: middle" scope="col">Observación</th>
									<th style="vertical-align: middle" scope="col"></th>
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

											<td><a href="" class="botonModalmodificarEvaluacionSolicitud" data-toggle="modal" data-form="{{route('modificarEvaluacionSolicitud',['id'=>$solicitud->id_solicitud])}}" data-target="#modal-modificarEvaluacionSolicitud"><span><i class="fas fa-edit"></i></span></a>
              
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

     	$('#modal-evaluarSolicitud').on('hidden.bs.modal', function (e) {
	        $(this).find('.modal-content').empty();
	    });
	});


	</script>

@endsection