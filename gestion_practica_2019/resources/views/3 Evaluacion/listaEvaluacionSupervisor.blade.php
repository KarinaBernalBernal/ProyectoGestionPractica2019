@extends('layouts.mainlayout')
@section('content')
        <div class="container-fluid text-center">
            <h2>Evaluaciones Supervisor</h2>
        </div>

        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header  ">
                    {!! Form::open(['route'=> ['listaEvaluacionSupervisor', $carrera], 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
                    <div class="col-2">
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::text('fono', null, ['class' => 'form-control', 'placeholder' => 'Fono']) !!}
                    </div>
                    <div class="col-2">
                        {!! Form::text('f_entrega_eval', null, ['class' => 'form-control', 'placeholder' => 'Fecha Entrega']) !!}
                    </div>
                    <button type="submit" class="btn btn-info form-group col-1">Buscar</button>
                    {!! Form::close() !!}
                    <p class="col-3">Hay {{ $contador }} Evaluaciones</p>
                </div>
                <div class="card-body">
                    @if (count($evaluacion)>0)
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-dark" style="color: white">
                                <tr>
                                    <th class="text-truncate text-center">Nombre</th>
                                    <th class="text-truncate text-center">Datos</th>
                                    <th class="text-truncate text-center">Fecha Entrega</th>
                                    <th class="text-truncate text-center">Evaluacion</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach( $evaluacion as $evaluaciones)
                                    <tr id="{{ $evaluaciones->id_supervisor }}">
                                        <td class="text-truncate text-center">
                                            {{ $evaluaciones->nombre }}
                                            {{ $evaluaciones->apellido_paterno }}
                                        </td>
                                        <td class="text-truncate">
                                            <b> Email :</b> {{ $evaluaciones->email }} <br>
                                            <b> Fono :</b> {{ $evaluaciones->fono }}
                                        </td>
                                        <td class="text-truncate text-center">{{date('d-m-Y', strtotime($evaluaciones->f_entrega_eval))}}</td>

                                        <td>
                                            @if($evaluaciones->resultado_eval)
                                                <strong>{{ $evaluaciones->nombre_alumno}}  {{$evaluaciones->apellido_alumno}}: </strong>
                                                <a href="" class='botonModalEvaluacion fa fa-file text-success' data-toggle="modal" data-form="{{ route('evaluacionModalInformatica',['id'=>$evaluaciones->id_eval_supervisor])}}" data-target="#modal-evaluacion"></a><br>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-danger text-center">No se encontraron Evaluaciones</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            {{ $evaluacion->links( "pagination::bootstrap-4") }}
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

                $('#modal-evaluacion').on('hidden.bs.modal', function (e)
                {
                    $(this).find('.modal-content').empty();
                });
            });
        </script>
@endsection

