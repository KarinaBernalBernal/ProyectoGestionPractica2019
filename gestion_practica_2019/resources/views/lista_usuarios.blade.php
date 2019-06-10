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
                    <div class="row">
                        <div class="col s12">
                            <table id="tabla" class="table">
                                <thead>
                                <tr>
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
                                </thead>
                                <tbody>
                                    @foreach ($lista as $usuario)
                                        <tr>
                                            <td>{{$usuario->id}}</td>
                                            <td>{{$usuario->name}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td>
                                                <a href="{{route('editar_usuario')}}"><button class="btn btn-warning">Editar</button>
                                                <a href="{{route('eliminar_usuario')}}"><button class="btn btn-danger">Eliminar</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
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
                    <a href="{{route('home')}}"><button class="btn btn-lg btn-block">Atras</button></a>
            </div>
            <div class='ml-auto'>
                <a href="{{route ('register')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
            </div>
        </div>

    </div>

<script>

</script>
@endsection
