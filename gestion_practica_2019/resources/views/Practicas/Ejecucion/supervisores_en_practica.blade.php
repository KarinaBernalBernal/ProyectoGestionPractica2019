@extends('layouts.mainlayout')
<!--
@//section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Supervisores</div>
                    <div class="panel-body">
                        {//!! Form::open([ 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search' ])  !!}
                            <div class="form-group">
                                {//!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de supervisor']) !!}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        {//!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@//endsection
    -->
@section('content')

    <form class="container-fluid" action="{{route('lista_alumnos')}}" method="get">

        <h4 class="text-center">Filtros</h4>

        <hr>

        <div class="row">
            <div class="col-3 mb-2">
                <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre...">
            </div>
            <div class="col-3 mb-2">
                <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido Paterno...">
            </div>
            <div class="col-3 mb-2">
                <input id="email" type="text" class="form-control" name="email" placeholder="Email...">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Buscar</button>
        </div>
    </form>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-offset">
                <div class="tab-content" id="myTabContent">
                    <div class="container-fluid text-center">
                        <h2>Supervisores</h2>
                    </div>

                    <br>
                    @if (count($supervisores) > 0 )

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
                    @else
                        <p class="text-center">No existen supervisores en este momento!!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
    {{---        {{ $supervisores->links() }} ---}}
        </div>
    @endsection

