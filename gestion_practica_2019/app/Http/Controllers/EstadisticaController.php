<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
//use SGPP\Alumno;
//use SGPP\User;

class EstadisticaController extends Controller
{
    public function verEstadisticaCriterios(){
        return view('Estadisticas/estadisticaCriterios');
    }
    public function buscarAlumno(Request $request){
        //return view('Estadisticas/........');
    }
}
