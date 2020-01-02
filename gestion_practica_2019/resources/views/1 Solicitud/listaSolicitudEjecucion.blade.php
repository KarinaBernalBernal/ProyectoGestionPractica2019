@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid text-center">
            <h2>Solicitudes</h2>
        </div>
        <div class="card text">
            <div class="card-body">
                <form class="form-horizontal container-fluid" action="{{route('listaSolicitudEjecucion')}}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut Alumno">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                        <div>Se encontraron {{ $contador }} Solicitudes</div>
                </form>
                <div class="tab-content" id="myTabContent">
                    <hr>
                    @if (count($solicitudes)>0)
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                    <tr>
                                        <th class="text-truncate text-center">Rut</th>
                                        <th class="text-truncate text-center">Nombres</th>
                                        <th class="text-truncate text-center">Apellido paterno</th>
                                        <th class="text-truncate text-center">Apellido materno</th>
                                        <th class="text-truncate text-center">Fecha</th>
                                        <th class="text-truncate text-center">Direccion</th>
                                        <th class="text-truncate text-center">Email</th>
                                        <th class="text-truncate text-center">Fono</th>
                                        <th class="text-truncate text-center">Año Ingreso</th>
                                        <th class="text-truncate text-center">Estimación</th>
                                      {{--  <th class="text-truncate text-center">Acciones</th>  --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($solicitudes as $solicitud)
                                            <tr>
                                                <td class="text-truncate text-center">{{ $solicitud->rut }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->nombre }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->apellido_paterno }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->apellido_materno }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->f_solicitud }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->direccion }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->email }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->fono }}</td>
                                                <td class="text-truncate text-center">{{ $solicitud->anno_ingreso }}</td>
                                                <td class="text-truncate text-center"><strong>Semestre:</strong> {{ $solicitud->semestre_proyecto }} <br>
                                                    <strong>Año:</strong>	{{ $solicitud->anno_proyecto }}</td>
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
            </div>
        </div>
    </div>
    <<div class="row d-flex justify-content-center">
        {{ $solicitudes->appends(Request::except("page"))->render("pagination::bootstrap-4") }}
    </div>
@endsection
