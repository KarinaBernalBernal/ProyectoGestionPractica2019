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
        data.addColumn('string', 'Actitud del alumno');
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
                title: 'Autoevaluación del alumno',
                subtitle: 'Escuela de Ingeniería en Informática',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };

        var chart = new google.charts.Line(document.getElementById('linechart_evalActPractica'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }
    

</script>

@endsection