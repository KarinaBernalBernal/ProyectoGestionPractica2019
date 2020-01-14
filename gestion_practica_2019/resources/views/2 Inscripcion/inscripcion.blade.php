@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Inscripción de práctica profesional</h4>
                    <div class="card-body" style="text-align: justify;">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el tercer paso que debes realizar para continuar con el proceso de la práctica profesional.
                            </li>
                            <li>
                                Para poder inscribir la práctica es necesario que tengas el estado de la solicitud como "autorizado". Recibirás un correo cuando el estado de tu solicitud cambie
                            </li>
                            <li>
                                El alumno, una vez decidido donde realizará su práctica, deberá inscribirla, completando el formulario “INSCRIPCIÓN DE PRÁCTICA”, en la cual se indicará fecha de inicio y finalización de ésta, nombre de la Empresa y datos del supervisor. Posterior a dicha inscripción, Secretaría de Docencia emitirá carta con la cual el alumno tramitará en el DAE su Certificado de Cobertura del Seguro Escolar.
                            </li>
                            <li>
                                Al finalizar esta etapa y luego de que el seguro escolar esté listo, podrás trabajar y cumplir con las 320 horas mínimas.
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h4 class="card-header">Prácticas Inscritas</h4>
        @if (count($practica)>0)
            <div class="table-responsive text-center">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark" style="color: white">
                    <tr>
                        <th class="text-truncate text-center">Fechas</th>
                        <th class="text-truncate text-center">Periodo Práctica</th>
                        <th class="text-truncate text-center">Supervisor</th>
                        <th class="text-truncate text-center">Resolucion Práctica</th>
                        <th class="text-truncate text-center">Formulario</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($practica as $practicas)
                        <tr id="{{$practicas->id_practica}}">
                            <td>
                                <b> Solicitud:</b>{{date('d-m-Y', strtotime($practicas->f_solicitud))}}<br>
                                @if($practicas->f_inscripcion)
                                    <b> Inscripción:</b>{{date('d-m-Y', strtotime($practicas->f_inscripcion))}}
                                    @else
                                        <b>Práctica no Inscrita</b>
                                @endif

                            </td>
                            <td >
                                @if($practicas->f_desde && $practicas->f_hasta)
                                    <b> Desde:</b> {{date('d-m-Y', strtotime($practicas->f_desde))}}<br>
                                    <b> Hasta:</b> {{date('d-m-Y', strtotime($practicas->f_hasta))}}
                                    @else
                                        <b>Práctica no inscrita</b>
                                @endif
                            </td>
                            <td>
                                @if($practicas->nombre && $practicas->apellido_paterno && $practicas->email)
                                {{$practicas->nombre}}
                                {{$practicas->apellido_paterno}}<br>
                                {{$practicas->email}}
                                    @else
                                        <b>Supervisor no Inscrito</b>
                                @endif
                            </td>
                            @if($practicas->resolucion_practica)
                                @if($practicas->resolucion_practica == 1)
                                    <td class="text-success">Aprobada</td>
                                @else
                                    <td class="text-danger">Reprobada</td>
                                @endif
                            @else
                                <td>Práctica no Evaluada</td>
                            @endif
                            <td>
                                @if($practicas->f_inscripcion)
                                    <b>Práctica Inscrita</b>
                                    <a href="" class='botonModalInscripcion fa fa-file text-success' data-toggle="modal" data-form="{{ route('inscripcionModal',['id'=>$practicas->id_practica])}}" data-target="#modal-inscripcion"></a>
                                    @else
                                        @if(!$solicitud)
                                        <a href="{{route('formularioInscripcion')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                                            @else
                                        <b>El estado de tu solicitud es "Pendiente"</b>
                                        @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No se encontraron Prácticas inscritas</p>
        @endif
    </div>
    <div class="modal" id="modal-inscripcion"></div>

    <script>
        /*BOTON INSCRIPCION*/
        $(document).ready(function ()
        {
            //modal-inscripcion
            $(".botonModalInscripcion").click(function (ev) // for each edit contact url
            {
                ev.preventDefault(); // prevent navigation
                var url = $(this).data("form"); // get the contact form url
                console.log(url);
                $("#modal-inscripcion").load(url, function () // load the url into the modal
                {
                    $(this).modal('show'); // display the modal on url load
                });
            });

            $('#modal-inscripcion').on('hidden.bs.modal', function (e)
            {
                $(this).find('.modal-content').empty();
            });
        });
    </script>
@endsection
