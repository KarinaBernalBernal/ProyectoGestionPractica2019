@extends('layouts.mainlayout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">REGLAMENTO INTERNO PRÁCTICAS</h1>
        </div>

        <!-- Content Row -->
        <div class="card text">
            <!-- Card Header -->
            <div class="card-header">
                <h4><strong>Objetivo de la Práctica</strong></h4>
            </div>
            <!-- Card Body -->

            <div class="card-body">
                <h5><strong>Para el Alumno:</strong> </h5>
                <p>
                <ul>
                    <li class="col-8">
                        Articular  el  conocimiento  académico  con  los  conocimientos  prácticos  que  emergen  de  los diversos contextos del que hacer profesional.
                    </li>
                </ul>
                </p>

                <h5><strong>Para el Escuela:</strong> </h5>
                <p>
                <ul>
                    <li>
                        Evaluar las competencias de egreso en contextos de Prácticas Profesionales, como un medio de aseguramiento de la calidad de la formación de pregrado.
                    </li>
                    <li>
                        Retroalimentar  el  currículo  de  formación  del  programa  de  pregrado  a  partir  de  las evidencias del desempeño de los estudiantes en las Prácticas Profesionales.
                    </li>
                </ul>
                </p>
                
                <h5><strong>Para el Alumno</strong> </h5>
                <p>
                    <ul>
                        <li class="col-8">
                            Articular  el  conocimiento  académico  con  los  conocimientos  prácticos  que  emergen  de  los diversos contextos del que hacer profesional.
                        </li>
                    </ul>
                </p>

                <h5><strong>Para el Escuela</strong> </h5>
                <p>
                    <ul>
                        <li>
                                Evaluar las competencias de egreso en contextos de Prácticas Profesionales, como un medio de aseguramiento de la calidad de la formación de pregrado.
                        </li>
                        <li>
                                Retroalimentar  el  currículo  de  formación  del  programa  de  pregrado  a  partir  de  las evidencias del desempeño de los estudiantes en las Prácticas Profesionales.
                        </li>
                    </ul>
                </p>

                <h5><strong>Lugares y Duración de la práctica</strong></h5>
                <p>
                    <ol>
                        <li>La práctica deberá tener  una duración mínima de 320 horas cronológica.</li>
                        <br>
                        <li>La práctica se podrá realizar en cualquier tipo de empresa u organización. Para lo anterior, el alumnopodrá  conseguir  un  lugar  para  su  realización  en  forma  independiente  o  bien  mediante  los  anuncios publicados por la Escuela. </li>
                        <br>
                        <li>Las actividades a realizar por el alumno durante dicho período corresponde a cualquier actividad que pudiese realizar un profesional de la especialidad.Inscripción de la Práctica  </li>
                        <br>
                        <li>Para  realizar  su  práctica  profesional,  todo  alumno debe  primero  solicitar  autorización  a  Jefatura  de Docencia, quien evaluando el avance académico del alumno,  publicará si dicha autorización es aceptada o rechazada. </li>
                        <br>
                        <li>Para  postular  a  una  práctica  profesional,  el  alumno  podrá  solicitar  en  Secretaría  de  Docencia  una “Carta Presentación”, mediante la cual la Escuela indica que el alumno realmente pertenece a esta unidad académica y requiere realizar su práctica. </li>
                        <br>
                        <li>Una vez aceptado donde realizará su práctica, el alumno deberá inscribirla, completando el formulario “INSCRIPCIÓN DE PRÁCTICA”, en la cual se indicará fecha de inicio y finalización de ésta, nombre de la Empresa y datos del supervisor. Posterior a dicha inscripción, Secretaría de Docencia emitirá carta con la cual el alumno tramitará en el DAE su Certificado de Cobertura del Seguro Escolar.</li>
                        <br>
                        <li>La   Escuela   solicitará   a   la   Empresa   que   realice   la   evaluación   del   estudiante,   según   informe “Evaluación Empresa”</li>
                        <b></b>
                        <li>Una  vez  finalizada  la  práctica,  el  alumno  dispondrá  de  dos  semanas  para  entregar  formulario “Autoevaluación del Alumno”</li>
                        <br>
                        <li>El  alumno  deberá  participar  de  una  actividad  donde dará  a  conocer    lo  realizado  en  su  práctica  y  la experiencia adquirida</li>
                        <br>
                        <li>Si  el  alumno  cumple  satisfactoriamente  con  las  actividades  desarrolladas,  tiene  una  evaluación  por parte  de  la  Empresa  por  sobre  el  70  %  de  los  criterios,    cumple  con  lo  establecido  en  el  formulario “Autoevaluación del Alumno”, y participar en la actividad señalada en el punto 6,  el alumno aprobará su práctica (escala conceptual, “Aprobado”).</li>
                        <br>
                        <li>La práctica se considerará reprobada (escala conceptual “Reprobado”), si se presenta cualquiera de lassiguientes situaciones: </li>
                        <ul>
                            <li>No se cumple con los plazos definidos para cada una de las instancias de esta actividad formativa.</li>
                            <li>Se tiene una evaluación de la empresa bajo lo señalado en punto anterior. </li>
                            <li>No  se  cumple  con  las  exigencias  establecidas  tanto en  la  actividad  de  exposición  de  su  práctica como en el documento de Autoevaluación del Alumno</li>
                            <li>No cumplir con el tiempo mínimo de duración. </li>
                            <li>No se realizan labores acordes a los objetivos señalados. </li>
                        </ul>
                    </ol>
                </p>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
