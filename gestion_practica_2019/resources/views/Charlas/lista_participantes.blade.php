@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h4>Agregar Estudiante Invitado</h4></div>
                    <div class="card-body">
                        {{ csrf_field() }}
                        <form class="form-horizontal" action="{{route('lista_participantes',[$idCharla] )}}" method="get" id="filtro">
                            <div class="row">
                                <div class="col-2 mb-2">
                                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                                <div class="col-2 mb-2">
                                    <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido">
                                </div>
                                <div class="col-2 mb-2">
                                    <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut">
                                </div>
                                <div class="col-2">
                                    <select id="resolucion_charla" type="text" class="form-control" name="resolucion_charla" placeholder="">
                                        <option value="">Estado</option>
                                        <option value="pendiente">Pendiente</option>
                                    </select>
                                </div>
                                <div class="col-3">
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
                        </form>
                        <hr>
                        <form action="{{route('agregar_participante',[$idCharla] )}}" method="POST">
                        <div class="container-fluid">
                            <div class="justify-content-center">
                                <div class="text-center">
                                {{ csrf_field() }}
                                @if (count($alumnos)>0)
                                    <!-- DATA TABLES -->
                                        <div class="row d-flex justify-content-center container-fluid">
                                            <div class="table-responsive">
                                                <table class="table table-bordered " id="MyTable">
                                                    <thead class="bg-dark" style="color: white">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Rut</th>
                                                        <th>Estado</th>
                                                        <th>Invitar</th>
                                                    </tr >
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($alumnos as $alumno)
                                                        <tr id="{{$alumno->id_alumno}}">
                                                            <td>
                                                                {{$alumno->nombre}}
                                                                {{$alumno->apellido_paterno}}
                                                            </td>
                                                            <td>{{$alumno->rut}}</td>
                                                            @if($alumno->resolucion_charla != "no aplica")
                                                                <td>{{$alumno->resolucion_charla}}</td>
                                                                @else
                                                                    <td>-</td>
                                                            @endif
                                                            <td>
                                                                <div>
                                                                    <input type="checkbox" name="invitacion[]" value="{{ $alumno->id_alumno }}" >
                                                                </div>
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
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                                <a href="{{route('lista_charlas')}}"><button class="btn btn-secondary" type="button">Atrás</button></a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        {{ $alumnos->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>
@endsection