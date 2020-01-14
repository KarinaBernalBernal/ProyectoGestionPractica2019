@extends('layouts.mainlayout')

@section('content')
        <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h3>Modificar Charla</h3></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('actualizar_charla',[$elemento->id_charla])}}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('sala') ? ' has-error' : '' }}">
                                <label for="sala" class="col-md-4 control-label">Sala</label>
                                <div class="col-md-6">
                                    <input id="sala" type="text" class="form-control" name="sala" value="{{ old('sala', $elemento->sala) }}" required autofocus>
                                    @if ($errors->has('sala'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sala') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('clave') ? ' has-error' : '' }}">
                                <label for="clave" class="col-md-4 control-label">Clave</label>
                                <div class="col-md-6">
                                    <select name="clave" id="clave" class="form-control">
                                        <option value="" disabled >Elige una opcion...</option>
                                        <option value="1-2" @if(old("clave", $elemento->clave) == '1-2') {{'selected'}} @endif>1-2</option>
                                        <option value="3-4" @if(old("clave",$elemento->clave) == '3-4') {{'selected'}} @endif>3-4</option>
                                        <option value="5-6" @if(old("clave", $elemento->clave) == '5-6') {{'selected'}} @endif>5-6</option>
                                        <option value="7-8" @if(old("clave", $elemento->clave) == '7-8') {{'selected'}} @endif>7-8</option>
                                        <option value="9-10" @if(old("clave", $elemento->clave) == '9-10') {{'selected'}} @endif>9-10</option>
                                        <option value="11-12" @if(old("clave", $elemento->clave) == '11-12') {{'selected'}} @endif>11-12</option>
                                        <option value="13-14" @if(old("clave", $elemento->clave) == '13-14') {{'selected'}} @endif>13-14</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('f_charla') ? ' has-error' : '' }}">
                                <label for="f_charla" class="col-md-4 control-label">Fecha Charla</label>
                                <div class="col-md-6">
                                    <input id="f_charla" type="date" class="form-control" name="f_charla" value="{{ old('f_charla', $elemento->f_charla) }}" required autofocus>
                                    @if ($errors->has('f_charla'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('f_charla') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                    <a href="{{route('lista_charlas')}}"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-header"><h3>Alumnos invitados</h3></div>
                            <div class="card-body">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                                <div class="container-fluid">
                                    <div class="justify-content-center">
                                        <div class="text-center">
                                        {{ csrf_field() }}
                                        @if (count($alumnos)>0)
                                            <!-- DATA TABLES -->
                                                <div class="row d-flex justify-content-center container-fluid">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered " id="MyTable">
                                                            <thead class="bg-dark" style="color: white">
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Rut</th>
                                                                <th>Opción</th>
                                                            </tr >
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($alumnos as $alumno)
                                                                <tr id="{{$alumno->id_alumno}}">
                                                                    <td>
                                                                        {{$alumno->nombre}}
                                                                        {{$alumno->apellido_paterno}}
                                                                    </td>
                                                                    <td>{{$alumno->rut}}</td>
                                                                    <td class="text-truncate text-center">
                                                                        <a href="#"><button id="{{$alumno->id_practica}}" class="btn btn-danger" onclick="borrar('{{$alumno->id_practica}}', '{{$alumno->nombre}}', '{{route('borrar_participante',[$alumno->id_practica])}}')">
                                                                                <span class="fas fa-trash-alt" aria-hidden="true"></span>
                                                                            </button></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                                <p>No existen alumnos en esta charla!</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script>
            function borrar(id_elemento,name , url_action)
            {
                Swal({
                    title: 'Estas seguro de querer eliminar al alumno '+name+' de esta charla?',
                    text: "Si te arrepientes deberás invitarlo de nuevo",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminalo!'
                }).then((result) => {

                    if (result.value) {

                        parametros={
                            'id_elemento': id_elemento,
                            "_token": $('#token').val()
                        }

                        $.ajax({
                            url: url_action,
                            method: "POST",
                            data: parametros,
                            success: function(response){
                                Swal(
                                    'Eliminado!',
                                    'El alumno ha sido eliminado de la charla.',
                                    'success'
                                )
                                $('#'+id_elemento).remove();
                            }
                        });
                    }
                })
            }
        </script>
@endsection