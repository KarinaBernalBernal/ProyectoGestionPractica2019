@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">FORMULARIO DE EVALUACIÓN DE EMPRESA</h1>
        </div>
        
        <form action="{{route('agregarEvaluacionEmpresa')}}" enctype="multipart/form-data" method="POST" role="form">
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

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>Tareas realizadas por alumno en Período de Práctica</strong></h6>
                    </div>
                    <br>

                    {{-- Tareas realizadas por alumno en practica --}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Programación') }}</label>
                            <input type="checkbox" name="area[]" value="Programación">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-4 col-form-label">{{ __('Análisis / Diseño') }}</label>
                            <input type="checkbox" name="area[]" value="Análisis / Diseño">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Mantención Sw') }}</label>
                            <input type="checkbox" name="area[]" value="Mantención Sw">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-4 col-form-label">{{ __('Documentación') }}</label>
                            <input type="checkbox" name="area[]" value="Documentación">
                        </div>
                        <div class="col-md-6">
                            <label for="area[]" class="col-md-5 col-form-label">{{ __('Testing') }}</label>
                            <input type="checkbox" name="area[]" value="Testing">
                        </div>
                        {{--
                        <div class="col-md-4">
                            <label for="otros" class="col-md-3 col-form-label">{{ __('Otros') }}</label>
                            <input id="otros" type="text" class="" name="otros" value="{{ old('otros') }}" required>
                        </div>
                        --}}
                    </div>

                    <br>
                </div>
            </div>

            <br>

            {{-- Autoevaluacion del Alumno --}}
            <div class="card text">
                <div class="card-header">
                    <h6>II. Evaluación</h6>
                </div>
                <div class="card-body">

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>Para los siguientes criterios, evalúe desempeño percibido por el alumno donde con una escala de 1 a 4, donde 1 representa criterio debilmente logrado y 4 criterio totalmente logrado. Además si considera necesario puede considerar evaluar con NA: No Aplica y NL: No Logrado</strong></h6>
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
                    <div class="col-md-auto">
                        <h6><strong>3.- ¿De las tareas asignadas cúal fue el porcentaje de tareas efectivamente realziado?</strong></h6>
                    </div>
                    <br>

                    {{-- Descripcion de tareas realizadas --}}
                    <div class="form-group row">
                        <div class="col-md-1">
                            <input id="porcentaje" type="text" class="form-control" name="porcentaje" value="{{ old('porcentaje') }}" required>
                        </div>
                        <label for="porcentaje" class="col-form-label text-md-left">{{ __('%') }}</label>
                    </div>

                    <br>
                    <div class="col-md-auto">
                        <h6><strong>4.- A su Juicio, ¿Cuáles son las mayores fortalezas presentadas por el alumno?</strong></h6>
                    </div>
                    <br>

                    {{-- Conocimientos/habilidades aprendidas más importantes --}}

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaFortalezas">
                            <tr>
                                <td><input type="text" name="fortaleza[]" placeholder="Ingrese Fortaleza" class="form-control name_list" required/></td>
                                <td><button type="button" name="addFortaleza" id="addFortaleza" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                    </div>
                    {{--
                    <div class="form-group row">
                        <label for="fortalezas" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="fortalezas" name="fortalezas" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>
                    --}}
                    <br>
                    <div class="col-md-auto">
                        <h6><strong>5.- A su Juicio, ¿Cuáles son las mayores debilidades presentadas por el alumno?</strong></h6>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaDebilidades">
                            <tr>
                                <td><input type="text" name="debilidad[]" placeholder="Ingrese Debilidad" class="form-control name_list" required/></td>
                                <td><button type="button" name="addDebilidad" id="addDebilidad" class="btn btn-success">Add More</button></td>
                            </tr>
                        </table>
                    </div>
                    {{-- Conocimientos/habilidades faltantes
                    <div class="form-group row">
                        <label for="debilidades" class="col-md-3 col-form-label text-md-right"></label>
                        <div class="col-md-6">
                            <textarea id="debilidades" name="debilidades" class="form-control" rows="10" cols="40">Escribe aquí tu comentario</textarea>
                        </div>
                    </div>
                    --}}
                    <br>
                    <div class="col-md-auto">
                        <h6><strong>7.- De acuerdo al desempeño del alumno, usted recomendaría que la práctica sea </strong></h6>
                    </div>
                    <br>

                    {{-- Conocimientos/habilidades adquiridas --}}
                    <div class="form-group row">
                        <label for="recomendacion" class="col-md-3 col-form-label text-md-right">{{ __('Recomiendo que sea:') }}</label>
                        <div class="col-md-4">
                            <select id="recomendacion" name="recomendacion" class="custom-select">
                                <option selected value="">Selecciona...</option>
                                <option>Aprobada</option>
                                <option>Rechazada</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
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

@section('scripts')
    <script>
        $(document).ready(function(){
            var i=1;
            $('#addFortaleza').click(function(){
                i++;
                $('#tablaFortalezas').append('<tr id="row'+i+'"><td><input type="text" name="fortaleza[]" placeholder="Ingrese la fortaleza" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

            $('#addDebilidad').click(function(){
                i++;
                $('#tablaDebilidades').append('<tr id="row'+i+'"><td><input type="text" name="debilidad[]" placeholder="Ingrese Debilidad" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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


