@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h1>Modificar {{$elemento->id_practica}}</h1></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('actualizar_alumno',[$elemento->id_practica])}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('f_solicitud') ? ' has-error' : '' }}">
                                <label for="f_solicitud" class="col-md-4 control-label">f_solicitud</label>
                                <div class="col-md-6">
                                    <input id="f_solicitud" type="text" class="form-control" name="f_solicitud" value="{{ old('f_solicitud', $elemento->f_solicitud) }}" required autofocus>
                                    @if ($errors->has('f_solicitud'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_solicitud') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_inscripcion') ? ' has-error' : '' }}">
                                <label for="f_inscripcion" class="col-md-4 control-label">f_inscripcion paterno</label>
                                <div class="col-md-6">
                                    <input id="f_inscripcion" type="text" class="form-control" name="f_inscripcion" value="{{ old('f_inscripcion', $elemento->f_inscripcion) }}"  required autofocus>
                                    @if ($errors->has('f_inscripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_inscripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_desde') ? ' has-error' : '' }}">
                                <label for="f_desde" class="col-md-4 control-label">f_desde materno</label>
                                <div class="col-md-6">
                                    <input id="f_desde" type="text" class="form-control" name="f_desde" value="{{ old('f_desde', $elemento->f_desde) }}"  required autofocus>
                                    @if ($errors->has('f_desde'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_desde') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('f_hasta') ? ' has-error' : '' }}">
                                <label for="f_hasta" class="col-md-4 control-label">f_hasta</label>
                                <div class="col-md-6">
                                    <input id="f_hasta" type="text" class="form-control" name="f_hasta" value="{{ old('f_hasta', $elemento->f_hasta) }}"  required autofocus>
                                    @if ($errors->has('f_hasta'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_hasta') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('asist_ch_post_pract') ? ' has-error' : '' }}">
                                <label for="asist_ch_post_pract" class="col-md-4 control-label">Correo</label>
                                <div class="col-md-6">
                                    <input id="asist_ch_post_pract" type="text" class="form-control" name="asist_ch_post_pract" value="{{ old('asist_ch_post_pract', $elemento->asist_ch_post_pract) }}"  required autofocus>
                                    @if ($errors->has('asist_ch_post_pract'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asist_ch_post_pract') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('asist_ch_pre_pract') ? ' has-error' : '' }}">
                                <label for="asist_ch_pre_pract" class="col-md-4 control-label">Dirección</label>
                                <div class="col-md-6">
                                    <input id="asist_ch_pre_pract" type="text" class="form-control" name="asist_ch_pre_pract" value="{{ old('asist_ch_pre_pract', $elemento->asist_ch_pre_pract) }}"  required autofocus>
                                    @if ($errors->has('asist_ch_pre_pract'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asist_ch_pre_pract') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> <div class="form-group{{ $errors->has('id_alumno') ? ' has-error' : '' }}">
                                <label for="id_alumno" class="col-md-4 control-label">Teléid_alumno</label>
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
                                <label for="id_supervisor" class="col-md-4 control-label">id_supervisor de ingreso</label>
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
                                    <a href="{{route('lista_practicas')}}"><button class="btn btn-secondary">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection