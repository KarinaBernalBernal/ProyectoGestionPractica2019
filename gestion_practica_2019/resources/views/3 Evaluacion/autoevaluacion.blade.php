@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Formulario de autoevaluación</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el penúltimo paso que debes realizar para seguir con el proceso de la práctica profesional.
                            </li>
                            <li>
                                Esta es la última instancia en la que deberás realizar algo en internet, cuando termines, la empresa podrá completar el formulario que contiene la calificación de tu desempeño.
                            </li>
                            <li>
                                Cuando tu autoevaluación y evaluación de la empresa estén terminados, la DAE te informará, mediante un correo electrónico, el día de la reunión con asistencia OBLIGATORIA para aprobar la práctica.
                            </li>
                            <li>
                                La decisión final será procesada tomando en cuenta tu autoevaluación, la evaluación de la empresa y tu asistencia a la charla.
                            </li>
                        </ul>
                        </p>

                        <div class="form-group">
                            <div class="row d-flex justify-content-center"> 
                                    <a href="{{route('formularioAutoEvaluacion')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
