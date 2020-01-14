@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="container-fluid text-center">
                    <h2>Inscripciones</h2>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        {!! Form::open(['route'=> ['listaInscripcion', $carrera], 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
                        <div class="col-2">
                            {!! Form::text('rut', null, ['class' => 'form-control', 'placeholder' => 'Rut']) !!}
                        </div>
                        <div class="col-2">
                            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                        </div>
                        <div class="col-2">
                            {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                        </div>
                        <div class="col-2">
                            {!! Form::text('f_inscripcion', null, ['class' => 'form-control', 'placeholder' => 'Fecha Inscripción']) !!}
                            <label  class="font-italic">"yy-mm-dd"</label>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                            <button class="btn btn-primary" type='button' id='btn' value='Print' onclick='printtag("DivIdToPrint");'><span class="fa fa-print"></span> </button>
                        </div>
                        <div class="container-fluid ">Se encontraron {{ $contador }} Inscripciones</div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body">
                        @if (count($alumnos)>0)
                            <div class="row d-flex justify-content-center container-fluid">
                                <div class="table-responsive" id="DivIdToPrint">
                                    <table class="table table-bordered" id="MyTable">
                                        <thead class="bg-dark" style="color: white">
                                              <tr>
                                                <th class="text-truncate text-center">rut</th>
                                                <th class="text-truncate text-center">Nombre</th>
                                                <th class="text-truncate text-center">Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($alumnos as $alumno)
                                                    <tr>
                                                        <td class="text-truncate text-center">{{ $alumno->rut }}</td>
                                                        <td class="text-truncate text-center">
                                                            {{ $alumno->nombre }}
                                                            {{ $alumno->apellido_paterno }}
                                                            {{ $alumno->apellido_materno }}
                                                        </td>
                                                        <td class="text-truncate text-center">
                                                            @if($alumno->f_inscripcion)
                                                                <b> Fecha inscripción :</b>  {{date('d-m-Y', strtotime($alumno->f_inscripcion))}}<br>
                                                            @endif
                                                            @if($alumno->f_desde)
                                                                <b> Desde :</b>  {{date('d-m-Y', strtotime($alumno->f_desde))}}
                                                            @endif
                                                            @if($alumno->f_hasta)
                                                                <b> Hasta :</b>  {{date('d-m-Y', strtotime($alumno->f_hasta))}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                         <p class="text-center">No se encontraron Inscripciones</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            {{ $alumnos->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
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