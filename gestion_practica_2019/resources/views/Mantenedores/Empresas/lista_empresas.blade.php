@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Empresas</h3>
        <br>

        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card text">
            <div class="card-body">
                <form class="form-horizontal" action="{{route('lista_empresas')}}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="col-2">
                            <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut">
                        </div>
                        <div class="col-2">
                            <input id="ciudad" type="text" class="form-control" name="ciudad" placeholder="Ciudad">
                        </div>
                        <div class="col-2">
                            <input id="direccion" type="text" class="form-control" name="direccion" placeholder="Direccion">
                        </div>
                        <div class="col-2">
                            <input id="email" type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                    <div class="text-left">Se encontraron {{ $contador }} Empresas</div>
                    <hr>
                </form>
                <div class="text-center">
                    @if (count($lista)>0)
                        <!-- DATA TABLES -->
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>RUT</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Casilla</th>
                                        <th>Email</th>
                                        <th>Opción</th>
                                    </tr >
                                    </thead>
                                    <tbody>
                                        @foreach ($lista as $empresa)
                                            <tr id="{{$empresa->id_empresa}}">
                                                <td>{{$empresa->id_empresa}}</td>
                                                <td>{{$empresa->n_empresa}}</td>
                                                <td>{{$empresa->rut}}</td>
                                                <td>
                                                    {{$empresa->ciudad}} <br>
                                                    {{$empresa->direccion}}
                                                </td>
                                                <td>{{$empresa->fono}}</td>
                                                <td>{{$empresa->casilla}}</td>
                                                <td>{{$empresa->email}}</td>
                                                <td>
                                                    <a href="{{route('editar_empresa',[$empresa->id_empresa])}} "><button id="{{$empresa->id_empresa}}" class="btn btn-warning">Editar</button></a>
                                                    <a href="#"><button id="{{$empresa->id_empresa}}" class="btn btn-danger" onclick="borrar('{{$empresa->id_empresa}}', '{{$empresa->n_empresa}}', '{{route('borrar_empresa',[$empresa->id_empresa])}}')">Borrar</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p>No existen Empresas en este momento</p>
                    @endif
                    <!-- FIN DATA TABLES -->
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="/"><button class="btn btn-primary btn-lg">Atras</button></a>
                        </div>
                        <div class='ml-auto'>
                            <a href="{{route ('crear_empresa')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        {{ $lista->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>
<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar la empresa '+name+'?',
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
                              'La empresa ha sido eliminada.',
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
