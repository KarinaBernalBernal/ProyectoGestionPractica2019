@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Crear {{$tipo}}</h3></div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('agregar_elemento_dinamico',[$tipo])}}">
                            {{ csrf_field() }}
                            @if($tipo == "Área" || $tipo == "Herramienta")
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Nombre</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($tipo == "Actitud" || $tipo =="Conocimiento")
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Nombre</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                        <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                                        <div class="col-md-6">
                                            <input id="descripcion" type="text" class="form-control" name="descripcion" required autofocus>
                                            @if ($errors->has('descripcion'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                            @endif
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_elementos_dinamicos',$tipo)}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

