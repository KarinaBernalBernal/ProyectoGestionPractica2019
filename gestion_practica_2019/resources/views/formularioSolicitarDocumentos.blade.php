@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SOLICITUD CARTA PRESENTACIÓN Y/O SEGURO ESCOLAR</h1>
        </div>
        
        <form action="{{route('agregarSolicitudDocumentos')}}" enctype="multipart/form-data" method="POST" role="form">
            {{ csrf_field() }} 

            {{-- Documentos solicitados --}}

            <div class="card text">
                 <div class="card-header">
                    <h6>Documentos y periodo de práctica</h6>    
                </div>
                
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="cartaPresentacion" class="col-md-5 col-form-label">{{ __('Carta presentación') }}</label>
                            <input type="checkbox" name="cartaPresentacion" required>
                        </div>

                        <div class="col-md-4">
                            <label for="seguroEscolar" class="col-md-5 col-form-label">{{ __('Seguro escolar') }}</label>
                            <input type="checkbox" name="seguroEscolar">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="fechaDesde" class="col-md-3 col-form-label">{{ __('Desde') }}</label>
                            <input type="date" name="fechaDesde" required>
                        </div>

                        <div class="col-md-4">
                            <label for="fechaHasta" class="col-md-3 col-form-label">{{ __('Hasta') }}</label>
                            <input type="date" name="fechaHasta" required>
                        </div>
                    </div>
                </div>                
            </div>

            <br>
            
            {{-- Datos de la empresa --}}

            <div class="card text">
                <div class="card-header"> 
                    <h6>Datos de la empresa</h6> 
                </div>
                <div class="card-body"> 
                    
                    {{-- Nombre --}}   
                    <div class="form-group row">
                        <label for="nombreAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Nombre a quien se dirige la carta') }}</label>
                        
                        <div class="col-md-6">
                            <input id="nombreAlumno" type="text" class="form-control" name="nombreAlumno" value="{{ old('nombreAlumno') }}" required>
                        </div>
                    </div>

                    {{-- Cargo --}}   
                    <div class="form-group row">
                        <label for="nombreAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Cargo') }}</label>
                        
                        <div class="col-md-6">
                            <input id="nombreAlumno" type="text" class="form-control" name="nombreAlumno" value="{{ old('nombreAlumno') }}" required>
                        </div>
                    </div>

                    {{-- Departamento --}}   
                    <div class="form-group row">
                        <label for="nombreAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Departamento') }}</label>
                        
                        <div class="col-md-6">
                            <input id="nombreAlumno" type="text" class="form-control" name="nombreAlumno" value="{{ old('nombreAlumno') }}" required>
                        </div>
                    </div>

                    {{-- Empresa --}}   
                    <div class="form-group row">
                        <label for="nombreAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Empresa') }}</label>
                        
                        <div class="col-md-6">
                            <input id="nombreAlumno" type="text" class="form-control" name="nombreAlumno" value="{{ old('nombreAlumno') }}" required>
                        </div>
                    </div>

                     {{-- Ciudad --}}
                    <div class="form-group row">
                        <label for="direccion" class="col-md-3 col-form-label text-md-right">{{ __('Ciudad') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                        </div>
                    </div>  

                    <br>
                    
                    <div class="row justify-content-end ">
                        <div class="col-md-4">
                            <a href="{{route('descripcionSolicitud')}} " class="btn btn-secondary">Cancelar</a>
                        </div>
                        <div class="col-md-4">
                            <input class="btn btn-primary" type="submit" value="Agregar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection