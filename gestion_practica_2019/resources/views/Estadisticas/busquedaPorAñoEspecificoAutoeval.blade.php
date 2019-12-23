@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h3 class="h3 mb-0 text-gray-800">Búsqueda por año específico: Autoevaluación del alumno</h3>
  	</div>

    <div class="card text">
        <div class="card-body">   
            <h4>Herramientas más utilizadas</h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="barchart_herramientas" style="height: 300px;"></div> 
                </div>
            </div>
        </div>
    </div>
    <br>
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
                    <div id="linechart_evalActPractica" style="height: 300px;"></div>                            
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
                    <div id="linechart_evalConPractica" style="height: 300px;"></div> 
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

    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Actitud del alumno');
        data.addColumn('number', 'Ingeniería Civil Informática');
        data.addColumn('number', 'Ingeniería de Ejecución Informática');

        data.addRows([
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
                title: 'Autoevaluación del alumno, <?php echo $desde ?>',
                subtitle: 'Escuela de Ingeniería en Informática',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Line(document.getElementById('linechart_evalActPractica'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }

    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Conocimiento del alumno');
        data.addColumn('number', 'Ingeniería Civil Informática');
        data.addColumn('number', 'Ingeniería de Ejecución Informática');

        data.addRows([
            <?php  
                foreach($evalConocimientos as $evalConocimiento){
            ?>
                    ['<?php echo $evalConocimiento->n_con; ?>' , <?php echo $evalConCivilPromG[($evalConocimiento->id_conocimiento)-1];?> , <?php echo $evalConEjecPromG[($evalConocimiento->id_conocimiento)-1];?> ],
            <?php
                }
            ?>

        ]);

        var options = {
            chart: {
                title: 'Autoevaluación del alumno, <?php echo $desde ?>',
                subtitle: 'Escuela de Ingeniería en Informática',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Line(document.getElementById('linechart_evalConPractica'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }

    //Herramientas 

    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['Herramientas', 'Ingeniería Civil Informática', 'Ingeniería de Ejecución Informática'],
            <?php  
                foreach($herramientas as $herramienta){
            ?>
                    ['<?php echo $herramienta->n_herramienta; ?>' , <?php echo $herramientasCivilPromG[($herramienta->id_herramienta)-1];?> , <?php echo $herramientasEjecPromG[($herramienta->id_herramienta)-1];?> ],
            <?php
                }
            ?>
        ]);

        var options = {
            chart: {
                title: 'Autoevaluación del alumno, Promedio general',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_herramientas'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
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