@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Avance del alumno entre 1era Práctica y 2da Práctica</h3>
    </div>
        
    <div class="card text">
        <div class="card-body"> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    {{-- Autoevaluacion --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h4>Actitudes del alumno</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalActPractica1 <> NULL)
                                    <div id="columnchart_evalActPractica1" style="height: 300px;"></div>
                                    <br> 
    
                                    <table id='tablagraficoAct' class="table table-sm table-responsive">
                                        <thead >
                                            <tr class='text-center'>
                                                <th></th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style="vertical-align: middle"> {{ $evalActitudinal->n_act }} </th>
                                                @endforeach
                                            </tr >
                                        </thead>
                                        <tbody>
                                            <tr class='text-center'>
                                                <th>1era Práctica - Autoevaluación</th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style=" font-weight: normal;"> {{ $evalActPractica1[($evalActitudinal->id_actitudinal)-1]->valor_act_practica }} </th>
                                                @endforeach
                                            </tr>
                                            <tr class='text-center'>
                                                <th>2da Práctica - Autoevaluación</th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style=" font-weight: normal;"> {{ $evalActPractica2[($evalActitudinal->id_actitudinal)-1]->valor_act_practica }} </th>
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
                        <hr>
                        {{-- Empresa --}}
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalActEmpPractica1 <> NULL)
                                    <div id="columnchart_evalActPracticaSup" style="height: 300px;"></div>
                                    <br> 
    
                                    <table id='tablagraficoActS' class="table table-sm table-responsive">
                                        <thead >
                                            <tr class='text-center'>
                                                <th></th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style="vertical-align: middle"> {{ $evalActitudinal->n_act }} </th>
                                                @endforeach
                                            </tr >
                                        </thead>
                                        <tbody>
                                            <tr class='text-center'>
                                                <th>1era Práctica - Evaluación Supervisor</th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style=" font-weight: normal;"> {{ $evalActEmpPractica1[($evalActitudinal->id_actitudinal)-1]->valor_act_emp_practica }} </th>
                                                @endforeach
                                            </tr>
                                            <tr class='text-center'>
                                                <th>2da Práctica - Evaluación Supervisor</th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style=" font-weight: normal;"> {{ $evalActEmpPractica2[($evalActitudinal->id_actitudinal)-1]->valor_act_emp_practica }} </th>
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
        </div>
    </div>
    <br>
    <div class="card text">
        <div class="card-body"> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    {{-- "2da Práctica" --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h4>Conocimiento del alumno</h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalConPractica1 <> NULL)
                                    <div id="columnchart_evalConPractica1" style="height: 300px;"></div>
                                    <br>
                                    <table id='tablagraficoCon' class="table table-sm table-responsive">
                                        <thead >
                                            <tr class='text-center'>
                                                <th></th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style="vertical-align: middle"> {{ $evalConocimiento->n_con }} </th>
                                                @endforeach
                                            </tr >
                                        </thead>
                                        <tbody>
                                            <tr class='text-center'>
                                                <th>1era Práctica - Autoevaluación</th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style=" font-weight: normal;"> {{ $evalConPractica1[($evalConocimiento->id_conocimiento)-1]->valor_con_practica }} </th>
                                                @endforeach
                                            </tr >
                                            <tr class='text-center'>
                                                <th>2da Práctica - Autoevaluación</th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style=" font-weight: normal;"> {{ $evalConPractica2[($evalConocimiento->id_conocimiento)-1]->valor_con_practica }} </th>
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
                        <hr>
                        {{-- Empresa --}}
                        <div class="form-group row">
                            <div class="col-md-11">
                                @if($evalConEmpPractica2 <> NULL)
                                    <div id="columnchart_evalConPracticaSup" style="height: 300px;"></div>
                                    <br> 
    
                                    <table id='tablagraficoConS' class="table table-sm table-responsive">
                                        <thead >
                                            <tr class='text-center'>
                                                <th></th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style="vertical-align: middle"> {{ $evalConocimiento->n_con }} </th>
                                                @endforeach
                                            </tr >
                                        </thead>
                                        <tbody>
                                            <tr class='text-center'>
                                                <th>1era Práctica - Evaluación Supervisor</th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style=" font-weight: normal;"> {{ $evalConEmpPractica1[($evalConocimiento->id_conocimiento)-1]->valor_con_emp_practica }} </th>
                                                @endforeach
                                            </tr>
                                            <tr class='text-center'>
                                                <th>2da Práctica - Evaluación Supervisor</th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style=" font-weight: normal;"> {{ $evalConEmpPractica2[($evalConocimiento->id_conocimiento)-1]->valor_con_emp_practica }} </th>
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
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{  route('datosAlumno',['id'=>$autoevaluacion1->id_practica]) }}"><button class="btn btn-secondary">Atrás</button></a>
            </div>  
        </div>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data_EvalActPractica1 = google.visualization.arrayToDataTable([
            ['Actitud del alumno','Respuesta 1era Práctica','Respuesta 2da Práctica'],
            <?php  
                foreach($evalActitudinales as $evalActitudinal){
            ?>
                    ['<?php echo $evalActitudinal->n_act; ?>', <?php echo intval($evalActPractica1[($evalActitudinal->id_actitudinal)-1]->valor_act_practica); ?> , <?php echo intval($evalActPractica2[($evalActitudinal->id_actitudinal)-1]->valor_act_practica); ?> ],
            <?php
                }
            ?>
        ]);
        
        var options1 = {
            chart: {
                title: 'Comparativa entre autoevaluaciones',
                subtitle: 'Criterios del alumno',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
          
        
        };
		var eval_act_practica= new google.charts.Bar(document.getElementById('columnchart_evalActPractica1'));
        eval_act_practica.draw(data_EvalActPractica1, google.charts.Bar.convertOptions(options1));
    }

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChartS1);

    function drawChartS1() {
        
        var data_EvalActEmpPractica1 = google.visualization.arrayToDataTable([
            ['Actitud del alumno','Respuesta 1era Práctica','Respuesta 2da Práctica'],
            <?php  
                foreach($evalActitudinales as $evalActitudinal){
            ?>
                    ['<?php echo $evalActitudinal->n_act; ?>', <?php echo intval($evalActEmpPractica1[($evalActitudinal->id_actitudinal)-1]->valor_act_emp_practica); ?> , <?php echo intval($evalActEmpPractica2[($evalActitudinal->id_actitudinal)-1]->valor_act_emp_practica); ?> ],
            <?php
                }
            ?>
        ]);
        
        var options3 = {
            chart: {
                title: 'Comparativa entre evaluaciones',
                subtitle: 'Criterios del Supervisor',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
          
        
        };
		var eval_act_emp_practica= new google.charts.Bar(document.getElementById('columnchart_evalActPracticaSup'));
        eval_act_emp_practica.draw(data_EvalActEmpPractica1, google.charts.Bar.convertOptions(options3));
    }

    // ----------------------------------------- Conociminto del alumno ------------------------------------

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data_EvalConPractica1 = google.visualization.arrayToDataTable([
            ['Conocimiento del alumno','Respuesta 1era Práctica','Respuesta 2da Práctica'],
            <?php               
                foreach($evalConocimientos as $evalConocimiento){
            ?>
                    ['<?php echo $evalConocimiento->n_con; ?>', <?php echo intval($evalConPractica1[($evalConocimiento->id_conocimiento)-1]->valor_con_practica); ?> , <?php echo intval($evalConPractica2[($evalConocimiento->id_conocimiento)-1]->valor_con_practica); ?> ],
            <?php
                }
            ?>
    
        ]);

        var options2 = {
            chart: {
                title: 'Comparativa entre autoevaluaciones',
                subtitle: 'Criterios del Alumno',
            },
            
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
		var eval_con_practica= new google.charts.Bar(document.getElementById('columnchart_evalConPractica1'));
        eval_con_practica.draw(data_EvalConPractica1, google.charts.Bar.convertOptions(options2));
    }

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChartS2);

    function drawChartS2() {
        
        var data_EvalConEmpPractica1 = google.visualization.arrayToDataTable([
            ['Conocimiento del alumno','Respuesta 1era Práctica','Respuesta 2da Práctica'],
            <?php  
                foreach($evalConocimientos as $evalConocimiento){
            ?>
                    ['<?php echo $evalConocimiento->n_con; ?>', <?php echo intval($evalConEmpPractica1[($evalConocimiento->id_conocimiento)-1]->valor_con_emp_practica); ?> , <?php echo intval($evalConEmpPractica2[($evalConocimiento->id_conocimiento)-1]->valor_con_emp_practica); ?> ],
            <?php
                }
            ?>
        ]);
        
        var options4 = {
            chart: {
                title: 'Comparativa entre evaluaciones',
                subtitle: 'Criterios del Supervisor',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
          
        
        };
		var eval_con_emp_practica= new google.charts.Bar(document.getElementById('columnchart_evalConPracticaSup'));
        eval_con_emp_practica.draw(data_EvalConEmpPractica1, google.charts.Bar.convertOptions(options4));
    }

</script>

@endsection
