@extends('layouts.mainlayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md col-md-offset-2">
                <div class="card">
                    <div class="card-header"><h4>Nueva Charla</h4></div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('agregar_charla')}}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('sala') ? ' has-error' : '' }}">
                                    <label for="sala" class="col-md-4 control-label">Sala</label>
                                    <div class="col-md-6">
                                        <input id="sala" type="text" class="form-control" name="sala" required autofocus maxlength="10">
                                        <label for="sala" class="font-italic">Ej. IBC 2-1</label>
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
                                        <select name="clave" id="clave" class="form-control" required autofocus>
                                            <option>1-2</option>
                                            <option>3-4</option>
                                            <option>5-6</option>
                                            <option>7-8</option>
                                            <option>9-10</option>
                                            <option>11-12</option>
                                            <option>13-14</option>
                                        </select>
                                        @if ($errors->has('clave'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('clave') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group{{ $errors->has('f_charla') ? ' has-error' : '' }}">
                                    <label for="f_charla" class="col-md-4 control-label">Fecha Charla</label>
                                    <div class="col-md-6">
                                        <input id="f_charla" type="date" class="form-control" name="f_charla" required autofocus>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
               <br>
               <div class="card">
                   <div class="card-header"><h4>Estudiantes Invitados</h4></div>
                   <div class="card-body">
                       <form class="form-horizontal" action="{{route('crear_charla',[$carrera])}}" method="get" id="filtro">
                           <div class="row">
                               <div class="col-3 mb-2">
                                   <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre">
                               </div>
                               <div class="col-3 mb-2">
                                   <input id="apellido_paterno" type="text" class="form-control" name="apellido_paterno" placeholder="Apellido">
                               </div>
                               <div class="col-3 mb-2">
                                   <input id="rut" type="text" class="form-control" name="rut" placeholder="Rut">
                               </div>
                               <div class="col-1">
                                   <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                               </div>
                           </div>
                       </form>
                       <div class="container-fluid">
                           <div class="justify-content-center">
                               <div class="text-center">
                               @if (count($alumno)>0)
                                   <!-- DATA TABLES -->
                                       <div class="row d-flex justify-content-center container-fluid">
                                           <div class="table-responsive">
                                               <table class="table table-bordered " id="MyTable">
                                                   <thead class="bg-dark" style="color: white">
                                                   <tr>
                                                       <th>Nombre</th>
                                                       <th>Rut</th>
                                                   </tr >
                                                   </thead>
                                                   <tbody>
                                                   @foreach ($alumno as $alumnos)
                                                       <tr id="{{$alumnos->id_alumno}}">
                                                           <td>
                                                               {{$alumnos->nombre}}
                                                               {{$alumnos->apellido_paterno}}
                                                           </td>
                                                           <td>{{$alumnos->rut}}</td>
                                                       </tr>
                                                   @endforeach
                                                   </tbody>
                                               </table>
                                           </div>
                                       </div>
                                   @else
                                       <p>No existen alumnos en este momento</p>
                                   @endif
                               </div>
                           </div>
                       </div>
                       <br>
                   </div>
                   --}}
@endsection