@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <div class="form-row">
                            <h4 class="col-11">Resolución de Charla</h4>
                            <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ csrf_field() }}
                        <form action="{{route('modificar_resolucion',[$idCharla] )}}" method="POST">
                            <div class="container-fluid" id="DivIdToPrint">
                                <div class="justify-content-center">
                                    <div class="text-center">
                                    {{ csrf_field() }}
                                    @if (count($alumnos)>0)
                                        <!-- DATA TABLES -->
                                            <div class="row d-flex justify-content-center container-fluid">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered " id="MyTable">
                                                        <thead class="bg-dark" style="color: white">
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Rut</th>
                                                            <th>Asistencia</th>
                                                            <th>Evaluar</th>
                                                        </tr >
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($alumnos as $alumno)
                                                            <tr id="{{$alumno->id_alumno}}">
                                                                <td>
                                                                    {{$alumno->nombre}}
                                                                    {{$alumno->apellido_paterno}}
                                                                </td>
                                                                <td>{{$alumno->rut}}</td>
                                                                @if($alumno->asistencia_charla != 0)
                                                                    <td>Si</td>
                                                                @else
                                                                    <td>No</td>
                                                                @endif
                                                                <td>
                                                                    <div>
                                                                        <input type="checkbox" name="alumno[]" value="{{$alumno->id_alumno}}" checked style="display: none">
                                                                        <select id="resolucion" name="resolucion[]" class="custom-select" data-id="{{$alumno->id_practica}}">
                                                                            <option selected value="">Selecciona...</option>
                                                                            <option value="Aprobada" @if(old("resolucion_charla", $alumno->resolucion_charla) == 'Aprobada') {{'selected'}} @endif>Aprobada</option>
                                                                            <option value="Rechazada" @if(old("resolucion_charla", $alumno->resolucion_charla) == 'Rechazada') {{'selected'}} @endif>Rechazada</option>
                                                                            <option value="Pendiente" @if(old("resolucion_charla", $alumno->resolucion_charla) == 'Pendiente') {{'selected'}} @endif>Pendiente</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @else
                                            <p>No existen alumnos en este momento</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
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