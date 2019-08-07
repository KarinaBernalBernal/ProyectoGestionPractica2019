@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">FORMULARIO DE AUTOEVALUACIÓN</h1>
        </div>
        
        <form action="" enctype="multipart/form-data" method="POST" role="form">
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
                    <h6>I. Autoevaluación del Alumno</h6>
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
                            <label for="codificacion" class="col-md-5 col-form-label">{{ __('Codificación') }}</label>
                            <input type="checkbox" name="codificacion">
                        </div>
                        <div class="col-md-6">
                            <label for="analisisDiseño" class="col-md-7 col-form-label">{{ __('Análisis / Diseño') }}</label>
                            <input type="checkbox" name="analisisDiseño">
                        </div>
                        <div class="col-md-6">
                            <label for="mantencionSw" class="col-md-5 col-form-label">{{ __('Mantención Sw') }}</label>
                            <input type="checkbox" name="seguroEscolar">
                        </div>
                        <div class="col-md-6">
                            <label for="documentar" class="col-md-7 col-form-label">{{ __('Documentar') }}</label>
                            <input type="checkbox" name="documentar">
                        </div>
                        <div class="col-md-6">
                            <label for="testingSqa" class="col-md-5 col-form-label">{{ __('Testing - SQA') }}</label>
                            <input type="checkbox" name="testingSqa">
                        </div>
                        <div class="col-md-6">
                            <label for="soporteHw" class="col-md-7 col-form-label">{{ __('Soporte HW') }}</label>
                            <input type="checkbox" name="soporteHw">
                        </div>
                        <div class="col-md-6">
                            <label for="administracionSo" class="col-md-5 col-form-label">{{ __('Administración S.O.') }}</label>
                            <input type="checkbox" name="administracionSo">
                        </div>
                        <div class="col-md-6">
                            <label for="instalacionAdministracion" class="col-md-7 col-form-label">{{ __('Instalacion / Administración redes') }}</label>
                            <input type="checkbox" name="seguroEscolar">
                        </div>
                        <div class="col-md-6">
                            <label for="modeladoProcesos" class="col-md-5 col-form-label">{{ __('Modelado de Procesos') }}</label>
                            <input type="checkbox" name="modeladoProcesos">
                        </div>
                        <div class="col-md-4">
                            <label for="otros" class="col-md-3 col-form-label">{{ __('Otros') }}</label>
                            <input id="otros" type="text" class="" name="otros" value="{{ old('otros') }}" required>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>2.- Descripción de Tareas Realizadas</strong></h6>
                    </div>
                    <br>

                    {{-- Descripcion de tareas realizadas --}}
                    <div class="form-group row">
                        <label for="dpTarea" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="dpTarea" name="dpTarea" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>3.- Indique las herramientas de SW utilizadas en la práctica</strong></h6>
                    </div>
                    <br>

                    {{-- Herramientas utilizadas --}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="eclipceId" class="col-md-5 col-form-label">{{ __('Eclipce IDE') }}</label>
                            <input type="checkbox" name="eclipceId">
                        </div>
                        <div class="col-md-6">
                            <label for="codeblocks" class="col-md-7 col-form-label">{{ __('CodeBlocks IDE') }}</label>
                            <input type="checkbox" name="codeblocks">
                        </div>
                        <div class="col-md-6">
                            <label for="trello" class="col-md-5 col-form-label">{{ __('Trello') }}</label>
                            <input type="checkbox" name="trello">
                        </div>
                        <div class="col-md-6">
                            <label for="xampp" class="col-md-7 col-form-label">{{ __('Xampp') }}</label>
                            <input type="checkbox" name="xampp">
                        </div>
                        <div class="col-md-6">
                            <label for="mySql" class="col-md-5 col-form-label">{{ __('MySql') }}</label>
                            <input type="checkbox" name="mySql">
                        </div>
                        <div class="col-md-4">
                            <label for="otros" class="col-md-3 col-form-label">{{ __('Otros') }}</label>
                            <input id="otros" type="text" class="" name="otros" value="{{ old('otros') }}" required>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>4.- ¿Qué Conocimientos / Habilidades aprendidas en la carrera fueron importantes para el desarrollo de su práctica? (comente):</strong></h6>
                    </div>
                    <br>

                    {{-- Conocimientos/habilidades aprendidas más importantes --}}
                    <div class="form-group row">
                        <label for="dpHabilidadImportante" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="dpHabilidadImportante" name="dpHabilidadImportante" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>5.- ¿Qué Conocimientos / Habilidades piensa que le faltaron para un buen desempeño en su práctica? (comente):</strong></h6>
                    </div>
                    <br>

                    {{-- Conocimientos/habilidades faltantes --}}
                    <div class="form-group row">
                        <label for="dpHabilidadFaltante" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="dpHabilidadFaltante" name="dpHabilidadFaltante" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>7.- ¿Qué conocimientos adquirió durante su práctica?</strong></h6>
                    </div>
                    <br>

                    {{-- Conocimientos/habilidades adquiridas --}}
                    <div class="form-group row">
                        <label for="dpHabilidadAdquirida" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="dpHabilidadAdquirida" name="dpHabilidadAdquirida" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>8.- ¿Cómo calificaría su desempeño durante el período de práctica?</strong></h6>
                    </div>
                    <br>

                    {{-- Calificación desempeño --}}
                    <div class="form-group row">
                        <label for="desempeño" class="col-md-3 col-form-label text-md-right"></label>

                        <div class="col-md-6">
                            <select id="desempeño" name="desempeño" class="custom-select">
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
                        <label for="dpDesempeño" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="dpDesempeño" name="dpDesempeño" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>9.- De acuerdo a su experiencia en la práctica, realice una autoevaluación para evaluar su desempeño, utilizando una escala de 1 a 4, donde 1 representa criterio débilmente logrado y 4 criterio totalmente logrado. Además si considera necesario puede considerar evaluar con NA: No Aplica o NL: No Logrado.</strong></h6>
                    </div>
                    <br>
                    {{-- Evaluacion con "dea acuerdo", "muy de acuerdo", etc. --}}
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
                            <form>
                                <td><input type="radio" name="criterio1" value="1"><br></td>
                                <td><input type="radio" name="criterio1" value="2"><br></td>
                                <td><input type="radio" name="criterio1" value="3"><br></td>
                                <td><input type="radio" name="criterio1" value="4"><br></td>
                                <td><input type="radio" name="criterio1" value="NA"><br></td>
                                <td><input type="radio" name="criterio1" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Demuestra Iniciativa, creatividad y proactividad en el desempeño de las tareas.</td>
                            <form>
                                <td><input type="radio" name="criterio2" value="1"><br></td>
                                <td><input type="radio" name="criterio2" value="2"><br></td>
                                <td><input type="radio" name="criterio2" value="3"><br></td>
                                <td><input type="radio" name="criterio2" value="4"><br></td>
                                <td><input type="radio" name="criterio2" value="NA"><br></td>
                                <td><input type="radio" name="criterio2" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Presenta capacidad de Autoaprendizaje</td>
                            <form>
                                <td><input type="radio" name="criterio3" value="1"><br></td>
                                <td><input type="radio" name="criterio3" value="2"><br></td>
                                <td><input type="radio" name="criterio3" value="3"><br></td>
                                <td><input type="radio" name="criterio3" value="4"><br></td>
                                <td><input type="radio" name="criterio3" value="NA"><br></td>
                                <td><input type="radio" name="criterio3" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Participa adecuadamente en trabajos en grupo</td>
                            <form>
                                <td><input type="radio" name="criterio4" value="1"><br></td>
                                <td><input type="radio" name="criterio4" value="2"><br></td>
                                <td><input type="radio" name="criterio4" value="3"><br></td>
                                <td><input type="radio" name="criterio4" value="4"><br></td>
                                <td><input type="radio" name="criterio4" value="NA"><br></td>
                                <td><input type="radio" name="criterio4" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Se comunica efectivamente en forma oral y escrita en su lengua materna</td>
                            <form>
                                <td><input type="radio" name="criterio5" value="1"><br></td>
                                <td><input type="radio" name="criterio5" value="2"><br></td>
                                <td><input type="radio" name="criterio5" value="3"><br></td>
                                <td><input type="radio" name="criterio5" value="4"><br></td>
                                <td><input type="radio" name="criterio5" value="NA"><br></td>
                                <td><input type="radio" name="criterio5" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Maneja de forma apropiada el idioma Inglés en el contexto de su profesión</td>
                            <form>
                                <td><input type="radio" name="criterio6" value="1"><br></td>
                                <td><input type="radio" name="criterio6" value="2"><br></td>
                                <td><input type="radio" name="criterio6" value="3"><br></td>
                                <td><input type="radio" name="criterio6" value="4"><br></td>
                                <td><input type="radio" name="criterio6" value="NA"><br></td>
                                <td><input type="radio" name="criterio6" value="NL"><br></td>
                            </form>
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
                            <form>
                            <td><input type="radio" name="criterio7" value="1"><br></td>
                            <td><input type="radio" name="criterio7" value="2"><br></td>
                            <td><input type="radio" name="criterio7" value="3"><br></td>
                            <td><input type="radio" name="criterio7" value="4"><br></td>
                            <td><input type="radio" name="criterio7" value="NA"><br></td>
                            <td><input type="radio" name="criterio7" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Concibe soluciones eficientes a los problemas presentados, considerando la evaluación de variables involucradas en éstas.</td>
                            <form>
                                <td><input type="radio" name="criterio8" value="1"><br></td>
                                <td><input type="radio" name="criterio8" value="2"><br></td>
                                <td><input type="radio" name="criterio8" value="3"><br></td>
                                <td><input type="radio" name="criterio8" value="4"><br></td>
                                <td><input type="radio" name="criterio8" value="NA"><br></td>
                                <td><input type="radio" name="criterio8" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Desarrolla su trabajo considerando aspectos de calidad, en proceso y resultado.</td>
                            <form>
                                <td><input type="radio" name="criterio9" value="1"><br></td>
                                <td><input type="radio" name="criterio9" value="2"><br></td>
                                <td><input type="radio" name="criterio9" value="3"><br></td>
                                <td><input type="radio" name="criterio9" value="4"><br></td>
                                <td><input type="radio" name="criterio9" value="NA"><br></td>
                                <td><input type="radio" name="criterio9" value="NL"><br></td>
                            </form>
                        </tr>
                        <tr>
                            <td>Gestiona proyectos y lidera procesos organizacionales</td>
                            <form>
                                <td><input type="radio" name="criterio10" value="1"><br></td>
                                <td><input type="radio" name="criterio10" value="2"><br></td>
                                <td><input type="radio" name="criterio10" value="3"><br></td>
                                <td><input type="radio" name="criterio10" value="4"><br></td>
                                <td><input type="radio" name="criterio10" value="NA"><br></td>
                                <td><input type="radio" name="criterio10" value="NL"><br></td>
                            </form>
                        </tr>
                    </table>
                </div>

                <div class="row justify-content-end ">
                    <div class="col-md-4">
                        <a href="" class="btn btn-secondary">Cancelar</a>
                    </div>
                    <div class="col-md-4">
                        <input class="btn btn-primary" type="submit" value="Aceptar">
                    </div>
                </div>

                <br>
            </div>
        </form>
    </div>
@endsection


