@extends('layouts.mainlayout')
@section('content')

    <div class="container-fluid">
        <div class="container-fluid text-center">
            <h2>Autoevaluaciones</h2>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header">
                {!! Form::open(['route'=> ['listaAutoevaluacion', $carrera], 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
                <div class="col-2">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                </div>
                <div class="col-2">
                    {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                </div>
                <div class="col-2">
                    {!! Form::text('rut', null, ['class' => 'form-control', 'placeholder' => 'Rut']) !!}
                </div>
                <div class="col-2">
                    {!! Form::text('f_entrega', null, ['class' => 'form-control', 'placeholder' => 'Fecha Entrega']) !!}
                    <label  class="font-italic">"yy-mm-dd"</label>
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                </div>
                <div class="container-fluid ">Se encontraron {{ $contador }} Autoevaluaciones</div>
                {!! Form::close() !!}
            </div>
            <div class="card-body">
            @if (count($autoevaluacion)>0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-dark" style="color: white">
                        <tr>
                            <th class="text-truncate text-center">Nombre</th>
                            <th class="text-truncate text-center">Rut</th>
                            <th class="text-truncate text-center">Fecha entrega</th>
                            <th class="text-truncate text-center">Autoevaluacion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($autoevaluacion as $autoevaluaciones)
                            <tr id="{{$autoevaluaciones->id_alumno}}">
                                <td class="text-truncate text-center">
                                    {{$autoevaluaciones->nombre}}<br>
                                    {{$autoevaluaciones->apellido_paterno}}<br>
                                    {{$autoevaluaciones->apellido_materno}}
                                </td>
                                <td class="text-truncate text-center">{{$autoevaluaciones->rut}}</td>
                                <td class="text-truncate text-center">{{date('d-m-Y', strtotime($autoevaluaciones->f_entrega))}}</td>
                                <td class="text-center">
                                    @if($autoevaluaciones->id_autoeval)
                                        <a  href="" class='botonModalAutoEvaluacion fa fa-file text-success' data-toggle="modal" data-form="{{ route('autoEvaluacionModal',['id'=>$autoevaluaciones->id_autoeval])}}" data-target="#modal-autoEvaluacion"></a><br>
                                    @else
                                        <a class='fa fa-times text-danger'></a><br>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            @else
                <p class="text-center">No se encontraron Autoevaluaciones</p>
            @endif
        <div class="row d-flex justify-content-center">
            {{ $autoevaluacion->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
        </div>
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
