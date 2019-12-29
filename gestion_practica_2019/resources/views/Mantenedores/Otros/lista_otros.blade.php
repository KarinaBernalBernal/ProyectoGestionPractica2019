@extends('layouts.mainlayout')

@section('content')
   <div class="container-fluid">
      <ul class="nav nav-tabs active" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link " id="otrosAreas-tab" data-toggle="tab" href="#otrosAreas" role="tab" aria-controls="otrosAreas" aria-selected="true">Otros/Áreas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="otrosHerramientas-tab" data-toggle="tab" href="#otrosHerramientas" role="tab" aria-controls="otrosHerramientas" aria-selected="false">Otros/Herramientas</a>
		</li>
	  </ul>

		<br>

		<div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show" id="otrosAreas" role="tabpanel" aria-labelledby="otrosAreas-tab">
				<h2>Áreas de Autoevaluación/Evaluación Supervisor</h2>
				<br>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="container">
					<div class="row justify-content-center">
						<div class="text-center">
						@if (count($otrosAreas)>0)
							<div class="row d-flex justify-content-center">
								<div class="table-responsive">
									<table class="table table-bordered" id="MyTable">
										<thead class="bg-dark" style="color: white">
											<tr class='text-center'>
												<th style="vertical-align: middle" scope="col">ID</th>
												<th style="vertical-align: middle" scope="col">Nombre</th>
												<th style="vertical-align: middle" scope="col">Opción</th>
											</tr>
										</thead>
										<tbody>
											@foreach($otrosAreas as $otroArea)
												<tr id="{{ $otroArea->id_otro_area }}">
													<td>{{ $otroArea->id_otro_area }} </td>
													<td>{{ $otroArea->n_area }}</td>
													<td>
														<a href="{{route('editar_otro',[$otroArea->id_otro_area, "Área"])}}"><button id="{{$otroArea->id_otro_area}}" class="btn btn-warning">
																		<span class="fas fa-edit" aria-hidden="true"></span>
															       	</button></a>
														<a href="#"><button id="{{$otroArea->id_otro_area}}" class="btn btn-danger" onclick="borrar('{{$otroArea->id_otro_area}}', '{{$otroArea->n_area}}', '{{route('borrar_otro',[$otroArea->id_otro_area, "Área"])}}')">
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
								<p>No existen Áreas en este momento!</p>
							</div>
						@endif
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<a href="/"><button class="btn btn-primary btn-lg">Atras</button></a>
						</div>
						<div class='ml-auto'>
							<a href="{{route ('crear_otro',["Área"])}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="otrosHerramientas" role="tabpanel" aria-labelledby="otrosHerramientas-tab">
				<h2>Herramientas de Formulario Autoevaluación</h2>
				<br>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="container">
					<div class="row justify-content-center">
						<div class="text-center">
							@if (count($otrosHerramientas)>0)
								<div class="row d-flex justify-content-center">
									<div class="table-responsive">
										<table class="table table-bordered" id="MyTable">
											<thead class="bg-dark" style="color: white">
											<tr class='text-center'>
												<th style="vertical-align: middle" scope="col">ID</th>
												<th style="vertical-align: middle" scope="col">Nombre</th>
												<th style="vertical-align: middle" scope="col">Opción</th>
											</tr>
											</thead>
											<tbody>
											@foreach($otrosHerramientas as $otroHerramienta)
												<tr>
                                                <tr id="{{ $otroHerramienta->id_otro_herramienta }}">
													<td>{{ $otroHerramienta->id_otro_herramienta }}</td>
													<td>{{ $otroHerramienta->n_herramienta }}</td>
													<td>
														<a href="{{route('editar_otro',[$otroHerramienta->id_otro_herramienta, "Herramienta"])}}"><button id="{{$otroHerramienta->id_otro_herramienta}}" class="btn btn-warning">
																<span class="fas fa-edit" aria-hidden="true"></span>
															</button></a>
														<a href="#"><button id="{{$otroHerramienta->id_otro_herramienta}}" class="btn btn-danger" onclick="borrar('{{$otroHerramienta->id_otro_herramienta}}', '{{$otroHerramienta->n_herramienta}}', '{{route('borrar_otro',[$otroHerramienta->id_otro_herramienta ,"Herramienta"])}}')">
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
									<p>No existen Herramientas en este momento!</p>
								</div>
						@endif
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<a href="/"><button class="btn btn-primary btn-lg">Atras</button></a>
						</div>
						<div class='ml-auto'>
							<a href="{{route ('crear_otro',["Herramienta"])}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
   	</div>
   <script>

       $(document).ready(function()
       {
           $('a[data-toggle="tab"]').on('shown.bs.tab', function(e)
           {
               sessionStorage.setItem('activeTabOtros', $(e.target).attr('href'));
           });
           var activeTabOtros = sessionStorage.getItem('activeTabOtros');
           if(activeTabOtros)
           {
			   $('#myTab a[href="' + activeTabOtros + '"]').click();
           }else
           {
               $('#myTab a[href="#otrosAreas"]').attr('class','nav-link active');
               $('#otrosAreas').attr('class','tab-pane fade show active');
           }
       });


       function borrar(id_elemento,name , url_action)
       {
           Swal({
               title: 'Estas seguro de querer eliminar el elemento '+name+'?',
               text: "No sera posible revertir este cambio!",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Si, Eliminalo!'
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
                               'Eliminado!',
                               'El elemento ha sido eliminado.',
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