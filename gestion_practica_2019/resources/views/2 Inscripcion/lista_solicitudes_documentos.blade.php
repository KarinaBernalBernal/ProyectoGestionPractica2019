@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <h3>Solicitudes de documentos</h3>
        <br>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center">
                @if (count($lista)>0)
                    <!-- DATA TABLES -->
                    <div class="row d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="MyTable">
                                <thead class="bg-dark" style="color: white">
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha solicitud</th>
                                    <th>Carta presentacion</th>
                                    <th>Seguro escolar</th>
                                    <th>Fecha desde</th>
                                    <th>Fecha hasta</th>
                                    <th>Nombre destinatario</th>
                                    <th>Cargo</th>
                                    <th>Departamento</th>
                                    <th>Cuidad</th>
                                    <th>Empresa</th>
                                    <th>Alumno</th>
                                </tr >
                                </thead>
                                <tbody>
                                    @foreach ($lista as $solicitud)
                                        <tr id="{{$solicitud->id_doc_solicitado}}">
                                            <td>{{$solicitud->id_doc_solicitado}}</td>
                                            <td>{{$solicitud->f_solicitud}}</td>
                                            <td>{{$solicitud->carta_presentacion}}</td>
                                            <td>{{$solicitud->seguro_escolar}}</td>
                                            <td>{{$solicitud->f_desde}}</td>
                                            <td>{{$solicitud->f_hasta}}</td>
                                            <td>{{$solicitud->n_destinatario}}</td>
                                            <td>{{$solicitud->cargo}}</td>
                                            <td>{{$solicitud->departamento}}</td>
                                            <td>{{$solicitud->cuidad}}</td>
                                            <td>{{$solicitud->empresa}}</td>
                                            <td>{{$solicitud->id_alumno}}</td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                @else
                    <p>No existen solicitudes en este momento</p>
                @endif
                <!-- FIN DATA TABLES -->
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                    <a href="/"><button class="btn btn-primary btn-lg">Atras</button></a>
            </div>
        </div>

    </div>

<script>
    function borrar(id_elemento,name , url_action)
    {

        Swal({
              title: 'Estas seguro de querer eliminar la solicitud '+name+'?',
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
                        "_token": $("#token").val()
                    }

                    $.ajax({
                        url: url_action,
                        method: "POST",
                        data: parametros,
                        success: function(response){
                            Swal(
                              'Eliminado!',
                              'La solicitud ha sido eliminada.',
                              'success'
                            )
                            $('#'+id_elemento).remove();
                        }
                    });
                }
            })

    }
</script>
@endsection
