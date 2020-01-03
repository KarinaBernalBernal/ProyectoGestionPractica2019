<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Resolución de Práctica</h4>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i class="fas fa-times"></i></span>
            </button>
        </div>
        @foreach($practicas as $practica)
        <form id="modalResolucionPractica" class="resolucionPractica-form" method="POST" action="{{route('evaluarPractica', ['id'=>$practica->id_practica, 'email'=>$evaluador->email, 'nombre'=>$evaluador->name])}}" enctype="multipart/form-data"  role="form">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-11">

                        {{-- Rut --}}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right" >{{ __('Rut') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right">{{$practica->rut}}</label>
                            </div>
                        </div>

                        {{-- Nombre --}}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right" >{{ __('Nombre') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right"> {{$practica->nombreAlumno}}</label>
                            </div>
                        </div>

                        {{-- Carrera --}}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right" >{{ __('Carrera') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right">{{$practica->carrera}}</label>
                            </div>
                        </div>

                        {{-- Percepción general del empleador --}}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right" >{{ __('Percepción general del empleador') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            @if($practica->resultado_eval == "")
                            <div class="col-md-5">
                                <label style="color: red" class="col-form-label text-md-right">Sin evaluación</label>
                            </div>
                            @else
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right">{{$practica->resultado_eval}}</label>
                            </div>
                            @endif
                        </div>

                        {{-- Presentación del alumno --}}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right" >{{ __('Presentación del alumno') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            @if($practica->asist_ch_post_pract == "")
                            <div class="col-md-5">
                                <label style="color: red" class="col-form-label text-md-right">Sin charla asignada</label>
                            </div>
                            @else
                            <div class="col-md-5">
                                <label class="col-form-label text-md-right">{{$practica->asist_ch_post_pract}}</label>
                            </div>
                            @endif
                        </div>
                        {{-- Observacion --}}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label for='observacion'class="col-form-label text-md-right" >{{ __('Observación') }} </label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-5">
                                <textarea id="observacion" placeholder="Escribe un comentario..." class="form-control" name="observacion" required></textarea>
                            </div>
                        </div>

                        {{-- Actitudinal y Aplicación de conceptos --}}
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead class="bg-dark" style="color: white">
                                        <tr>
                                            <th class="text-center" style="width: 60%">
                                                Item
                                            </th>
                                            <th class="text-center">
                                                Evaluación
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                Evaluación del empleador: Actitudinal
                                            </td>
                                            @if($practica->idEvaluacionSupervisor != null)
                                            <td style="font-size: 12px">
                                               <strong>MPA:</strong> {{$maximoAplicableA}}, <strong>PO:</strong> {{$puntajeObtenidoA}}, <strong>Porcentaje:</strong> {{$porcentajeA}}%
                                            </td>
                                            @else
                                                <td style="font-size: 12px; color: red">
                                                    <strong>Sin Evaluación</strong>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>
                                                <span>Evaluación del empleador: Aplicación de Conceptos</span>
                                            </td>
                                            @if($practica->idEvaluacionSupervisor != null)
                                            <td style="font-size: 12px">
                                                <strong>MPA:</strong> {{$maximoAplicableC}}, <strong>PO:</strong> {{$puntajeObtenidoC}}, <strong>Porcentaje:</strong> {{$porcentajeC}}%
                                            </td>
                                            @else
                                                <td style="font-size: 12px; color: red">
                                                    <strong>Sin Evaluación</strong>
                                                </td>
                                            @endif
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-left" style="font-size: 11px"><strong>MPA:</strong> Maximo puntaje Aplicable | <strong>PO:</strong> Puntaje Obtenido</div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5>Resolución Práctica</h5>

                        {{-- Profesor Evaluador --}}
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="col-form-label text-md-right" >{{ __('Evaluador') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-8">
                                <label class="col-form-label text-md-right">{{$evaluador->name}}</label>
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
                                    <option value="1">Aprobada</option>
                                    <option value="2">Rechazada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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

    $("#modalResolucionPractica").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        Swal({
            title: '¿Estás seguro?',
            text: "Se notificará al estudiante el estado de la resolución",
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
                            'Se ha guardado la resolución',
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
                            text: 'Algo malo ocurrió',
                        });
                    }
                });
            }
        });
    });
</script>