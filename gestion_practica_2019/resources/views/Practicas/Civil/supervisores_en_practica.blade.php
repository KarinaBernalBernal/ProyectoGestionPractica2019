@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid text-center">
        <h2>Supervisores</h2>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header ">
                {!! Form::open(['route'=> 'supervisoresPracticaCivil', 'method' => 'GET', 'class' => 'row container-fluid', 'role' => 'search' ])  !!}
                <div class="col-2 mb-2">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                </div>
                <div class="col-2 mb-2">
                    {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido']) !!}
                </div>
                <div class="col-2 mb-2">
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
                <button type="submit" class="btn btn-info form-group">Buscar</button>
                {!! Form::close() !!}
            </div>
            <div class="card-body">
                @if (count($lista)>0)
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark" style="color: white">
                            <tr>
                                <th class="text-truncate text-center">Nombre</th>
                                <th class="text-truncate text-center">Trabajo</th>
                                <th class="text-truncate text-center">Email</th>
                                <th class="text-truncate text-center">Fono</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $lista as $supervisores)
                                <tr id="{{ $supervisores->id_supervisor }}">
                                    <td class="text-truncate text-center">
                                        {{ $supervisores->nombre }}
                                        {{ $supervisores->apellido_paterno }}
                                    </td>
                                    <td class="text-truncate text-center">
                                        <strong>Cargo :</strong> {{ $supervisores->cargo }}<br>
                                        <strong>Departamento :</strong> {{ $supervisores->departamento }}<br>
                                    </td>
                                    <td class="text-truncate text-center">{{ $supervisores->email }}</td>
                                    <td class="text-truncate text-center">{{ $supervisores->fono }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-danger text-center">No se encontraron Supervisores</p>
                @endif
            </div>
        </div>
    </div>
    @endsection

