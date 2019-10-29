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
                        <label for="aPaternoAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                        <div class="col-md-6">
                            <input id="aPaternoAlumno" type="text" class="form-control" name="aPaternoAlumno" value="{{ old('aPaternoAlumno') }}" required>
                        </div>
                    </div>

                    {{-- Apellido Materno --}}
                    <div class="form-group row">
                        <label for="aMaternoAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                        <div class="col-md-6">
                            <input id="aMaternoAlumno" type="text" class="form-control" name="aMaternoAlumno" value="{{ old('aMaternoAlumno') }}" required>
                        </div>
                    </div> 

                    {{-- RUT --}}
                    <div class="form-group row">
                        <label for="rutAlumno" class="col-md-3 col-form-label text-md-right">{{ __('RUT') }}</label>

                        <div class="col-md-6">
                            <input id="rutAlumno" type="text" class="form-control" name="rutAlumno" value="{{ old('rutAlumno') }}" maxlength="10" minlength="10" required pattern="[0-9]{8}-[K-k0-9]{1}">
                            <label for="rutAlumno" class="font-italic">Ej. 12345678-9</label>
                        </div>
                    </div>

                    {{-- Correo Electronico --}}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                        <label for="email" class="col-md-3 col-form-label text-md-right control-label">Correo electronico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
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
                            <input id="fono" type="number" class="form-control" name="fono" value="{{ old('fono') }}"minlength="9">
                            <label for="fono" class="font-italic">Ej. 9 87654321</label>
                        </div>
                    </div>    

                    {{-- Año de ingreso a la carrera --}}
                    <div class="form-group row">
                        <label for="añoCarrera" class="col-md-3 col-form-label text-md-right">{{ __('Año de Ingreso a la Carrera') }}</label>

                        <div class="col-md-2">
                            <input id="añoCarrera" type="number" class="form-control" name="añoCarrera" value="{{ old('añoCarrera') }}" maxlength="4" minlength="4" min="2000" required>
                            <label for="añoCarrera" class="font-italic">Ej. 2019</label>
                        </div>
                    </div>    

                    {{-- Carrera --}}
                    <div class="form-group row">
                        <label for="carrera" class="col-md-3 col-form-label text-md-right">{{ __('Carrera') }}</label>

                        <div class="col-md-6">
                            <select id="carrera" name="carrera" class="custom-select" required>
                                <option selected value="">Selecciona...</option>
                                <option value="Ingeniería Civil Informática">Ingeniería Civil Informática</option>
                                <option value="Ingeniería de Ejecución Informática">Ingeniería de Ejecución Informática</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    {{-- Practica Profesional --}}
                    <div id="prueba">
                    <h6>2.- Si es alumno de Ingeniería Civil. ¿Ha realizado su primera <strong>Práctica Profesional</strong>? (Solo Ing. Civil Informática)</h6>
                        <div class="form-group row">
                        <label for="practica" class="col-md-3 col-form-label text-md-right">{{ __('') }}</label>

                        <div class="col-md-2">
                            <select id="practica" name="practica" class="custom-select">
                                <option selected value="">Selecciona...</option>
                                <option value ="Si">Si</option>
                                <option value ="No">No</option>
                            </select>     
                        </div> 
                    </div>
                    </div>

                    <br>

                    {{-- Avance Curricular --}}
                    <h6>3.- Según su avance curricular, en que semestre se realizaria la asignatura <strong>Proyecto de Título</strong>?</h6>

                    {{-- Semestre --}}

                    <div class="form-group row">
                        <label for="semestreProyecto" class="col-md-3 col-form-label text-md-right">{{ __('Semestre') }}</label>

                        <div class="col-md-2">
                            <select id="semestreProyecto" name="semestreProyecto" class="custom-select" required>
                                <option selected value="">Selecciona...</option>
                                <option value ="1">1</option>
                                <option value ="2">2</option>
                            </select>
                        </div>
                    </div>
                    {{-- AñoProyecto --}}
                    <div class="form-group row">
                        <label for="añoProyecto" class="col-md-3 col-form-label text-md-right">{{ __('Año') }}</label>

                        <div class="col-md-2">
                            <input id="añoProyecto" type="number" class="form-control" name="añoProyecto" value="{{ old('añoProyecto') }}" maxlength="4" minlength="4" min="2000"required>
                            <label for="añoProyecto" class="font-italic">Ej. 2019</label>
                        </div>
                    </div>

                    <br>
                    {{--Botones--}}
                    <div class="row justify-content-end ">
                        <div class="col-md-4">
                            <button id="cancelar" class="btn btn-secondary" type="button">Cancelar</button>
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
@section('scripts')

    {{--Metodo para esconder la opcion de "se ha realizado su primera practica profesional--}}
    <script>
        $(document).ready(function ()
        {
            $('#carrera').change(function()
            {
                if($("#carrera").val() != "Ingeniería Civil Informática"){
                    $('#prueba').hide();
                }
                else{
                    $('#prueba').show();
                }

            });
        });
    </script>

    {{--Metodo para mostrar pantalla para el boton "cancelar"--}}
    <script>
        $('#cancelar').click(function()
        {
            Swal({
                title: 'Estas seguro de querer cancelar?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No!',
                confirmButtonText:'Si!'

            }).then((result) =>
            {
                if (result.value)
                {
                    window.location.href = "{{route('descripcionSolicitud')}}"
                }
            })
        });
    </script>


@endsection
