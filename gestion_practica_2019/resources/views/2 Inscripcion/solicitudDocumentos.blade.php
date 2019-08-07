@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Solicitud de seguro escolar y/o carta de presentación</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el segundo paso que debes realizar para continuar con el proceso de la práctica profesional.
                            </li>
                            <li>
                                El seguro escolar es de carácter OBLIGATORIO para poder realizar la práctica ya que, en caso de ocurra algún accidente, este documento cubrirá los gastos médicos.</li>
                            <li>
                                En la solicitud, se tendrá que indicar cuál es la empresa u organismo que recibirá al practicante, junto con la fecha de inicio y término, para así determinar el período de cobertura.
                            </li>
                            <li>
                                El alumno podrá solicitar una “Carta Presentación” llenando la casilla correspondiente en el formulario de "solicitud carta presentación y/o seguro escolar" mediante la cual la Escuela indica que el alumno realmente pertenece a esta unidad académica y requiere realizar su práctica. Depende de la empresa si este documento es obligatorio o no.
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
