@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Reporte de Alumnos</h3>
        <br>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container">
        <h4>Filtros</h4>
    
        <form class="form-horizontal" action="{{route('reporte_alumnos')}}" method="get">
            <div class="row">
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
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-info">buscar</button>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="text-center">
                @if (count($lista)>0)
                    <!-- DATA TABLES -->
                    <div class="row d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="MyTable">
                                <thead class="bg-dark" style="color: white">

                                <tr >
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>RUT</th>
                                    <th>Datos de contacto</th>
                                    <th>Año ingreso</th>
                                    <th>Carrera</th>
                                    <th>Estimación semestres</th>   
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
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr >
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>RUT</th>
                                    <th>Datos de contacto</th>
                                    <th>Año ingreso</th>
                                    <th>Carrera</th>
                                    <th>Estimación semestres</th>
                                </tr>
                                </tfoot>
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
            
        </div>
    </div>
@endsection
