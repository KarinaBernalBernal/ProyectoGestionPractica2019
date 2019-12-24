@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Autoevaluación vs Evaluación del supervisor</h3>
    </div>
        
    <div class="card text">
        <div class="card-body"> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    {{-- Autoevaluacion --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h4>Actitud del alumno</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalActPractica <> NULL)
                                    <div id="columnchart_evalActPractica" style="height: 300px;"></div>
                                    <br>
                                @else
                                    No se puede visualizar el grafico
                                @endif
                            </div>
                        </div>
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h4>Conocimiento del alumno</h4>
                                <hr>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data_EvalActPractica = google.visualization.arrayToDataTable([
            ['Actitud del alumno','Respuesta alumno','Respuesta supervisor'],
            <?php  
                foreach($evalActitudinales as $evalActitudinal){
                    if($evalActPractica[($evalActitudinal->id_actitudinal)-1]->valor_act_practica == 'NA' || $evalActPractica[($evalActitudinal->id_actitudinal)-1]->valor_act_practica == 'NL'){
            ?>
                        ['<?php echo $evalActitudinal->n_act; ?>', 'NA' , 0 ],
            <?php
                    }
                    else{
            ?>
                        ['<?php echo $evalActitudinal->n_act; ?>', <?php echo intval($evalActPractica[($evalActitudinal->id_actitudinal)-1]->valor_act_practica); ?> , <?php echo intval($evalActEmpPractica[($evalActitudinal->id_actitudinal)-1]->valor_act_emp_practica); ?> ],
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
            ['Conocimiento del alumno','Respuesta alumno','Respuesta supervisor'],
            <?php               
                foreach($evalConocimientos as $evalConocimiento){
                    if($evalConPractica[($evalConocimiento->id_conocimiento)-1]->valor_con_practica == 'NA' || $evalConPractica[($evalConocimiento->id_conocimiento)-1]->valor_con_practica == 'NL'){
            ?>
                        ['<?php echo $evalConocimiento->n_con; ?>', 'NA' , 0 ],
            <?php
                    }
                    else{
            ?>
                        ['<?php echo $evalConocimiento->n_con; ?>', <?php echo intval($evalConPractica[($evalConocimiento->id_conocimiento)-1]->valor_con_practica); ?> , <?php echo intval($evalConEmpPractica[($evalConocimiento->id_conocimiento)-1]->valor_con_emp_practica); ?> ],
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