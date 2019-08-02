@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Practicas</h3>
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
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        f_solicitud
                                    </th>
                                    <th>
                                        f_inscripcion
                                    </th>
                                    <th>
                                        f_desde
                                    </th>
                                    <th>
                                        f_hasta
                                    </th>
                                    <th>
                                        asist_ch_post_pract
                                    </th>
                                    <th>
                                        asist_ch_pre_pract
                                    </th>
                                    <th>
                                        id_alumno
                                    </th>
                                    <th>
                                         id_supervisor
                                    </th>
                                </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $practica)
                                        <tr id="{{$practica->id_practica}}">
                                            <td>{{$practica->id_practica}}</td>
                                            <td>{{$practica->f_solicitud}}</td>
                                            <td>{{$practica->f_inscripcion}}</td>
                                            <td>{{$practica->f_desde}}</td>
                                            <td>{{$practica->f_hasta}}</td>
                                            <td>{{$practica->asist_ch_post_pract}}</td>
                                            <td>{{$practica->asist_ch_pre_pract}}</td>
                                            <td>{{$practica->id_alumno}}</td>
                                            <td>{{$practica->id_supervisor}}</td>


                                            <td>
                                                <a href="{{route('editar_practica',[$practica->id_practica])}} "><button id="{{$practica->id_practica}}" class="btn btn-warning">Editar</button></a>
                                                <a href="#"><button id="{{$practica->id_practica}}" class="btn btn-danger" onclick="borrar('{{$practica->id_practica}}', '{{$practica->id_practica}}', '{{route('borrar_practica',[$practica->id_practica])}}')">Borrar</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr >
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        f_solicitud
                                    </th>
                                    <th>
                                        f_inscripcion
                                    </th>
                                    <th>
                                        f_desde
                                    </th>
                                    <th>
                                        f_hasta
                                    </th>
                                    <th>
                                        asist_ch_post_pract
                                    </th>
                                    <th>
                                        asist_ch_pre_pract
                                    </th>
                                    <th>
                                        id_alumno
                                    </th>
                                    <th>
                                         id_supervisor
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @else
                    <p>No existen practicas  en este momento</p>
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
            <div class='ml-auto'>
                <a href="{{route ('crear_practica')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar la practica '+name+'?',
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
                              'La practica ha sido eliminada.',
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
