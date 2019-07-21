@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Solicitud permiso de práctica profesional</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el primer paso que debes realizar para seguir con el proceso de la práctica profesional.
                            </li>
                            <li>
                                Esta es la única instancia en la que no necesitas de una cuenta registrada en la página para continuar, esta se creará con los datos que ingreses en el formulario de "solicitud de practica".
                            </li>
                            <li>
                                Es de suma importancia que revises si los datos ingresados más adelante son correctos.
                            </li>
                            <li>
                                Cuando termines con la solicitud, en Docencia, se procesarán los datos ingresados junto a tus antecedentes y se decidirá si eres apto para realizar la práctica. En el caso que la solicitud sea aprobada, podrás continuar con la inscripción de la práctica y la solicitud del seguro escolar junto con la carta de presentación.
                            </li>
                            <li>
                                La decisión de Docencia será informada mediante un correo electrónico enviado a las personas que llenaron el formulario o puedes preguntar directamente a los encargados.
                            </li>
                        </ul>
                        </p>

                        <br>

                        <div class="form-group">
                            <div class="row d-flex justify-content-center"> 
                                <a href="{{route('formularioSolicitud')}}" class="btn btn-secondary"> <span>Acceder al formulario</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
