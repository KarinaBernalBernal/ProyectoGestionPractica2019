@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h4 class="col-11">Asistencia Charla</h4>
                            <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <form action="#" method="POST">
                        <div class="container-fluid"  id="DivIdToPrint">
                            <div class="justify-content-center">
                                <div class="text-center">
                                {{ csrf_field() }}
                                @if (count($invitados)>0)
                                    <!-- DATA TABLES -->
                                        <div class="row d-flex justify-content-center container-fluid">
                                            <div class="table-responsive">
                                                <table class="table table-bordered " id="MyTable">
                                                    <thead class="bg-dark" style="color: white">
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Rut</th>
                                                        <th>Asistencia</th>
                                                    </tr >
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($invitados as $invitado)
                                                        <tr id="{{$invitado->id_alumno}}">
                                                            <td>
                                                                {{$invitado->nombre}}
                                                                {{$invitado->apellido_paterno}}
                                                            </td>
                                                            <td>{{$invitado->rut}}</td>
                                                            @if($invitado->asistencia_charla == 1)
                                                                <td><input name="asistencia[]" type="checkbox" data-id="{{ $invitado->id_practica }}" data-title="{{$idCharla}}" checked></td>
                                                            @else
                                                                <td><input name="asistencia[]" type="checkbox" data-id="{{ $invitado->id_practica }}" data-title="{{$idCharla}}"></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <h4>No hay invitados asignados para esta charla!</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{route('lista_charlas')}}"><button class="btn btn-secondary" type="button">Atrás</button></a>
                            </div>
                        </div>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        var _token = $("input[name='_token']").val();
        $(document).on('click','input[name="asistencia[]"]',function()
        {
            $.post({
                url: '/Charlas/asistencia',
                method: "POST",
                data: { _token:_token,id: $(this).data('id'), tipo: $(this).data('title')},

                error:function() {
                    Swal.fire({
                        type: 'error',
                        title: 'Opps...!',
                        text: 'No se pudo modificar la asistencia, recarge la pagina para verificar!',
                    });
                }
            });
        });

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
@endsection