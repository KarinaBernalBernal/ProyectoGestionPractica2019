@extends('layouts.mainlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-offset">
                <div class="card">
                    <h4 class="card-header">Solicitud permiso de práctica profesional</h4>
                    <div class="card-body" style="text-align: justify;">
                        <h5><strong>Debes saber que...</strong> </h5>
                        <p>
                        <ul>
                            <li>
                                Este es el primer paso que debes realizar para continuar con el proceso de la práctica profesional.
                            </li>
                            <li>
                                Esta es la única instancia en la que no necesitas de una cuenta registrada en la página para continuar, esta se creará con los datos que ingreses en el formulario de "solicitud de practica".
                            </li>
                            <li>
                                Para poder acceder al formulario, es necesario que ingreses tu correo de alumno(institución), el cual, termina con @mail.pucv.cl. Este correo se puede encontrar en tu navegador académico.
                            </li>
                            <li>
                                Es de suma importancia que revises si los datos ingresados más adelante son correctos.
                            </li>
                            <li>
                                Cuando termines con la solicitud, en Docencia, se procesarán los datos ingresados junto a tus antecedentes y se decidirá si eres apto para realizar la práctica. En el caso que la solicitud sea aprobada, podrás continuar con la inscripción de la práctica y la solicitud del seguro escolar junto con la carta de presentación.
                            </li>
                            <li>
                                En el caso de que tu solicitud quede evaluada como "pendiente", podrás entrar al sistema, pero no tendrás la capacidad de inscribir ninguna práctica hasta que tu solicitud sea finalmente aprobada.
                            </li>
                            <li>
                                La decisión de Docencia será informada mediante un correo electrónico enviado a las personas que llenaron el formulario o puedes preguntar directamente a los encargados.
                            </li>
                        </ul>
                        </p>

                        <br>

                        <div class="form-group" id="formulario">
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-secondary" id="envioCorreo">Acceder al formulario</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#envioCorreo').click(function() {

            (async () => {

                const pattern = /@mail.pucv.cl/;

                const { value: email } = await Swal.fire({
                    title: 'Ingrese su email de alumno',
                    input: 'email',
                    html:
                        'Se debe ingresar un correo con la siguiente estructura: <b>ejemplo@mail.pucv.cl</b>',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    validationMessage: 'Dirección de correo electrónico no válida',
                    allowOutsideClick: false,
                    inputValidator: (email) => {
                        return new Promise((resolve) => {
                            if (email.match(pattern)) {
                                resolve()
                            } else {
                                resolve('No se ingresó un correo válido y/o perteneciente a la institución!')
                            }
                        })
                    }
                }).then((email) => {

                    if (email.value) {

                        window.swal({
                            title: "enviando...",
                            text: "Por favor espere",
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        $.ajax({
                            url: '{{route('contact')}}',
                            method: "GET",
                            data: { emailSolicitud : email.value },
                            success: function(){
                                Swal(
                                    'Listo!',
                                    'Se te ha enviado un email.',
                                    'success'
                                )
                            },
                            error:function() {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Opps...!',
                                    text: 'No se pudo enviar el correo electrónico',
                                });
                            }
                        });
                    }
                });
            })()
        })
    </script>
@endsection


