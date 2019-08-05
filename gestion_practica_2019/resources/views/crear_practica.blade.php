@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                <h1>Agregar Practica profecional</h1>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('agregar_practica')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('f_solicitud') ? ' has-error' : '' }}">
                                <label for="f_solicitud" class="col-md-4 control-label">Fecha solicitud</label>
                                <div class="col-md-6">
                                    <input id="f_solicitud" type="text" class="form-control" name="f_solicitud" required autofocus>
                                    @if ($errors->has('f_solicitud'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_solicitud') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_inscripcion') ? ' has-error' : '' }}">
                                <label for="f_inscripcion" class="col-md-4 control-label">Fecha inscripción</label>
                                <div class="col-md-6">
                                    <input id="f_inscripcion" type="text" class="form-control" name="f_inscripcion" required autofocus>
                                    @if ($errors->has('f_inscripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_inscripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_desde') ? ' has-error' : '' }}">
                                <label for="f_desde" class="col-md-4 control-label">Fecha desde</label>
                                <div class="col-md-6">
                                    <input id="f_desde" type="text" class="form-control" name="f_desde" required autofocus>
                                    @if ($errors->has('f_desde'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_desde') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('f_hasta') ? ' has-error' : '' }}">
                                <label for="f_hasta" class="col-md-4 control-label">Fecha hasta</label>
                                <div class="col-md-6">
                                    <input id="f_hasta" type="text" class="form-control" name="f_hasta" required autofocus>
                                    @if ($errors->has('f_hasta'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_hasta') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('asist_ch_post_pract') ? ' has-error' : '' }}">
                                <label for="asist_ch_post_pract" class="col-md-4 control-label">asist_ch_post_pract</label>
                                <div class="col-md-6">
                                    <input id="asist_ch_post_pract" type="text" class="form-control" name="asist_ch_post_pract" required autofocus>
                                    @if ($errors->has('asist_ch_post_pract'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asist_ch_post_pract') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('asist_ch_pre_pract') ? ' has-error' : '' }}">
                                <label for="asist_ch_pre_pract" class="col-md-4 control-label">asist_ch_pre_pract</label>
                                <div class="col-md-6">
                                    <input id="asist_ch_pre_pract" type="text" class="form-control" name="asist_ch_pre_pract" required autofocus>
                                    @if ($errors->has('asist_ch_pre_pract'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asist_ch_pre_pract') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('id_alumno') ? ' has-error' : '' }}">
                                <label for="id_alumno" class="col-md-4 control-label">Id alumno</label>
                                <div class="col-md-6">
                                    <input id="id_alumno" type="text" class="form-control" name="id_alumno" required autofocus>
                                    @if ($errors->has('id_alumno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_alumno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('id_supervisor') ? ' has-error' : '' }}">
                                <label for="id_supervisor" class="col-md-4 control-label">Id supervisor</label>
                                <div class="col-md-6">
                                    <input id="id_supervisor" type="text" class="form-control" name="id_supervisor" required autofocus>
                                    @if ($errors->has('id_supervisor'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_supervisor') }}</strong>
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
                        <a href="{{route('lista_alumnos')}}"><button class="btn btn-lg btn-block">Cancelar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection