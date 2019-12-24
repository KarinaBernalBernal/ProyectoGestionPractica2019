<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Alumno;
use SGPP\User;

class AlumnoController extends Controller
{

    //vista principal de un elemento en especifico
    public function lista(Request $request)
    {
        $lista= Alumno::filtrarYPaginar($request->get('buscador'),
                                        $request->get('nombre'), 
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('email'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera')
                                    );
        return view('Mantenedores.Alumnos.lista_alumnos')->with("lista", $lista);
    }

    public function crear()
    {
        return view('Mantenedores/Alumnos/crear_alumno');
    }

    public function editar($id_elemento)
    {
        $elemento= Alumno::find($id_elemento);
        return view('Mantenedores/Alumnos/editar_alumno',[
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
        $nuevo->semestre_proyecto = $data['semestreProyecto'];
        $nuevo->anno_proyecto = $data['annoProyecto'];

        $nueva_instancia = new User;
        $nueva_instancia->name = $nuevo->nombre;
        $nueva_instancia->email = $nuevo->email;
        $nueva_instancia->password = bcrypt($data['rut']);
        $nueva_instancia->type = 'alumno';

        $nueva_instancia->save();

		$nuevo->id_user = $nueva_instancia->id_user;


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
            $elemento_editar->semestre_proyecto=$request->semestreProyecto;
            $elemento_editar->anno_proyecto=$request->annoProyecto;

            $user_editar=User::find($elemento_editar->id_user);
            if(isset($user_editar))
            {
                $user_editar->name=$request->nombre;
                $user_editar->email=$request->email;
                $user_editar->type=$user_editar->type;
            }
			$elemento_editar->id_user=$user_editar->id_user;
            $elemento_editar->save();

            $user_editar->save();

            return redirect()->route('lista_alumnos');
        }
    }
    public function borrarAlumno($id_elemento){
        $elemento_eliminar =  Alumno::find($id_elemento);
        $usuario_eliminar = User::find($elemento_eliminar->id_user);
        $usuario_eliminar->delete();
        return redirect()->route('lista_alumnos');
    }
}
