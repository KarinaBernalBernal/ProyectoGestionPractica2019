<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Solicitud</h4>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i class="fas fa-times"></i></span>
            </button> 
        </div>
        <form id= "modalEvaluarSolicitud" class="evaluarSolicitud-form" method="POST" action="{{route('evaluarSolicitud', ['id'=>$solicitud->id_solicitud])}}" enctype="multipart/form-data"  role="form">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-11">

                        {{-- Rut --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Rut') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->rut}}</label>
                            </div>
                        </div>

                        {{-- Nombre --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Nombre') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->nombre}}</label>
                            </div>
                        </div>

                        {{-- Apellido paterno --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Apellido paterno') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->apellido_paterno}}</label>
                            </div>
                        </div>

                        {{-- Apellido materno --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Apellido materno') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->apellido_materno}}</label>
                            </div>
                        </div>

                        {{-- Año de Ingreso --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Año de ingreso') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->anno_ingreso}}</label>
                            </div>
                        </div>

                        {{-- Carrera --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Carrera') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->carrera}}</label>
                            </div>
                        </div>

                        @if($solicitud->practica == "Ingeniería Civil Informática")
                        {{-- Segunda Practica --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Segunda Práctica') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->practica}}</label>
                            </div>
                        </div>
                        @endif
                        {{-- Proyecto de Titulo --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Semestre') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->semestre_proyecto}}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Año') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$solicitud->anno_proyecto}}</label>
                            </div>
                        </div>

                        {{-- Resolucion --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="resolucion" class="col-form-label text-md-right">{{ __('Resolución') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8"> 
                                <select id="resolucion" name="resolucion" class="custom-select" required>
                                    <option selected value="">Selecciona...</option>
                                    <option>Autorizada</option>
                                    <option>Rechazada</option>
                                    <option>Pendiente</option>
                                </select>      
                            </div>
                        </div>

                        {{-- Observacion --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for='observacion'class="col-form-label text-md-right" >{{ __('Observación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8"> 
                                <textarea id="observacion" placeholder="Escribe un comentario..." class="form-control" name="observacion"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col-md-6 ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                 </div>
                <div class="col-md-6 text-md-right">
                    <button type="submit" class="btn btn-primary">Evaluar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

    $("#modalEvaluarSolicitud").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        Swal({
            title: '¿Estás seguro?',
            text: "Se notificará al estudiante el estado de su solicitud mediante un email",
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
                            'Listo',
                            'El ha evaluado la solicitud',
                            'success'
                        ).then((result) =>
                        {
                            if (result.value)
                            {
                                window.location.reload();
                            }
                        })
                    },
                    error:function() {
                        Swal.fire({
                            type: 'error',
                            title: 'Opps...!',
                            text: 'No se pudo evaluar la solicitud',
                        });
                    }
                });
            }
        });
    });
</script>