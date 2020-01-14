@extends('layouts.mainlayout')
@section('content')

    <div class="container-fluid">
        <h3>Mantenedor de Evaluaciones de Supervisor</h3>
        <br>

        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card text">
            <div class="card-body">
                <form class="form-horizontal" action="{{route('lista_evaluaciones_supervisor')}}" method="get">
                    <div class="row">
                        <div class="col-3">
                            <input id="email" type="text" class="form-control" name="email" placeholder="Email Supervisor">
                        </div>
                        <div class="col-2">
                            <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut Alumno">
                        </div>
                        <div class="col-2">
                            <input id="porcent_tareas_realizadas" type="text" class="form-control" name="porcent_tareas_realizadas" placeholder="% Tareas Realizadas">
                        </div>
                        <div class="col-2">
                            <select id="resultado_eval" type="text" class="form-control" name="resultado_eval">
                                <option value="">Seleccione un resultado</option>
                                <option value="Aprobada">Aprobada</option>
                                <option value="Rechazada">Rechazada</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input id="f_entrega_eval" type="text" class="form-control" name="f_entrega_eval" placeholder="Fecha Entrega">
                            <label  class="font-italic">"yy-mm-dd"</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                    <div class="text-left">Se encontraron {{ $contador }} Evaluaciones</div>
                    <hr>
                </form>
                <div class="container-fluid">
                    @if (count($lista)>0)
                        <!-- DATA TABLES -->
                        <div class="container-fluid text-center">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                        <tr>
                                            <th>Id</th>
                                            <th>Correo Supervisor</th>
                                            <th>Alumno Evaluado</th>
                                            <th>% Tareas realizadas</th>
                                            <th>Resultado Evaluación</th>
                                            <th>Fecha Entrega</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lista as $evaluacion)
                                            <tr id="{{$evaluacion->id_eval_supervisor}}">
                                                <td>{{$evaluacion->id_eval_supervisor}}</td>
                                                <td>{{$evaluacion->email}}</td>
                                                <td>{{$evaluacion->rut}}</td>
                                                <td>{{$evaluacion->porcent_tareas_realizadas}}%</td>
                                                <td>{{$evaluacion->resultado_eval}}</td>
                                                <td>{{ date('d-m-Y', strtotime($evaluacion->f_entrega_eval)) }}</td>
                                                <td>
                                                    <a href="{{route('editar_evaluacion_supervisor',[$evaluacion->id_eval_supervisor])}} "><button id="{{$evaluacion->id_eval_supervisor}}" class="btn btn-warning">Editar</button></a>
                                                    <a href="#"><button id="{{$evaluacion->id_eval_supervisor}}" class="btn btn-danger" onclick="borrar('{{$evaluacion->id_eval_supervisor}}', '{{$evaluacion->id_eval_supervisor}}', '{{route('borrar_evaluacion_supervisor',[$evaluacion->id_eval_supervisor])}}')">Borrar</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="text-center">No existen evaluaciones de supervisor en este momento</p>
                    @endif
                    <!-- FIN DATA TABLES -->
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
                        </div>
                        {{--
                        <div class='ml-auto'>
                            <a href="{{route ('crear_evaluacion_supervisor')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            {{ $lista->appends(Request::except('page'))->render("pagination::bootstrap-4") }}
        </div>
    </div>
<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: '¿Estás seguro de querer eliminar la evaluación de supervisor  '+name+'?',
              text: "No será posible revertir este cambio",
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
                              'El registro de evaluación de supervisor ha sido eliminado.',
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
