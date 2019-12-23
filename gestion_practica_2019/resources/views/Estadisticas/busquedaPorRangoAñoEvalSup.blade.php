@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h3 class="h3 mb-0 text-gray-800">Búsqueda por rango de año: Evaluación del supervisor</h3>
  	</div>
    <div class="card text">
    	<div class="card-body">   
            <h4>Áreas más solicitadas</h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="barchart_areas" style="height: 300px;"></div> 
                </div>
            </div>
        </div>
    </div>
    <br>
	<div class="card text">
    	<div class="card-body">                 
      		<h4>Criterios por Actitud del alumno</h4> 
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="columnchart_evalActPractica" style="height: 300px;"></div>                            
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card text">
    	<div class="card-body">   
            <h4>Criterios por Conocimiento del alumno</h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="columnchart_evalConPractica" style="height: 300px;"></div> 
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ URL::previous() }}"><button class="btn btn-secondary">Atrás</button></a>
            </div>  
        </div>
    <div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data_EvalActPractica = google.visualization.arrayToDataTable([
            ['Actitud del Alumno','Ingeniería Civil Informática', 'Ingeniería de Ejecución Informática'],
            <?php    
                foreach($evalActitudinales as $evalActitudinal){
            ?>
                ['<?php echo $evalActitudinal->n_act; ?>' , <?php echo $evalActCivilPromG[($evalActitudinal->id_actitudinal)-1];?> , <?php echo $evalActEjecPromG[($evalActitudinal->id_actitudinal)-1];?> ],
            <?php 
                }
            ?>
            
        ]);
        
        var options = {
            chart: {
                title: 'Evaluación del supervisor, <?php echo $desde ?> - <?php echo $hasta ?>',
                subtitle: 'Escuela de Ingeniería en Informática',  
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
		var eval_act_practica= new google.charts.Bar(document.getElementById('columnchart_evalActPractica'));
        eval_act_practica.draw(data_EvalActPractica, google.charts.Bar.convertOptions(options));
    }
    //------------------------------------------------------------------------------------------------------------------------
    
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data_EvalConPractica = google.visualization.arrayToDataTable([
            ['Conocimiento del Alumno','Ingeniería Civil Informática', 'Ingeniería de Ejecución Informática'],
            <?php  
                foreach($evalConocimientos as $evalConocimiento){
            ?>
                    ['<?php echo $evalConocimiento->n_con; ?>' , <?php echo $evalConCivilPromG[($evalConocimiento->id_conocimiento)-1];?> , <?php echo $evalConEjecPromG[($evalConocimiento->id_conocimiento)-1];?> ],
            <?php
                }
            ?>
        ]);
        
        var options2 = {
            chart: {
                title: 'Evaluación del supervisor, <?php echo $desde ?> - <?php echo $hasta ?>',
                subtitle: 'Escuela de Ingeniería en Informática',  
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
		var eval_con_practica= new google.charts.Bar(document.getElementById('columnchart_evalConPractica'));
        eval_con_practica.draw(data_EvalConPractica, google.charts.Bar.convertOptions(options2));
    }

      //Areas

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart4() {
        var data = google.visualization.arrayToDataTable([
            ['Áreas', 'Ingeniería Civil Informática', 'Ingeniería de Ejecución Informática'],
            <?php  
                foreach($areas as $area){
            ?>
                    ['<?php echo $area->n_area; ?>' , <?php echo $areasCivilPromG[($area->id_area)-1];?> , <?php echo $areasEjecPromG[($area->id_area)-1];?> ],
            <?php
                }
            ?>
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_areas'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

@endsection