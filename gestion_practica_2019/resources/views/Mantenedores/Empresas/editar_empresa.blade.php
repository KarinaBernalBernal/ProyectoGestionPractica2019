@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Modificar {{$elemento->n_empresa}}</h3></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('actualizar_empresa',[$elemento->id_empresa])}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('n_empresa') ? ' has-error' : '' }}">
                                <label for="n_empresa" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input id="n_empresa" type="text" class="form-control" name="n_empresa" value="{{ old('n_empresa', $elemento->n_empresa) }}" required autofocus>
                                    @if ($errors->has('n_empresa'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('n_empresa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('rut') ? ' has-error' : '' }}">
                                <label for="rut" class="col-md-4 control-label">RUT </label>
                                <div class="col-md-6">
                                    <input id="rut" type="text" class="form-control" name="rut" value="{{ old('rut', $elemento->rut) }}"  required autofocus>
                                    <label for="fono" class="font-italic">Ej. 11111111-1</label>
                                    @if ($errors->has('rut'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rut') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                                <label for="ciudad" class="col-md-4 control-label">Ciudad </label>
                                <div class="col-md-6">
                                    <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad', $elemento->ciudad) }}"  required autofocus>
                                    @if ($errors->has('ciudad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ciudad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion" class="col-md-4 control-label">Dirección</label>
                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion', $elemento->direccion) }}"  required autofocus>
                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('direccion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('fono') ? ' has-error' : '' }}">
                                <label for="fono" class="col-md-4 control-label">Teléfono</label>
                                <div class="col-md-6">
                                    <input id="fono" type="text" class="form-control" name="fono" value="{{ old('fono', $elemento->fono) }}"  required autofocus minlength="9">
                                    <label for="fono" class="font-italic">Ej. 9 87654321</label>
                                    @if ($errors->has('fono'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('casilla') ? ' has-error' : '' }}">
                                <label for="casilla" class="col-md-4 control-label">Casilla</label>
                                <div class="col-md-6">
                                    <input id="casilla" type="text" class="form-control" name="casilla" value="{{ old('casilla', $elemento->casilla) }}"  required autofocus>
                                    @if ($errors->has('casilla'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('casilla') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $elemento->email) }}"  required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_empresas')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
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
        </script>
@endsection
