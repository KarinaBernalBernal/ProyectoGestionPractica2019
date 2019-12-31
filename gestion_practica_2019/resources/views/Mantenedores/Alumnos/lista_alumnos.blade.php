@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Alumnos</h3>

        <br>
    
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card text">
            <div class="card-body"> 
                <form class="form-horizontal" action="{{route('lista_alumnos')}}" method="get">
                    <div class="row">
                        <div class="col-3 mb-2">
                            <input id="buscador" type="text" class="form-control" name="buscador" placeholder="Ingrese palabra clave...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido Paterno...">
                        </div>
                        <div class="col-3 mb-2">
                             <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" placeholder="Apellido Materno...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="email" type="text" class="form-control" name="email" placeholder="Ingrese email...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="anno_ingreso" type="text" class="form-control" name="anno_ingreso" placeholder="Año de ingreso...">
                        </div>
                        <div class="col-3 mb-2">
                            <select id="carrera" type="text" class="form-control" name="carrera" placeholder="">
                                <option value="">Seleccione Carrera</option>
                                <option value="Ingeniería Civil Informática">Ingeniería Civil en Informatica</option>
                                <option value="Ingeniería de Ejecución Informática">Ingeniería de Ejecución en Informatica</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                    <div class="text-left">Se encontraron {{ $contador }} Alumnos</div>
                </form>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="text-center">
                            @if (count($lista)>0)
                                <!-- DATA TABLES -->
                                <div class="row d-flex justify-content-center container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered " id="MyTable">
                                            <thead class="bg-dark" style="color: white">

                                            <tr >
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>RUT</th>
                                                <th>Datos de contacto</th>
                                                <th>Año ingreso</th>
                                                <th>Carrera</th>
                                                <th>Estimación Proyecto de Título</th>
                                                <th>Opción</th>
                                            </tr >
                                            </thead>
                                            <tbody>
                                                @foreach ($lista as $alumno)
                                                    <tr id="{{$alumno->id_alumno}}">
                                                        <td>{{$alumno->id_alumno}}</td>
                                                        <td>
                                                            {{$alumno->nombre}}<br>
                                                            {{$alumno->apellido_paterno}}<br>
                                                            {{$alumno->apellido_materno}}
                                                        </td>
                                                        <td>{{$alumno->rut}}</td>
                                                        <td>
                                                            <strong>Email :</strong> {{$alumno->email}}<br>
                                                            <strong>Dirección :</strong> {{$alumno->direccion}}<br>
                                                            <strong>Fono :</strong> {{$alumno->fono}}
                                                        </td>
                                                        <td>{{$alumno->anno_ingreso}}</td>
                                                        <td>{{$alumno->carrera}}</td>
                                                        <td class="text-truncate text-center">
                                                            <strong>Semestre:</strong> {{ $alumno->semestre_proyecto }} <br>
                                                            <strong>Año:</strong>	{{ $alumno->anno_proyecto }}</td>
                                                        <td>
                                                            <a href="{{route('editar_alumno',[$alumno->id_alumno])}} "><button id="{{$alumno->id_alumno}}" class="btn btn-warning">Editar</button></a>
                                                            <a href="#"><button id="{{$alumno->id_alumno}}" class="btn btn-danger" onclick="borrar('{{$alumno->id_alumno}}', '{{$alumno->nombre}}', '{{route('borrar_alumno',[$alumno->id_alumno])}}')">Borrar</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p>No existen alumnos en este momento</p>
                            @endif
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
                            <a href="{{route ('crear_alumno')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
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
              title: 'Estas seguro de querer eliminar el alumno '+name+'?',
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
                              'El alumno ha sido eliminado.',
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
