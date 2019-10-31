<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Supervisor;
use SGPP\User;
use SGPP\Empresa;


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


}
