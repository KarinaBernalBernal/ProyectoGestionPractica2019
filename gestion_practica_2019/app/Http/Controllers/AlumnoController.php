<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Alumno;

class AlumnoController extends Controller
{

    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Alumno::all();
        return view('lista_alumnos',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('crear_alumno');
    }

    public function editar($id_elemento)
    {
        $elemento= Alumno::find($id_elemento);
        return view('editar_alumno',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearAlumno (Request $request)
    {
        $data = $request->all();

        $nuevo = new Alumno;

        $nuevo->nombre = $data['nombre'];
		$nuevo->apellido_paterno = $data['apellido_paterno'];
        $nuevo->apellido_materno = $data['apellido_materno'];
        $nuevo->rut = $data['rut'];
		$nuevo->email = $data['email'];
        $nuevo->direccion = $data['direccion'];
        $nuevo->fono = $data['fono'];
		$nuevo->anno_ingreso = $data['anno_ingreso'];
        $nuevo->carrera = $data['carrera'];
        $nuevo->estimacion_semestre = $data['estimacion_semestre'];
		$nuevo->id_user = $data['id_user'];


        $nuevo->save();

        return redirect()->route('lista_alumnos');
    }

    public function editarAlumno(Request $request, $id_elemento)
    {
        $elemento_editar=Alumno::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->nombre=$request->nombre;
			$elemento_editar->apellido_paterno=$request->apellido_paterno;
            $elemento_editar->apellido_materno=$request->apellido_materno;
            $elemento_editar->rut=$request->rut;
			$elemento_editar->email=$request->email;
            $elemento_editar->direccion=$request->direccion;
            $elemento_editar->fono=$request->fono;
			$elemento_editar->anno_ingreso=$request->anno_ingreso;
            $elemento_editar->carrera=$request->carrera;
            $elemento_editar->estimacion_semestre=$request->estimacion_semestre;
			$elemento_editar->id_user=$request->id_user;

            $elemento_editar->save();

            return redirect()->route('lista_alumnos');
        }
    }
    public function borrarAlumno($id_elemento){
        $elemento_eliminar =  Alumno::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_alumnos');
    }

}
