<div class="modal-dialog modal-lg">
    <div class="modal-content" id="DivIdToPrint">
        <div class="modal-header">
    @foreach($solicitudD AS $solicitudesD)
            <h4>Solicitud de {{$solicitudesD->nombre}} {{$solicitudesD->apellido_paterno}} {{$solicitudesD->apellido_materno}}</h4>
            <div class="col-1">
                <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
            </div>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i style="color: red;" class="fas fa-times"></i></span>
            </button>
        </div>
        <form id="modalSolicitudDocumentos" class="solicitudDocumentos-form" method="POST" enctype="multipart/form-data"  role="form">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-11">

                        {{-- Carta Presentación / Seguro escolar --}}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label text-md-right" >{{ __('Carta Presentación') }}</label>
                            @if($solicitudesD->carta_presentacion == 1)
                                <input type="checkbox" class="col-form-label text-md-right col-6" checked>
                            @else
                                <input type="checkbox" class="col-form-label text-md-right col-6">
                            @endif
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label text-md-right" >{{ __('Seguro Escolar') }}</label>
                                @if($solicitudesD->seguro_escolar == 1)
                                    <input type="checkbox" class="col-form-label text-md-right col-6" checked>
                                @else
                                    <input type="checkbox" class="col-form-label text-md-right col-6">
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h5>Periodo Práctica</h5>
                        {{-- Periodo de práctica --}}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">{{ __('Desde') }}</label>
                                <label class="col-form-label col-4" >:</label>
                                <label class="col-form-label col-auto">{{ date('d-m-Y', strtotime($solicitudesD->f_desde)) }}</label>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">{{ __('Hasta') }}</label>
                                <label class="col-form-label col-4" >:</label>
                                <label class="col-form-label col-auto">{{ date('d-m-Y', strtotime($solicitudesD->f_hasta)) }}</label>
                            </div>
                        </div>
                        <hr>
                        <h5>Datos del Alumno</h5>
                        {{-- Nombre --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Nombre') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-auto">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->nombre}} {{$solicitudesD->apellido_paterno}} {{$solicitudesD->apellido_materno}}</label>
                            </div>
                        </div>

                        {{-- Rut --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Rut') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->rut}}</label>
                            </div>
                        </div>

                        {{-- Condicion Práctica--}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Condición práctica') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->resolucion_solicitud}}</label>
                            </div>
                        </div>

                        <hr>
                        <h5>Datos de la Empresa</h5>
                        <br>
                        {{-- Nombre a quien se dirige la carta --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-left" >{{ __('Nombre a quien se dirige la carta') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->n_destinatario}}</label>
                            </div>
                        </div>

                        {{-- Cargo--}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Cargo') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->cargo}}</label>
                            </div>
                        </div>

                        {{-- Departamento --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Departamento') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->departamento}}</label>
                            </div>
                        </div>
                        {{-- Empresa --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Empresa') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->empresa}}</label>
                            </div>
                        </div>

                        {{-- Ciudad --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Ciudad') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right col-auto">{{$solicitudesD->ciudad}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
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
        });
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

