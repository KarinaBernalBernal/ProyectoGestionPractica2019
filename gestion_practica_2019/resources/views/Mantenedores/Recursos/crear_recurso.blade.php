@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h1>Agregar recurso</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agregar_recurso')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('n_recurso') ? ' has-error' : '' }}">
                                <label for="n_recurso" class="col-md-4 control-label">Nombre del recurso</label>

                                <div class="col-md-6">
                                    <input id="n_recurso" type="text" class="form-control" name="n_recurso" required autofocus>

                                    @if ($errors->has('n_recurso'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('n_recurso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">


                                <label for="url" class="col-md-4 control-label">Url</label>

                                <div class="col-md-6">
                                    <input id="url" type="text" class="form-control" name="url" required autofocus>

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <label for="perfil" class="col-md-4 control-label">Perfiles</label>
                                    <select id="type_element" name="perfil" class="form-control">

                                        @foreach($perfiles as $perfil)
                                            <option value="{{ $perfil->id_perfil }}" >{{ $perfil->n_perfil }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('modulo') ? ' has-error' : '' }}">
                                <label for="modulo" class="col-md-4 control-label">Modulo</label>

                                <div class="col-md-6">
                                    <input id="modulo" type="text" class="form-control" name="modulo" required autofocus>

                                    @if ($errors->has('modulo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('modulo') }}</strong>
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
                        <a href="{{route('lista_recursos')}}"><button class="btn btn-lg btn-block">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection