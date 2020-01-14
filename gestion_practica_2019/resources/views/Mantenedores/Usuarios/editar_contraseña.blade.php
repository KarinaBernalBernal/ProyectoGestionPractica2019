@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Modificar Contraseña de {{$user->name}}</h3></div>
                    <div class="card-body">
                        <form id="cambioContrasenna"class="form-horizontal" action="{{route('actualizar_contraseña',[$user->id_user])}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nuevaPassword') ? ' has-error' : '' }}">
                                <label for="nuevaPassword" class="col-md-4 control-label">Nueva Contraseña</label>

                                <div class="col-md-6">
                                    <input id="nuevaPassword" type="password" class="form-control" name="nuevaPassword" required autofocus maxlength="12">

                                    @if ($errors->has('nuevaPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nuevaPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('verificarPassword') ? ' has-error' : '' }}">
                                <label for="verificarPassword" class="col-md-4 control-label">Verificar Contraseña</label>

                                <div class="col-md-6">
                                    <input id="verificarPassword" type="password" class="form-control" name="verificarPassword" required autofocus maxlength="12">

                                    @if ($errors->has('verificarPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('verificarPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Modificar
                                    </button>
                                    <a href="{{route('home')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#verificarPassword').change(function()
        {
            if ($("#verificarPassword").val() != $("#nuevaPassword").val())
            {
                this.setCustomValidity('Las contraseñas deben ser iguales');
            } else
                {
                    this.setCustomValidity('');
                }
        });


        $("#cambioContrasenna").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            Swal({
                title: '¿Estás seguro?',
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
            }).then((result) => {

                if (result.value) {

                    window.swal({
                        title: "Por favor, espere",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: form.serialize(), // serializes the form's elements.
                        success: function(){
                            Swal(
                                'Listo',
                                'Se ha modificado tu contraseña.',
                                'success'
                            ).then((result) =>
                            {
                                if (result.value)
                                {
                                    window.location.href = "{{route('home')}}"
                                }
                            })
                        },
                        error:function() {
                            Swal.fire({
                                type: 'error',
                                title: 'Opps...!',
                                text: 'No se pudo modificar su contraseña',
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection

