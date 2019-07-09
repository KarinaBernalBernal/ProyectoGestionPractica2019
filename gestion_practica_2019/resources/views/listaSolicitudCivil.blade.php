@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Solicitudes</h4>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="MyTable">
                                <thead>
                                <tr>
                                    <th class="text-truncate text-center">Rut</th>
                                    <th class="text-truncate text-center">Nombres</th>
                                    <th class="text-truncate text-center">Apellido paterno</th>
                                    <th class="text-truncate text-center">Apellido materno</th>
                                    <th class="text-truncate text-center">Fecha</th>
                                    <th class="text-truncate text-center">Direccion</th>
                                    <th class="text-truncate text-center">Fono</th>
                                    <th class="text-truncate text-center">Año Ingreso</th>
                                    <th class="text-truncate text-center">Estimación</th>
                                    <th class="text-truncate text-center">Acciones</th>
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
                                        <td class="text-truncate text-center">{{ $solicitud->fono }}</td>
                                        <td class="text-truncate text-center">{{ $solicitud->anno_ingreso }}</td>
                                        <td class="text-truncate text-center">{{ $solicitud->estimacion_semestre }}</td>


                                        <td class="text-center">
                                            <div class="btn-group">
                                                <form method="get" action='{{ route('aceptarSolicitud', $solicitud->id_solicitud) }}'>
                                                    <button type="submit" class="btn btn-success btn-sm btn-block">Aceptar</button>
                                                </form>
                                                <form method="get" action='{{ route('borrarSolicitud', $solicitud->id_solicitud) }}'>
                                                    <button type="submit" class="btn btn-danger btn-sm">Denegar</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-truncate text-center">Rut</th>
                                    <th class="text-truncate text-center">Nombres</th>
                                    <th class="text-truncate text-center">Apellido paterno</th>
                                    <th class="text-truncate text-center">Apellido materno</th>
                                    <th class="text-truncate text-center">Fecha</th>
                                    <th class="text-truncate text-center">Direccion</th>
                                    <th class="text-truncate text-center">Fono</th>
                                    <th class="text-truncate text-center">Año Ingreso</th>
                                    <th class="text-truncate text-center">Estimación</th>
                                    <th class="text-truncate text-center">Acciones</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
