@extends('layouts.mainlayout')
@section('content')
    <?php use App\Http\Controllers\AlumnoController;?>

    <div class="container-fluid text-center">
        <h2>Alumnos</h2>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                {!! Form::open(['route'=> 'alumnosPracticaEjecucion', 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
                <div class="col-2 mb-2">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                </div>
                <div class="col-2 mb-2">
                    {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                </div>
                <div class="col-2 mb-2">
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
                <div class="col-2 mb-2">
                    {!! Form::text('anno_ingreso', null, ['class' => 'form-control', 'placeholder' => 'Año de ingreso']) !!}
                </div>
                <button type="submit" class="btn btn-info form-group">Buscar</button>
                {!! Form::close() !!}
            </div>
            <div class="card-body">
                @if (count($lista)>0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-truncate text-center">Nombre</th>
                                <th class="text-truncate text-center">Rut</th>
                                <th class="text-truncate text-center">Datos de contacto</th>
                                <th class="text-truncate text-center">Año de ingreso</th>
                                <th class="text-truncate text-center">Formularios</th>
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
                                    <td class="text-truncate text-center">{{$alumnos->anno_ingreso}}</td>
                                    <td>

                                        <b> Autoevaluacion :</b>

                                        @if(\SGPP\Http\Controllers\AlumnoController::verificarFormularioAlumno($alumnos->id_alumno))
                                            <a  href="" class='botonModalAutoEvaluacion fa fa-check text-success' data-toggle="modal" data-form="{{ route('autoEvaluacionModal',['id'=>$alumnos->id_alumno])}}" data-target="#modal-autoEvaluacion"></a>
                                         @else
                                            <a class='fa fa-times text-danger'></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-danger text-center">No se encontraron Alumnos</p>
                @endif
            </div>
        </div>
    </div>

    <script>

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
        });
    </script>

@endsection

