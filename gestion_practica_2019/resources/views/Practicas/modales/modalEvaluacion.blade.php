<div class="modal-dialog modal-lg">
    <div class="modal-content" id="DivIdToPrint">
        <div class="modal-header">
            <h4>Evaluación Supervisor</h4>
            <div class="col-1">
                <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
            </div>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i style="color: red;" class="fas fa-times"></i></span>
            </button>
        </div>
        <form id="modalEvaluacion" class="evaluacion-form" method="POST" enctype="multipart/form-data"  role="form">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-11">

                        <h5>Tareas realizadas por alumno en Período de Práctica</h5><br>
                        <div class="form-row">
                            @foreach($areasevaluacion as $areaevaluacion)
                                <div class="col-md-4">
                                    <label class="col-auto" >{{$areaevaluacion->n_area}}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <h5>Evaluación</h5><br>
                        <h6>Actitud del Alumno:</h6>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>Criterio</th>
                                <th colspan="6">Evaluación</th>
                            </tr>

                            @foreach($evalActEmpresas as $evalActEmpresa)
                                <tr>
                                    <td>{{$evalActEmpresa->dp_act}}</td>
                                    <td>{{$evalActEmpresa->valor_act_emp_practica}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <h6>Aplicación de conocimientos del Alumno:</h6>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>Criterio</th>
                                <th colspan="6">Evaluación</th>
                            </tr>

                            @foreach($evalConEmpresas as $evalConEmpresa)
                                <tr>
                                    <td>{{$evalConEmpresa->dp_con}}</td>
                                    <td>{{$evalConEmpresa->valor_con_emp_practica}}</td>
                                </tr>
                            @endforeach
                        </table>

                        <h6>¿De las tareas asignadas cúal fue el porcentaje de tareas efectivamente realizado?</h6>
                        <div class="form-row">
                                <div class="col-md-auto text-center">
                                    <label class="col-form-label" >{{$evaluacion->porcent_tareas_realizadas}}%</label>
                                </div>
                        </div>
                        <br>
                        <h6>A su Juicio, ¿Cuáles son las mayores fortalezas presentadas por el alumno?</h6>
                        <div class="form-row">
                            @foreach($fortalezas AS $fortaleza)
                                <div class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$fortaleza->n_fortaleza}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$fortaleza->dp_fortaleza}}</label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <h6>A su Juicio, ¿Cuáles son las mayores debilidades presentadas por el alumno?</h6>
                        <div class="form-row">
                            @foreach($debilidades AS $debilidad)
                                <div class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$debilidad->n_debilidad}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$debilidad->dp_debilidad}}</label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <h6>De acuerdo al desempeño del alumno, usted recomendaría que la práctica sea</h6>
                        <div class="form-row">
                            <div class="col-md-auto text-center">
                                <label class="col-form-label" >{{$evaluacion->resultado_eval}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function printtag(tagid) {
        var hashid = "#"+ tagid;
        var tagname =  $(hashid).prop("tagName").toLowerCase() ;
        var attributes = "";
        var attrs = document.getElementById(tagid).attributes;
        $.each(attrs,function(i,elem){
            attributes +=  " "+  elem.name+" ='"+elem.value+"' " ;
        })
        var divToPrint= $(hashid).html() ;
        var head = "<html><head>"+ $("head").html() + "</head>" ;
        var allcontent = head + "<body  onload='window.print()' >"+ "<" + tagname + attributes + ">" +  divToPrint + "<" + tagname + ">" +  "</body></html>"  ;
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write(allcontent);
        newWin.document.close();
        // setTimeout(function(){newWin.close();},10);
    }
</script>

