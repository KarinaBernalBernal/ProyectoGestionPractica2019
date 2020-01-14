@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Modificar {{$elemento->id_practica}}</h3></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('actualizar_practica',[$elemento->id_practica])}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('f_solicitud') ? ' has-error' : '' }}">
                                <label for="f_solicitud" class="col-md-4 control-label">Fecha Solicitud</label>
                                <div class="col-md-6">
                                    <input id="f_solicitud" type="date" class="form-control" name="f_solicitud" value="{{ old('f_solicitud', $elemento->f_solicitud) }}" required autofocus>
                                    @if ($errors->has('f_solicitud'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_solicitud') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_inscripcion') ? ' has-error' : '' }}">
                                <label for="f_inscripcion" class="col-md-4 control-label">Fecha Inscripción</label>
                                <div class="col-md-6">
                                    <input id="f_inscripcion" type="date" class="form-control" name="f_inscripcion" value="{{ old('f_inscripcion', $elemento->f_inscripcion) }}"  required autofocus>
                                    @if ($errors->has('f_inscripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_inscripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_desde') ? ' has-error' : '' }}">
                                <label for="f_desde" class="col-md-4 control-label">Práctica Desde</label>
                                <div class="col-md-6">
                                    <input id="f_desde" type="date" class="form-control" name="f_desde" value="{{ old('f_desde', $elemento->f_desde) }}"  required autofocus>
                                    @if ($errors->has('f_desde'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_desde') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_hasta') ? ' has-error' : '' }}">
                                <label for="f_hasta" class="col-md-4 control-label">Practica Hasta</label>
                                <div class="col-md-6">
                                    <input id="f_hasta" type="date" class="form-control" name="f_hasta" value="{{ old('f_hasta', $elemento->f_hasta) }}"  required autofocus>
                                    @if ($errors->has('f_hasta'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_hasta') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('asistenciaCharla') ? ' has-error' : '' }}">
                                <label for="asistenciaCharla" class="col-md-4 control-label">Asistencia Charla</label>
                                <div class="col-md-6">
                                    <select id="asistenciaCharla" type="text" class="form-control" name="asistenciaCharla" placeholder="">
                                        <option value="">Seleccione Asistencia Charla</option>
                                        <option value="1" @if(old("asistenciaCharla", $elemento->asistecia_charla) == 1) {{'selected'}} @endif>Si</option>
                                        <option value="0" @if(old("asistenciaCharla", $elemento->asistecia_charla) == 0) {{'selected'}} @endif>No</option>
                                    </select>
                                    @if ($errors->has('asistenciaCharla'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asistenciaCharla') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('id_alumno') ? ' has-error' : '' }}">
                                <label for="id_alumno" class="col-md-4 control-label">ID Alumno</label>
                                <div class="col-md-6">
                                    <input id="id_alumno" type="text" class="form-control" name="id_alumno" value="{{ old('id_alumno', $elemento->id_alumno) }}"  required autofocus>
                                    @if ($errors->has('id_alumno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_alumno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('id_supervisor') ? ' has-error' : '' }}">
                                <label for="id_supervisor" class="col-md-4 control-label">ID Supervisor</label>
                                <div class="col-md-6">
                                    <input id="id_supervisor" type="text" class="form-control" name="id_supervisor" value="{{ old('id_supervisor', $elemento->id_supervisor) }}"  required autofocus>
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
                                    <a href="{{route('lista_practicas')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection