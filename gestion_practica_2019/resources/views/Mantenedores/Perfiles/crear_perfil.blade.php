@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h1>Agregar perfil</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agregar_perfil')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('n_perfil') ? ' has-error' : '' }}">
                                <label for="n_perfil" class="col-md-4 control-label">n_perfil</label>

                                <div class="col-md-6">
                                    <input id="n_perfil" type="text" class="form-control" name="n_perfil" required autofocus>

                                    @if ($errors->has('n_perfil'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('n_perfil') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_perfiles')}}"><button class="btn btn-secondary">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
