<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Administrador;
use SGPP\User;

class AdministradorController extends Controller
{

    public function lista()
    {
        $administradores = Administrador::all();
        return view('Mantenedores.Administradores.lista_administradores')->with("administradores", $administradores);
    }

    public function crear()
    {
        return view('Mantenedores/Administradores/crear_administrador');
    }

    public function editar($id_elemento)
    {
        $elemento= Administrador::find($id_elemento);
        return view('Mantenedores/Administradores/editar_administrador',[
            'elemento'=>$elemento,
        ]);
    }

    public function crearAdministrador (Request $request)
    {
        $data = $request->all();

        $nuevo = new Administrador;

        $nuevo->nombre = $data['nombre'];
        $nuevo->apellido_paterno = $data['apellido_paterno'];
        $nuevo->apellido_materno = $data['apellido_materno'];
        $nuevo->rut = $data['rut'];
        $nuevo->email = $data['email'];
        $nuevo->cargo = $data['cargo'];

        $nueva_instancia = new User;
        $nueva_instancia->name = $nuevo->nombre;
        $nueva_instancia->email = $nuevo->email;
        $nueva_instancia->password = bcrypt($data['rut']);
        $nueva_instancia->type = 'administrador';

        $nueva_instancia->save();

        $nuevo->id_user = $nueva_instancia->id_user;

        $nuevo->save();

        return redirect()->route('lista_administradores');
    }

    public function editarAdministrador(Request $request, $id_elemento)
    {
        $elemento_editar=Administrador::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->nombre=$request->nombre;
            $elemento_editar->apellido_paterno=$request->apellido_paterno;
            $elemento_editar->apellido_materno=$request->apellido_materno;
            $elemento_editar->rut=$request->rut;
            $elemento_editar->email=$request->email;
            $elemento_editar->cargo=$request->cargo;

            $user_editar=User::find($elemento_editar->id_user);
            if(isset($user_editar))
            {
                $user_editar->name=$request->nombre;
                $user_editar->email=$request->email;
            }
            $elemento_editar->id_user=$user_editar->id_user;
            $elemento_editar->save();

            $user_editar->save();

            return redirect()->route('lista_administradores');
        }
    }
    public function borrarAdministrador($id_elemento)
    {
        $elemento_eliminar =  Administrador::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_administradores');
    }
}
