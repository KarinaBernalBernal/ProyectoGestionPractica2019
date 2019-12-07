<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Autoevaluación</h4>
            <button type="button" class="close" data-dismiss="modal">
                <span> <i class="fas fa-times"></i></span>
            </button> 
        </div>
        <div class="modal-body">
            <div class="form-group row justify-content-md-center">
                <div class="col-md-12">
                    @if($autoevaluacion->count())
                        {{-- Autoevaluacion --}}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Fecha de autoevaluación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label text-md-right">{{$autoevaluacion->f_entrega}}</label>
                            </div>
                        </div>

                        {{-- Desempeño --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Desempeño del alumno</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Calificación') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-right">{{$desempeño->valor}}</label><!-- Malo - Regular - Bueno - Muy bueno -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label text-md-right" >{{ __('Descripción') }}</label>
                            </div>
                            <div class="col-md-1">
                                <label class="col-form-label text-md-right" >:</label>
                            </div>
                            <div class="col-md-7">
                                <label class="col-form-label text-md-right">{{$desempeño->dp_tarea}}</label>
                            </div>
                        </div>
                        
                        {{-- Tareas --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Tareas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @foreach($tareas as $tarea)
                                    <div class="form-group row">   
                                        <div class="col-md-1">
                                            <label class="col-form-label text-md-right" >{{ $loop->iteration }}</label>
                                        </div>  
                                        <div class="col-md-9"> 
                                            <label class="col-form-label text-md-right">{{$tarea->n_tarea}}</label>
                                            <br>
                                            <label class="col-form-label text-md-right">{{$tarea->dp_tarea}}</label> 
                                            <br>
                                        </div>
                                    </div>
                                @endforeach                   
                            </div> 
                        </div>

                        {{-- Habilidades --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Habilidades</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Habilidades aprendidas<h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Habilidades faltantes<h6>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($habilidades as $habilidad)
                                        @if($habilidad->tipo_habilidad == 'aprendida')
                                            <div class="col-md-1">
                                                <label class="col-form-label text-md-right" >-</label>
                                            </div>  
                                            <div class="col-md-5"> 
                                                <label class="col-form-label text-md-right">{{$habilidad->n_habilidad}}</label>
                                                <br>
                                                <label class="col-form-label text-md-right">{{$habilidad->dp_habilidad}}</label> 
                                                <br>
                                            </div>            
                                        @else
                                            <div class="col-md-1">
                                                <label class="col-form-label text-md-right" >-</l   abel>
                                            </div>  
                                            <div class="col-md-5"> 
                                                <label class="col-form-label text-md-right">{{$habilidad->n_habilidad}}</label>
                                                <br>
                                                <label class="col-form-label text-md-right">{{$habilidad->dp_habilidad}}</label> 
                                                <br>
                                            </div>      
                                        @endif
                                    @endforeach                   
                                <div>
                            </div>
                        </div>
                        <br>
                        {{-- Conocimientos --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Conocimientos</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Conocimientos aprendidos<h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Conocimientos faltantes<h6>
                                    </div>
                                </div>
                                <!--Aqui va codigo guardado-->
                            </div>
                        </div>
                        <br>
                        {{-- Herramientas --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-12">
                                <h5>Herramientas</h5>
                                <hr>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-11">
                                @foreach($herramientaPracticas as $herramientaPractica)
                                    @foreach($herramientas as $herramienta)
                                        @if($herramientaPractica->id_herramienta == $herramienta->id_herramienta )
                                            <div class="form-group row">   
                                                <div class="col-md-9"> 
                                                    <label class="col-form-label text-md-right">{{$herramienta->n_herramienta}} </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach                   
                            </div> 
                        </div>

                    @else
                        No existe la autoevaluación del alumno seleccionado.
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="modal-footer">
                <div class="col-md-12 text-md-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>