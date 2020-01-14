<div class="modal-dialog modal-lg">
    <div class="modal-content" id="paraImprimir">
        <div class="modal-header">
            <div>
                <h1 class="h3 mb-0 text-gray-1000">Inscripión de Práctica</h1>
            </div>
            <div class="col-1">
                <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("paraImprimir");'><span class="fa fa-print"></span> </button>
            </div>
            <button type="button" class="close text-danger" data-dismiss="modal">
                <span> <i class="fas fa-times"></i></span>
            </button>
        </div>

        <div class="card-body">

            {{-- Documentos solicitados --}}

            <div class="card text">
                <div class="card-body">

                    <h4 class="text-center">Periodo de práctica</h4>
                    {{--Fechas--}}
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label><b>{{ __('Desde') }} :</b> {{date('d-m-y', strtotime($practicas->f_desde))}}</label>
                        </div>
                        <div class="col-md-4">
                            <label><b>{{ __('Hasta') }} :</b> {{date('d-m-y', strtotime($practicas->f_hasta))}}</label>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            {{-- Datos de la empresa --}}
            <div class="card text">
                <div class="card-body">
                    <h4 class="text-center">Datos de la empresa</h4>

                    <hr>

                    {{-- Nombre Empresa --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Nombre Empresa') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->n_empresa}}</label>
                        </div>
                    </div>

                    {{-- RUT --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('RUT') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->rut}}</label>
                        </div>
                    </div>

                    {{-- Ciudad --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Ciudad') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->ciudad}}</label>
                        </div>
                    </div>

                    {{-- Direccion --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Dirección') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->direccion}}</label>
                        </div>
                    </div>

                    {{-- Fono --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Fono') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->fono}}</label>
                        </div>
                    </div>

                    {{-- Casilla --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Casilla') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->casilla}}</label>
                        </div>
                    </div>

                    {{-- Correo Electronico Empresa--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >Email Empresa</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->email}}</label>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="card text">
                <div class="card-body">
                    <h4 class="text-center">Datos del supervisor</h4>

                    <hr>

                    {{-- Nombre Supervisor--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Nombre') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->nombre}}</label>
                        </div>
                    </div>

                    {{-- Apellido Paterno --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Apellido Paterno') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->apellido_paterno}}</label>
                        </div>
                    </div>

                    {{-- Cargo --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Cargo') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->cargo}}</label>
                        </div>
                    </div>

                    {{-- Departamento --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Departamento') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->departamento}}</label>
                        </div>
                    </div>

                    {{-- Fono --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Fono') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->fono}}</label>
                        </div>
                    </div>

                    {{-- Correo Electronico Supervisor--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >Email supervisor</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->email}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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