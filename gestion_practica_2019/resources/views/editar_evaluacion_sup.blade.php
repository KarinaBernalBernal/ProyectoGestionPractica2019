@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <h1>Modificar {{$elemento->id_eval_supervisor}}</h1>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('actualizar_evaluacion_supervisor',[$elemento->id_eval_supervisor])}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('porcent_tareas_realizadas') ? ' has-error' : '' }}">
                                <label for="porcent_tareas_realizadas" class="col-md-4 control-label">Porcentaje tareas realizadas</label>
                                <div class="col-md-6">
                                    <input id="porcent_tareas_realizadas" type="text" class="form-control" name="porcent_tareas_realizadas" value="{{ old('porcent_tareas_realizadas', $elemento->porcent_tareas_realizadas) }}" required autofocus>
                                    @if ($errors->has('porcent_tareas_realizadas'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('porcent_tareas_realizadas') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('resultado_eval') ? ' has-error' : '' }}">
                                <label for="resultado_eval" class="col-md-4 control-label">Resultado de evaluación</label>
                                <div class="col-md-6">
                                    <input id="resultado_eval" type="text" class="form-control" name="resultado_eval" value="{{ old('resultado_eval', $elemento->resultado_eval) }}"  required autofocus>
                                    @if ($errors->has('resultado_eval'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('resultado_eval') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_entrega_eval') ? ' has-error' : '' }}">
                                <label for="f_entrega_eval" class="col-md-4 control-label">Fecha entrega evaluación</label>
                                <div class="col-md-6">
                                    <input id="f_entrega_eval" type="text" class="form-control" name="f_entrega_eval" value="{{ old('f_entrega_eval', $elemento->f_entrega_eval) }}"  required autofocus>
                                    @if ($errors->has('f_entrega_eval'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_entrega_eval') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('id_practica') ? ' has-error' : '' }}">
                                <label for="id_practica" class="col-md-4 control-label">Id practica</label>
                                <div class="col-md-6">
                                    <input id="id_practica" type="text" class="form-control" name="id_practica" value="{{ old('id_practica', $elemento->id_practica) }}"  required autofocus>
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
                        <a href="{{route('lista_evaluaciones_supervisor')}}"><button class="btn btn-lg btn-block">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection