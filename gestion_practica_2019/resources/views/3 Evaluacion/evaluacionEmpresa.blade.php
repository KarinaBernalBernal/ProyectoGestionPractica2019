@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Evaluación de la empresa sobre el desempeño del estudiante en práctica</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                En esta instancia se debe de evaluar al estudiante en práctica.
                            </li>
                            <li>
                                El resultado de esta evaluación afectará la decisión final sobre la aprobación o reprobación del estudiante.
                            </li>
                            <li>
                                Se ruega completar el formulario con responsabilidad y sinceridad.
                            </li>
                        </ul>
                        </p>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{route('formularioEvaluacionEmpresa')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
