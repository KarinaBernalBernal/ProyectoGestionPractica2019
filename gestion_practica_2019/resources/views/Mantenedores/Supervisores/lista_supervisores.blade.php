@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Supervisores</h3>
        <br>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center">
                @if (count($lista)>0)
                    <!-- DATA TABLES -->
                    <div class=" container-fluid">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="MyTable">
                                <thead class="bg-dark" style="color: white">
                                <tr >
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido paterno</th>
                                    <th>Cargo</th>
                                    <th>Departamento</th>
                                    <th>Email</th>
                                    <th>Fono</th>
                                    <th>Opción</th>
                                </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $supervisor)
                                        <tr id="{{$supervisor->id_supervisor}}">
                                            <td>{{$supervisor->id_supervisor}}</td>
                                            <td>{{$supervisor->nombre}}</td>
                                            <td>{{$supervisor->apellido_paterno}}</td>
                                            <td>{{$supervisor->cargo}}</td>
                                            <td>{{$supervisor->departamento}}</td>
                                            <td>{{$supervisor->email}}</td>
                                            <td>{{$supervisor->fono}}</td>

                                            <td>
                                                <a href="{{route('editar_supervisor',[$supervisor->id_supervisor])}} "><button id="{{$supervisor->id_supervisor}}" class="btn btn-warning">Editar</button></a>
                                                <a href="#"><button id="{{$supervisor->id_supervisor}}" class="btn btn-danger" onclick="borrar('{{$supervisor->id_supervisor}}', '{{$supervisor->nombre}}', '{{route('borrar_supervisor',[$supervisor->id_supervisor])}}')">Borrar</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <p>No existen supervisores en este momento</p>
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
                <a href="{{route ('crear_supervisor')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar el supervisor '+name+'?',
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
                              'El supervisor ha sido eliminado.',
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
