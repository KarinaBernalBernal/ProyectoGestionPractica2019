<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Supervisor;
use SGPP\User;
use SGPP\Empresa;
use SGPP\Alumno;
use SGPP\Practica;

class SupervisorController extends Controller
{

    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Supervisor::all();
        return view('Mantenedores/Supervisores/lista_supervisores',[
                'lista'=>$lista,
            ]);
    }

    public function supervisoresEnPractica(Request $request) //Supervisores de alumnos de ejecucion en practica
    {
        //$supervisores = Supervisor::nombre($request->get('nombre'));
        //dd($request->get('nombre'));
        //dd(Supervisor::all());
        /*
        $alumnosInformatica = Alumno::all()->where('carrera', 'Ingeniería de Ejecución Informática');
        $practicas = Practica::all();
        $supervisores = Supervisor::all();

        if($practicas->isNotEmpty()) //el recorrido no se hace si no hay nada que recorrer
        {
            for($i = 0; $i<count($alumnosInformatica,1); $i++)
            {
                $practicas[$i] = Practica::all()->where('id_alumno', $alumnosInformatica[$i]->id_alumno)->first(); // Clave foranea, variable alumnosInformatica
            }
        }

        if($supervisores->isNotEmpty())
        {
            for($i = 0; $i<count($practicas,1); $i++)
            {
                $supervisores[$i] = Supervisor::all()->where('id_supervisor', $practicas[$i]->id_supervisor)->first(); // Clave foranea, variable alumnosInformatica
            }
        }

       /*
        if(trim($request) != "")
        {
            $supervisores = Supervisor:: nombre($request->get('nombre'));
            //nombre($request->get('nombre'));
        }
        */

        return view('Practicas/Ejecucion/supervisores_en_practica')->with('supervisores',$supervisores);
         //return view('admin.users.index', compact('users'));
    }

    public function crear()
    {
        $empresas= Empresa::all();

        return view('Mantenedores/Supervisores/crear_supervisor')->with('empresas', $empresas);
    }

    public function editar($id_elemento)
    {
        $elemento= Supervisor::find($id_elemento);
        $empresas= Empresa::all();

        return view('Mantenedores/Supervisores/editar_supervisor',[
                'elemento'=>$elemento,
                'empresas' => $empresas,
            ]);
    }

    public function crearSupervisor (Request $request)
    {
        $data = $request->all();
        $nuevo = new Supervisor;
        $nuevo->nombre = $data['nombre'];
        $nuevo->apellido_paterno = $data['apellido_paterno'];
        //Verificar @Pablo y @Luis
        //$nuevo->apellido_materno = $data['apellido_materno'];
        $nuevo->cargo = $data['cargo'];
        $nuevo->departamento = $data['departamento'];
        $nuevo->email = $data['email'];
        $nuevo->fono = $data['fono'];
        $empresa = $data['id_empresa'];

        $nuevo->id_empresa = $empresa;

        $nueva_instancia = new User;
        $nueva_instancia->name = $nuevo->nombre;
        $nueva_instancia->email = $nuevo->email;
        $nueva_instancia->password = bcrypt($data['nombre']);
        $nueva_instancia->type = 'supervisor';
        $nueva_instancia->save();

        $nuevo->id_user = $nueva_instancia->id_user;

        $nuevo->save();

        return redirect()->route('lista_supervisores');
    }

    public function editarSupervisor(Request $request, $id_elemento)
    {
        $elemento_editar=Supervisor::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->nombre=$request->nombre;
            $elemento_editar->apellido_paterno=$request->apellido_paterno;
            //Verificar @Pablo y @Luis
            //$elemento_editar->apellido_materno=$request->apellido_materno;
            $elemento_editar->cargo=$request->cargo;
            $elemento_editar->departamento=$request->departamento;
            $elemento_editar->email=$request->email;
            $elemento_editar->fono=$request->fono;
            $elemento_editar->id_empresa=$request->id_empresa;

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
            return redirect()->route('lista_supervisores');
        }
    }
    public function borrarSupervisor($id_elemento){
        $elemento_eliminar =  Empresa::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_supervisores');
    }

    public function probando()
    {
        return view('Practicas/Ejecucion/supervisores_en_practica');
    }
}
