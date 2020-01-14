@extends('layouts.mainlayout')
@section('content')

    <div class="container-fluid">
        <ul class="nav nav-tabs active" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="practicasInscritas-tab" data-toggle="tab" href="#practicasInscritas" role="tab" aria-controls="practicasInscritas" aria-selected="true">Inscritas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="practicasNoInscritas-tab" data-toggle="tab" href="#practicasNoInscritas" role="tab" aria-controls="practicasNoInscritas" aria-selected="false">No Inscritas</a>
            </li>
        </ul>

        <br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show" id="practicasInscritas" role="tabpanel" aria-labelledby="practicasInscritas-tab">
                <h3>Mantenedor de Prácticas Inscritas</h3>
                <br>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="container  card text">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('lista_practicas')}}" method="get">
                            <div class="row">
                                <div class="col-2">
                                    <input id="f_solicitud" type="text" class="form-control" name="f_solicitud" placeholder="Solicitud">
                                </div>
                                <div class="col-2">
                                    <input id="f_inscripcion" type="text" class="form-control" name="f_inscripcion" placeholder="Inscripción">
                                    <label  class="font-italic">"yy-mm-dd"</label>
                                </div>
                                <div class="col-2">
                                    <input id="rutAlumno" type="text" class="form-control" name="rutAlumno" placeholder="Rut Alumno">
                                </div>
                                <div class="col-3">
                                    <input id="emailSupervisor" type="text" class="form-control" name="emailSupervisor" placeholder="Email Supervisor">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                            <div class="text-left">Se encontraron {{ $contador }} Prácticas</div>
                            <hr>
                        </form>
                        <div class="text-center">
                            @if (count($lista)>0)
                            <!-- DATA TABLES -->
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="MyTable">
                                        <thead class="bg-dark" style="color: white">
                                        <tr>
                                            <th>Id</th>
                                            <th>Solicitud</th>
                                            <th>Fechas</th>
                                            <th>Alumno</th>
                                            <th>Supervisor</th>
                                            <th>Opción</th>
                                        </tr >
                                        </thead>
                                        <tbody>
                                            @foreach ($lista as $practica)
                                                <tr id="{{$practica->id_practica}}">
                                                    <td>{{$practica->id_practica}}</td>
                                                    <td>
                                                        @if( $practica->f_solicitud)
                                                            {{ date('d-m-Y', strtotime($practica->f_solicitud)) }}<br>
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        @if( $practica->f_inscripcion)
                                                            <strong>Inscripción :</strong> {{ date('d-m-Y', strtotime($practica->f_inscripcion)) }}
                                                            <br>
                                                        @else
                                                            <strong>Práctica no Inscrita</strong>
                                                        @endif
                                                        @if( $practica->f_desde)
                                                            <strong>Desde :</strong> {{ date('d-m-Y', strtotime($practica->f_desde)) }} <br>
                                                        @endif
                                                        @if( $practica->f_hasta)
                                                            <strong>Hasta :</strong> {{ date('d-m-Y', strtotime($practica->f_hasta)) }}
                                                        @endif
                                                    </td>
                                                    <td>{{$practica->rut}}</td>
                                                    <td>
                                                        @if( $practica->email)
                                                            {{$practica->email}}
                                                        @else
                                                            <strong>Supervisor no Inscrito</strong>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('editar_practica',[$practica->id_practica])}} "><button id="{{$practica->id_practica}}" class="btn btn-warning">Editar</button></a>
                                                        <a href="#"><button id="{{$practica->id_practica}}" class="btn btn-danger" onclick="borrar('{{$practica->id_practica}}', '{{$practica->id_practica}}', '{{route('borrar_practica',[$practica->id_practica])}}')">Borrar</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                @else
                                <p>No existen prácticas en este momento</p>
                                @endif
                        </div>
                        <br>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
                                </div>
                                {{--
                                <div class='ml-auto'>
                                    <a href="{{route ('crear_practica')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
                                </div>
                                --}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    {{ $lista->appends(Request::except("page1"))->render("pagination::bootstrap-4") }}
                </div>
            </div>

            <div class="tab-pane fade show" id="practicasNoInscritas" role="tabpanel" aria-labelledby="practicasNoInscritas-tab">
                <h3>Mantenedor de Prácticas No Inscritas</h3>
                <br>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="container  card text">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('lista_practicasNoInscritos')}}" method="get">
                            <div class="row">
                                <div class="col-2">
                                    <input id="f_solicitud" type="text" class="form-control" name="f_solicitud" placeholder="Solicitud">
                                </div>
                                <div class="col-2">
                                    <input id="rutAlumno" type="text" class="form-control" name="rutAlumno" placeholder="Rut Alumno">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                            <div class="text-left">Se encontraron {{ $contadorNoInscritos }} Prácticas no Inscritas</div>
                            <hr>
                        </form>
                        <div class="text-center">
                        @if (count($listaNoInscritos)>0)
                            <!-- DATA TABLES -->
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="MyTable">
                                            <thead class="bg-dark" style="color: white">
                                            <tr>
                                                <th>Id</th>
                                                <th>Solicitud</th>
                                                <th>Rut Alumno</th>
                                                <th>Opción</th>
                                            </tr >
                                            </thead>
                                            <tbody>
                                            @foreach ($listaNoInscritos as $noInscrito)
                                                <tr id="{{$noInscrito->id_practica}}">
                                                    <td>{{$noInscrito->id_practica}}</td>
                                                    <td>
                                                        @if( $noInscrito->f_solicitud)
                                                            {{ date('d-m-Y', strtotime($noInscrito->f_solicitud)) }}<br>
                                                        @endif
                                                    </td>
                                                    <td>{{$noInscrito->rut}}</td>
                                                    <td>
                                                        <a href="{{route('editar_practica',[$noInscrito->id_practica])}} "><button id="{{$noInscrito->id_practica}}" class="btn btn-warning">Editar</button></a>
                                                        <a href="#"><button id="{{$noInscrito->id_practica}}" class="btn btn-danger" onclick="borrar('{{$noInscrito->id_practica}}', '{{$noInscrito->id_practica}}', '{{route('borrar_practica',[$noInscrito->id_practica])}}')">Borrar</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p>No existen prácticas no inscritas en este momento</p>
                            @endif
                        </div>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    {{ $listaNoInscritos->appends(Request::except("page2"))->render("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: '¿Estás seguro de querer eliminar la práctica '+name+'?',
              text: "No será posible revertir este cambio!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Elimínalo'
            }).then((result) => {

                if (result.value) {

                    parametros={
                        'id_elemento': id_elemento,
                        "_token": $("#token").val()
                    }

                    $.ajax({
                        url: url_action,
                        method: "POST",
                        data: parametros,
                        success: function(response){
                            Swal(
                              'Eliminado',
                              'La práctica ha sido eliminada.',
                              'success'
                            )
                            $('#'+id_elemento).remove();
                        }
                    });
                }
            })
    }

    $(document).ready(function()
    {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e)
        {
            sessionStorage.setItem('activeTabPractica', $(e.target).attr('href'));
        });
        var activeTabPractica = sessionStorage.getItem('activeTabPractica');
        if(activeTabPractica)
        {
            $('#myTab a[href="' + activeTabPractica + '"]').click();
        }else
        {
            $('#myTab a[href="#practicasInscritas"]').attr('class','nav-link active');
            $('#practicasInscritas').attr('class','tab-pane fade show active');
        }
    });
</script>
@endsection
