@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Inscripción de práctica profesional</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el tercer paso que debes realizar para continuar con el proceso de la práctica profesional.
                            </li>
                            <li>
                                El alumno, una vez decidido donde realizará su práctica, deberá inscribirla, completando el formulario “INSCRIPCIÓN DE PRÁCTICA”, en la cual se indicará fecha de inicio y finalización de ésta, nombre de la Empresa y datos del supervisor. Posterior a dicha inscripción, Secretaría de Docencia emitirá carta con la cual el alumno tramitará en el DAE su Certificado de Cobertura del Seguro Escolar.
                            </li>
                            <li>
                                Al finalizar esta etapa y luego de que el seguro escolar y/o carta de presentación estén listos, podrás trabajar y cumplir con las 320 horas mínimas.
                            </li>
                        </ul>
                        </p>

                        <div class="form-group">
                            <div class="row d-flex justify-content-center"> 
                                <a href="{{route('formularioInscripcion')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
