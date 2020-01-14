@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Solicitud de seguro escolar y/o carta de presentación</h4>
                    <div class="card-body" style="text-align: justify;">
                        <h5><strong>Carta de presentación</strong> </h5>
                        <p>
                            <ul>
                                <li>
                                    Solicitar la carta de presentación es el segundo paso(opcional) con el cual se emitirá una carta de carácter formal que apoye tus antecedentes.
                                </li>
                                <li>
                                    Puedes pedir tantas cartas de presentación como a empresas postules.
                                <li>
                                    Con esta carta, la Escuela indica que el alumno realmente pertenece a esta unidad académica y requiere realizar su práctica. Depende de la empresa si este documento es obligatorio o no
                                </li>
                            </ul>
                        </p>
                        <h5><strong>Seguro escolar</strong> </h5>
                        <p>
                            <ul>
                                <li>
                                    El seguro escolar es de carácter OBLIGATORIO para poder realizar la práctica ya que, en caso de ocurra algún accidente, este documento cubrirá los gastos médicos.</li>
                                <li>
                                    En la solicitud, se tendrá que indicar cuál es la empresa u organismo que recibirá al practicante, junto con la fecha de inicio y término, para así determinar el período de cobertura.
                                </li>
                                <li>
                                    La solicitud del seguro escolar debe gestionarse en conjunto con la inscripción de la práctica.
                                </li>
                            </ul>
                        </p>
                        <div class="form-group">
                            <div class="row d-flex justify-content-center"> 
                                <a href="{{route('formularioSolicitarDocumentos')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
