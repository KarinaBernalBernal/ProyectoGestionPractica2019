@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">FORMULARIO DE AUTOEVALUACIÓN</h1>
        </div>

        <form id="formularioAutoevaluacion" action="{{route('agregarAutoEvaluacion')}}" enctype="multipart/form-data" method="POST" role="form">
            {{ csrf_field() }}

            {{-- Autoevaluacion del Alumno --}}
            <div class="card text">
                <div class="card-body">
                    <h4>¿En qué área(s) clasificaría su práctica?</h4>
                    <hr>
                    <div class="form-group row">
                        @foreach($area as $areas)
                            <div class="col-lg-6">
                                <label for="area[]" class="col-lg-7 col-form-label">{{ $areas->n_area }}</label>
                                <input type="checkbox" name="area[]" value="{{ $areas->n_area }}" >
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="form-group row container-fluid" >
                        <label for="areasOtros[]" class="col-lg-1 col-form-label"><strong>{{ __('Otro:') }}</strong></label>
                        {{--<input type="text" name="areasOtros[]" placeholder="Area" class="form-control name_list col-lg-2"/>--}}
                        <div class="col-lg-11">
                            <button type="button" name="addAreasOtros" id="addAreasOtros" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                        </div>
                    </div>
                    <div class="form-group row container-fluid" id="areasOtros"></div>
                </div>
            </div>
            <br>
            <div class="card text">
                <div class="card-body">

                    <h4>Describe las tareas realizadas</h4>
                    <hr>
                    <div id="tablaTareas">
                        <div class="form-group row container-fluid">
                            <input type="text" name="tarea[]" placeholder="Nombre tarea" class="form-control name_list col-lg-2" required/>
                            <div class="col-9">
                                <input type="text" name="dptarea[]" placeholder="Explicación de tarea" class="form-control name_list" required/>
                            </div>
                            <div class="col-1">
                                <button type="button" name="addTarea" id="addTarea" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card text">
                <div class="card-body">
                    <h4>Herramientas de SW utilizadas en la práctica</h4>

                    <hr>

                    {{-- Herramientas utilizadas --}}
                    <div class="form-group row">
                        @foreach($herramienta as $herramientas)
                            <div class="col-lg-6">
                                <label for="herramienta[]" class="col-lg-5 col-form-label">{{ $herramientas->n_herramienta }}</label>
                                <input type="checkbox" name="herramienta[]" value="{{ $herramientas->n_herramienta }}">
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="form-group row container-fluid">
                        <label for="herramientasOtros" class="col-lg-1 col-form-label"><strong>{{ __('Otro:') }}</strong></label>
                        {{--<input type="text" name="herramientasOtros[]" placeholder="Herramienta" class="form-control name_list col-lg-2"/>--}}
                        <div class="col-lg-1">
                            <button type="button" name="addHerramientasOtros" id="addHerramientasOtros" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                        </div>
                    </div>
                    <div class="form-group row container-fluid" id="herramientasOtros"></div>
                </div>
            </div>
            <br>
            <div class="card text">
                <div class="card-body">
                    <h4>Conocimientos y Hablidades</h4>

                    <hr>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>1.- ¿Qué Conocimientos / Habilidades aprendidas en la carrera fueron importantes para el desarrollo de su práctica?:</strong></h6>
                    </div>
                    <br>
                    <div id="tablaConocimientosA" class="container-fluid">
                        <div class="form-group row container-fluid">
                            <label for="conocimientoA" class="col-lg-2 col-form-label text-md-right"><strong>{{ __('Conocimiento:') }}</strong></label>
                            <div class="col-2">
                                <input type="text" name="conocimientoA[]" placeholder="Nombre" class="form-control name_list" required/>
                                <label for="conocimientoA" class="font-italic">Ej."Programación"</label>
                            </div>
                            <div class="col-7">
                                <input type="text" name="dpConocimientoA[]" placeholder="Explicación de conocimiento aprendido" class="form-control name_list" required/>
                                <label for="dpConocimientoA" class="font-italic">Ej."Conocimientos en programación orientada a objetos"</label>
                            </div>
                            <div class="col-1">
                                <button type="button" name="addConocimientoA" id="addConocimientoA" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="tablaHabilidadesA" class="container-fluid">
                        <div class="form-group row container-fluid">
                            <label for="habilidadA" class="col-lg-2 col-form-label text-md-right"><strong>{{ __('Habilidad:') }}</strong></label>
                            <div class="col-2">
                                <input type="text" name="habilidadA[]" placeholder="Nombre" class="form-control name_list" required/>
                                <label for="habilidadA" class="font-italic">Ej."Informes"</label>
                            </div>
                            <div class="col-7">
                                <input type="text" name="dpHabilidadA[]" placeholder="Explicación de habilidad aprendida" class="form-control name_list" required/>
                                <label for="dpHabilidadA" class="font-italic">Ej."Habilidad en redacción de informes"</label>
                            </div>
                            <div class="col-1">
                                <button type="button" name="addHabilidadA" id="addHabilidadA" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>2.- ¿Qué Conocimientos / Habilidades piensa que le faltaron para un buen desempeño en su práctica?:</strong></h6>
                    </div>
                    <br>

                    <div id="tablaConocimientosF" class="container-fluid">
                        <div class="form-group row container-fluid">
                            <label for="conocimientoF" class="col-lg-2 col-form-label text-md-right"><strong>{{ __('Conocimiento:') }}</strong></label>
                            <div class="col-2">
                                <input type="text" name="conocimientoF[]" placeholder="Nombre" class="form-control name_list" required/>
                                <label for="conocimientoF" class="font-italic">Ej."Programación"</label>
                            </div>
                            <div class="col-7">
                                <input type="text" name="dpConocimientoF[]" placeholder="Explicación de conocimiento faltante" class="form-control name_list" required/>
                                <label for="dpConocimientoF" class="font-italic">Ej."Conocimientos en programación orientada a objetos"</label>
                            </div>
                            <div class="col-1">
                                <button type="button" name="addConocimientoF" id="addConocimientoF" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="tablaHabilidadesF" class="container-fluid">
                        <div class="form-group row container-fluid">
                            <label for="habilidadF" class="col-lg-2 col-form-label text-md-right"><strong>{{ __('Habilidad:') }}</strong></label>
                            <div class="col-2">
                                <input type="text" name="habilidadF[]" placeholder="Nombre" class="form-control name_list" required/>
                                <label for="habilidadF" class="font-italic">Ej."Informes"</label>
                            </div>
                            <div class="col-7">
                                <input type="text" name="dpHabilidadF[]" placeholder="Explicación de habilidad faltante" class="form-control name_list" required/>
                                <label for="dpHabilidadF" class="font-italic">Ej."Habilidad en redacción de informes"</label>
                            </div>
                            <div class="col-1">
                                <button type="button" name="addHabilidadF" id="addHabilidadF" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>


                    <br>
                    <div class="col-md-auto">
                        <h6><strong>3.- ¿Qué conocimientos adquirió durante su práctica?</strong></h6>
                    </div>
                    <br>

                    <div id="tablaConocimientos" class="container-fluid">
                        <div class="form-group row container-fluid">
                            <input type="text" name="conocimiento[]" placeholder="Nombre" class="form-control name_list col-sm-2" required/>
                            <div class="col-9">
                                <input type="text" name="dpConocimiento[]" placeholder="Explicación del conocimiento" class="form-control name_list" required/>
                            </div>
                            <div class="col-1">
                                <button type="button" name="ddConocimiento" id="addConocimiento" class="btn btn-success"><span class="fas fa-plus" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <br>
             <div class="card text">
                <div class="card-body">
                    <h4>Autoevaluacion</h4>
                    <hr>
                    <div class="col-md-auto">
                        <h6><strong>1.- ¿Cómo calificaría su desempeño durante el período de práctica?</strong></h6>
                    </div>
                    <br>

                    {{-- Calificación desempeño --}}
                    <div class="form-group row">
                        <label for="desempenno" class="col-md-3 col-form-label text-md-right"></label>

                        <div class="col-md-6">
                            <select id="desempenno" name="desempenno" class="custom-select">
                                <option selected value="">Selecciona...</option>
                                <option>Malo</option>
                                <option>Regular</option>
                                <option>Bueno</option>
                                <option>Muy bueno</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto" style="padding-left: 5%">
                        <h6><strong>¿Por qué? (Fundamente su autoevaluación):</strong></h6>
                    </div>
                    <br>

                    {{-- Explicación del por qué --}}
                    <div class="form-group row">
                        <label for="dpDesempenno" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="dpDesempenno" name="dpDesempenno" class="form-control" rows="10" cols="40" placeholder="Escribe aquí tu comentario..."></textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>2.- De acuerdo a su experiencia en la práctica, realice una autoevaluación para evaluar su desempeño, utilizando una escala de 1 a 4, donde 1 representa criterio débilmente logrado y 4 criterio totalmente logrado. Además si considera necesario puede considerar evaluar con NA: No Aplica o NL: No Logrado.</strong></h6>
                    </div>
                    <br>
                    {{-- Evaluacion con "dea acuerdo", "muy de acuerdo", etc.  --}}
                    <div class="col-md-auto" style="padding-left: 5%">
                        <h6><strong>1. Actitud del Alumno:</strong></h6>
                    </div>
                    <br>
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th>Criterio</th>
                            <th colspan="6">Evaluación</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>1</strong></td>
                            <td><strong>2</strong></td>
                            <td><strong>3</strong></td>
                            <td><strong>4</strong></td>
                            <td><strong>NA</strong></td>
                            <td><strong>NL</strong></td>
                        </tr>
                        <?php $i = 0 ?>
                        @foreach($actitud as $actitudes)
                            <tr>
                                <td>{{ $actitudes->dp_act }}</td>
                                <input name="actitud[{{$i}}]" value="{{$actitudes->id_actitudinal}}" style="display: none">
                                <td><input type="radio" name="criterio[{{$i}}]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[{{$i}}]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[{{$i}}]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[{{$i}}]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[{{$i}}]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[{{$i}}]" value="NL" required><br></td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                    </table>
                    <br>
                    <div class="col-md-auto" style="padding-left: 5%">
                        <h6><strong>2. Aplicación de conocimientos del Alumno:</strong></h6>
                    </div>
                    <br>

                    <table class="table table-sm table-bordered">
                        <tr>
                            <th>Criterio</th>
                            <th colspan="6">Evaluación</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>1</strong></td>
                            <td><strong>2</strong></td>
                            <td><strong>3</strong></td>
                            <td><strong>4</strong></td>
                            <td><strong>NA</strong></td>
                            <td><strong>NL</strong></td>
                        </tr>
                        <?php $j = 0 ?>
                        @foreach($conocimiento as $conocimientos)
                        <tr>
                            <td>{{ $conocimientos->dp_con }}</td>
                            <input name="criterioConocimiento[{{$j}}]" value="{{$conocimientos->id_conocimiento}}" style="display: none">
                            <td><input type="radio" name="criterio2[{{$j}}]" value="1" required><br></td>
                            <td><input type="radio" name="criterio2[{{$j}}]" value="2" required><br></td>
                            <td><input type="radio" name="criterio2[{{$j}}]" value="3" required><br></td>
                            <td><input type="radio" name="criterio2[{{$j}}]" value="4" required><br></td>
                            <td><input type="radio" name="criterio2[{{$j}}]" value="NA" required><br></td>
                            <td><input type="radio" name="criterio2[{{$j}}]" value="NL" required><br></td>

                        </tr>
                            <?php $j++ ?>
                        @endforeach
                    </table>
                </div>

                <div class="row justify-content-end ">
                    <div class="col-md-4">
                        <button id="cancelar" class="btn btn-secondary" type="button">Cancelar</button>
                    </div>
                    <div class="col-md-4">
                        <input class="btn btn-primary" id="submit" type="submit" value="Aceptar">
                    </div>
                </div>

                <br>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            var i=1;
            $('#addTarea').click(function(){
                i++;
                $('#tablaTareas').append('<div class="form-group row container-fluid" id="row'+i+'"><input type="text" name="tarea[]" placeholder="Nombre" class="form-control name_list col-sm-2" required/><div class="col-9"><input type="text" name="dptarea[]" placeholder="Descripción de tarea" class="form-control name_list" required/></div><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addAreasOtros').click(function(){
                i++;
                $('#areasOtros').append('<div id="row'+i+'" class="col-lg-4"><div class="form-group row" ><input type="text" name="areasOtros[]" placeholder="Area" class="form-control name_list col-lg-6" required/><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
            $('#addHerramientasOtros').click(function(){
                i++;
                $('#herramientasOtros').append('<div id="row'+i+'" class="col-4"><div class="form-group row" ><input type="text" name="herramientasOtros[]" placeholder="Herramienta" class="form-control name_list col-lg-6" required/><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
            $('#addConocimientoA').click(function(){
                i++;
                $('#tablaConocimientosA').append('<div class="form-group row container-fluid" id="row'+i+'"><label for="conocimientoA" class="col-lg-2 col-form-label text-md-right"></label><div class="col-2"><input type="text" name="conocimientoA[]" placeholder="Nombre" class="form-control name_list" required/></div><div class="col-7"><input type="text" name="dpConocimientoA[]" placeholder="Explicación de conocimiento aprendido" class="form-control name_list" required/></div><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addConocimientoF').click(function(){
                i++;
                $('#tablaConocimientosF').append('<div class="form-group row container-fluid" id="row'+i+'"><label for="conocimientoF" class="col-lg-2 col-form-label text-md-right"></label><div class="col-2"><input type="text" name="conocimientoF[]" placeholder="Nombre" class="form-control name_list" required/></div><div class="col-7"><input type="text" name="dpConocimientoF[]" placeholder="Explicación de conocimiento faltante" class="form-control name_list" required/></div><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addHabilidadA').click(function(){
                i++;
                $('#tablaHabilidadesA').append('<div class="form-group row container-fluid" id="row'+i+'"><label for="habilidadA" class="col-lg-2 col-form-label text-md-right"></label><div class="col-2"><input type="text" name="habilidadA[]" placeholder="Nombre" class="form-control name_list" required/></div><div class="col-7"><input type="text" name="dpHabilidadA[]" placeholder="Explicación de habilidad aprendida" class="form-control name_list" required/></div><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addHabilidadF').click(function(){
                i++;
                $('#tablaHabilidadesF').append('<div class="form-group row container-fluid" id="row'+i+'"><label for="habilidadF" class="col-lg-2 col-form-label text-md-right"></label><div class="col-2"><input type="text" name="habilidadF[]" placeholder="Nombre" class="form-control name_list" required/></div><div class="col-7"><input type="text" name="dpHabilidadF[]" placeholder="Explicación de habilidad faltante" class="form-control name_list" required/></div><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addConocimiento').click(function(){
                i++;
                $('#tablaConocimientos').append('<div class="form-group row container-fluid" id="row'+i+'"><input type="text" name="conocimiento[]" placeholder="Nombre" class="form-control name_list col-sm-2" required/><div class="col-9"><input type="text" name="dpConocimiento[]" placeholder="Explicación del conocimiento" class="form-control name_list" required/></div><div class="col-1"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="fas fa-trash-alt" aria-hidden="true"></span></button></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        });


        $("#formularioAutoevaluacion").submit(function(e) {

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
                                    window.location.href = "{{route('descripcionAutoEvaluacion')}}"
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
                    window.location.href = "{{route('descripcionAutoEvaluacion')}}"
                }
            })
        });
    </script>
@endsection


