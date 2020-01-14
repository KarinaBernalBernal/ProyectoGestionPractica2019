@extends('layouts.mainlayout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Evaluación de la empresa sobre el desempeño del estudiante en práctica</h4>
                    <div class="card-body" style="text-align: justify;">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                En esta instancia se debe de evaluar al estudiante en práctica.
                            </li>
                            <li>
                                Podrás evaluar a tu practicante luego de que este haya completado su autoevaluación. Se te notificara con un correo en el momento en el que el alumno haya realizado su autoevaluación
                            </li>
                            <li>
                                El resultado de esta evaluación afectará la decisión final sobre la aprobación o reprobación del estudiante.
                            </li>
                            <li>
                                Se ruega completar el formulario con responsabilidad, sinceridad y lo antes posible.
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <h4 class="card-header">Alumnos Supervisados</h4>
        @if (count($lista)>0)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark" style="color: white">
                    <tr>
                        <th class="text-truncate text-center">Nombre</th>
                        <th class="text-truncate text-center">Rut</th>
                        <th class="text-truncate text-center">Datos de contacto</th>
                        <th class="text-truncate text-center">Periodo Práctica</th>
                        <th class="text-truncate text-center">Evaluación</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($lista as $alumnos)
                        <tr id="{{$alumnos->id_alumno}}">
                            <td class="text-truncate text-center">
                                {{$alumnos->nombre}}<br>
                                {{$alumnos->apellido_paterno}}<br>
                                {{$alumnos->apellido_materno}}
                            </td>
                            <td class="text-truncate text-center">{{$alumnos->rut}}</td>
                            <td >
                                <b> Email :</b> {{$alumnos->email}}<br>
                                <b> Dirección :</b> {{$alumnos->direccion}}<br>
                                <b> Fono :</b> {{$alumnos->fono}}
                            </td>
                            <td>
                                <b> Desde :</b> {{date('d-m-Y', strtotime($alumnos->f_desde))}}<br>
                                <b> Hasta :</b> {{date('d-m-Y', strtotime($alumnos->f_hasta))}}
                            </td>
                            <td class="text-center">
                                @if($alumnos->f_entrega_eval)
                                    <a  href="" class='botonModalEvaluacion fa fa-check text-success' data-toggle="modal" data-form="{{ route('evaluacionModalInformatica',['id'=>$alumnos->id_eval_supervisor])}}" data-target="#modal-evaluacion"></a><br>
                                @else
                                    @if($alumnos->id_autoeval)
                                        @if(!$alumnos->resolucion_practica)
                                            <a href="{{route('formularioEvaluacionEmpresa', ['id'=>$alumnos->id_practica])}}" class="btn btn-secondary"> <span>Evaluar al alumno</span></a>
                                            @else
                                                <p class="text-danger">La Práctica del alumno ya fue evaluada</p>
                                        @endif
                                    @else
                                    <p class="text-danger">El alumno debe completar su Autoevaluación</p>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No se encontraron Alumnos</p>
        @endif
    </div>
    <<div class="row d-flex justify-content-center">
        {{ $lista->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>

    <div class="modal" id="modal-evaluacion"></div>
    <script>
        /*BOTON EVALUACION SUPERVISOR*/

        $(document).ready(function ()
        {
            //modal-autoEvaluacion
            $(".botonModalEvaluacion").click(function (ev) // for each edit contact url
            {
                ev.preventDefault(); // prevent navigation
                var url = $(this).data("form"); // get the contact form url
                console.log(url);
                $("#modal-evaluacion").load(url, function () // load the url into the modal
                {
                    $(this).modal('show'); // display the modal on url load
                });
            });
            $('.evaluacion-form').on('submit', function ()
            {
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    context: this,
                    success: function (data, status)
                    {
                        $('#modal-evaluacion').html(data);
                    }
                });
            });

            $('#modal-evaluacion').on('hidden.bs.modal', function (e)
            {
                $(this).find('.modal-content').empty();
            });

        });
    </script>

@endsection
