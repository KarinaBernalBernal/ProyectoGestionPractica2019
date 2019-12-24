@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="tab-content" id="myTabContent">
                    <div class="container-fluid">
                        <h2>Nuevas Solicitudes</h2>
                    </div>

                    <br>
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
                    <p class="container-fluid">No existen solicitudes en este momento</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
    {{ $solicitudes->links() }}
    </div>
@endsection
