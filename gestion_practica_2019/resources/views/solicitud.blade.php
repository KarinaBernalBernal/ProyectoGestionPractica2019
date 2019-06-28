@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Solicitud permiso de practica profesional</h4>
                    <div class="card-body">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el primer paso que debes realizar para seguir con el proceso de la practica profesional.
                            </li>
                            <li>
                                Esta es la unica instancia en la que no necesitas de una cuenta registrada en la pagina para continuar, esta se creará con los datos que ingreses en el formulario de "solicitud de practica".
                            </li>
                            <li>
                                Es de suma importancia que revises si los datos ingresados mas adelante son correctos.
                            </li>
                            <li>
                                Cuando termines con la solicitud, en Docencia, se procesarán los datos ingresados junto a tus antecedentes y se decidirá si eres apto para realizar la practica. En el caso que la solicitud sea aprobada, podras continuar con la inscripcion de la practica y la solicitud del seguro escolar junto con la carta de presentación.
                            </li>
                            <li>
                                La decisión de Dosencia será informada mediante un correo electronico enviado a las personas que llenaron el formulario o puedes preguntar directamente a los encargados.
                            </li>
                        </ul>
                        </p>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" href="#">
                                       Acceder al formulario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
