@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Autoevaluación 1era Practica vs 2da Practica</h3>
    </div>
        
    <div class="card text">
        <div class="card-body"> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    {{-- Autoevaluacion --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h4>Actitud del alumno</h4>
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
                                                <th>1era practica</th>
                                                @foreach($evalActitudinales as $evalActitudinal)
                                                    <th style=" font-weight: normal;"> {{ $evalActPractica1[($evalActitudinal->id_actitudinal)-1]->valor_act_practica }} </th>
                                                @endforeach
                                            </tr>
                                            <tr class='text-center'>
                                                <th>2da practica</th>
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
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card text">
        <div class="card-body"> 
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    {{-- "2da practica" --}}
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
                                                <th>1era Practica</th>
                                                @foreach($evalConocimientos as $evalConocimiento)
                                                    <th style=" font-weight: normal;"> {{ $evalConPractica1[($evalConocimiento->id_conocimiento)-1]->valor_con_practica }} </th>
                                                @endforeach
                                            </tr >
                                            <tr class='text-center'>
                                                <th>2da practica</th>
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
            ['Actitud del alumno','Respuesta 1era practica','Respuesta 2da practica'],
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
                title: 'Escuela de Ingeniería en Informática',
                subtitle: 'Autoevaluación, Actitud del alumno',
            },
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
          
        
        };
		var eval_act_practica= new google.charts.Bar(document.getElementById('columnchart_evalActPractica1'));
        eval_act_practica.draw(data_EvalActPractica1, google.charts.Bar.convertOptions(options1));
    }

    // ----------------------------------------- Conociminto del alumno ------------------------------------

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data_EvalConPractica1 = google.visualization.arrayToDataTable([
            ['Conocimiento del alumno','1era Practica','2da Practica'],
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
                title: 'Escuela de Ingeniería en Informática',
                subtitle: 'Autoevaluación, Conocimiento del Alumno',
            },
            
            legend: { position: 'bottom', alignment: 'end' },
            responsive: true,
        };
		var eval_con_practica= new google.charts.Bar(document.getElementById('columnchart_evalConPractica1'));
        eval_con_practica.draw(data_EvalConPractica1, google.charts.Bar.convertOptions(options2));
    }

</script>

@endsection
