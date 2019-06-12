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
        return view('lista_usuarios',[
                'lista'=>$lista,
            ]);
    }
    public function editar($id_elemento)
    {
        $elemento= User::find($id_elemento);
        return view('editar_usuario',[
                'elemento'=>$elemento,
        	]);

    }
    public function editarUsuario(Request $request)
    {
        $elemento_editar=User::find($request->id);
        if(isset($elemento_editar))
        {
            $elemento_editar->name=$request->name;
            $elemento_editar->email=$request->email;
            $elemento_editar->type=$request->type;
            $elemento_editar->save();
        }
        return redirect()->route('lista_usuarios');

    }

}