@extends('layouts.mainlayout')

@section('content')

<div class="container-fluid">
  	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h3 class="h3 mb-0 text-gray-800">Promedio por criterio</h3>
  	</div>

	<div class="card text">
    	<div class="card-body">                 
      		<h4>Criterios por Actitud del alumno</h4> 
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Criterio 1: Se desempeña con responsabilidad, respeto y ética profesional.</h6>

                        <div id="columnchart_cri_act_ejec_1" style="width: 900px; height: 300px;"></div>
                        <!--<div id="columnchart_cri_act_civil_1" style="width: 900px; height: 300px;"></div>-->
                            
                    </div>
                </div>
                <br>
                <div class="row">
                	<div class="col-md-12">
                    	<h5>Criterio 2: Demuestra iniciativa, creatividad y proactividad en el desempeño de las tareas.</h5>
                        <!--<div id="columnchart_cri_act_2" style="width: 900px; height: 300px;"></div>-->
                            
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Criterio 3: Presenta capacidad de Autoaprendizaje.</h5>
                        <!--<div id="columnchart_cri_act_3" style="width: 900px; height: 300px;"></div>-->
                            
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Criterio 4: Participa adecuadamente en trabajos en grupo.</h5>
                        <!--<div id="columnchart_cri_act_4" style="width: 900px; height: 300px;"></div>-->
                            
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Criterio 5: Se comunica efectivamente en forma oral y escrita en su lengua materna.</h5>
                        <!--<div id="columnchart_cri_act_5" style="width: 900px; height: 300px;"></div>-->
                            
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Criterio 6: Maneja de forma apropiada el idioma Inglés en el contexto de su profesión.</h5>
                        <!--<div id="columnchart_cri_act_6" style="width: 900px; height: 300px;"></div>-->
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card text">
        <div class="card-body">                 
            <h4>Criterios por Conocimiento del alumno</h4>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Criterio 1</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


@endsection