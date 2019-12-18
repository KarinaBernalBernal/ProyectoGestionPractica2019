<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Alumno;
use SGPP\User;

class AlumnosReporteController extends Controller
{
    //Vista principal
    public function index(Request $request)
        {

        $lista= Alumno::filtrarYPaginar($request->get('buscador'),
                                        $request->get('nombre'), 
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('email'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera'));
        return view('Reportes.alumnos')->with("lista", $lista);
    }
}
