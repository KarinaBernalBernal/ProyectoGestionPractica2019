@extends('layouts.mainlayout')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">FORMULARIO DE AUTOEVALUACIÓN</h1>
        </div>

            {{-- Autoevaluacion del Alumno --}}
            <div class="card text">
                <div class="card-body">
                    <h4>¿En qué área(s) clasificaría su práctica?</h4>
                    <hr>


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
                </div>
            </div>
            <br>
            <div class="card text">
                <div class="card-body">

                    <h4>Describe las tareas realizaadas</h4>
                    <hr>


                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaTareas">
                            <tr>
                                <td><input type="text" name="tarea[]" placeholder="Ingrese la tarea" class="form-control name_list" required/></td>
                                <td><button type="button" name="addTarea" id="addTarea" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
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
                </div>
            </div>
            <br>
            <div class="card text">
                <div class="card-body">
                    <h4>Conocimientos y Hablidades</h4>

                    <hr>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>1.- ¿Qué Conocimientos / Habilidades aprendidas en la carrera fueron importantes para el desarrollo de su práctica? (comente):</strong></h6>
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
                        <h6><strong>2.- ¿Qué Conocimientos / Habilidades piensa que le faltaron para un buen desempeño en su práctica? (comente):</strong></h6>
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
                        <h6><strong>3.- ¿Qué conocimientos adquirió durante su práctica?</strong></h6>
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
                            <textarea id="dpDesempenno" name="dpDesempenno" class="form-control" rows="10" cols="40" placeholder="Escribe aquí tu comentario"></textarea>
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
            </div>
    </div>
@endsection