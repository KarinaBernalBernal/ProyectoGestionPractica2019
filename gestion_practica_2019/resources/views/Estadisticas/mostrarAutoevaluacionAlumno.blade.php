@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="card text">
        <div class="card-body">
            {{-- Autoevaluacion --}}
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    <h3>Autoevaluación del alumno</h3>
                    <hr>
                </div>
            </div> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
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
                        <div class="form-group row justify-content-md-center">
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
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Tareas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <ol>
                                @foreach($tareas as $tarea)
                                    <li>
                                        <label class="col-form-label text-md-right">{{$tarea->n_tarea}}</label>
                                        <!--<label class="col-form-label text-md-justify">{{$tarea->dp_tarea}}</label> 
                                            -->
                                    </li>
                                @endforeach                   
                            </ol> 
                        </div>

                        {{-- Habilidades --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Habilidades</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Habilidades aprendidas<h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($habilidades as $habilidad)
                                                        @if($habilidad->tipo_habilidad == 'aprendida')
                                                            <li>                                            
                                                                <label class="col-form-label text-md-justify">{{$habilidad->n_habilidad}}</label>
                                                                <!--<label class="col-form-label text-md-justify">{{$habilidad->dp_habilidad}}</label> 
                                                                -->
                                                            </li>              
                                                        @endif
                                                    @endforeach   
                                                </ul> 
                                            </div>
                                        </div>         
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Habilidades faltantes<h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($habilidades as $habilidad)
                                                        @if($habilidad->tipo_habilidad == 'faltante')
                                                            <li>                                            
                                                                <label class="col-form-label text-md-justify">{{$habilidad->n_habilidad}}</label>
                                                                <!--<label class="col-form-label text-md-justify">{{$habilidad->dp_habilidad}}</label> 
                                                                -->
                                                            </li>            
                                                        @endif
                                                    @endforeach   
                                                </ul> 
                                            </div>
                                        </div>  
                                    </div>
                                <div>
                            </div>
                        </div>
                        <br>
                        {{-- Conocimientos --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Conocimientos</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Conocimientos aprendidos<h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($conocimientos as $conocimiento)
                                                        @if($conocimiento->tipo_conocimiento == 'aprendida')
                                                            <li>
                                                                <label class="col-form-label text-md-left">{{$conocimiento->n_conocimiento}}</label>
                                                                <!--<label class="col-form-label text-md-justify">{{$conocimiento->dp_conocimiento}}</label> 
                                                                -->
                                                            </li>            
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Conocimientos faltantes<h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($conocimientos as $conocimiento)
                                                        @if($conocimiento->tipo_conocimiento == 'faltante')
                                                            <li>
                                                                <label class="col-form-label text-md-left">{{$conocimiento->n_conocimiento}}</label>
                                                                <!--<label class="col-form-label text-md-justify">{{$conocimiento->dp_conocimiento}}</label> 
                                                                -->
                                                            </li>            
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Conocimientos adqueridos en la práctica<h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    @foreach($conocimientos as $conocimiento)
                                                        @if($conocimiento->tipo_conocimiento == 'adquerido')
                                                            <li>
                                                                <!--<label class="col-form-label text-md-left">{{$conocimiento->n_conocimiento}}</label>-->
                                                                <label class="col-form-label text-md-justify">{{$conocimiento->dp_conocimiento}}</label> 
                                                                
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
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Herramientas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group row">   
                                    <div class="col-md-9"> 
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
                            </div> 
                        </div>
                        {{-- Autoevaluacion --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Autoevaluación del alumno</h5>
                                <hr>
                                <h6>Actitud del alumno</h6>                       
                                                       
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalActPractica <> NULL)
                                    <div id="columnchart_evalActPractica" style="height: 300px;"></div>
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
                                  
                                @else
                                    No se puede visualizar el grafico
                                @endif
                            </div>
                        </div>
                    @else
                        No existe la autoevaluación del alumno seleccionado.
                    @endif
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