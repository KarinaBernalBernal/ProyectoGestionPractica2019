@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs active" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link " id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="evaluadas-tab" data-toggle="tab" href="#evaluadas" role="tab" aria-controls="evaluadas" aria-selected="false">Evaluadas</a>
            </li>
        </ul>

        <br>

        <div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                <h2>Prácticas sin Evaluar</h2>
                <br>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="card text">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('filtrarResolucionP', $carrera)}}" method="get">
                            <div class="row">
                                <div class="col-2">
                                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                                <div class="col-2">
                                    <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido">
                                </div>
                                <div class="col-2">
                                    <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut Alumno">
                                </div>
                                <div class="col-2">
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email Supervisor">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                            <div class="text-left">Se encontraron {{ $contadorP }} Prácticas</div>
                            <hr>
                        </form>
                        <div class="text-center container-fluid">
                            @if (count($practicasP)>0)
                            <br>
                            <div class="row d-flex justify-content-center">
                                <table class="table table-bordered" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                    <tr >
                                        <th>Id</th>
                                        <th>Alumno</th>
                                        <th>Supervisor</th>
                                        <th>Fecha Inscripción</th>
                                        <th>Desde</th>
                                        <th>Hasta</th>
                                        <th>Charla</th>
                                        <th>Opción</th>
                                    </tr >
                                    </thead>
                                    <tbody>
                                    @foreach ($practicasP as $practicaP)
                                        <tr id="{{$practicaP->id_practica}}">
                                            <td>{{$practicaP->id_practica}}</td>
                                            <td>
                                                {{$practicaP->nombreAlumno}}
                                                {{$practicaP->apellidoAlumno}}<br>
                                                <strong>Rut:</strong> {{$practicaP->rut}}
                                            </td>
                                            <td>
                                                {{$practicaP->nombre}}
                                                {{$practicaP->apellido_paterno}} <br>
                                                {{$practicaP->emailSupervisor}}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($practicaP->f_inscripcion)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($practicaP->f_desde)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($practicaP->f_hasta)) }}</td>
                                            <td>{{$practicaP->asist_ch_post_pract}}</td>
                                            <td class="text-center"><a class='botonModalResolucionPractica btn btn-primary btn-sm' href="" data-toggle="modal" data-form="{{ route('resolucionPracticaModal',['id'=>$practicaP->id_practica])}}" data-target="#modal-resolucionPractica">Evaluar</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <br>
                                <div class="container-fluid text-center">
                                <p>No se encuentran Practicas en este momento!</p>
                                </div>
                            @endif
				        </div>
                        <div class="row d-flex justify-content-center">
                            {{ $practicasP->appends(Request::except("pendiente"))->render("pagination::bootstrap-4") }}
                        </div>
			        </div>
                </div>
            </div>

			<div class="tab-pane fade" id="evaluadas" role="tabpanel" aria-labelledby="evaluadas-tab">
                <h2>Prácticas Evaluadas</h2>
                <br>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="card text">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('filtrarResolucionE', $carrera)}}" method="get">
                            <div class="row">
                                <div class="col-2">
                                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                                <div class="col-2">
                                    <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido">
                                </div>
                                <div class="col-2">
                                    <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut Alumno">
                                </div>
                                <div class="col-2">
                                    <input id="email" type="text" class="form-control" name="email" placeholder="Email Supervisor">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                            <div class="text-left">Se encontraron {{ $contadorE }} Prácticas</div>
                            <hr>
                        </form>
                        <div class="text-center container-fluid">
					    @if (count($practicasE)>0)
					    <br>
					    <div class="row d-flex justify-content-center">
                            <table class="table table-bordered" id="MyTable">
                                <thead class="bg-dark" style="color: white">
                                <tr>
                                    <th>Id</th>
                                    <th>Alumno</th>
                                    <th>Supervisor</th>
                                    <th>Fecha Resolución</th>
                                    <th>Resolución</th>
                                    <th>Opción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($practicasE as $practicaE)
                                    <tr id="{{$practicaE->id_practica}}">
                                        <td>{{$practicaE->id_practica}}</td>
                                        <td>
                                            {{$practicaE->nombreAlumno}}
                                            {{$practicaE->apellidoAlumno}}<br>
                                            <strong>RUT:</strong> {{$practicaE->rut}}
                                        </td>
                                        <td>
                                            {{$practicaE->nombre}}
                                            {{$practicaE->apellido_paterno}} <br>
                                            {{$practicaE->emailSupervisor}}
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($practicaE->f_resolucion)) }}</td>
                                        @if($practicaE->resolucion_practica == 1)
                                            <td style="color: green">Aprobada</td>
                                        @else
                                            <td style="color: red">Reprobada</td>
                                        @endif
                                        <td class="text-center"><a class='botonModalModificarResolucionPractica btn btn-primary btn-sm' href="" data-toggle="modal" data-form="{{ route('modificarResolucionPracticaModal',['id'=>$practicaE->id_practica])}}" data-target="#modal-ModificarResolucionPractica">Modificar</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
					    </div>
                        @else
                            <br>
                            <div class="container-fluid text-center">
                                <p>No existen Prácticas que mostrar en estos momentos!</p>
                            </div>
                        @endif
                        </div>
                        <div class="row d-flex justify-content-center">
                            {{ $practicasE->appends(Request::except("evaluada"))->render("pagination::bootstrap-4") }}
                        </div>
		            </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-resolucionPractica"></div>
    <div class="modal" id="modal-modificarResolucionPractica"></div>

<script>

$(document).ready(function()
   {
       $('a[data-toggle="tab"]').on('shown.bs.tab', function(e)
       {
           sessionStorage.setItem('activeTabResolucion', $(e.target).attr('href'));
       });
       var activeTabResolucion = sessionStorage.getItem('activeTabResolucion');
       if(activeTabResolucion)
       {
           $('#myTab a[href="' + activeTabResolucion + '"]').click();
       }else
       {
           $('#myTab a[href="#pendientes"]').attr('class','nav-link active');
           $('#pendientes').attr('class','tab-pane fade show active');
       }
   });

$(document).ready(function () {

    //modal-evaluarSolicitud
    $(".botonModalResolucionPractica").click(function (ev) { // for each edit contact url
        ev.preventDefault(); // prevent navigation
        var url = $(this).data("form"); // get the contact form url
        console.log(url);
        $("#modal-resolucionPractica").load(url, function () { // load the url into the modal
        $(this).modal('show'); // display the modal on url load
        });
    });
    $('.resolucionPractica-form').on('submit', function () {
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            context: this,
            success: function (data, status) {
               $('#modal-resolucionPractica').html(data);
            }
        });
    });

    //modal-modificarEvaluacionSolicitud
    $(".botonModalModificarResolucionPractica").click(function (ev) { // for each edit contact url
            ev.preventDefault(); // prevent navigation
            var url = $(this).data("form"); // get the contact form url
            console.log(url);
            $("#modal-modificarResolucionPractica").load(url, function () { // load the url into the modal
            $(this).modal('show'); // display the modal on url load
            });
        });
    $('.modificarResolucionPractica-form').on('submit', function () {
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            context: this,
            success: function (data, status) {
               $('#modal-modificarResolucionPractica').html(data);
            }
        });
    });

    $('#modal-resolucionPractica').on('hidden.bs.modal', function (e) {
        $(this).find('.modal-content').empty();
    });

    $('#modal-modificarResolucionPractica').on('hidden.bs.modal', function (e) {
        $(this).find('.modal-content').empty();
    });
});
</script>

@endsection