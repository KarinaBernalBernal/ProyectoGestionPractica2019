@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h3 class="h3 mb-0 text-gray-800">Evaluación del supervisor</h3>
  	</div>

    <form class="form-horizontal" action="{{route('busquedaEvalSup')}}" method="get">    
        <div class="card text">
            <div class="card-body">     
            {{ csrf_field() }} 
                <div class="input-group input-group-md mb-3">
                    <label for="tipoBusqueda" class="col-form-label">{{ __('Tipo búsqueda:') }}</label>
                    <div class="col-md-3">
                            <select id="tipoBusqueda" name="tipoBusqueda" class="custom-select" required>
                                <option selected value="">Selecciona...</option>
                                <option value ="1">Búsqueda por rango de año</option>
                                <option value ="2">Búsqueda por año específico</option>
                            </select>
                    </div>
                    
                    <label for="busquedaDesde" class="col-form-label">Ingrese año: </label>
                    <div class="col-md-2">
                        <input id="busquedaDesde" type="number" placeholder="Desde"class="form-control" name="busquedaDesde" value="{{ old('busquedaHasta') }}" required>
                    </div>

                    <div class="col-md-2">
                        <input id="busquedaHasta" type="number" placeholder="Hasta" class="form-control" name="busquedaHasta" value="{{ old('busquedaHasta') }}" style="display: none;" required disabled>
                    </div>
                    
                    <div class="col-md-2">
                        <a href=""><button class="btn btn-primary" type="submit" ><i class="fas fa-search"></i></button></a>
                    </div>
                </div>
                <br>
            <div>
        </div>
    <form>

	<div class="card text">
    	<div class="card-body">                 
      		<h4>Criterios por Actitud del alumno</h4> 
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="columnchart_evalActPractica" style="height: 300px;"></div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card text">
    	<div class="card-body"> 
            <h4>Criterios por Conocimiento del alumno</h4>
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="columnchart_evalConPractica" style="height: 300px;"></div> 
                    </div>
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

    $(function(){
        $('#busquedaDesde').change(function(){
            $('#busquedaHasta').removeAttr('disabled');
            $('#busquedaHasta').attr('min', $('#busquedaDesde').val() );
        });

        $("#tipoBusqueda").change( function() {
            if ($(this).val() === "2") {
                $("#busquedaHasta").removeAttr("required");
                document.getElementById('busquedaHasta').style.display = "none";
                
            }else{
                if ($(this).val() === "1") {
                    document.getElementById('busquedaHasta').style.display = "block";
                    $("#busquedaHasta").prop("required", true);
                }
            }
        });
    });
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
                title: 'Escuela de Ingeniería en Informática',
                subtitle: 'Autoevaluación, Promedio general',
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
                title: 'Escuela de Ingeniería en Informática',
                subtitle: 'Autoevaluación, Promedio General',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
		var eval_con_practica= new google.charts.Bar(document.getElementById('columnchart_evalConPractica'));
        eval_con_practica.draw(data_EvalConPractica, google.charts.Bar.convertOptions(options2));
    }

</script>

@endsection