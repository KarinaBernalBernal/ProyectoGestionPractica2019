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
                        <div class="form-group row">
                            <div class="col-md-11">
                                No existe la evaluación del supervisor seleccionado.
                            </div>
                        </div>
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
                            ['<?php echo $evalActitudinales[($evalActPract->id_actitudinal)-1]->n_act; ?>', <?php echo intval($evalActPract->valor_act_emp_practica); ?> , <?php echo $evalActPromG[($evalActPract->id_actitudinal)-1];?> ],
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
                            ['<?php echo $evalConocimientos[($evalConPract->id_conocimiento)-1]->n_con; ?>', <?php echo intval($evalConPract->valor_con_emp_practica); ?> , <?php echo $evalConPromG[($evalConPract->id_conocimiento)-1];?> ],
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