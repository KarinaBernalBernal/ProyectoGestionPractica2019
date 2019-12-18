@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Administradores</h3>

        <br>
    
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card text">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="text-center">
                            @if (count($administradores)>0)
                                <!-- DATA TABLES -->
                                <div class="row d-flex justify-content-center">
                                    <div class="table-responsive">
                                        <table class="table table-bordered " id="MyTable">
                                            <thead class="bg-dark" style="color: white">
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>RUT</th>
                                                <th>Email</th>
                                                <th>Cargo</th>
                                                <th>Opción</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($administradores as $administrador)
                                                    <tr id="{{$administrador->id_admin}}">
                                                        <td>{{$administrador->id_admin}}</td>
                                                        <td>
                                                            {{$administrador->nombre}}<br>
                                                            {{$administrador->apellido_paterno}}<br>
                                                            {{$administrador->apellido_materno}}
                                                        </td>
                                                        <td>{{$administrador->rut}}</td>
                                                        <td>{{$administrador->email}}</td>
                                                        <td>{{$administrador->cargo}}</td>
                                                        <td>
                                                            <a href="{{route('editar_administrador',[$administrador->id_admin])}} "><button id="{{$administrador->id_admin}}" class="btn btn-warning">Editar</button></a>
                                                            <a href="#"><button id="{{$administrador->id_admin}}" class="btn btn-danger" onclick="borrar('{{$administrador->id_administrador}}', '{{$administrador->nombre}}', '{{route('borrar_administrador',[$administrador->id_admin])}}')">Borrar</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p>No existen Administradores en este momento</p>
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
                            <a href="{{route ('crear_administrador')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar el administrador '+name+'?',
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
                              'El administrador ha sido eliminado.',
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
