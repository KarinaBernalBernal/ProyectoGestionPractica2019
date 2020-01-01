@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SOLICITUD CARTA PRESENTACIÓN Y/O SEGURO ESCOLAR</h1>
        </div>
        
        <form action="{{route('agregarSolicitudDocumentos')}}" enctype="multipart/form-data" method="POST" role="form">
            {{ csrf_field() }} 

            <div class="card text">                
                <div class="card-body">

                    <h5>Documentos y periodo de práctica</h5>   

                    <hr>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="cartaPresentacion" class="col-form-label col-4">{{ __('Carta Presentación') }}</label>
                            <input type="checkbox" class="col-form-label text-md-right col-1" name="cartaPresentacion">
                        </div>

                        <div class="col-md-6">
                            <label for="seguroEscolar" class="col-form-label col-4">{{ __('Seguro Escolar') }}</label>
                            <input type="checkbox" class="col-form-label text-md-left col-1" name="seguroEscolar">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="fechaDesde" class="col-md-3 col-form-label">{{ __('Desde') }}</label>
                            <input id="fechaDesde" type="date" name="fechaDesde" min="<?php echo date("Y-m-d");?>" required >
                        </div>
                        <div class="col-md-6">
                            <label for="fechaHasta" class="col-md-3 col-form-label">{{ __('Hasta') }}</label>
                            <input id="fechaHasta" type="date" name="fechaHasta" required disabled>
                        </div>
                    </div>
                </div>                
            </div>

            <br>
            
            {{-- Datos de la empresa --}}

            <div class="card text">
                <div class="card-body"> 

                    <h5>Datos de la empresa</h5> 

                    <hr>

                    {{-- Nombre --}}
                    <div class="form-group form-row">
                        <label for="n_destinatario" class="col-md-3 col-form-label text-right">Nombre a quien se dirige la carta</label>

                        <div class="col-md-6">
                            <input id="n_destinatario" type="text" class="form-control" name="n_destinatario" value="{{ old('n_destinatario') }}" required>
                        </div>
                    </div>

                    {{-- Cargo --}}   
                    <div class="form-group form-row">
                        <label for="cargo" class="col-md-3 col-form-label text-md-right">{{ __('Cargo') }}</label>
                        
                        <div class="col-md-6">
                            <input id="cargo" type="text" class="form-control" name="cargo" value="{{ old('cargo') }}" required>
                        </div>
                    </div>

                    {{-- Departamento --}}   
                    <div class="form-group form-row">
                        <label for="departamento" class="col-md-3 col-form-label text-md-right">{{ __('Departamento') }}</label>

                        <div class="col-md-6">
                            <input id="departamento" type="text" class="form-control" name="departamento" value="{{ old('departamento') }}" required>
                        </div>
                    </div>

                    {{-- Empresa --}}   
                    <div class="form-group form-row">
                        <label for="empresa" class="col-md-3 col-form-label text-md-right">{{ __('Empresa') }}</label>
                        
                        <div class="col-md-6">
                            <input id="empresa" type="text" class="form-control" name="empresa" value="{{ old('empresa') }}" required>
                        </div>
                    </div>

                    {{-- Ciudad --}}  
                    <div class="form-group form-row">
                        <label for="ciudad" class="col-md-3 col-form-label text-md-right">{{ __('Ciudad') }}</label>
                        
                        <div class="col-md-6">
                            <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" required>
                        </div>
                    </div>

                    <br>

                    <div class="row justify-content-end ">
                        <div class="col-md-4">
                            <a href="{{route('descripcionSolicitudDocumentos')}} " class="btn btn-secondary">Cancelar</a>
                        </div>
                        <div class="col-md-4">
                            <input class="btn btn-primary" type="submit" value="Agregar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        {{--Metodo para validar el rango de las fechas--}}
        $('#fechaDesde').change(function()
        {
            $('#fechaHasta').removeAttr('disabled');
            $('#fechaHasta').attr('min', $('#fechaDesde').val());
        });
    </script>
@endsection 