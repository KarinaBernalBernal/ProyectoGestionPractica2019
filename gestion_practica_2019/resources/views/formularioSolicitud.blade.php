@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SOLICITUD DE AUTORIZACIÓN PRÁCTICA PROFESIONAL</h1>
        </div>

        {{-- Antecendentes Generales --}}
        
         <form action="{{route('agregarSolicitud')}}" enctype="multipart/form-data" method="POST" role="form">
            <div class="card text">
                <div class="card-body">  
                {{ csrf_field() }} 
                    <h6>1.- Antecendentes Generales</h6>    

                    {{-- Nombre --}}   
                    <div class="form-group row">
                        <label for="nombreAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>
                        
                        <div class="col-md-6">
                            <input id="nombreAlumno" type="text" class="form-control" name="nombreAlumno" value="{{ old('nombreAlumno') }}" required>
                        </div>
                    </div>

                    {{-- Apellido Paterno --}} 
                    <div class="form-group row">
                        <label for="APaternoAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                        <div class="col-md-6">
                            <input id="APaternoAlumno" type="text" class="form-control" name="APaternoAlumno" value="{{ old('APaternoAlumno') }}" required>
                        </div>
                    </div>

                    {{-- Apellido Materno --}}
                    <div class="form-group row">
                        <label for="AMaternoAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                        <div class="col-md-6">
                            <input id="AMaternoAlumno" type="text" class="form-control" name="AMaternoAlumno" value="{{ old('AMaternoAlumno') }}" required>
                        </div>
                    </div> 

                    {{-- RUT --}}
                    <div class="form-group row">
                        <label for="rutAlumno" class="col-md-3 col-form-label text-md-right">{{ __('RUT') }}</label>

                        <div class="col-md-6">
                            <input id="rutAlumno" type="text" class="form-control" name="rutAlumno" value="{{ old('rutAlumno') }}" required>
                        </div>
                    </div>   

                     {{-- Direccion --}}
                    <div class="form-group row">
                        <label for="direccion" class="col-md-3 col-form-label text-md-right">{{ __('Dirección') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                        </div>
                    </div>  

                     {{-- Fono --}}
                    <div class="form-group row">
                        <label for="fono" class="col-md-3 col-form-label text-md-right">{{ __('Fono') }}</label>

                        <div class="col-md-6">
                            <input id="fono" type="text" class="form-control" name="fono" value="{{ old('fono') }}" required>
                        </div>
                    </div>    

                    {{-- Año de ingreso a la carrera --}}
                    <div class="form-group row">
                        <label for="AñoCarrera" class="col-md-3 col-form-label text-md-right">{{ __('Año de Ingreso a la Carrera') }}</label>

                        <div class="col-md-2">
                            <input id="AñoCarrera" type="number" class="form-control" name="AñoCarrera" value="{{ old('AñoCarrera') }}" required>
                        </div>
                    </div>    

                    {{-- Carrera --}}
                    <div class="form-group row">
                        <label for="carrera" class="col-md-3 col-form-label text-md-right">{{ __('Carrera') }}</label>

                        <div class="col-md-6"> 
                            <select id="carrera" name="carrera" class="custom-select">
                                <option selected value="">Selecciona...</option>
                                <option>Ingeniería Civil Informática</option>
                                <option>Ingeniería de Ejecución Informática</option>
                            </select>      
                        </div>
                    </div>

                    {{-- Practica Profesional --}} 
                    <h6>2.- Si es alumno de Ingeniería Civil. ¿Ha realizado su primera <strong>Práctica Profesional</strong>?</h6>

                    <div class="form-group row">
                        <label for="practica" class="col-md-3 col-form-label text-md-right">{{ __('') }}</label>

                        <div class="col-md-2">
                            <select id="practica" name="practica" class="custom-select">
                                <option selected value="">Selecciona...</option>
                                <option>Si</option>
                                <option>No</option>
                            </select>     
                        </div> 
                    </div>

                    {{-- Avance Curricular --}}
                    <h6>3.- Según su avance curricular, cuando realizaria la asignatura <strong>Proyecto de Título</strong>?</h6>

                    {{-- Semestre --}} 
                    <div class="form-group row">
                        <label for="semestre" class="col-md-3 col-form-label text-md-right">{{ __('Semestre') }}</label>

                        <div class="col-md-2">
                            <input id="semestre" type="number" class="form-control" name="semestre" value="{{ old('semestre') }}" required>
                        </div>
                    </div>    

                    {{-- AñoProyecto --}}
                    <div class="form-group row">
                        <label for="AñoProyecto" class="col-md-3 col-form-label text-md-right">{{ __('Año') }}</label>

                        <div class="col-md-2">
                            <input id="AñoProyecto" type="number" class="form-control" name="AñoProyecto" value="{{ old('AñoProyecto') }}" required>
                        </div>
                    </div>

                    <div class="row justify-content-end ">
                        <div class="col-md-6">
                            <a href="{{route('home2')}} " class="btn btn-secondary btn-lg">Cancelar</a>
                        </div>
                        <div class="col-md-6">
                            <input class="btn btn-primary btn-lg" type="submit" value="Agregar">
                        </div>
                    </div>
                </div>
            </div>
        </form>    
    </div>
@endsection
