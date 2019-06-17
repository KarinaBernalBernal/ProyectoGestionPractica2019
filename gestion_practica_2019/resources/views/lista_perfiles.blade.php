@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Perfiles</h3>
        <br>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center">
                @if (count($lista)>0)
                    <!-- DATA TABLES -->
                    <div class="row">
                        <div class="col s12">
                            <table id="tabla" class="table">
                                <thead>
                                <tr >
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Nombre
                                    </th>

                                </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $perfil)
                                        <tr id="{{$perfil->id_perfil}}">
                                            <td>{{$perfil->id_perfil}}</td>
                                            <td>{{$perfil->n_perfil}}</td>
                                            <td>
                                                <a href="{{route('editar_perfil',[$perfil->id_perfil])}} "><button id="{{$perfil->id_perfil}}" class="btn btn-warning">Editar</button></a>
                                                <a href="#"><button id="{{$perfil->id_perfil}}" class="btn btn-danger" onclick="borrar('{{$perfil->id_perfil}}', '{{$perfil->n_perfil}}', '{{route('borrar_perfil',[$perfil->id_perfil])}}')">Borrar</button></a>
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
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @else
                    <p>No existen Perfiles en este momento</p>
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
                <a href="{{route ('crear_perfil')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar el perfil '+name+'?',
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
                              'El perfil ha sido eliminado.',
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
