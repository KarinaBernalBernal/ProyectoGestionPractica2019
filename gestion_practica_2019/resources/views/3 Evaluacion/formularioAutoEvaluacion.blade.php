@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">FORMULARIO DE AUTOEVALUACIÓN</h1>
        </div>

        <form action="{{route('agregarAutoEvaluacion')}}" enctype="multipart/form-data" method="POST" role="form">
            {{ csrf_field() }}

            {{-- Antecedentes generales --}}

            <div class="card text">
                <div class="card-header">
                    <h6>I. Antecedentes Generales</h6>
                </div>
                <div class="card-body">

                    {{-- Nombre --}}
                    <div class="form-group row">
                        <label for="nombreAlumno" class="col-md-3 col-form-label text-md-right">{{ __('Nombre del Alumno') }}</label>

                        <div class="col-md-6">
                            <input id="nombreAlumno" type="text" class="form-control" name="nombreAlumno" value="{{ old('nombreAlumno') }}" required>
                        </div>
                    </div>
                    {{-- Carrera --}}
                    <div class="form-group row">
                        <label for="carrera" class="col-md-3 col-form-label text-md-right">{{ __('Carrera') }}</label>

                        <div class="col-md-6">
                            <select id="carrera" name="carrera" class="custom-select">
                                <option selected value="">Selecciona...</option>
                                <option>Ingeniería Civil Informática</option>
                                <option>Ingeniería de Ejecución Informática</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    {{-- Periodo de practica --}}
                    <div class="form-group row">
                            <label for="fechaDesde" class="col-md-3 col-form-label text-md-right">{{ __('Periodo de practica desde') }}</label>
                            <input type="date" name="fechaDesde" required>
                        <div class="col-md-4">
                            <label for="fechaHasta" class="col-md-3 col-form-label text-md-right">{{ __('Hasta') }}</label>
                            <input type="date" name="fechaHasta" required>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                    <h6 class="col-md-3 col-form-label text-md-right"><strong>Datos Empresa</strong></h6>
                    </div>
                    <br>

                    {{-- Nombre de la empresa --}}
                    <div class="form-group row">
                        <label for="nombreEmpresa" class="col-md-3 col-form-label text-md-right">{{ __('Nombre de la Empresa') }}</label>

                        <div class="col-md-6">
                            <input id="nombreEmpresa" type="text" class="form-control" name="nombreEmpresa" value="{{ old('nombreEmpresa') }}" required>
                        </div>
                    </div>

                    {{-- direccion --}}
                    <div class="form-group row">
                        <label for="direccion" class="col-md-3 col-form-label text-md-right">{{ __('Dirección') }}</label>

                        <div class="col-md-6">
                            <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                        </div>
                    </div>

                    {{-- ciudad --}}
                    <div class="form-group row">
                        <label for="ciudad" class="col-md-3 col-form-label text-md-right">{{ __('Ciudad') }}</label>

                        <div class="col-md-6">
                            <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" required>
                        </div>
                    </div>

                    {{-- casilla --}}
                    <div class="form-group row">
                        <label for="casilla" class="col-md-3 col-form-label text-md-right">{{ __('Casilla') }}</label>

                        <div class="col-md-6">
                            <input id="casilla" type="text" class="form-control" name="casilla" value="{{ old('casilla') }}" required>
                        </div>
                    </div>

                    {{-- Fono --}}
                    <div class="form-group row">
                        <label for="fono" class="col-md-3 col-form-label text-md-right">{{ __('Fono') }}</label>

                        <div class="col-md-6">
                            <input id="fono" type="text" class="form-control" name="Fono" value="{{ old('fono') }}" required>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                        <h6 class="col-md-3 col-form-label text-md-right"><strong>Datos Supervisor</strong></h6>
                    </div>
                    <br>
                    {{-- Nombre del supervisor --}}
                    <div class="form-group row">
                        <label for="nombreSupervisor" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="nombreSupervisor" type="text" class="form-control" name="nombreSupervisor" value="{{ old('nombreSupervisor') }}" required>
                        </div>
                    </div>

                    {{-- Cargo --}}
                    <div class="form-group row">
                        <label for="cargo" class="col-md-3 col-form-label text-md-right">{{ __('Cargo') }}</label>

                        <div class="col-md-6">
                            <input id="cargo" type="text" class="form-control" name="cargo" value="{{ old('cargo') }}" required>
                        </div>
                    </div>

                    {{-- Fono --}}
                    <div class="form-group row">
                        <label for="fono" class="col-md-3 col-form-label text-md-right">{{ __('Fono') }}</label>

                        <div class="col-md-6">
                            <input id="fono" type="text" class="form-control" name="Fono" value="{{ old('fono') }}" required>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            {{-- Autoevaluacion del Alumno --}}
            <div class="card text">
                <div class="card-header">
                    <h6>II. Autoevaluación del Alumno</h6>
                </div>
                <div class="card-body">

                    <br>
                    <div class="col-md-4">
                        <h6><strong>1.- ¿En qué área(s) clasificaría su práctica?</strong></h6>
                    </div>
                    <br>

                    {{-- Areas --}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Codificación') }}</label>
                            <input type="checkbox" name="area[]" value="Codificación">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-7 col-form-label">{{ __('Análisis / Diseño') }}</label>
                            <input type="checkbox" name="area[]" value="Análisis / Diseño">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Mantención Sw') }}</label>
                            <input type="checkbox" name="area[]" value="Mantención Sw">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-7 col-form-label">{{ __('Documentar') }}</label>
                            <input type="checkbox" name="area[]" value="Documentar">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Testing - SQA') }}</label>
                            <input type="checkbox" name="area[]" value="Testing - SQA">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-7 col-form-label">{{ __('Soporte HW') }}</label>
                            <input type="checkbox" name="area[]" value="Soporte HW">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Administración S.O.') }}</label>
                            <input type="checkbox" name="area[]" value="Administración S.O.">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-7 col-form-label">{{ __('Instalacion / Administración redes') }}</label>
                            <input type="checkbox" name="area[]" value="Instalacion / Administración redes">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Modelado de Procesos') }}</label>
                            <input type="checkbox" name="area[]" value="Modelado de Procesos">
                        </div>
                        {{--
                        <div class="col-md-4">
                            <label for="otros" class="col-md-3 col-form-label">{{ __('Otros') }}</label>
                            <input id="otros" type="text" class="" name="area[9]" value="{{ old('otros') }}" >
                        </div>
                        --}}
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>2.- Descripción de Tareas Realizadas</strong></h6>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaTareas">
                            <tr>
                                <td><input type="text" name="tarea[]" placeholder="Ingrese la tarea" class="form-control name_list" required/></td>
                                <td><button type="button" name="addTarea" id="addTarea" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                    </div>


                    <br>
                    <div class="col-md-auto">
                        <h6><strong>3.- Indique las herramientas de SW utilizadas en la práctica</strong></h6>
                    </div>
                    <br>

                    {{-- Herramientas utilizadas --}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="herramienta[]" class="col-md-5 col-form-label">{{ __('Eclipce IDE') }}</label>
                            <input type="checkbox" name="herramienta[]" value="Eclipce IDE">
                        </div>
                        <div class="col-md-6">
                            <label for="herramienta[]" class="col-md-7 col-form-label">{{ __('CodeBlocks IDE') }}</label>
                            <input type="checkbox" name="herramienta[]" value="CodeBlocks IDE">
                        </div>
                        <div class="col-md-6">
                            <label for="herramienta[]" class="col-md-5 col-form-label">{{ __('Trello') }}</label>
                            <input type="checkbox" name="herramienta[]" value="Trello">
                        </div>
                        <div class="col-md-6">
                            <label for="herramienta[]" class="col-md-7 col-form-label">{{ __('Xampp') }}</label>
                            <input type="checkbox" name="herramienta[]" value="Xampp">
                        </div>
                        <div class="col-md-6">
                            <label for="herramienta[]" class="col-md-5 col-form-label">{{ __('MySql') }}</label>
                            <input type="checkbox" name="herramienta[]" value="MySql">
                        </div>
                        {{--
                        <div class="col-md-4">
                            <label for="otros" class="col-md-3 col-form-label">{{ __('Otros') }}</label>
                            <input id="otros" type="text" class="" name="otros" value="{{ old('otros') }}" required>
                        </div>
                        --}}
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>4.- ¿Qué Conocimientos / Habilidades aprendidas en la carrera fueron importantes para el desarrollo de su práctica? (comente):</strong></h6>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaHabilidadesA">
                            <tr>
                                <td><input type="text" name="habilidadA[]" placeholder="Ingrese habilidad aprendida" class="form-control name_list" required/></td>
                                <td><button type="button" name="addHabilidadA" id="addHabilidadA" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>5.- ¿Qué Conocimientos / Habilidades piensa que le faltaron para un buen desempeño en su práctica? (comente):</strong></h6>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaHabilidadesF">
                            <tr>
                                <td><input type="text" name="habilidadF[]" placeholder="Ingrese habilidad faltante" class="form-control name_list" required/></td>
                                <td><button type="button" name="addHabilidadF" id="addHabilidadF" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>7.- ¿Qué conocimientos adquirió durante su práctica?</strong></h6>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaConocimientos">
                            <tr>
                                <td><input type="text" name="conocimiento[]" placeholder="Ingrese conocimiento" class="form-control name_list" required/></td>
                                <td><button type="button" name="addConocimiento" id="addConocimiento" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>8.- ¿Cómo calificaría su desempeño durante el período de práctica?</strong></h6>
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
                            <textarea id="dpDesempenno" name="dpDesempenno" class="form-control" rows="10" cols="40" placeholder="Escribe aquí tu comentario"></textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>9.- De acuerdo a su experiencia en la práctica, realice una autoevaluación para evaluar su desempeño, utilizando una escala de 1 a 4, donde 1 representa criterio débilmente logrado y 4 criterio totalmente logrado. Además si considera necesario puede considerar evaluar con NA: No Aplica o NL: No Logrado.</strong></h6>
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
                        <tr>
                            <td>Se desempeña con responsabilidad, respeto y ética profesional</td>

                                <td><input type="radio" name="criterio[0]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[0]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[0]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[0]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[0]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[0]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Demuestra Iniciativa, creatividad y proactividad en el desempeño de las tareas.</td>

                                <td><input type="radio" name="criterio[1]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[1]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[1]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[1]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[1]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[1]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Presenta capacidad de Autoaprendizaje</td>

                                <td><input type="radio" name="criterio[2]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[2]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[2]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[2]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[2]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[2]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Participa adecuadamente en trabajos en grupo</td>

                                <td><input type="radio" name="criterio[3]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[3]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[3]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[3]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[3]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[3]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Se comunica efectivamente en forma oral y escrita en su lengua materna</td>

                                <td><input type="radio" name="criterio[4]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[4]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[4]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[4]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[4]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[4]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Maneja de forma apropiada el idioma Inglés en el contexto de su profesión</td>

                                <td><input type="radio" name="criterio[5]" value="1" required><br></td>
                                <td><input type="radio" name="criterio[5]" value="2" required><br></td>
                                <td><input type="radio" name="criterio[5]" value="3" required><br></td>
                                <td><input type="radio" name="criterio[5]" value="4" required><br></td>
                                <td><input type="radio" name="criterio[5]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio[5]" value="NL" required><br></td>

                        </tr>
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
                        <tr>
                            <td>Aplica adecuadamente conocimientos teóricos para diseñar soluciones.</td>

                            <td><input type="radio" name="criterio2[0]" value="1" required><br></td>
                            <td><input type="radio" name="criterio2[0]" value="2" required><br></td>
                            <td><input type="radio" name="criterio2[0]" value="3" required><br></td>
                            <td><input type="radio" name="criterio2[0]" value="4" required><br></td>
                            <td><input type="radio" name="criterio2[0]" value="NA" required><br></td>
                            <td><input type="radio" name="criterio2[0]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Concibe soluciones eficientes a los problemas presentados, considerando la evaluación de variables involucradas en éstas.</td>

                                <td><input type="radio" name="criterio2[1]" value="1" required><br></td>
                                <td><input type="radio" name="criterio2[1]" value="2" required><br></td>
                                <td><input type="radio" name="criterio2[1]" value="3" required><br></td>
                                <td><input type="radio" name="criterio2[1]" value="4" required><br></td>
                                <td><input type="radio" name="criterio2[1]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio2[1]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Desarrolla su trabajo considerando aspectos de calidad, en proceso y resultado.</td>

                                <td><input type="radio" name="criterio2[2]" value="1" required><br></td>
                                <td><input type="radio" name="criterio2[2]" value="2" required><br></td>
                                <td><input type="radio" name="criterio2[2]" value="3" required><br></td>
                                <td><input type="radio" name="criterio2[2]" value="4" required><br></td>
                                <td><input type="radio" name="criterio2[2]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio2[2]" value="NL" required><br></td>

                        </tr>
                        <tr>
                            <td>Gestiona proyectos y lidera procesos organizacionales</td>

                                <td><input type="radio" name="criterio2[3]" value="1" required><br></td>
                                <td><input type="radio" name="criterio2[3]" value="2" required><br></td>
                                <td><input type="radio" name="criterio2[3]" value="3" required><br></td>
                                <td><input type="radio" name="criterio2[3]" value="4" required><br></td>
                                <td><input type="radio" name="criterio2[3]" value="NA" required><br></td>
                                <td><input type="radio" name="criterio2[3]" value="NL" required><br></td>

                        </tr>
                    </table>
                </div>

                <div class="row justify-content-end ">
                    <div class="col-md-4">
                        <a href="{{route('descripcionAutoEvaluacion')}}" class="btn btn-secondary">Cancelar</a>
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
                $('#tablaTareas').append('<tr id="row'+i+'"><td><input type="text" name="tarea[]" placeholder="Ingrese la tarea" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addConocimiento').click(function(){
                i++;
                $('#tablaConocimientos').append('<tr id="row'+i+'"><td><input type="text" name="conocimiento[]" placeholder="Ingrese conocimiento" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addHabilidadA').click(function(){
                i++;
                $('#tablaHabilidadesA').append('<tr id="row'+i+'"><td><input type="text" name="habilidadA[]" placeholder="Ingrese habilidad aprendida" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addHabilidadF').click(function(){
                i++;
                $('#tablaHabilidadesF').append('<tr id="row'+i+'"><td><input type="text" name="habilidadF[]" placeholder="Ingrese habilidad faltante" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

        });
    </script>

@endsection
