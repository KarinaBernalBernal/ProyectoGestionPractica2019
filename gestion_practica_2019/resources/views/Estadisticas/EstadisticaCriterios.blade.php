@extends('layouts.mainlayout')

@section('content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Promedio por criterio</h1>
        </div>

        <div class="card text">
            <div class="card-body">                 
                <h4>Criterios por Actitud del alumno</h4> 
                <hr>
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-md-12">
                            <h5>Criterio 1: Se desempeña con responsabilidad, respeto y ética profesional.</h5>

                            <div id="columnchart_cri_act_ejec_1" style="width: 900px; height: 300px;"></div>
                            <div id="columnchart_cri_act_civil_1" style="width: 900px; height: 300px;"></div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                       <div class="col-md-12">
                            <h5>Criterio 2: Demuestra iniciativa, creatividad y proactividad en el desempeño de las tareas.</h5>

                            <div id="columnchart_cri_act_2" style="width: 900px; height: 300px;"></div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                       <div class="col-md-12">
                            <h5>Criterio 3: Presenta capacidad de Autoaprendizaje.</h5>

                            <div id="columnchart_cri_act_3" style="width: 900px; height: 300px;"></div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                       <div class="col-md-12">
                            <h5>Criterio 4: Participa adecuadamente en trabajos en grupo.</h5>

                            <div id="columnchart_cri_act_4" style="width: 900px; height: 300px;"></div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                       <div class="col-md-12">
                            <h5>Criterio 5: Se comunica efectivamente en forma oral y escrita en su lengua materna.</h5>

                            <div id="columnchart_cri_act_5" style="width: 900px; height: 300px;"></div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Criterio 6: Maneja de forma apropiada el idioma Inglés en el contexto de su profesión.</h5>

                            <div id="columnchart_cri_act_6" style="width: 900px; height: 300px;"></div>
                            
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

    <script type="text/javascript">

    var fecha = new Date();

    //graficos
    //Criterios por actitud del alumno
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data_act_ejec_1 = google.visualization.arrayToDataTable([
          ['Año', 'Opción 1', 'Opción 2', 'Opción 3','Opción 4'],
          [(fecha.getFullYear()-3).toString(), 2, 3, 10, 10],
          [(fecha.getFullYear()-2).toString(), 3, 6, 4, 5],
          [(fecha.getFullYear()-1).toString(), 2, 7, 11, 7],
          [(fecha.getFullYear()).toString(), 6, 9, 8, 6]
        ]);

        var data_act_2 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_act_3 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_act_4 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_act_5 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_act_6 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Escuela de Ingeniería en Informática',
            subtitle: 'Año, Expenses, and Profit: 2014-2017',
          }
        };

        var cri_act_ejec_1 = new google.charts.Bar(document.getElementById('columnchart_cri_act_ejec_1'));
        var cri_act_2 = new google.charts.Bar(document.getElementById('columnchart_cri_act_2'));
        var cri_act_3 = new google.charts.Bar(document.getElementById('columnchart_cri_act_3'));
        var cri_act_4 = new google.charts.Bar(document.getElementById('columnchart_cri_act_4'));
        var cri_act_5 = new google.charts.Bar(document.getElementById('columnchart_cri_act_5'));
        var cri_act_6 = new google.charts.Bar(document.getElementById('columnchart_cri_act_6'));

        cri_act_ejec_1.draw(data_act_ejec_1, google.charts.Bar.convertOptions(options));
        cri_act_2.draw(data_act_2, google.charts.Bar.convertOptions(options));
        cri_act_3.draw(data_act_3, google.charts.Bar.convertOptions(options));
        cri_act_4.draw(data_act_4, google.charts.Bar.convertOptions(options));
        cri_act_5.draw(data_act_5, google.charts.Bar.convertOptions(options));
        cri_act_6.draw(data_act_6, google.charts.Bar.convertOptions(options));
      }


    //Criterios por conocimiento del alumno
    /*
    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data_con_1 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_con_2 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_con_3 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_con_4 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_con_5 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var data_con_6 = google.visualization.arrayToDataTable([
          ['Año', 'Promedio Ingeniería de Ejecución en Informática', 'Promedio Ingeniería Civil en Informática', 'Promedio entre carreras'],          
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Escuela de Ingeniería en Informática',
            subtitle: 'Año, Expenses, and Profit: 2014-2017',
          }
        };

        var cri_con_1 = new google.charts.Bar(document.getElementById('columnchart_cri_con_1'));
        var cri_con_2 = new google.charts.Bar(document.getElementById('columnchart_cri_con_2'));
        var cri_con_3 = new google.charts.Bar(document.getElementById('columnchart_cri_con_3'));
        var cri_con_4 = new google.charts.Bar(document.getElementById('columnchart_cri_con_4'));
        var cri_con_5 = new google.charts.Bar(document.getElementById('columnchart_cri_con_5'));
        var cri_con_6 = new google.charts.Bar(document.getElementById('columnchart_cri_con_6'));

        cri_con_1.draw(data_con_1, google.charts.Bar.convertOptions(options));
        cri_con_2.draw(data_con_2, google.charts.Bar.convertOptions(options));
        cri_con_3.draw(data_con_3, google.charts.Bar.convertOptions(options));
        cri_con_4.draw(data_con_4, google.charts.Bar.convertOptions(options));
        cri_con_5.draw(data_con_5, google.charts.Bar.convertOptions(options));
        cri_con_6.draw(data_con_6, google.charts.Bar.convertOptions(options));

      }*/
    </script>
@endsection