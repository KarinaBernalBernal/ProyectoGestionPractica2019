@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <h3>Estadísticas por alumno</h3>

    <br>

    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="card text">
        <div class="card-body"> 
            <form class="form-horizontal" action="{{route('estadisticaAlumno')}}" method="get">
                <div class="row">
                    <div class="col-sm-12 mb-6">
                        <div class="row">
           
                            <div class="col-sm-3">
                                <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                            </div>
                
                            <div class="col-sm-3">
                                <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido paterno">
                            </div>
                
                            <div class="col-sm-3">
                                <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" placeholder="Apellido materno">
                            </div>
                            <div class="col-sm-3 ">
                                <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut: Ej. 11111111-1">
                            </div>
                        </div>
                    </div>
                </div> 
                <br> 
                <div class="row">
                    <div class="col-sm-12 mb-12"">
                        <div class="row">
                            
                            <div class="col-sm-3">
                                <input id="anno_ingreso" type="number" min="1" pattern="^[0-9]+" class="form-control" name="anno_ingreso" placeholder="Año de ingreso">
                            </div>
                    
                            <div class="col-sm-4">
                                <select id="carrera" type="text" class="form-control" name="carrera">
                                    <option value="">Seleccione carrera...</option>
                                    <option value="Ingeniería Civil Informatica">Ingeniería Civil en Informatica</option>
                                    <option value="Ingeniería de Ejecución Informática">Ingeniería de Ejecución en Informatica</option>
                                </select>
                            </div>


                       
                 
                    <div class="col-sm-2 mb-12">
                        <button type="submit" class="btn btn-primary" name="buscador"><i class="fas fa-search"></i><span> Buscar</span></button>
                    </div>
                
                </div>
            </form>
            <br> 
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        @if (count($lista)>0)
                            <!-- DATA TABLES -->
                            <div class="row d-flex justify-content-center table-responsive">
                                
                                    <table class="table-center table-bordered col-12 mr-10" id="dataTable">
                                        <thead class="bg-dark" style="color: white">
                                            
                                            <tr >
                                                <th>Id</th>
                                                <th>Nombre</th>
                                                <th>RUT</th>
                                                <th>Año ingreso</th>
                                                <th>Carrera</th>
                                                <th>Opción</th>
                                            </tr >
                                            <colgroup>
                                                <col width="5%">
                                                <col width="28%">
                                                <col width="15%">
                                                <col width="12%">
                                                <col width="30%">
                                                <col width="10%">
                                            </colgroup>
                                        </thead>
                                        <tbody>
                                            @foreach ($lista as $alumno)
                                                <tr id="{{$alumno->id_alumno}}">
                                                    <td>{{$alumno->id_alumno}}</td>
                                                    <td>
                                                        {{$alumno->nombre}} 
                                                        {{$alumno->apellido_paterno}} 
                                                        {{$alumno->apellido_materno}}
                                                    </td>
                                                    <td>{{$alumno->rut}}</td>
                                                    <td>{{$alumno->anno_ingreso}}</td>
                                                    <td>{{$alumno->carrera}}</td>
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
                    <a id="botonCerrar" href="{{ route('home') }}"><button class="btn btn-secondary">Atras</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection