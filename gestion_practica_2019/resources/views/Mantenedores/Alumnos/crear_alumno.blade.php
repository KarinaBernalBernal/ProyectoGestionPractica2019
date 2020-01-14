@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Agregar alumno</h3></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('agregar_alumno')}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('apellido_paterno') ? ' has-error' : '' }}">
                                <label for="apellido_paterno" class="col-md-4 control-label">Apellido paterno</label>
                                <div class="col-md-6">
                                    <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" required autofocus>
                                    @if ($errors->has('apellido_paterno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido_paterno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('apellido_materno') ? ' has-error' : '' }}">
                                <label for="apellido_materno" class="col-md-4 control-label">Apellido materno</label>
                                <div class="col-md-6">
                                    <input id="apellido_materno" type="text" class="form-control" name="apellido_materno" required autofocus>
                                    @if ($errors->has('apellido_materno'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido_materno') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                                <label for="rut" class="col-md-4 control-label">RUT</label>
                                <div class="col-md-6">
                                    <input id="rut" type="text" class="form-control" name="rut" required autofocus>
                                    <label for="rut" class="font-italic">Ej. 11111111-1</label>
                                    @if ($errors->has('rut'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rut') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion" class="col-md-4 control-label">Dirección</label>
                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion" required autofocus>
                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('direccion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> <div class="form-group{{ $errors->has('fono') ? ' has-error' : '' }}">
                                <label for="fono" class="col-md-4 control-label">Teléfono</label>
                                <div class="col-md-6">
                                    <input id="fono" type="text" class="form-control" name="fono" minlength="9" required autofocus>
                                    <label for="fono" class="font-italic">Ej. 9 87654321</label>
                                    @if ($errors->has('fono'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('anno_ingreso') ? ' has-error' : '' }}">
                                <label for="anno_ingreso" class="col-md-4 control-label">Año de ingreso a la carrera</label>
                                <div class="col-md-6">
                                    <input id="anno_ingreso" type="number" class="form-control" name="anno_ingreso" value="{{ old('anno_ingreso') }}" maxlength="4" minlength="4" min="2000" required>
                                    @if ($errors->has('anno_ingreso'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('anno_ingreso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                                <label for="carrera" class="col-md-4 control-label">Carrera</label>
                                <div class="col-md-6">                                    
                                    <select name="carrera" id="carrera" class="form-control" required autofocus>
                                        <option value="Ingeniería de Ejecución Informática">Ingeniería de Ejecución en Informatica</option>
                                        <option value="Ingeniería Civil Informática">Ingeniería Civil en Informatica</option>
                                    </select>
                                    @if ($errors->has('carrera'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('carrera') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <h5 class="container-fluid">Estimación de Proyecto de Título</h5>
                            <br>
                            <div class="form-group{{ $errors->has('semestreProyecto') ? ' has-error' : '' }}">
                                <label for="semestreProyecto" class="col-md-4 control-label">Semestre Proyecto</label>
                                <div class="col-md-6">
                                    <select id="semestreProyecto" name="semestreProyecto" class="custom-select" required autofocus>
                                        <option selected value="">Selecciona...</option>
                                        <option value ="1">1</option>
                                        <option value ="2">2</option>
                                    </select>
                                    @if ($errors->has('semestreProyecto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('semestreProyecto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('annoProyecto') ? ' has-error' : '' }}">
                                <label for="annoProyecto" class="col-md-4 control-label">Año Proyecto</label>
                                <div class="col-md-6">
                                    <input id="annoProyecto" type="number" class="form-control" name="annoProyecto" value="{{ old('annoProyecto') }}" maxlength="4" minlength="4" min="2000"required autofocus>
                                    @if ($errors->has('annoProyecto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('annoProyecto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_alumnos')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#rut").change(function()
        {
            var Fn = {
                // Valida el rut con su cadena completa "XXXXXXXX-X"
                validaRut : function (rutCompleto) {
                    rutCompleto = rutCompleto.replace("‐","-");
                    if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                        return false;
                    var tmp     = rutCompleto.split('-');
                    var digv    = tmp[1];
                    var rut     = tmp[0];
                    if ( digv == 'K' ) digv = 'k' ;

                    return (Fn.dv(rut) == digv );
                },
                dv : function(T)
                {
                    var M=0,S=1;
                    for(;T;T=Math.floor(T/10))
                        S=(S+T%10*(9-M++%6))%11;
                    return S?S-1:'k';
                }
            };

            if (Fn.validaRut( $("#rut").val() )){
                $('#rut').attr('class', 'form-control is-valid');
                this.setCustomValidity('');
            } else {
                $('#rut').attr('class', 'form-control is-invalid');
                this.setCustomValidity('Rut inválido');
            }
        });

        $('#annoProyecto').change(function()
        {
            $('#annoProyecto').attr('min', $('#anno_ingreso').val());
        });
    </script>
@endsection