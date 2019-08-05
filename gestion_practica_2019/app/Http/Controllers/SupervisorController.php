<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Supervisor;

class SupervisorController extends Controller
{

    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Supervisor::all();
        return view('lista_supervisores',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('crear_supervisor');
    }

    public function editar($id_elemento)
    {
        $elemento= Supervisor::find($id_elemento);
        return view('editar_supervisor',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearSupervisor (Request $request)
    {
        $data = $request->all();
        $nuevo = new Supervisor;
        $nuevo->nombre = $data['nombre'];
        $nuevo->apellido_paterno = $data['apellido_paterno'];
        $nuevo->apellido_materno = $data['apellido_materno'];
        $nuevo->cargo = $data['cargo'];
        $nuevo->departamento = $data['departamento'];
        $nuevo->email = $data['email'];
        $nuevo->fono = $data['fono'];
        $nuevo->id_user = $data['id_user'];
        $nuevo->id_empresa = $data['id_empresa'];

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
            $elemento_editar->apellido_materno=$request->apellido_materno;
            $elemento_editar->cargo=$request->cargo;
            $elemento_editar->departamento=$request->departamento;
            $elemento_editar->email=$request->email;
            $elemento_editar->fono=$request->fono;
            $elemento_editar->id_user=$request->id_user;
            $elemento_editar->id_empresa=$request->id_empresa;

            $elemento_editar->save();

            return redirect()->route('lista_supervisores');
        }
    }
    public function borrarSupervisor($id_elemento){
        $elemento_eliminar =  Empresa::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_supervisores');
    }


}
