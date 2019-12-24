@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h1>Agregar Evaluación</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agregar_evaluacion_supervisor')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('porcent_tareas_realizadas') ? ' has-error' : '' }}">
                                <label for="porcent_tareas_realizadas" class="col-md-4 control-label">Porcentaje tareas realizadas</label>
                                <div class="col-md-6">
                                    <input id="porcent_tareas_realizadas" type="text" class="form-control" name="porcent_tareas_realizadas" required autofocus>
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
                                    <input id="resultado_eval" type="text" class="form-control" name="resultado_eval" required autofocus>
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
                                    <input id="f_entrega_eval" type="date" class="form-control" name="f_entrega_eval" required autofocus>
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
                                    <a href="{{route('lista_evaluaciones_supervisor')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection