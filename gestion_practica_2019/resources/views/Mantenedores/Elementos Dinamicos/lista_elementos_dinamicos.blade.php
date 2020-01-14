@extends('layouts.mainlayout')

@section('content')
   <div class="container-fluid">
      <ul class="nav nav-tabs active" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link" id="areas-tab" data-toggle="tab" href="#areas" role="tab" aria-controls="areas" aria-selected="true">Áreas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="herramientas-tab" data-toggle="tab" href="#herramientas" role="tab" aria-controls="herramientas" aria-selected="false">Herramientas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="actitudes-tab" data-toggle="tab" href="#actitudes" role="tab" aria-controls="actitudes" aria-selected="false">Actitudes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="conocimientos-tab" data-toggle="tab" href="#conocimientos" role="tab" aria-controls="conocimientos" aria-selected="false">Conocimientos</a>
		</li>
	  </ul>

		<br>

		<div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show" id="areas" role="tabpanel" aria-labelledby="areas-tab">
				<h2>Áreas de Autoevaluación/Evaluación Supervisor</h2>
				<br>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="card text">
					<div class="card-body">
						<form class="form-horizontal" action="{{route('lista_elementos_dinamicos',["Área"])}}" method="get">
							<div class="row">
								<div class="col-2">
									<input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
								</div>
								<div class="col-2">
									<select id="vigencia" type="text" class="form-control" name="vigencia">
										<option value="">Seleccione Estado</option>
										<option value="1">Vigente</option>
										<option value="2">No Vigente</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
								</div>
							</div>
							<div class="text-left">Se encontraron {{ $contadorAreas }} Áreas</div>
							<hr>
						</form>
						<div class="text-center container-fluid">
						@if (count($area)>0)
							<div class="row d-flex justify-content-center">
								<div class="table-responsive">
									<table class="table table-bordered" id="MyTable">
										<thead class="bg-dark" style="color: white">
											<tr class='text-center'>
												<th style="vertical-align: middle" scope="col">ID</th>
												<th style="vertical-align: middle" scope="col">Nombre</th>
												<th style="vertical-align: middle" scope="col">Vigencia</th>
												<th style="vertical-align: middle" scope="col">Opción</th>
											</tr>
										</thead>
										<tbody>
											@foreach($area as $areas)
												<tr id="{{ $areas->id_area }}">
													<td>{{ $areas->id_area }} </td>
													<td>{{ $areas->n_area }}</td>

													@if($areas->vigencia == 1)
														<td><input name="area[]" type="checkbox" data-id="{{ $areas->id_area }}" data-title="area" checked></td>
													@else
														<td><input name="area[]" type="checkbox" data-id="{{ $areas->id_area }}" data-title="area"></td>
													@endif
													<td>
														<a href="{{route('editar_elemento',[$areas->id_area, "Área"])}}"><button id="{{$areas->id_area}}" class="btn btn-warning">
																		<span class="fas fa-edit" aria-hidden="true"></span>
															       	</button></a>
														<a href="#"><button id="{{$areas->id_area}}" class="btn btn-danger" onclick="borrar('{{$areas->id_area}}', '{{$areas->n_area}}', '{{route('borrar_elemento_dinamico',[$areas->id_area, "Área"])}}')">
																		<span class="fas fa-trash-alt" aria-hidden="true"></span>
																	</button></a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						@else
							<div class="container-fluid text-center">
								<p>No existen Áreas en este momento</p>
							</div>
						@endif
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-2">
									<a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
								</div>
								<div class='ml-auto'>
									<a href="{{route ('crear_elemento_dinamico',["Área"])}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row d-flex justify-content-center">
					{{ $area->appends(Request::except('area'))->render("pagination::bootstrap-4") }}
				</div>
			</div>

			<div class="tab-pane fade" id="herramientas" role="tabpanel" aria-labelledby="herramientas-tab">
				<h2>Herramientas de Formulario Autoevaluación</h2>
				<br>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="card text">
					<div class="card-body">
						<form class="form-horizontal" action="{{route('lista_elementos_dinamicos',["Herramienta"])}}" method="get">
							<div class="row">
								<div class="col-2">
									<input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
								</div>
								<div class="col-2">
									<select id="vigencia" type="text" class="form-control" name="vigencia">
										<option value="">Seleccione Estado</option>
										<option value="1">Vigente</option>
										<option value="2">No Vigente</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
								</div>
							</div>
							<div class="text-left">Se encontraron {{ $contadorHerramientas }} Herramientas</div>
							<hr>
						</form>
						<div class="text-center container-fluid">
							@if (count($herramienta)>0)
								<div class="row d-flex justify-content-center">
									<div class="table-responsive">
										<table class="table table-bordered" id="MyTable">
											<thead class="bg-dark" style="color: white">
											<tr class='text-center'>
												<th style="vertical-align: middle" scope="col">ID</th>
												<th style="vertical-align: middle" scope="col">Nombre</th>
												<th style="vertical-align: middle" scope="col">Vigencia</th>
												<th style="vertical-align: middle" scope="col">Opción</th>
											</tr>
											</thead>
											<tbody>
											@foreach($herramienta as $herramientas)
												<tr>
                                                <tr id="{{ $herramientas->id_herramienta }}">
													<td>{{ $herramientas->id_herramienta }}</td>
													<td>{{ $herramientas->n_herramienta }}</td>
													@if($herramientas->vigencia == 1)
														<td><input name="herramienta[]" type="checkbox" data-id="{{ $herramientas->id_herramienta }}" data-title="herramienta" checked></td>
													@else
														<td><input name="herramienta[]" type="checkbox" data-id="{{ $herramientas->id_herramienta }}" data-title="herramienta"></td>
													@endif
													<td>
														<a href="{{route('editar_elemento',[$herramientas->id_herramienta, "Herramienta"])}}"><button id="{{$herramientas->id_herramienta}}" class="btn btn-warning">
																<span class="fas fa-edit" aria-hidden="true"></span>
															</button></a>
														<a href="#"><button id="{{$herramientas->id_herramienta}}" class="btn btn-danger" onclick="borrar('{{$herramientas->id_herramienta}}', '{{$herramientas->n_herramienta}}', '{{route('borrar_elemento_dinamico',[$herramientas->id_herramienta ,"Herramienta"])}}')">
																<span class="fas fa-trash-alt" aria-hidden="true"></span>
															</button></a>
													</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							@else
								<div class="container-fluid text-center">
									<p>No existen Herramientas en este momento</p>
								</div>
						@endif
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-2">
									<a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
								</div>
								<div class='ml-auto'>
									<a href="{{route ('crear_elemento_dinamico',["Herramienta"])}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row d-flex justify-content-center">
					{{ $herramienta->appends(Request::except('herramienta'))->render("pagination::bootstrap-4") }}
				</div>
			</div>

			<div class="tab-pane fade" id="actitudes" role="tabpanel" aria-labelledby="actitudes-tab">
				<h2>Actitudes de Autoevaluación/Evaluación Supervisor</h2>
				<br>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="card text">
					<div class="card-body">
						<form class="form-horizontal" action="{{route('lista_elementos_dinamicos',["Actitud"])}}" method="get">
							<div class="row">
								<div class="col-2">
									<input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
								</div>
								<div class="col-2">
									<select id="vigencia" type="text" class="form-control" name="vigencia">
										<option value="">Seleccione Estado</option>
										<option value="1">Vigente</option>
										<option value="2">No Vigente</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
								</div>
							</div>
							<div class="text-left">Se encontraron {{ $contadorActitudinal }} Actitudes</div>
							<hr>
						</form>
						<div class="text-center container-fluid">
							@if (count($evalActitudinal)>0)
								<div class="container-fluid">
									<div class="table-responsive">
										<table class="table table-bordered" id="MyTable">
											<thead class="bg-dark" style="color: white">
											<tr class='text-center'>
												<th style="vertical-align: middle" scope="col">ID</th>
												<th style="vertical-align: middle" scope="col">Nombre</th>
												<th style="vertical-align: middle" scope="col">Descripción</th>
												<th style="vertical-align: middle" scope="col">Vigencia</th>
												<th style="vertical-align: middle" scope="col">Opción</th>
											</tr>
											</thead>
											<tbody>
											@foreach($evalActitudinal as $evalActitudinales)
												<tr id="{{ $evalActitudinales->id_actitudinal }}">
													<td>{{ $evalActitudinales->id_actitudinal }}</td>
													<td>{{ $evalActitudinales->n_act }}</td>
													<td>{{ $evalActitudinales->dp_act }}</td>
													@if($evalActitudinales->vigencia == 1)
														<td><input name="actitud[]" type="checkbox" data-id="{{ $evalActitudinales->id_actitudinal }}" data-title="actitud" checked></td>
													@else
														<td><input name="actitud[]" type="checkbox" data-id="{{ $evalActitudinales->id_actitudinal }}" data-title="actitud"></td>
													@endif
													<td>
														<a href="{{route('editar_elemento',[$evalActitudinales->id_actitudinal, "Actitud"])}}"><button id="{{$evalActitudinales->id_actitudinal}}" class="btn btn-warning">
																<span class="fas fa-edit" aria-hidden="true"></span>
															</button></a>
														<a href="#"><button id="{{$evalActitudinales->id_actitudinal}}" class="btn btn-danger" onclick="borrar('{{$evalActitudinales->id_actitudinal}}', '{{$evalActitudinales->n_act}}', '{{route('borrar_elemento_dinamico',[$evalActitudinales->id_actitudinal, "Actitud"])}}')">
																<span class="fas fa-trash-alt" aria-hidden="true"></span>
															</button></a>
													</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							@else
								<div class="container-fluid text-center">
									<p>No existen Actitudes en este momento</p>
								</div>
							@endif
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-2">
									<a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
								</div>
								<div class='ml-auto'>
									<a href="{{route ('crear_elemento_dinamico',["Actitud"])}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row d-flex justify-content-center">
					{{ $evalActitudinal->appends(Request::except('actitudinal'))->render("pagination::bootstrap-4") }}
				</div>
			</div>

			<div class="tab-pane fade" id="conocimientos" role="tabpanel" aria-labelledby="conocimientos-tab">
				<h2>Conocimientos de Autoevaluación/Evaluación Supervisor</h2>
				<br>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="card text">
					<div class="card-body">
						<form class="form-horizontal" action="{{route('lista_elementos_dinamicos',["Conocimiento"])}}" method="get">
							<div class="row">
								<div class="col-2">
									<input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
								</div>
								<div class="col-2">
									<select id="vigencia" type="text" class="form-control" name="vigencia">
										<option value="">Seleccione Estado</option>
										<option value="1">Vigente</option>
										<option value="2">No Vigente</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
								</div>
							</div>
							<div class="text-left">Se encontraron {{ $contadorConocimiento }} Conocimientos</div>
							<hr>
						</form>
						<div class="text-center container-fluid">
							@if (count($evalConocimiento)>0)
								<div class=" container-fluid">
									<div class="table-responsive">
										<table class="table table-bordered" id="MyTable">
											<thead class="bg-dark" style="color: white">
											<tr class='text-center'>
												<th style="vertical-align: middle" scope="col">ID</th>
												<th style="vertical-align: middle" scope="col">Nombre</th>
												<th style="vertical-align: middle" scope="col">Descripción</th>
												<th style="vertical-align: middle" scope="col">Vigencia</th>
												<th style="vertical-align: middle" scope="col">Opción</th>
											</tr>
											</thead>
											<tbody>
											@foreach($evalConocimiento as $evalConocimientos)
												<tr id="{{ $evalConocimientos->id_conocimiento }}">
													<td>{{ $evalConocimientos->id_conocimiento }}</td>
													<td>{{ $evalConocimientos->n_con }}</td>
													<td>{{ $evalConocimientos->dp_con }}</td>
													@if($evalConocimientos->vigencia == 1)
														<td><input name="conocimiento[]" type="checkbox" data-id="{{ $evalConocimientos->id_conocimiento }}" data-title="conocimiento" checked></td>
													@else
														<td><input name="conocimiento[]" type="checkbox" data-id="{{ $evalConocimientos->id_conocimiento }}" data-title="conocimiento"></td>
													@endif
													<td>
														<a href="{{route('editar_elemento',[$evalConocimientos->id_conocimiento, "Conocimiento"])}}"><button id="{{$evalConocimientos->id_conocimiento}}" class="btn btn-warning">
																<span class="fas fa-edit" aria-hidden="true"></span>
															</button></a>
														<a href="#"><button id="{{$evalConocimientos->id_conocimiento}}" class="btn btn-danger" onclick="borrar('{{$evalConocimientos->id_conocimiento}}', '{{$evalConocimientos->n_con}}', '{{route('borrar_elemento_dinamico',[$evalConocimientos->id_conocimiento, "Conocimiento"])}}')">
																<span class="fas fa-trash-alt" aria-hidden="true"></span>
															</button></a>
													</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
								</div>
							@else
								<div class="container-fluid text-center">
									<p>No existen Conocimientos en este momento</p>
								</div>
							@endif
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-2">
									<a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
								</div>
								<div class='ml-auto'>
									<a href="{{route ('crear_elemento_dinamico',["Conocimiento"])}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row d-flex justify-content-center">
					{{ $evalConocimiento->appends(Request::except('conocimiento'))->render("pagination::bootstrap-4") }}
				</div>
			</div>
		</div>
   	</div>
   <script>
       $(document).ready(function()
	   {
           $('a[data-toggle="tab"]').on('shown.bs.tab', function(e)
		   {
               sessionStorage.setItem('activeTab', $(e.target).attr('href'));
           });
           var activeTab = sessionStorage.getItem('activeTab');
           if(activeTab)
           {
			   $('#myTab a[href="' + activeTab + '"]').click();
           }else
		   {
               $('#myTab a[href="#areas"]').attr('class','nav-link active');
               $('#areas').attr('class','tab-pane fade show active');
           }
       });
       $.ajaxSetup({

           headers: {

               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

           }

       });
	   var _token = $("input[name='_token']").val();
	   $(document).on('click','input[name="area[]"]',function()
	   {
		   $.post({
			   url: '/ElementosDinamicos/vigencia',
			   method: "POST",
			   data: { _token:_token,id: $(this).data('id'), tipo: $(this).data('title')},

			   error:function() {
                   Swal.fire({
                       type: 'error',
                       title: 'Opps...!',
                       text: 'No se pudo modificar la vigencia, recargue la página para verificar',
                   });
               }
		   });
	   });
       $(document).on('click','input[name="herramienta[]"]',function()
       {
           $.post({
               url: '/ElementosDinamicos/vigencia',
               method: "POST",
               data: { _token:_token,id: $(this).data('id'), tipo: $(this).data('title')},

               error:function() {
                   Swal.fire({
                       type: 'error',
                       title: 'Opps...!',
                       text: 'No se pudo modificar la vigencia, recargue la página para verificar',
                   });
               }
           });
       });
       $(document).on('click','input[name="actitud[]"]',function()
       {
           $.post({
               url: '/ElementosDinamicos/vigencia',
               method: "POST",
               data: { _token:_token,id: $(this).data('id'), tipo: $(this).data('title')},

               error:function() {
                   Swal.fire({
                       type: 'error',
                       title: 'Opps...!',
                       text: 'No se pudo modificar la vigencia, recargue la página para verificar',
                   });
               }
           });
       });
       $(document).on('click','input[name="conocimiento[]"]',function()
       {
           $.post({
               url: '/ElementosDinamicos/vigencia',
               method: "POST",
               data: { _token:_token,id: $(this).data('id'), tipo: $(this).data('title')},

               error:function() {
                   Swal.fire({
                       type: 'error',
                       title: 'Opps...!',
                       text: 'No se pudo modificar la vigencia, recargue la página para verificar',
                   });
               }
           });
       });
       function borrar(id_elemento,name , url_action)
       {
           Swal({
               title: '¿Estás seguro de querer eliminar el elemento '+name+'?',
               text: "No será posible revertir este cambio",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Si, Elimínalo'
           }).then((result) => {

               if (result.value) {

                   parametros={
                       'id_elemento': id_elemento,
                       "_token": $('#token').val()
                   }

                   $.ajax({
                       url: url_action,
                       method: "POST",
                       data: parametros,
                       success: function(response){
                           Swal(
                               'Eliminado',
                               'El usuario ha sido eliminado.',
                               'success'
                           )
                           $('#'+id_elemento).remove();
                       }
                   });
               }
           })
       }
   </script>
@endsection