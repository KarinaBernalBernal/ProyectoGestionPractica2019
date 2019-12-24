@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Modificar {{$tipo}}</h3></div>
                    <div class="card-body">

                        @if($tipo == "Área" || $tipo == "Herramienta")
                        <form class="form-horizontal" @if($tipo == "Área")action="{{route('actualizar_elemento_dinamico',[$elemento->id_area, $tipo])}}"@endif @if($tipo == "Herramienta")action="{{route('actualizar_elemento_dinamico',[$elemento->id_herramienta, $tipo])}}"@endif method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" @if($tipo == "Área") value="{{ old('name', $elemento->n_area) }}"@endif @if($tipo == "Herramienta") value="{{ old('name', $elemento->n_herramienta) }}"@endif required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_elementos_dinamicos')}}"><button class="btn btn-secondary">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                        @endif

                        @if($tipo == "Actitud" || $tipo =="Conocimiento")
                            <form class="form-horizontal" @if($tipo == "Actitud")action="{{route('actualizar_elemento_dinamico',[$elemento->id_actitudinal, $tipo])}}"@endif @if($tipo == "Conocimiento")action="{{route('actualizar_elemento_dinamico',[$elemento->id_conocimiento, $tipo])}}"@endif method="post">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Nombre</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" @if($tipo == "Actitud") value="{{ old('name', $elemento->n_act) }}"@endif @if($tipo == "Conocimiento") value="{{ old('name', $elemento->n_con) }}"@endif required autofocus>
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
                                        <input id="descripcion" type="text" class="form-control" name="descripcion" @if($tipo == "Actitud") value="{{ old('descripcion', $elemento->dp_act) }}"@endif @if($tipo == "Conocimiento") value="{{ old('descripcion', $elemento->dp_con) }}"@endif required autofocus>
                                        @if ($errors->has('descripcion'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button>
                                        <a href="{{route('lista_elementos_dinamicos')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

