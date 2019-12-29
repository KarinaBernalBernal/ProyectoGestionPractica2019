@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Estadísticas del alumno</h3>
    </div>
        
    <div class="card text">
        <div class="card-body"> 
        {{-- Datos del alumno --}}
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    <h5>Datos del alumno</h5>
                    <hr>
                </div>
            </div>

            <div class="form-group row justify-content-md-center">
                <div class="col-md-11">
                        {{-- Rut --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Rut') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$alumno->rut}}</label>
                            </div>
                        </div>

                        {{-- Nombre --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Nombre') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$alumno->nombre}}</label>
                            </div>
                        </div>

                        {{-- Apellido paterno --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Apellido paterno') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$alumno->apellido_paterno}}</label>
                            </div>
                        </div>

                        {{-- Apellido materno --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Apellido materno') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$alumno->apellido_materno}}</label>
                            </div>
                        </div>

                        {{-- Año de Ingreso --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Año de ingreso') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$alumno->anno_ingreso}}</label>
                            </div>
                        </div>

                        {{-- Carrera --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Carrera') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$alumno->carrera}}</label>
                            </div>
                        </div>
                </div>
            </div>

        {{-- Datos de Practica --}}
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    <h5>Datos de práctica</h5>
                    <hr>
                </div>
            </div>
            
            @foreach($practicas as $practica) 
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-12">
                        <h6>Práctica {{ $loop->iteration }}</h6>
                    </div>
                </div>

                <div class="form-group row justify-content-md-center">
                    <div class="col-md-11">
                        
                        {{-- Fecha inscripción --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Fecha de inscripción') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$practica->f_inscripcion}}</label>
                            </div>
                        </div>
                        <br>

                        @foreach($supervisores as $supervisor)
                            @if($practica->id_supervisor == $supervisor->id_supervisor)

                                @foreach($empresas as $empresa)
                                    @if($supervisor->id_empresa == $empresa->id_empresa)
                                        {{-- Empresa --}}
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <label class="col-form-label text-md-right" >{{ __('Empresa') }}</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="col-form-label text-md-right" >:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="col-form-label text-md-right">{{$empresa->n_empresa}}</label>
                                            </div>
                                        </div>
                                    @endif                            
                                @endforeach
                                
                                {{-- Supervisor --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="col-form-label text-md-right" >{{ __('Supervisor') }}</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="col-form-label text-md-right" >:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="col-form-label text-md-right">{{$supervisor->nombre}} {{$supervisor->apellido_paterno}}</label>
                                    </div>
                                </div>
                            
                            @endif                            
                        @endforeach

                        {{-- Fecha inicio --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Fecha inicio') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$practica->f_desde}}</label>
                            </div>
                        </div>

                        {{-- Fecha termino --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Fecha termino') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$practica->f_hasta}}</label>
                            </div>
                        </div>
                        <br>
                        @foreach($resoluciones as $resolucion)
                            @if($resolucion->id_practica == $practica->id_practica )
                                {{-- Resultados practica --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="col-form-label text-md-right" >{{ __('Resultado práctica') }}</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="col-form-label text-md-right" >:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="col-form-label text-md-right">{{$resolucion->resolucion_practica}}</label>
                                    </div>
                                </div>
                                {{-- observacion practica --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="col-form-label text-md-right" >{{ __('Observación práctica') }}</label>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="col-form-label text-md-right" >:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="col-form-label text-md-right">{{$resolucion->observacion_resolucion}}</label>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        <div class="row">
                            <div class="col-md-12">
                                <a id='botonMostrarAutoevaluacionAlumno' class='btn btn-info btn-sm' href="{{ route('mostrarAutoevaluacionAlumno',['id'=>$practica->id_practica])}}" >Ver autoevaluación</a>
                                <a id='botonMostrarAutoevaluacionAlumno' class='btn btn-info btn-sm' href="{{ route('mostrarEvaluacionSupervisor',['id'=>$practica->id_practica])}}" >Ver evaluación del supervisor</a>
                                <a id='botonMostrarComparativaEvaluaciones' class='btn btn-info btn-sm' href="{{ route('mostrarComparativaEvaluaciones',['id'=>$practica->id_practica])}}" >Comparativa de criterios de evaluaciones</a>
                                
                                @if($alumno->carrera == 'Ingeniería Civil en Informatica')
                                    <a id='avance' class='btn btn-info btn-sm' href="{{ route('avanceCivil',['id'=>$practica->id_practica])}}" >Avance</a>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
                <br>
            @endforeach 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ URL::previous() }}"><button class="btn btn-secondary">Atrás</button></a>
                    </div>  
                </div>
            <div>      
        </div>
    </div>
</div>  

@endsection
                