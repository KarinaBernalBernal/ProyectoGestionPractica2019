@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <h3>Rendimiento de Alumnos</h3>

    <br>

    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="card text">
        <div class="card-body"> 
            <form class="form-horizontal" action="{{route('estadisticaAlumno')}}" method="get">
                <div class="row">
                    <div class="col-sm-2 mb-1">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Ingrese nombre...">
                    </div>
    
                    <div class="col-sm-2 mb-1">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Ingrese apellido...">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" placeholder="Ingrese apellido...">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="anno_ingreso">Año de ingreso</label>
                        <input id="anno_ingreso" type="number" min="1" pattern="^[0-9]+" class="form-control" name="anno_ingreso" placeholder="Ingrese año...">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="carrera">Carrera</label>
                        <select id="carrera" type="text" class="form-control" name="carrera">
                            <option value="">Seleccione...</option>
                            <option value="Ingeniería Civil en Informatica">Ingeniería Civil en Informatica</option>
                            <option value="Ingeniería de Ejecución en Informatica">Ingeniería de Ejecución en Informatica</option>
                        </select>
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="rut">Rut</label>
                        <input id="rut" type="text" class="form-control" name="rut" placeholder="Ingrese Rut...">
                        <label for="rut" class="font-italic"> Ej. 11111111-1</label>
                    </div>
                     
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="buscador">
                        <i class="fas fa-search"></i>
                        <span>Buscar</span>
                    </button>
                </div>
            </form>
            
            <div class="container-fluid">
                <div class="justify-content-center">
                    <div class="text-center">
                        @if (count($lista)>0)
                            <!-- DATA TABLES -->
                            <div class="row d-flex justify-content-center">
                                <div class="table-responsive">
                                    <table class="table-center table-bordered col-10 mr-12" id="dataTable">
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
                                                        <a id='botonRevisar' class='btn btn-primary btn-sm' href="{{ route('datosAlumno',['id'=>$alumno->id_alumno])}}" >Ver</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row d-flex justify-content-center">
                                        {{ $lista->links() }}
                                    </div>
                                    
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

            <div class="row">
                <div class="col">
                    <a id="botonCerrar" href="{{ route('home') }}"><button class="btn btn-primary">Atras</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection