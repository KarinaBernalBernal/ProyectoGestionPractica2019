@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h1>Agregar supervisro</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agregar_supervisor')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                                <label for="apellido_paterno" class="col-md-4 control-label">Apellido paterno</label>
                                <div class="col-md-6">
                                    <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" required autofocus>
                                    @if ($errors->has('apellido_paterno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                                <label for="apellido_materno" class="col-md-4 control-label">Apellido materno</label>
                                <div class="col-md-6">
                                    <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" required autofocus>
                                    @if ($errors->has('apellido_materno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido_materno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                <label for="cargo" class="col-md-4 control-label">Cargo</label>
                                <div class="col-md-6">
                                    <input id="cargo" type="text" class="form-control" name="cargo" required autofocus>
                                    @if ($errors->has('cargo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cargo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('departamento') ? ' has-error' : '' }}">
                                <label for="departamento" class="col-md-4 control-label">Departamento</label>
                                <div class="col-md-6">
                                    <input id="departamento" type="text" class="form-control" name="departamento" required autofocus>
                                    @if ($errors->has('departamento'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('departamento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('fono') ? ' has-error' : '' }}">
                                <label for="fono" class="col-md-4 control-label">Teléfono</label>
                                <div class="col-md-6">
                                    <input id="fono" type="text" class="form-control" name="fono" required autofocus>
                                    @if ($errors->has('fono'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div>
                                <div class="col-md-6">
                                    <label for="id_empresa" class="col-md-4 control-label">id_Empresas</label>
                                    <select id="id_empresa" name="id_empresa" class="form-control">

                                        @foreach($empresas as $id_empresa)
                                            <option value="{{ $id_empresa->id_empresa }}" >{{ $id_empresa->n_empresa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_supervisores')}}"><button class="btn btn-secondary">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection