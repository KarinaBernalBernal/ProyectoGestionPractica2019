<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Alumno;
use SGPP\User;

class EstadisticaController extends Controller
{
    public function verEstadisticaCriterios(){
        return view('Estadisticas/estadisticaCriterios');
    }
    
    public function buscarAlumno(Request $request){
        $lista= Alumno::filtrarYPaginar($request->get('buscador'),
                                        $request->get('nombre'), 
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('email'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera')
                                    );
        return view('Estadisticas/AlumnosDetalles')->with("lista", $lista);
    }
}
