@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid text-center">
            <h2>Solicitudes</h2>
        </div>
        <div class="card text">
            <div class="card-body">
                <form class="form-horizontal container-fluid" action="{{route('listaSolicitudCivil')}}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut Alumno">
                        </div>
                        <div class="col-2">
                            <input id="anno_ingreso" type="text" class="form-control" name="anno_ingreso" placeholder="Año Ingreso">
                            <label  class="font-italic">"yy-mm-dd"</label>
                        </div>
                        <div class="col-2">
                            <input id="f_solicitud" type="text" class="form-control" name="f_solicitud" placeholder="Fecha Solicitud">
                            <label  class="font-italic">"yy-mm-dd"</label>
                        </div>
                        <div class="col-3">
                            <select id="resolucion_solicitud" type="text" class="form-control" name="resolucion_solicitud">
                                <option value="">Seleccione Resolución</option>
                                <option value="Autorizada">Autorizada</option>
                                <option value="Rechazada">Rechazada</option>
                                <option value="Pendiente">Pendiente</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                            <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
                        </div>
                    </div>
                    <div>Se encontraron {{ $contador }} Solicitudes</div>
                </form>
                <div class="tab-content" id="myTabContent">
                    <hr>
                    <div class="container-fluid">
                        {{ $solicitudes->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
                    </div>
                    @if (count($solicitudes)>0)
                        <div class="container-fluid" id="DivIdToPrint">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                    <tr>
                                        <th class="text-truncate text-center">N°</th>
                                        <th class="text-truncate text-center">Rut</th>
                                        <th class="text-truncate text-center">Nombres</th>
                                        <th class="text-truncate text-center">Año Ingreso</th>
                                        <th class="text-truncate text-center">Estado Solicitud</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($solicitudes as $solicitud)
                                        <tr>
                                            <td class="text-truncate text-center">
                                                {{$numeroSolicitudes = $numeroSolicitudes + 1}}
                                            </td>
                                            <td class="text-truncate text-center">{{ $solicitud->rut }}</td>
                                            <td class="text-truncate text-center">
                                                {{ $solicitud->nombre }}
                                                {{ $solicitud->apellido_paterno }}
                                                {{ $solicitud->apellido_materno }}
                                            </td>
                                            <td class="text-truncate text-center">{{ $solicitud->anno_ingreso }}</td>
                                            @if($solicitud->resolucion_solicitud == "Autorizada")
                                                <td class="text-truncate text-center text-success">{{ $solicitud->resolucion_solicitud }}</td>
                                            @endif
                                            @if($solicitud->resolucion_solicitud == "Rechazada")
                                                <td class="text-truncate text-center text-danger">{{ $solicitud->resolucion_solicitud }}</td>
                                            @endif
                                            @if($solicitud->resolucion_solicitud== "Pendiente")
                                                <td class="text-truncate text-center text-info">{{ $solicitud->resolucion_solicitud }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                    <p class="text-center">No existen solicitudes en este momento</p>
                    @endif
                </div>
                <div class="container-fluid">
                    {{ $solicitudes->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
    <<div class="row d-flex justify-content-center">
        {{ $solicitudes->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>

    <script>
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
    @endsection
