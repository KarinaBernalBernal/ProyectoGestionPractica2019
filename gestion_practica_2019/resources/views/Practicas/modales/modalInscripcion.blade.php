<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div>
                <h1 class="h3 mb-0 text-gray-1000">INSCRIPCION PRÁCTICA</h1>
            </div>
            <button type="button" class="close text-danger" data-dismiss="modal">
                <span> <i class="fas fa-times"></i></span>
            </button>
        </div>

        <div class="card-body">

            {{-- Documentos solicitados --}}

            <div class="card text">
                <div class="card-body">

                    <h4 class="text-center">Periodo de práctica</h4>
                    {{--Fechas--}}
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label><b>{{ __('Desde') }} :</b> {{date('d-m-y', strtotime($practicas->f_desde))}}</label>
                        </div>
                        <div class="col-md-4">
                            <label><b>{{ __('Hasta') }} :</b> {{date('d-m-y', strtotime($practicas->f_hasta))}}</label>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            {{-- Datos de la empresa --}}
            <div class="card text">
                <div class="card-body">
                    <h4 class="text-center">Datos de la Empresa</h4>

                    <hr>

                    {{-- Nombre Empresa --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Nombre Empresa') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->n_empresa}}</label>
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
                            <label class="col-form-label text-md-right">{{$empresas->rut}}</label>
                        </div>
                    </div>

                    {{-- Ciudad --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Ciudad') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->ciudad}}</label>
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
                            <label class="col-form-label text-md-right">{{$empresas->direccion}}</label>
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
                            <label class="col-form-label text-md-right">{{$empresas->fono}}</label>
                        </div>
                    </div>

                    {{-- Casilla --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Casilla') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->casilla}}</label>
                        </div>
                    </div>

                    {{-- Correo Electronico Empresa--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >Email empresa</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$empresas->email}}</label>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="card text">
                <div class="card-body">
                    <h4 class="text-center">Datos del Supervisor</h4>

                    <hr>

                    {{-- Nombre Supervisor--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Nombre') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->nombre}}</label>
                        </div>
                    </div>

                    {{-- Apellido Paterno --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Apellido Paterno') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->apellido_paterno}}</label>
                        </div>
                    </div>

                    {{-- Cargo --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Cargo') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->cargo}}</label>
                        </div>
                    </div>

                    {{-- Departamento --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >{{ __('Departamento') }}</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->departamento}}</label>
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
                            <label class="col-form-label text-md-right">{{$supervisores->fono}}</label>
                        </div>
                    </div>

                    {{-- Correo Electronico Supervisor--}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <b class="col-form-label text-md-right" >Email supervisor</b>
                        </div>
                        <div class="col-md-1">
                            <label class="col-form-label text-md-right" >:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="col-form-label text-md-right">{{$supervisores->email}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>