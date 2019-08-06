@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h1>Agregar alumno</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agregar_alumno')}}" method="post">
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
                             <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                                <label for="rut" class="col-md-4 control-label">RUT</label>
                                <div class="col-md-6">
                                    <input id="rut" type="text" class="form-control" name="rut" required autofocus>
                                    @if ($errors->has('rut'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rut') }}</strong>
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
                             <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion" class="col-md-4 control-label">Dirección</label>
                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion" required autofocus>
                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('direccion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> <div class="form-group{{ $errors->has('fono') ? ' has-error' : '' }}">
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
                             <div class="form-group{{ $errors->has('anno_ingreso') ? ' has-error' : '' }}">
                                <label for="anno_ingreso" class="col-md-4 control-label">Año de ingreso</label>
                                <div class="col-md-6">
                                    <input id="anno_ingreso" type="text" class="form-control" name="anno_ingreso" required autofocus>
                                    @if ($errors->has('anno_ingreso'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('anno_ingreso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                                <label for="carrera" class="col-md-4 control-label">Carrera</label>
                                <div class="col-md-6">
                                    <input id="carrera" type="text" class="form-control" name="carrera" required autofocus>
                                    @if ($errors->has('carrera'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('carrera') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('estimacion_semestre') ? ' has-error' : '' }}">
                                <label for="estimacion_semestre" class="col-md-4 control-label">Estimación de semestre</label>
                                <div class="col-md-6">
                                    <input id="estimacion_semestre" type="text" class="form-control" name="estimacion_semestre" required autofocus>
                                    @if ($errors->has('estimacion_semestre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('estimacion_semestre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('id_user') ? ' has-error' : '' }}">
                                <label for="id_user" class="col-md-4 control-label">id user</label>
                                <div class="col-md-6">
                                    <input id="id_user" type="text" class="form-control" name="id_user" required autofocus>
                                    @if ($errors->has('id_user'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_user') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_alumnos')}}"><button class="btn btn-secondary">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection