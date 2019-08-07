<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class UsuarioController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista=User::all();
        return view('Mantenedores/Usuarios/lista_usuarios',[
                'lista'=>$lista,
            ]);
    }

    public function editar($id_elemento)
    {
        // dd($id_elemento);

        $elemento= User::find($id_elemento);
        return view('Mantenedores/Usuarios/editar_usuario',[
                'elemento'=>$elemento,
        	]);

    }

    public function editarUsuario(Request $request, $id_elemento)
    {
        $elemento_editar=User::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->name=$request->name;
            $elemento_editar->email=$request->email;
            $elemento_editar->email=$request->perfil;

            $elemento_editar->save();


            return redirect()->route('lista_usuarios');
        }
    }

    public function borrarUsuario($id_elemento){
            $elemento_eliminar =  User::find($id_elemento);
            $elemento_eliminar->delete();
            return redirect()->route('lista_usuarios');

    }


    // public function get_permissions(Request $request){
    //     $user = $request->$user->id;
    //     $profile = None;
    //     if (isset($user->$profile))
    //     {
    //         $profile = $user->$profile;
    //         $permissions = Recurso::all()->where('profile', 'profile');
    //     }
    //     return view('get_permissions')->with('permissions', $permissions);
    // }


}