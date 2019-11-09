@extends('layouts.mainlayout')
@section('content')

        <h4 class="text-center">Filtros</h4>

        <hr>

        <div class="container-fluid">
            {!! Form::open(['route'=> 'supervisoresPractica', 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
            <div class="col-3 mb-2">
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'nombre del supervisor']) !!}
            </div>
            <button type="submit" class="btn btn-info form-group">Buscar</button>
            {!! Form::close() !!}
        </div>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="tab-content" id="myTabContent">
                    <div class="container-fluid text-center">
                        <h2>Supervisores</h2>
                    </div>
                    <br>
                        <div class="row d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="MyTable">
                                    <thead class="bg-dark" style="color: white">
                                    <tr>
                                        <th class="text-truncate text-center">ID</th>
                                        <th class="text-truncate text-center">Nombre</th>
                                        <th class="text-truncate text-center">Apellido</th>
                                        <th class="text-truncate text-center">Cargo</th>
                                        <th class="text-truncate text-center">Departamento</th>
                                        <th class="text-truncate text-center">Email</th>
                                        <th class="text-truncate text-center">Fono</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($supervisores as $lista)
                                        <tr>
                                            <td class="text-truncate text-center">{{ $lista->id_supervisor }}</td>
                                            <td class="text-truncate text-center">{{ $lista->nombre }}</td>
                                            <td class="text-truncate text-center">{{ $lista->apellido_paterno }}</td>
                                            <td class="text-truncate text-center">{{ $lista->cargo }}</td>
                                            <td class="text-truncate text-center">{{ $lista->departamento }}</td>
                                            <td class="text-truncate text-center">{{ $lista->email }}</td>
                                            <td class="text-truncate text-center">{{ $lista->fono }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
    {{---        {{ $supervisores->links() }} ---}}
    </div>
    @endsection

