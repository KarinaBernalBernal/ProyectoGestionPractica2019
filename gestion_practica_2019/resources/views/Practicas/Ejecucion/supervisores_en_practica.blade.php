@extends('layouts.mainlayout')
@section('content')
        <hr>

        <div class="container-fluid">
            {!! Form::open(['route'=> 'supervisoresPracticaEjecucion', 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
            <div class="col-3 mb-2">
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
            </div>
            <div class="col-3 mb-2">
                {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido paterno']) !!}
            </div>
            <div class="col-3 mb-2">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            </div>
            <button type="submit" class="btn btn-info form-group">Buscar</button>
            {!! Form::close() !!}
        </div>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="tab-content text-center" id="myTabContent">
                    @if (count($lista)>0)
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
                                    @foreach( $lista as $supervisores)
                                        <tr>
                                            <td class="text-truncate text-center">{{ $supervisores->id_supervisor }}</td>
                                            <td class="text-truncate text-center">{{ $supervisores->nombre }}</td>
                                            <td class="text-truncate text-center">{{ $supervisores->apellido_paterno }}</td>
                                            <td class="text-truncate text-center">{{ $supervisores->cargo }}</td>
                                            <td class="text-truncate text-center">{{ $supervisores->departamento }}</td>
                                            <td class="text-truncate text-center">{{ $supervisores->email }}</td>
                                            <td class="text-truncate text-center">{{ $supervisores->fono }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <p class="text-danger">No se encontraron Supervisores</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
    {{---        {{ $supervisores->links() }} ---}}
    </div>
    @endsection

