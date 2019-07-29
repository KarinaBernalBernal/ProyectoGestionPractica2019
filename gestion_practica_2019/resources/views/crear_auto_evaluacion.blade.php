@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <h1>Agregar auto evaluación</h1>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('agregar_auto_evaluacion')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('f_entrega') ? ' has-error' : '' }}">
                                <label for="f_entrega" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="f_entrega" type="text" class="form-control" name="f_entrega" required autofocus>

                                    @if ($errors->has('f_entrega'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_entrega') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('id_practica') ? ' has-error' : '' }}">
                                <label for="id_practica" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="id_practica" type="text" class="form-control" name="id_practica" required autofocus>

                                    @if ($errors->has('id_practica'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_practica') }}</strong>
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
                        <a href="{{route('lista_auto_evaluaciones')}}"><button class="btn btn-lg btn-block">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
