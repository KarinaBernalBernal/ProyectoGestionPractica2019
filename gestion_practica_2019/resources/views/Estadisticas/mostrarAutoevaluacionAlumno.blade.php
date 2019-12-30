@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="card text">
        <div class="card-body">
            {{-- Autoevaluacion --}}
            <div class="form-group row">
                <div class="col-md-12">
                    <h3>Autoevaluación del alumno</h3>
                    <hr>
                </div>
            </div> 
            <div class="form-group row">
                <div class="col-md-11">
                    @if($autoevaluacion <> NULL)
                        {{-- Autoevaluacion --}}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Fecha de autoevaluación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-left">{{$autoevaluacion->f_entrega}}</label>
                            </div>
                        </div>

                        {{-- Desempeño --}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Desempeño del alumno</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Calificación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-right">{{$desempeño->valor}}</label><!-- Malo - Regular - Bueno - Muy bueno -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-left" >{{ __('Descripción') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-left">{{$desempeño->dp_desempenno}}</label>
                            </div>
                        </div>
                        
                        {{-- Tareas --}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Tareas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                <ul>
                                    @foreach($tareas as $tarea)
                                        <li>
                                            <p>
                                                <a class="col-form-label text-md-right" data-toggle="collapse" href="#collapseTarea" aria-expanded="false" aria-controls="collapseExample">{{$tarea->n_tarea}}</a>
                                            </p>
                                            <div class="collapse" id="collapseTarea">
                                                <div class="card card-body">
                                                    <label class="col-form-label text-md-justify">{{$tarea->dp_tarea}}</label> 
                                                </div>
                                            </div>                                            
                                        </li>
                                    @endforeach                   
                                </ul>
                            </div>
                        </div>

                        {{-- Habilidades --}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Habilidades</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Habilidades aprendidas</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($habilidades as $habilidad)
                                                        @if($habilidad->tipo_habilidad == 'aprendida')
                                                            <li>
                                                                <p>
                                                                    <a class="col-form-label text-md-right" data-toggle="collapse" href="#collapseHabAprendida" aria-expanded="false" aria-controls="collapseExample">{{$habilidad->n_habilidad}}</a>
                                                                </p>
                                                                <div class="collapse" id="collapseHabAprendida">
                                                                    <div class="card card-body">
                                                                        <label class="col-form-label text-md-justify">{{$habilidad->dp_habilidad}}</label> 
                                                                    </div>
                                                                </div>                                            
                                                            </li>         
                                                        @endif
                                                    @endforeach   
                                                </ul> 
                                            </div>
                                        </div>         
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Habilidades faltantes</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($habilidades as $habilidad)
                                                        @if($habilidad->tipo_habilidad == 'faltante')
                                                            <li>
                                                                <p>
                                                                    <a class="col-form-label text-md-right" data-toggle="collapse" href="#collapseHabFaltante" aria-expanded="false" aria-controls="collapseExample">{{$habilidad->n_habilidad}}</a>
                                                                </p>
                                                                <div class="collapse" id="collapseHabFaltante">
                                                                    <div class="card card-body">
                                                                        <label class="col-form-label text-md-justify">{{$habilidad->dp_habilidad}}</label> 
                                                                    </div>
                                                                </div>                                            
                                                            </li>                  
                                                        @endif
                                                    @endforeach   
                                                </ul> 
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        </br>
                        {{-- Conocimientos --}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Conocimientos</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Conocimientos aprendidos</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($conocimientos as $conocimiento)
                                                        @if($conocimiento->tipo_conocimiento == 'aprendida') 
                                                            <li>
                                                                <p>
                                                                    <a class="col-form-label text-md-left" data-toggle="collapse" href="#collapseConAprendido" aria-expanded="false" aria-controls="collapseExample">{{$conocimiento->n_conocimiento}}</a>
                                                                </p>
                                                                <div class="collapse" id="collapseConAprendido">
                                                                    <div class="card card-body">
                                                                        <label class="col-form-label text-md-justify">{{$conocimiento->dp_conocimiento}}</label> 
                                                                    </div>
                                                                </div>                                            
                                                            </li>           
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Conocimientos faltantes</h6>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <ul>
                                                    @foreach($conocimientos as $conocimiento)
                                                        @if($conocimiento->tipo_conocimiento == 'faltante')
                                                            <li>
                                                                <p>
                                                                    <a class="col-form-label text-md-left" data-toggle="collapse" href="#collapseConFaltante" aria-expanded="false" aria-controls="collapseExample">{{$conocimiento->n_conocimiento}}</a>
                                                                </p>
                                                                <div class="collapse" id="collapseConFaltante">
                                                                    <div class="card card-body">
                                                                        <label class="col-form-label text-md-justify">{{$conocimiento->dp_conocimiento}}</label> 
                                                                    </div>
                                                                </div>                                            
                                                            </li>            
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Conocimientos adqueridos en la práctica</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($conocimientos as $conocimiento)
                                                        @if($conocimiento->tipo_conocimiento == 'adquerido')
                                                            <li>
                                                                <p>
                                                                    <a class="col-form-label text-md-left" data-toggle="collapse" href="#collapseConAdquerido" aria-expanded="false" aria-controls="collapseExample">{{$conocimiento->n_conocimiento}}</a>
                                                                </p>
                                                                <div class="collapse" id="collapseConAdquerido">
                                                                    <div class="card card-body">
                                                                        <label class="col-form-label text-md-justify">{{$conocimiento->dp_conocimiento}}</label> 
                                                                    </div>
                                                                </div>                                            
                                                            </li>             
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- Herramientas --}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Herramientas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                @foreach($herramientaPracticas as $herramientaPractica)
                                    @foreach($herramientas as $herramienta)
                                        @if($herramientaPractica->id_herramienta == $herramienta->id_herramienta )
                                            <label class="col-form-label text-md">{{$herramienta->n_herramienta}}</label>
                                        @endif
                                    @endforeach
                                    @if($loop->count <> $loop->iteration)
                                        <label >-</label>
                                    @endif
                                @endforeach       
                            </div> 
                        </div>

                        {{-- Areas --}}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Áreas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @foreach($areaAutoevals as $areaAutoeval)
                                    @foreach($areas as $area)
                                        @if($areaAutoeval->id_area == $area->id_area )
                                            <label class="col-form-label text-md-right">{{$area->n_area}}</label>
                                        @endif
                                    @endforeach
                                    @if($loop->count <> $loop->iteration)
                                        <label >-</label>
                                    @endif
                                @endforeach                   
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5>Autoevaluación del alumno</h5>

                            </div>
                        </div>
                        <div class="card text">
                            <div class="card-body">
                                {{-- Autoevaluacion --}}
                                <div class="form-group row">
                                    <div class="col-md-12">
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
                                                            <th style=" font-weight: normal;"> {{ $evalActPract->valor_act_practica }} </th>
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
                            </div>
                        </div>
                        <br> 
                        <div class="card text">
                            <div class="card-body">
                                <div class="form-group row">
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
                                                            <th style=" font-weight: normal;"> {{ $evalConPract->valor_con_practica }} </th>
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
                                No existe la autoevaluación del alumno seleccionado.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('datosAlumno',['id'=>$autoevaluacion->id_practica]) }}"><button class="btn btn-secondary">Atrás</button></a>
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
                        if($evalActPract->valor_act_practica == 'NA' || $evalActPract->valor_act_practica == 'NL'){
            ?>
                            ['<?php echo $evalActitudinales[($evalActPract->id_actitudinal)-1]->n_act; ?>', 'NA' , <?php echo $evalActPromG[($evalActPract->id_actitudinal)-1];?> ],
            <?php
                        }
                        else{
            ?>
                            ['<?php echo $evalActitudinales[($evalActPract->id_actitudinal)-1]->n_act; ?>', <?php echo intval($evalActPract->valor_act_practica); ?> , <?php echo $evalActPromG[($evalActPract->id_actitudinal)-1];?> ],
            <?php
                        } 
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
                        if($evalConPract->valor_con_practica == 'NA' || $evalConPract->valor_con_practica == 'NL'){
            ?>
                            ['<?php echo $evalConocimientos[($evalConPract->id_conocimiento)-1]->n_con; ?>', 'NA' , <?php echo $evalConPromG[($evalConPract->id_conocimiento)-1];?> ],
            <?php
                        }
                        else{
            ?>
                            ['<?php echo $evalConocimientos[($evalConPract->id_conocimiento)-1]->n_con; ?>', <?php echo intval($evalConPract->valor_con_practica); ?> , <?php echo $evalConPromG[($evalConPract->id_conocimiento)-1];?> ],
            <?php
                        } 
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