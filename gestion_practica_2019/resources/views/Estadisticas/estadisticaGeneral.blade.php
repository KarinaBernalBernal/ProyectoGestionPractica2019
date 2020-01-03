@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h3 class="h3 mb-0 text-gray-800">Estadísticas generales</h3>
  	</div>

    <div class="card text">
    	<div class="card-body">   
            <h4>Frecuencia de practicantes</h4>
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
            <h4>Empresas Frecuentes</h4>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div id="barchart_empresas" style="height: 600px;"></div> 
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('home') }}"><button class="btn btn-secondary">Atrás</button></a>
            </div>  
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Años');
        data.addColumn('number', 'Ingeniería Civil Informática');
        data.addColumn('number', 'Ingeniería de Ejecución Informática');

        data.addRows([
            <?php
                $i = 0;
                foreach($arrayFechas as $arrayFecha){
            ?>
                    ['<?php echo $arrayFecha ?>' ,<?php echo $totalCivil[$i] ?>, <?php  echo $totalEjec[$i] ?>],
            <?php 
                    $i += 1;
                }
            ?>
        ]);

        var options = {
            chart: {
                title: 'Comparativa de frecuencia de practicantes',
                subtitle: 'Ingeniería Civil Informática , Ingeniería de Ejecución Informática'
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Line(document.getElementById('linechart_evalActPractica'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
    //Empresas 

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['empresas', 'Ingeniería Civil Informática', 'Ingeniería de Ejecución Informática'],
            <?php  
                foreach($empresas as $empresa){
            ?>
                    ['<?php echo $empresa->n_empresa; ?>' , <?php echo $empresasCivil[($empresa->id_empresa)-1];?> , <?php echo $empresasEjec[($empresa->id_empresa)-1];?> ],
            <?php
                }
            ?>
        ]);

        var options = {
            chart: {
                title: 'Comparativa de frecuencia de empresas',
                subtitle: 'Ingeniería Civil Informática , Ingeniería de Ejecución Informática'
            },
            bars: 'horizontal', // Required for Material Bar Charts.
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_empresas'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    

</script>

@endsection