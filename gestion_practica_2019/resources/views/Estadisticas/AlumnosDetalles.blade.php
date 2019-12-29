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
                    <div class="col-3 mb-2">
                        <label>Nombre</label>
                        <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Ingrese nombre...">
                    </div>
    
                    <div class="col-3 mb-2">
                        <label>Apellido Paterno</label>
                        <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Ingrese apellido Paterno...">
                    </div>
                    <div class="col-3 mb-2">
                        <label>Apellido Materno</label>
                        <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" placeholder="Ingrese apellido Materno...">
                    </div>
                    <div class="col-3 mb-2">
                        <label>Correo electronico</label>
                        <input id="email" type="text" class="form-control" name="email" placeholder="Ingrese correo electronico...">
                    </div>
                    <div class="col-3 mb-2">
                        <label>Año de ingreso</label>
                        <input id="anno_ingreso" type="number" class="form-control" name="anno_ingreso" placeholder="Ingrese año de ingreso...">
                    </div>
                    <div class="col-3 mb-2">
                        <label>Carrera</label>
                        <select id="carrera" type="text" class="form-control" name="carrera">
                            <option value="">Seleccione Carrera</option>
                            <option value="Ingeniería Civil en Informatica">Ingeniería Civil en Informatica</option>
                            <option value="Ingeniería de Ejecución en Informatica">Ingeniería de Ejecución en Informatica</option>
                        </select>
                    </div>
                    
                </div>
    
                <div class="row">
                    <div class="col mb-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            <span>Buscar</span>
                        </button>
                    </div> 
                </div>

            </form>
            <div class="container-fluid">
                <div class="justify-content-center">
                    <div class="text-center">
                        @if (count($lista)>0)
                            <!-- DATA TABLES -->
                            <div class="row d-flex justify-content-center">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable">
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
                                                        @if($alumno->carrera == 'Ingeniería Civil en Informatica')
                                                            <a id='avance' class='btn btn-info btn-sm' href="{{ route('avanceCivil',['id'=>$alumno->id_alumno])}}" >Avance</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $lista->links() }}
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