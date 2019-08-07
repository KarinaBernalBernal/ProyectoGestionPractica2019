@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header"><h1>Modificar {{$elemento->n_recurso}}</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('actualizar_recurso',[$elemento->id_recurso])}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre del recurso</label>

                                <div class="col-md-6">
                                    <input id="n_recurso" type="text" class="form-control" name="n_recurso" value="{{ old('n_recurso', $elemento->n_recurso) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('n_recurso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <label for="url" class="col-md-4 control-label">Url</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control" name="url" value="{{ old('url', $elemento->url) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_recursos')}}"><button class="btn btn-secondary">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
