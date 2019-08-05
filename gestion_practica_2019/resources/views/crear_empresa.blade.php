@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <h1>Agregar alumno</h1>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('agregar_empresa')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('n_empresa') ? ' has-error' : '' }}">
                                <label for="n_empresa" class="col-md-4 control-label">n_empresa</label>
                                <div class="col-md-6">
                                    <input id="n_empresa" type="text" class="form-control" name="n_empresa" required autofocus>
                                    @if ($errors->has('n_empresa'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('n_empresa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                                <label for="rut" class="col-md-4 control-label">rut</label>
                                <div class="col-md-6">
                                    <input id="rut" type="text" class="form-control" name="rut" required autofocus>
                                    @if ($errors->has('rut'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rut') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                                <label for="ciudad" class="col-md-4 control-label">ciudad</label>
                                <div class="col-md-6">
                                    <input id="ciudad" type="text" class="form-control" name="ciudad" required autofocus>
                                    @if ($errors->has('ciudad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ciudad') }}</strong>
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
                             <div class="form-group{{ $errors->has('casilla') ? ' has-error' : '' }}">
                                <label for="casilla" class="col-md-4 control-label">casilla de ingreso</label>
                                <div class="col-md-6">
                                    <input id="casilla" type="text" class="form-control" name="casilla" required autofocus>
                                    @if ($errors->has('casilla'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('casilla') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <a href="{{route('lista_empresas')}}"><button class="btn btn-lg btn-block">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection