@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid text-center">
        <h2>Charlas</h2>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <form class="form-horizontal" action="{{route('lista_charlas')}}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <input id="clave" type="text" class="form-control" name="clave" placeholder="Clave">
                        </div>
                        <div class="col-2">
                            <input id="sala" type="text" class="form-control" name="sala" placeholder="Sala">
                        </div>
                        <div class="col-2">
                            <input id="f_charla" type="text" class="form-control" name="f_charla" placeholder="Fecha de charla">
                            <label  class="font-italic">"yy-mm-dd"</label>
                        </div>
                        <div class="form-group col-4">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                            <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
                        </div>
                        <div class="col-auto text-right">
                            <a href="{{route ('crear_charla')}}"><button type="button" id="boton_agregar" class="btn btn-primary">Nueva Charla</button></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if (count($charla)>0)
                    <div class="table-responsive" id="DivIdToPrint">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-truncate text-center">Clave</th>
                                <th class="text-truncate text-center">Sala</th>
                                <th class="text-truncate text-center">Fecha</th>
                                <th class="text-truncate text-center noMostrar">Opción</th>
                                <th class="text-truncate text-center noMostrar">Gestión</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($charla as $charlas)
                                <tr id="{{$charlas->id_charla}}">
                                    <td class="text-truncate text-center">{{$charlas->clave}}<br></td>
                                    <td class="text-truncate text-center">{{$charlas->sala}}</td>
                                    <td class="text-truncate text-center">{{ date('d-m-Y', strtotime($charlas->f_charla)) }}<br></td>
                                    <td class="text-truncate text-center noMostrar">
                                        <a href="{{route ('lista_participantes',[$charlas->id_charla])}}"><button class="btn btn-warning"><span class="fa fa-user-plus"></span></button></a>
                                        <a href="{{route ('lista_asistencia',[$charlas->id_charla])}}"><button class="btn btn-primary"><span class="fa fa-users"></span> Asistencia</button></a>
                                        <a href="{{route ('lista_resolucion',[$charlas->id_charla])}}"><button id="{{$charlas->id_charla}}" class="btn btn-dark"><span class="fa fa-graduation-cap"></span> Resolución</button></a>
                                    </td>
                                    <td class="text-truncate text-center noMostrar">
                                        <a href="#"><button id="{{$charlas->id_charla}}" class="btn btn-danger" onclick="borrar('{{$charlas->id_charla}}', '{{ date('d-m-Y', strtotime($charlas->f_charla))}}', '{{route('borrar_charla',[$charlas->id_charla])}}')">
                                                <span class="fas fa-trash-alt" aria-hidden="true"></span>
                                            </button></a>
                                        <a href="{{route ('editar_charla', [$charlas->id_charla])}}"><button type="button" id="boton_agregar" class="btn btn-primary"><span class="fa fa-edit"></span></button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">No se encontraron Charlas</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        {{ $charla->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>
    <script>
        function borrar(id_elemento,name , url_action)
        {
            Swal({
                title: 'Estas seguro de querer eliminar la charla con fecha '+name+'?',
                text: "No sera posible revertir este cambio!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminalo!'
            }).then((result) => {

                if (result.value) {

                    parametros={
                        'id_elemento': id_elemento,
                        "_token": $('#token').val()
                    }

                    $.ajax({
                        url: url_action,
                        method: "POST",
                        data: parametros,
                        success: function(response){
                            Swal(
                                'Eliminado!',
                                'La charla ha sido eliminada.',
                                'success'
                            )
                            $('#'+id_elemento).remove();
                        }
                    });
                }
            })
        }

        function printtag(tagid) {

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

