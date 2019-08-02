@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Usuarios</h3>
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
                                        Nombre
                                    </th>
                                    <th>
                                        Email
                                    </th>

                                </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $usuario)
                                        <tr id="{{$usuario->id_user}}">
                                            <td>{{$usuario->id_user}}</td>
                                            <td>{{$usuario->name}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td>
                                                <a href="{{route('editar_usuario',[$usuario->id_user])}} "><button id="{{$usuario->id_user}}" class="btn btn-warning">Editar</button></a>
                                                <a href="#"><button id="{{$usuario->id_user}}" class="btn btn-danger" onclick="borrar('{{$usuario->id_user}}', '{{$usuario->name}}', '{{route('borrar_usuario',[$usuario->id_user])}}')">Borrar</button></a>
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
                                        Nombre
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @else
                    <p>No existen Usuarios en este momento</p>
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
                <a href="{{route ('register')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar el usuario '+name+'?',
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
                        "_token": $('#token').val()
                    }

                    $.ajax({
                        url: url_action,
                        method: "POST",
                        data: parametros,
                        success: function(response){
                            Swal(
                              'Eliminado!',
                              'El usuario ha sido eliminado.',
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
