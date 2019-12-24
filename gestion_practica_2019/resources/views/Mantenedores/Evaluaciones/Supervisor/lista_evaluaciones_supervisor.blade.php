@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Evaluaciones de Supervisor</h3>
        <br>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center">
                @if (count($lista)>0)
                    <!-- DATA TABLES -->
                    <div class="row d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="MyTable">
                                <thead class="bg-dark" style="color: white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Porcentaje tareas realizadas</th>
                                        <th>Resultado Evaluación</th>
                                        <th>Fecha Entrega</th>
                                        <th>Id Práctica</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lista as $evaluacion)
                                        <tr id="{{$evaluacion->id_eval_supervisor}}">
                                            <td>{{$evaluacion->id_eval_supervisor}}</td>
                                            <td>{{$evaluacion->porcent_tareas_realizadas}}</td>
                                            <td>{{$evaluacion->resultado_eval}}</td>
                                            <td>{{ date('d-m-Y', strtotime($evaluacion->f_entrega_eval)) }}</td>
                                            <td>{{$evaluacion->id_practica}}</td>
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
                    <p>No existen evaluaciones de supervisor en este momento</p>
                @endif
                <!-- FIN DATA TABLES -->
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                    <a href="/"><button class="btn btn-primary btn-lg">Atras</button></a>
            </div>
            {{--
            <div class='ml-auto'>
                <a href="{{route ('crear_evaluacion_supervisor')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
            --}}
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar la evaluación de supervisor  '+name+'?',
              text: "No sera posible revertir este cambio!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Eliminalo!'
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
                              'Eliminado!',
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
