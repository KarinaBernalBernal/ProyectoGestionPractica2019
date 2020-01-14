@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="tab-content" id="myTabContent">
                    <div class="container-fluid">
                        <h2>Nuevas Solicitudes</h2>
                    </div>
                    <div class="col-auto text-right">
                        <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
                    </div>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <br>
                    @if (count($lista)>0)

                        <div class="container-fluid">
                            <div class="table-responsive" id="DivIdToPrint">
                                <table class="table table-bordered table-sm" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                    <tr class="text-truncate text-center">
                                        <th>Id</th>
                                        <th>Alumno</th>
                                        <th>Fecha solicitud</th>
                                        <th>Carta presentación</th>
                                        <th>Seguro escolar</th>
                                        <th class="noMostrar">Opción</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-truncate text-center">
                                    @foreach ($lista as $solicitud)
                                        <tr id="{{$solicitud->id_doc_solicitado}}">
                                            <td>{{$solicitud->id_doc_solicitado}}</td>
                                            <td class="text-md-left">
                                                {{$solicitud->nombre}} {{$solicitud->apellido_paterno}} {{$solicitud->apellido_materno}}
                                                <br>
                                                {{$solicitud->rut}}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($solicitud->f_solicitud)) }}</td>
                                            @if($solicitud->carta_presentacion == 1)
                                                <td>Si</td>
                                            @else
                                                <td>No</td>
                                            @endif
                                            @if($solicitud->seguro_escolar == 1)
                                                <td>Si</td>
                                            @else
                                                <td>No</td>
                                            @endif
                                            <td class="noMostrar">
                                                <a class='botonModalSolicitudDocumentos btn btn-primary btn-sm' href="" data-toggle="modal" data-form="{{ route('solicitudDocumentosModal',['id'=>$solicitud->id_doc_solicitado])}}" data-target="#modal-solicitudDocumentos"><span class="fa fa-file"></span></a>
                                                <button id="{{$solicitud->id_alumno}}" class="btn btn-warning btn-sm" onclick="aviso('{{$solicitud->id_alumno}}', '{{$solicitud->nombre}}', '{{route('aviso')}}')"><span class="fa fa-bell"></span></button>
                                                <a href="#"><button id="{{$solicitud->id_doc_solicitado}}" class="btn btn-danger btn-sm" onclick="borrar('{{$solicitud->id_doc_solicitado}}', '{{$solicitud->nombre}}', '{{route('borrar_solicitud_documentos',[$solicitud->id_doc_solicitado])}}')"><span class="fa fa-trash-alt"></span></button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="container-fluid">No existen solicitudes en este momento</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal-solicitudDocumentos"></div>
    <script>
        $(document).ready(function () {

            //modal-evaluarSolicitud
            $(".botonModalSolicitudDocumentos").click(function (ev) { // for each edit contact url
                ev.preventDefault(); // prevent navigation
                var url = $(this).data("form"); // get the contact form url
                console.log(url);
                $("#modal-solicitudDocumentos").load(url, function () { // load the url into the modal
                    $(this).modal('show'); // display the modal on url load
                });
            });
            $('.solicitudDocumentos-form').on('submit', function () {
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    context: this,
                    success: function (data, status) {
                        $('#modal-solicitudDocumentos').html(data);
                    }
                });
            });

            $('#modal-solicitudDocumentos').on('hidden.bs.modal', function (e) {
                $(this).find('.modal-content').empty();
            });
        });

        function aviso(id_elemento,name , url_action)
        {
            Swal({
                title: '¿Estás seguro de querer enviar un aviso a '+name+'?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!'
            }).then((result) => {

                if (result.value) {

                    window.swal({
                        title: "enviando...",
                        text: "Por favor espere",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: url_action,
                        method: "GET",
                        data: { id : id_elemento },
                        success: function(){
                            Swal(
                                'Listo',
                                'Se ha notificado a '+name+'.',
                                'success'
                            )
                        },
                        error:function() {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps...!',
                                text: 'No se pudo notificar',
                            });
                        }
                    });
                }
            })
        }

        function borrar(id_elemento, name , url_action) {
            Swal({
                title: '¿Estás seguro de querer eliminar la solicitud de ' + name + '?',
                text: "No será posible revertir este cambio",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Elimínalo'
            }).then((result) => {

                if (result.value) {

                    parametros = {
                        'id_elemento': id_elemento,
                        "_token": $('#token').val()
                    };

                    $.ajax({
                        url: url_action,
                        method: "POST",
                        data: parametros,
                        success: function (response) {
                            Swal(
                                'Eliminado',
                                'La solicitud ha sido eliminada.',
                                'success'
                            );
                            $('#' + id_elemento).remove();
                        }
                    });
                }
            })
        }
        function printtag(tagid)
        {
            $('.noMostrar').hide();
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
            $('.noMostrar').show();
        }
    </script>
@endsection