@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Autoevaluaciones</h3>
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
                                    <tr >
                                        <th>Id</th>
                                        <th>Fecha entrega</th>
                                        <th>Id practica</th>
                                        <th>Opción</th>
                                    </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $auto_evaluacion)
                                        <tr id="{{$auto_evaluacion->id_autoeval}}">
                                            <td>{{$auto_evaluacion->id_autoeval}}</td>
                                            <td>{{ date('d-m-Y', strtotime($auto_evaluacion->f_entrega)) }}</td>
                                            <td>{{$auto_evaluacion->id_practica}}</td>
                                            <td>
                                                <a href="{{route('editar_auto_evaluacion',[$auto_evaluacion->id_autoeval])}} "><button id="{{$auto_evaluacion->id_autoeval}}" class="btn btn-warning">Editar</button></a>
                                                <a href="#"><button id="{{$auto_evaluacion->id_autoeval}}" class="btn btn-danger" onclick="borrar('{{$auto_evaluacion->id_autoeval}}', '{{$auto_evaluacion->id_autoeval}}', '{{route('borrar_auto_evaluacion',[$auto_evaluacion->id_autoeval])}}')">Borrar</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <p>No existen Auto evaluaciones en este momento</p>
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
                <a href="{{route ('crear_auto_evaluacion')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
            --}}
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar la auto evaluación '+name+'?',
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
                              'La auto evaluación ha sido eliminado.',
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
