@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="tab-content" id="myTabContent">
                    <div class="row">
                        <h2>Inscripciones</h2>
                    </div>

                    <br>

                    @if (count($practicas)>0)
                        <div class="row d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                          <tr>
                                            <th class="text-truncate text-center">rut</th>
                                            <th class="text-truncate text-center">Nombre</th>
                                            <th class="text-truncate text-center">Apellido Paterno</th>
                                            <th class="text-truncate text-center">Apellido Materno</th>
                                            <th class="text-truncate text-center">Fecha Inscripcion</th>
                                            <th class="text-truncate text-center">Inicio</th>
                                            <th class="text-truncate text-center">Termino</th>
                                            <!--<th class="text-truncate text-center">Supervisor</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($practicas as $practica)
                                                @foreach($alumnos as $alumno)
                                                    @if($practica->id_alumno === $alumno->id_alumno)
                                                        <tr>
                                                            <td class="text-truncate text-center">{{ $alumno->rut }}</td>
                                                            <td class="text-truncate text-center">{{ $alumno->nombre }}</td>
                                                            <td class="text-truncate text-center">{{ $alumno->apellido_paterno }}</td>
                                                            <td class="text-truncate text-center">{{ $alumno->apellido_materno }}</td>
                                                            <td class="text-truncate text-center">{{ $practica->f_inscripcion }}</td>
                                                            <td class="text-truncate text-center">{{ $practica->f_desde }}</td>
                                                            <td class="text-truncate text-center">{{ $practica->f_hasta }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    @else
                    <p>No existen solicitudes en este momento</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        {{ $alumnos->links() }}
    </div>
@endsection
