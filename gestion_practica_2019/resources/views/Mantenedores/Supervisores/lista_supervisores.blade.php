@extends('layouts.mainlayout')

@section('content')
<div class="container-fluid">
        <h3>Mantenedor de Supervisores</h3>
        <br>

    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container card text">
        <div class="card-body">
            <form class="form-horizontal" action="{{route('lista_supervisores')}}" method="get">
                <div class="row">
                    <div class="col-2">
                        <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="col-2">
                        <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido">
                    </div>
                    <div class="col-3">
                        <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="col-3">
                        <input id="fono" type="text" class="form-control" name="fono" placeholder="Fono">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                    </div>
                </div>
                <div class="text-left">Se encontraron {{ $contador }} Supervisores</div>
                <hr>
            </form>
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
                                    <th>Trabajo</th>
                                    <th>Datos de contacto</th>
                                    <th>Opción</th>
                                </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $supervisor)
                                        <tr id="{{$supervisor->id_supervisor}}">
                                            <td>{{$supervisor->id_supervisor}}</td>
                                            <td>
                                                {{$supervisor->nombre}}<br>
                                                {{$supervisor->apellido_paterno}}
                                            </td>
                                            <td>
                                                <strong>Cargo :</strong> {{$supervisor->cargo}}<br>
                                                <strong>Departamento :</strong> {{$supervisor->departamento}}
                                            </td>
                                            <td>
                                                <strong>Email :</strong>  {{$supervisor->email}}<br>
                                                <strong>Fono :</strong>  {{$supervisor->fono}}
                                            </td>
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
