<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div>
                <h1 class="h3 mb-0 text-gray-1000">SOLICITUD PRÁCTICA</h1>
            </div>
            <button type="button" class="close text-danger" data-dismiss="modal">
                <span> <i class="fas fa-times"></i></span>
            </button>
        </div>

        <div class="card-body">

            {{-- Datos de la empresa --}}

            <div class="card text">
                <div class="card-body">
                    <h4 class="text-center">Antecedentes generales</h4>

                    <hr>

                    {{-- Nombre del alumno --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Nombre') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->nombre}}</label>
                        </div>
                    </div>

                    {{-- Apellido paterno --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Apellido Paterno') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->apellido_paterno}}</label>
                        </div>
                    </div>

                    {{-- Apellido materno --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Apellido Materno') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->apellido_materno}}</label>
                        </div>
                    </div>

                    {{-- RUT --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('RUT') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->rut}}</label>
                        </div>
                    </div>

                    {{-- Correo Electronico--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >Email</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->email}}</label>
                        </div>
                    </div>

                    {{-- Direccion --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Dirección') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->direccion}}</label>
                        </div>
                    </div>

                    {{-- Fono --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Fono') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->fono}}</label>
                        </div>
                    </div>

                    {{-- Año de ingreso --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Año de Ingreso') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->anno_ingreso}}</label>
                        </div>
                    </div>

                    {{-- Carrera --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Carrera') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->carrera}}</label>
                        </div>
                    </div>

                    <hr>
                    <h5 class="text-center">Semestre / Año Proyecto de Titulo</h5>

                    {{-- Semestre --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Semestre') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->semestre_proyecto}}</label>
                        </div>
                    </div>

                    {{-- Año --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Año') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$solicitudes->anno_proyecto}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>