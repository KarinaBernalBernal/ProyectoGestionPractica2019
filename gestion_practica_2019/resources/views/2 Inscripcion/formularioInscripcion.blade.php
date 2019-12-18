@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">INSCRIPCION PRÁCTICA PROFESIONAL</h1>
        </div>

        <form action="{{route('agregarInscripcion')}}" enctype="multipart/form-data" method="POST" role="form" id="formularioInscripcion">
            {{ csrf_field() }} 

            {{-- Documentos solicitados --}}

            <div class="card text">
                <div class="card-body"> 

                    <h4>Documentos y periodo de práctica</h4> 
            {{--Fechas--}}
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-5">  
                            <label for="fechaDesde" class="col-md-3 col-form-label">{{ __('Desde') }}</label>
                            <input id="fechaDesde" type="date" name="fechaDesde" min="<?php echo date("Y-m-d");?>" required >
                        </div>
                        <div class="col-md-4">
                            <label for="fechaHasta" class="col-md-3 col-form-label">{{ __('Hasta') }}</label>
                            <input id="fechaHasta" type="date" name="fechaHasta" required disabled>
                         </div>
                     </div>
                 </div>
             </div>

             <br>

             {{-- Datos de la empresa --}}

            <div class="card text"> 
                <div class="card-body">
                    <h4>Datos de la empresa</h4> 

                    <hr>
    
                    {{-- Nombre Empresa --}}   
                    <div class="form-group row">
                        <label for="empresa" class="col-md-3 col-form-label text-md-right">{{ __('Nombre Empresa') }}</label>
                        
                        <div class="col-md-6">
                            <input id="empresa" type="text" class="form-control" name="empresa" value="{{ old('empresa') }}" required>
                        </div>
                    </div>

                    {{-- RUT --}}
                    <div class="form-group row">
                        <label for="rutEmpresa" class="col-md-3 col-form-label text-md-right">{{ __('RUT') }}</label>

                        <div class="col-md-6">
                            <input id="rutEmpresa" type="text" class="form-control" name="rutEmpresa" value="{{ old('rutEmpresa') }}">
                            <label for="rutEmpresa" class="font-italic">Ej. 11111111-1</label>
                        </div>
                    </div>

                     {{-- Ciudad --}}  
                    <div class="form-group row">
                        <label for="ciudad" class="col-md-3 col-form-label text-md-right">{{ __('Ciudad') }}</label>
                        
                        <div class="col-md-6">
                            <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" required>
                        </div>
                    </div>

                     {{-- Direccion --}}
                    <div class="form-group row">
                        <label for="direccion" class="col-md-3 col-form-label text-md-right">{{ __('Dirección') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                        </div>
                    </div>  

                    {{-- Fono --}}
                    <div class="form-group row">
                        <label for="fono" class="col-md-3 col-form-label text-md-right">{{ __('Fono') }}</label>

                        <div class="col-md-6">
                            <input id="fono" type="number" class="form-control" name="fono" value="{{ old('fono') }}" required>
                        </div>
                    </div>

                    {{-- Casilla --}}
                    <div class="form-group row">
                        <label for="casilla" class="col-md-3 col-form-label text-md-right">{{ __('Casilla') }}</label>

                        <div class="col-md-6">
                            <input id="casilla" type="number" class="form-control" name="casilla" value="{{ old('casilla') }}" required>
                        </div>
                    </div>

                    {{-- Correo Electronico Empresa--}}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                        <label for="email" class="col-md-3 col-form-label text-md-right control-label">Email empresa</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>  
                </div>
            </div>

            <br>

            <div class="card text">
                <div class="card-body"> 
                    <h4>Datos Supervisor</h4> 

                    <hr>

                     {{-- Nombre Supervisor--}}   
                    <div class="form-group row">
                        <label for="nombreSupervisor" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>
                        
                        <div class="col-md-6">
                            <input id="nombreSupervisor" type="text" class="form-control" name="nombreSupervisor" value="{{ old('nombreSupervisor') }}" required>
                        </div>
                    </div>

                    {{-- Apellido Paterno --}} 
                    <div class="form-group row">
                        <label for="aPaternoSupervisor" class="col-md-3 col-form-label text-md-right">{{ __('Apellido Paterno') }}</label>

                        <div class="col-md-6">
                            <input id="aPaternoSupervisor" type="text" class="form-control" name="aPaternoSupervisor" value="{{ old('aPaternoSupervisor') }}" required>
                        </div>
                    </div>

                    {{-- Cargo --}}   
                    <div class="form-group row">
                        <label for="cargo" class="col-md-3 col-form-label text-md-right">{{ __('Cargo') }}</label>
                        
                        <div class="col-md-6">
                            <input id="cargo" type="text" class="form-control" name="cargo" value="{{ old('cargo') }}" required>
                        </div>
                    </div>

                    {{-- Departamento --}}   
                    <div class="form-group row">
                        <label for="departamento" class="col-md-3 col-form-label text-md-right">{{ __('Departamento') }}</label>
                        
                        <div class="col-md-6">
                            <input id="departamento" type="text" class="form-control" name="departamento" value="{{ old('departamento') }}" required>
                        </div>
                    </div>

                     {{-- Fono --}}
                    <div class="form-group row">
                        <label for="fonoSupervisor" class="col-md-3 col-form-label text-md-right">{{ __('Fono') }}</label>

                        <div class="col-md-6">
                            <input id="fonoSupervisor" type="number" class="form-control" name="fonoSupervisor" value="{{ old('fonoSupervisor') }}" required>
                        </div>
                    </div>

                    {{-- Correo Electronico Supervisor--}}
                    <div class="form-group{{ $errors->has('emailSupervisor') ? ' has-error' : '' }} row">
                        <label for="emailSupervisor" class="col-md-3 col-form-label text-md-right control-label">Email supervisor</label>

                        <div class="col-md-6">
                            <input id="emailSupervisor" type="email" class="form-control" name="emailSupervisor" value="{{ old('emailSupervisor') }}" required>

                            @if ($errors->has('emailSupervisor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('emailSupervisor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>  

                    <br>

                    {{-- Botones --}}
                    <div class="row justify-content-end ">
                        <div class="col-md-4">
                            <button id="cancelar" class="btn btn-secondary" type="button">Cancelar</button>
                        </div>
                        <div class="col-md-4">
                            <input class="btn btn-primary" type="submit" value="Agregar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{--Metodo para mostrar pantalla para el boton "cancelar"--}}
    <script>
        $('#cancelar').click(function()
        {
            Swal({
                title: '¿Estás seguro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No!',
                confirmButtonText:'Si!'

            }).then((result) =>
            {
                if (result.value)
                {
                    window.location.href = "{{route('descripcionInscripcion')}}"
                }
            })
        });

        {{--Metodo para validar el rango de las fechas--}}
        $('#fechaDesde').change(function()
        {
            $('#fechaHasta').removeAttr('disabled');
            $('#fechaHasta').attr('min', $('#fechaDesde').val());
        });

        $("#rutEmpresa").change(function()
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

            if (Fn.validaRut( $("#rutEmpresa").val() )){
                $('#rutEmpresa').attr('class', 'form-control is-valid');
                this.setCustomValidity('');
            } else {
                $('#rutEmpresa').attr('class', 'form-control is-invalid');
                this.setCustomValidity('Rut inválido');
            }
        });



        // this is the id of the form
        $("#formularioInscripcion").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            Swal({
                title: '¿Estás seguro?',
                text: "Es imporante revisar si todo está correcto!",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!'
            }).then((result) => {

                if (result.value) {

                    window.swal({
                        title: "Por favor espere",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: form.serialize(), // serializes the form's elements.
                        success: function(){
                            Swal(
                                'Listo!',
                                'El formulario ha sido enviado.',
                                'success'
                            ).then((result) =>
                            {
                                if (result.value)
                                {
                                    window.location.href = "{{route('descripcionInscripcion')}}"
                                }
                            })
                        },
                        error:function() {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps...!',
                                text: 'No se pudo enviar el formulario',
                            });
                        }
                    });
                }
            });
        });

    </script>

@endsection