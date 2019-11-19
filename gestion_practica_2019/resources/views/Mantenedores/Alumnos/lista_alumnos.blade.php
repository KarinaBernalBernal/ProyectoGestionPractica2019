@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Mantenedor de Alumnos</h3>

        <br>
    
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card text">
            <div class="card-body"> 
                <form class="form-horizontal" action="{{route('lista_alumnos')}}" method="get">
            
                    <h4>Filtros</h4>

                    <hr>
        
                    <div class="row">
                        <div class="col-3 mb-2">
                            <input id="buscador" type="text" class="form-control" name="buscador" placeholder="Ingrese palabra clave...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Ingrese nombre...">
                        </div>

                        <div class="col-3 mb-2">
                            <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Ingrese Apellido Paterno...">
                        </div>
                        <div class="col-3 mb-2">
                             <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" placeholder="Ingrese Apellido Materno...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="email" type="text" class="form-control" name="email" placeholder="Ingrese email...">
                        </div>
                        <div class="col-3 mb-2">
                            <input id="anno_ingreso" type="text" class="form-control" name="anno_ingreso" placeholder="Ingrese año de ingreso...">
                        </div>
                        <div class="col-3 mb-2">
                            <select id="carrera" type="text" class="form-control" name="carrera" placeholder="Ingrese año de ingreso">
                                <option value="">Seleccione Carrera</option>
                                <option value="Ingeniería Civil en Informatica">Ingeniería Civil en Informatica</option>
                                <option value="Ingeniería de Ejecución en Informatica">Ingeniería de Ejecución en Informatica</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">buscar</button>
                    </div>
                </form>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="text-center">
                            @if (count($lista)>0)
                                <!-- DATA TABLES -->
                                <div class="row d-flex justify-content-center">
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
                                                <th>Estimación semestres</th>
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
                                                            Email : {{$alumno->email}}<br>
                                                            Dirección : {{$alumno->direccion}}<br>
                                                            Fono : {{$alumno->fono}}
                                                        </td>
                                                        <td>{{$alumno->anno_ingreso}}</td>
                                                        <td>{{$alumno->carrera}}</td>
                                                        <td>{{$alumno->estimacion_semestre}}</td>
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
                            <a href="{{route ('crear_alumno')}}"><button id="boton_agregar" class="btn btn-primary btn-lg">Agregar</button></a>
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
