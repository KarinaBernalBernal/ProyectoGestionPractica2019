@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Modificar {{$tipo}}</h3></div>
                    <div class="card-body">

                        @if($tipo == "Área" || $tipo == "Herramienta")
                        <form class="form-horizontal" @if($tipo == "Área")action="{{route('actualizar_otro',[$elemento->id_otro_area, $tipo])}}"@endif @if($tipo == "Herramienta")action="{{route('actualizar_otro',[$elemento->id_otro_herramienta, $tipo])}}"@endif method="post">
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

