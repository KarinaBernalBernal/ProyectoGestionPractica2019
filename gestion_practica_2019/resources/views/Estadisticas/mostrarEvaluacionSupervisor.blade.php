@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Evaluación del Supervisor</h3>
    </div>
        
    <div class="card text">
        <div class="card-body"> 
            {{-- evaluacion --}}
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    <h3>evaluación del alumno</h3>
                    <hr>
                </div>
            </div> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    @if($evaluacion <> NULL)
                        {{-- evaluacion --}}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Fecha de evaluación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-left">{{$evaluacion->f_entrega_eval}}</label>
                            </div>
                        </div>
                        
                        {{-- fortalezas --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>fortalezas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <ol>
                                @foreach($fortalezas as $fortaleza)
                                    <li>
                                        <label class="col-form-label text-md-right">{{$fortaleza->n_fortaleza}}</label>
                                        <!--<label class="col-form-label text-md-justify">{{$fortaleza->dp_fortaleza}}</label> 
                                            -->
                                    </li>
                                @endforeach                   
                            </ol> 
                        </div>

                        {{-- debilidades --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>debilidades</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <ol>
                                @foreach($debilidades as $debilidad)
                                    <li>
                                        <label class="col-form-label text-md-right">{{$debilidad->n_debilidad}}</label>
                                        <!--<label class="col-form-label text-md-justify">{{$debilidad->dp_debilidad}}</label> 
                                            -->
                                    </li>
                                @endforeach                   
                            </ol> 
                        </div>

                        {{-- Areas --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Áreas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group row">   
                                    <div class="col-md-9"> 
                                        @foreach($areaEvals as $areaEval)
                                            @foreach($areas as $area)
                                                @if($areaEval->id_area == $area->id_area )
                                                    <label class="col-form-label text-md-right">{{$area->n_area}}</label>
                                                @endif
                                            @endforeach
                                            @if($loop->count <> $loop->iteration)
                                                <label >-</label>
                                            @endif
                                        @endforeach    
                                    </div>
                                </div>                  
                            </div> 
                        </div>                 
                    @else
                        No existe la autoevaluación del alumno seleccionado.
                    @endif
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ URL::previous() }}"><button class="btn btn-secondary">Atrás</button></a>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection