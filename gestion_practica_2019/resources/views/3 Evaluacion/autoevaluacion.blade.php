@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Formulario de autoevaluación</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el penúltimo paso que debes realizar para seguir con el proceso de la práctica profesional.
                            </li>
                            <li>
                                Esta es la última instancia en la que deberás realizar algo en internet, cuando termines, la empresa podrá completar el formulario que contiene la calificación de tu desempeño.
                            </li>
                            <li>
                                Cuando tu autoevaluación y evaluación de la empresa estén terminados, la DAE te informará, mediante un correo electrónico, el día de la reunión con asistencia OBLIGATORIA para aprobar la práctica.
                            </li>
                            <li>
                                La decisión final será procesada tomando en cuenta tu autoevaluación, la evaluación de la empresa y tu asistencia a la charla.
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h4 class="card-header">Autoevaluaciones</h4>
        @if (count($autoevaluacion)>0)
            <div class="table-responsive text-center">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark" style="color: white">
                    <tr>
                        <th class="text-truncate text-center">Fecha Inscripcion Practica</th>
                        <th class="text-truncate text-center">Fecha de entrega</th>
                        <th class="text-truncate text-center">Autoevaluacion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($autoevaluacion as $autoevaluaciones)
                        <tr id="{{$autoevaluaciones->id_practica}}">
                            @if($autoevaluaciones->f_inscripcion)
                                <td>{{date('d-m-Y', strtotime($autoevaluaciones->f_inscripcion))}}</td>
                            @else
                                <td>La Práctica no esta inscrita</td>
                            @endif
                            @if($autoevaluaciones->f_entrega)
                                <td>{{date('d-m-Y', strtotime($autoevaluaciones->f_entrega))}}</td>
                            @else
                                <td>La Autoevaluacion no esta terminada</td>
                            @endif
                            <td class="text-center">
                                @if($autoevaluaciones->f_inscripcion)
                                    @if($autoevaluaciones->id_autoeval)
                                        <a  href="" class='botonModalAutoEvaluacion fa fa-file text-success' data-toggle="modal" data-form="{{ route('autoEvaluacionModal',['id'=>$autoevaluaciones->id_autoeval])}}" data-target="#modal-autoEvaluacion"></a><br>
                                    @else
                                        @if( $fechaActual >= $autoevaluaciones->f_hasta)
                                            @if(!$autoevaluaciones->resolucion_practica)
                                                <a href="{{route('formularioAutoEvaluacion')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                                            @else
                                                <span class="text-danger">No se puede completar, la práctica ya fue evaluada</span>
                                            @endif
                                        @else
                                            <span>El periodo de tu Práctica aun no termina</span>
                                        @endif()
                                    @endif
                                @else
                                    <span>La Práctica no esta inscrita</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No se encontraron Autoevaluaciones</p>
        @endif
    </div>

    <div class="modal" id="modal-autoEvaluacion"></div>

    <script>
        /*BOTON AUTO EVALUACION*/
        $(document).ready(function ()
        {
            //modal-autoEvaluacion
            $(".botonModalAutoEvaluacion").click(function (ev) // for each edit contact url
            {
                ev.preventDefault(); // prevent navigation
                var url = $(this).data("form"); // get the contact form url
                console.log(url);
                $("#modal-autoEvaluacion").load(url, function () // load the url into the modal
                {
                    $(this).modal('show'); // display the modal on url load
                });
            });

            $('#modal-autoEvaluacion').on('hidden.bs.modal', function (e)
            {
                $(this).find('.modal-content').empty();
            });
        });

    </script>
@endsection
