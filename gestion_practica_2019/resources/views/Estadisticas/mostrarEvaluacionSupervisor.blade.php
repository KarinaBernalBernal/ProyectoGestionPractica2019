@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="card text">
        <div class="card-body">
            {{-- Evaluacion del supervisor --}}
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    <h3>Evaluación del supervisor</h3>
                    <hr>
                </div>
            </div> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    @if($evaluacionSupervisor <> NULL)
                        {{-- evaluacion --}}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Fecha de evaluación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-left">{{$evaluacionSupervisor->f_entrega_eval}}</label>
                            </div>
                        </div>
                        
                        {{-- fortalezas --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Fortalezas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                <ul>
                                    @foreach($fortalezas as $fortaleza)
                                        <li>
                                            <p>
                                                <a class="col-form-label text-md-left" data-toggle="collapse" href="#collapseFortalezas" aria-expanded="false" aria-controls="collapseExample">{{$fortaleza->n_fortaleza}}</a>
                                            </p>
                                            <div class="collapse" id="collapseFortalezas">
                                                <div class="card card-body">
                                                    <label class="col-form-label text-md-justify">{{$fortaleza->dp_fortaleza}}</label> 
                                                </div>
                                            </div>                                            
                                        </li>    
                                    @endforeach                   
                                </ul> 
                            </div>
                        </div>

                        {{-- debilidades --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Debilidades</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                <ul>
                                    @foreach($debilidades as $debilidad)
                                        <li>
                                            <p>
                                                <a class="col-form-label text-md-left" data-toggle="collapse" href="#collapseDebilidades" aria-expanded="false" aria-controls="collapseExample">{{$fortaleza->n_fortaleza}}</a>
                                            </p>
                                            <div class="collapse" id="collapseDebilidades">
                                                <div class="card card-body">
                                                    <label class="col-form-label text-md-justify">{{$debilidad->dp_debilidad}}</label> 
                                                </div>
                                            </div>                                            
                                        </li>    
                                    @endforeach                   
                                </ul>
                            </div>
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
                        {{-- Evaluacion supervisor --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Evaluación del supervisor</h5>
                                <hr>
                                <h6>Actitud del alumno</h6>                       
                                                       
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalActPractica <> NULL)
                                    <div id="columnchart_evalActPractica" style="height: 300px;"></div>
                                    <br>
                                    <table id='tablagraficoAct' class="table table-sm table-responsive">
                                        <thead >
                                            <tr class='text-center'>
                                                <th></th>
                                                @foreach($evalActPractica as $evalActPract)
                                                    <th style="vertical-align: middle"> {{ $evalActitudinales[($evalActPract->id_actitudinal)-1]->n_act }} </th>
                                                @endforeach
                                            </tr >
                                        </thead>
                                        <tbody>
                                            <tr class='text-center'>
                                                <th>Promedio general</th>
                                                @foreach($evalActPractica as $evalActPract)
                                                    <th style=" font-weight: normal;"> {{ $evalActPract->valor_act_emp_practica }} </th>
                                                @endforeach
                                                
                                            </tr >
                                            <tr class='text-center'>
                                                <th>Evaluación del supervisor</th>
                                                @foreach($evalActPractica as $evalActPract)
                                                    <th style=" font-weight: normal;"> {{ $evalActPromG[($evalActPract->id_actitudinal)-1] }} </th>
                                                @endforeach
                                            </tr >
                                        </tbody>
                                    </table>
                                    <label style="font-size: small"> * NL: No logrado, NA: No aplica. </label>
                                @else
                                    No se puede visualizar el grafico
                                @endif
                            </div>
                        </div>

                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h6>Conocimiento del alumno</h6>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalConPractica <> NULL)
                                    <div id="columnchart_evalConPractica" style="height: 300px;"></div>
                                    <br>
                                    <table id='tablagraficoCon' class="table table-sm table-responsive">
                                        <thead >
                                            <tr class='text-center'>
                                                <th></th>
                                                @foreach($evalConPractica as $evalConPract)
                                                    <th style="vertical-align: middle"> {{ $evalConocimientos[($evalConPract->id_conocimiento)-1]->n_con }} </th>
                                                @endforeach
                                            </tr >
                                        </thead>
                                        <tbody>
                                            <tr class='text-center'>
                                                <th>Promedio general</th>
                                                @foreach($evalConPractica as $evalConPract)
                                                    <th style=" font-weight: normal;"> {{ $evalConPract->valor_con_emp_practica }} </th>
                                                @endforeach
                                                
                                            </tr >
                                            <tr class='text-center'>
                                                <th>Evaluación del supervisor</th>
                                                @foreach($evalConPractica as $evalConPract)
                                                    <th style=" font-weight: normal;"> {{ $evalConPromG[($evalConPract->id_conocimiento)-1] }} </th>
                                                @endforeach
                                            </tr >
                                        </tbody>
                                    </table>
                                    <label style="font-size: small"> * NL: No logrado, NA: No aplica. </label>
                                @else
                                    No se puede visualizar el grafico
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="form-group row">
                            <div class="col-md-11">
                                No existe la evaluación del supervisor seleccionado.
                            </div>
                        </div>
                    @endif
                

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{  route('datosAlumno',['id'=>$evaluacionSupervisor->id_practica]) }}"><button class="btn btn-secondary">Atrás</button></a>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    //graficos

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data_EvalActPractica = google.visualization.arrayToDataTable([
            ['Actitud del Alumno','Respuesta alumno','Promedio General'],
            <?php  
                foreach($evalActPractica as $evalActPract){
                    if ($evalActitudinales[($evalActPract->id_actitudinal)-1]->id_actitudinal == $evalActPract->id_actitudinal){       
            ?>
                        ['<?php echo $evalActitudinales[($evalActPract->id_actitudinal)-1]->n_act; ?>', <?php echo intval($evalActPract->valor_act_emp_practica); ?> , <?php echo $evalActPromG[($evalActPract->id_actitudinal)-1];?> ],
            <?php 
                    }
                }
            ?>
        ]);
        
        var options1 = {
            chart: {
                title: 'Escuela de Ingeniería en Informática',
                subtitle: 'Autoevaluación, Actitud del alumno',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
        
		var eval_act_practica= new google.charts.Bar(document.getElementById('columnchart_evalActPractica'));
        eval_act_practica.draw(data_EvalActPractica, google.charts.Bar.convertOptions(options1));

    }

    // ----------------------------------------- Conociminto del alumno ------------------------------------

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data_EvalConPractica = google.visualization.arrayToDataTable([
            ['Conocimiento del Alumno','Respuesta alumno','Promedio General'],
            <?php          
                foreach($evalConPractica as $evalConPract){
                    if ($evalConocimientos[($evalConPract->id_conocimiento)-1]->id_conocimiento == $evalConPract->id_conocimiento){      
            ?>
                        ['<?php echo $evalConocimientos[($evalConPract->id_conocimiento)-1]->n_con; ?>', <?php echo intval($evalConPract->valor_con_emp_practica); ?> , <?php echo $evalConPromG[($evalConPract->id_conocimiento)-1];?> ],
            <?php
                    }
                }
            ?>
    
        ]);
        
        var options2 = {
            chart: {
                title: 'Escuela de Ingeniería en Informática',
                subtitle: 'Autoevaluación, Conocimiento del Alumno',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
		var eval_con_practica= new google.charts.Bar(document.getElementById('columnchart_evalConPractica'));
        eval_con_practica.draw(data_EvalConPractica, google.charts.Bar.convertOptions(options2));
    }

</script>

@endsection