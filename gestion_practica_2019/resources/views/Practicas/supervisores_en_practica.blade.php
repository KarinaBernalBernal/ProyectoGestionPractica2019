@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid text-center">
        <h2>Supervisores en Práctica</h2>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header  ">
                {!! Form::open(['route'=> ['supervisoresPractica', $carrera], 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
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
                <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                <div class="container-fluid">Se encontraron {{ $contador }} Supervisores</div>
                {!! Form::close() !!}
            </div>
            <div class="card-body text-center">
                @if (count($lista)>0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-truncate text-center">Nombre</th>
                                <th class="text-truncate text-center">Trabajo</th>
                                <th class="text-truncate text-center">Email</th>
                                <th class="text-truncate text-center">Fono</th>
                                <th class="text-truncate text-center">Evaluacion</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $lista as $supervisores)
                                <tr id="{{ $supervisores->id_supervisor }}">
                                    <td class="text-truncate text-center">
                                        {{ $supervisores->nombre }}
                                        {{ $supervisores->apellido_paterno }}
                                    </td>
                                    <td class="text-truncate text-center">
                                        <strong>Cargo :</strong> {{ $supervisores->cargo }}<br>
                                        <strong>Departamento :</strong> {{ $supervisores->departamento }}<br>
                                    </td>
                                    <td class="text-truncate text-center">{{ $supervisores->email }}</td>
                                    <td class="text-truncate text-center">{{ $supervisores->fono }}</td>
                                    <td>
                                        @if($supervisores->resultado_eval)
                                            <strong>{{ $supervisores->nombre_alumno}}  {{$supervisores->apellido_alumno}}: </strong>
                                            <a href="" class='botonModalEvaluacion fa fa-check text-success' data-toggle="modal" data-form="{{ route('evaluacionModal',['id'=>$supervisores->id_eval_supervisor])}}" data-target="#modal-evaluacion"></a><br>
                                        @else
                                            <strong>{{ $supervisores->nombre_alumno}}  {{$supervisores->apellido_alumno}}: </strong>
                                            <a class='fa fa-times text-danger'></a><br>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">No se encontraron Supervisores</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        {{ $lista->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>

    <div class="modal" id="modal-evaluacion"></div>

<script>
    /*BOTON AUTO EVALUACION*/

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

