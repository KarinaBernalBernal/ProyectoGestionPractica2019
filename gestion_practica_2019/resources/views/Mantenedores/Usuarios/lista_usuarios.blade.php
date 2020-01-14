@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Usuarios</h3>
        <br>

        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card text">
            <div class="card-body">
                <form class="form-horizontal" action="{{route('lista_usuarios')}}" method="get">
                <div class="row">
                    <div class="col-2">
                        <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="col-3">
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="col-3">
                        <select id="type" type="text" class="form-control" name="type">
                            <option value="">Seleccione un Tipo</option>
                            <option value="administrador">Administrador</option>
                            <option value="alumno">Alumno</option>
                            <option value="supervisor">Supervisor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                    </div>
                </div>
                <div class="text-left">Se encontraron {{ $contador }} Usuarios</div>
                </form>
                <hr>
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
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Opción</th>
                                        </tr >
                                        </thead>
                                        <tbody>
                                            @foreach ($lista as $usuario)
                                                <tr id="{{$usuario->id_user}}">
                                                    <td>{{$usuario->id_user}}</td>
                                                    <td>{{$usuario->name}}</td>
                                                    <td>{{$usuario->email}}</td>
                                                    <td>{{$usuario->type}}</td>
                                                    <td>
                                                        <a href="{{route('editar_usuario',[$usuario->id_user])}} "><button id="{{$usuario->id_user}}" class="btn btn-warning">Editar</button></a>
                                                        <a href="#"><button id="{{$usuario->id_user}}" class="btn btn-danger" onclick="borrar('{{$usuario->id_user}}', '{{$usuario->name}}', '{{route('borrar_usuario',[$usuario->id_user])}}')">Borrar</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <p>No existen Usuarios en este momento</p>
                        @endif
                        <!-- FIN DATA TABLES -->
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="/"><button class="btn btn-primary btn-lg">Atrás</button></a>
                        </div>
                        {{--
                        <div class='ml-auto'>
                            <a href="{{route ('crear_usuario_mantenedor')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        {{ $lista->appends(Request::except('page'))->render("pagination::bootstrap-4") }}
    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {
        Swal({
              title: '¿Estás seguro de querer eliminar el usuario '+name+'?',
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
                        "_token": $('#token').val()
                    }

                    $.ajax({
                        url: url_action,
                        method: "POST",
                        data: parametros,
                        success: function(response){
                            Swal(
                              'Eliminado',
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
