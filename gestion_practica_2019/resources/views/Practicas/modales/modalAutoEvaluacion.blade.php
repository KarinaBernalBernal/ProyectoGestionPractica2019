<div class="modal-dialog modal-lg">
    <div class="modal-content" id="paraImprimir">
        <div class="modal-header">
            <h4>Autoevaluación</h4>
            <div class="col-1">
                <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("paraImprimir");'><span class="fa fa-print"></span> </button>
            </div>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i style="color: red;" class="fas fa-times"></i></span>
            </button>
        </div>
        <form id="modalAutoEvaluacion" class="autoEvaluacion-form" method="POST" enctype="multipart/form-data"  role="form">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-11">

                        <h5>¿En qué área(s) clasificaría su práctica?</h5><br>
                        {{-- Periodo de práctica --}}
                        <div class="form-row">
                            @foreach($areasautoeval AS $areaautoeval)
                                <div class="col-md-4">
                                    <label class="col-auto" >{{$areaautoeval->n_area}}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>

                        <h5>Herramientas de SW utilizadas en la práctica</h5><br>
                        {{-- Periodo de práctica --}}
                        <div class="form-row">
                            @foreach($herramientasPractica AS $herramientaPractica)
                                <div class="col-md-4">
                                    <label class="col-auto" >{{$herramientaPractica->n_herramienta}}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>

                        <h5>Tareas realizadas</h5>
                        <div class="form-row">
                            @foreach($tareas AS $tarea)
                                <div class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$tarea->n_tarea}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$tarea->dp_tarea}}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>

                        <h5>Conocimientos y Hablidades</h5><br>
                        <h6>¿Qué <strong style="color: green">Conocimientos</strong>/<strong style="color: red">Habilidades</strong> aprendidas en la carrera fueron importantes para el desarrollo de su práctica?</h6>
                        <div class="form-row">
                            @foreach($conocimientosA AS $conocimientoA)
                                <div style="color: green" class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$conocimientoA->n_conocimiento}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$conocimientoA->dp_conocimiento}}</label>
                                </div>
                            @endforeach
                            @foreach($habilidadesA AS $habilidadA)
                                <div style="color: red;" class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$habilidadA->n_habilidad}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$habilidadA->dp_habilidad}}</label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <h6>¿Qué <strong style="color: green">Conocimientos</strong>/<strong style="color: red">Habilidades</strong> piensa que le faltaron para un buen desempeño en su práctica?</h6>
                        <div class="form-row">
                            @foreach($conocimientosF AS $conocimientoF)
                                <div style="color: green" class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$conocimientoF->n_conocimiento}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$conocimientoF->dp_conocimiento}}</label>
                                </div>
                            @endforeach
                            @foreach($habilidadesF AS $habilidadF)
                                <div style="color: red;" class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$habilidadF->n_habilidad}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$habilidadF->dp_habilidad}}</label>
                                </div>
                            @endforeach
                        </div>

                        <br>
                        <h6>¿Qué conocimientos adquirió durante su práctica?</h6>
                        <div class="form-row">
                            @foreach($conocimientosA AS $conocimientoA)
                                <div class="col-md-3">
                                    <label class="col-form-label text-md-right" >{{$conocimientoA->n_conocimiento}}</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-md-right" >:</label>
                                </div>
                                <div class="col-md-8">
                                    <label class="col-form-label text-md-right col-auto">{{$conocimientoA->dp_conocimiento}}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <h5>Autoevaluación</h5><br>
                        <h6>¿Cómo calificaría su desempeño durante el período de práctica?</h6>
                        <div class="form-row">
                            @foreach($desempennos AS $desempenno)
                                <div class="col-md-auto text-center">
                                    <label class="col-form-label" >{{$desempenno->valor}}</label>
                                </div>
                            @endforeach
                        </div>
                        <h6>¿Por qué? (Fundamente su autoevaluación):</h6>
                        <div class="form-row">
                            @foreach($desempennos AS $desempenno)
                                <div class="col-md-auto">
                                    <label class="col-form-label text-md-right col-auto">{{$desempenno->dp_desempenno}}</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <h6>Actitud del Alumno:</h6>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>Criterio</th>
                                <th colspan="6">Evaluación</th>
                            </tr>

                            @foreach($evalActPracticas as $evalActPractica)
                                <tr>
                                    <td>{{$evalActPractica->dp_act}}</td>
                                    <td>{{$evalActPractica->valor_act_practica}}</td>
                                </tr>
                            @endforeach
                        </table>
                        <h6>Aplicación de conocimientos del Alumno:</h6>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>Criterio</th>
                                <th colspan="6">Evaluación</th>
                            </tr>

                            @foreach($evalConPracticas as $evalConPractica)
                                <tr>
                                    <td>{{$evalConPractica->dp_con}}</td>
                                    <td>{{$evalConPractica->valor_con_practica}}</td>
                                </tr>
                            @endforeach
                        </table>
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

