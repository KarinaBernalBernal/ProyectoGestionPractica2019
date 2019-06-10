<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use SGPP\User;

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
	public function registrar()
    {

		return view('register');

    }
    //vista para crear un usuario
    public function crear_usuario(Request $request)
    {

        $nuevo = new User();
        $nuevo->name= $request->name;
        $nuevo->email = $request->email;
        $nuevo->password = bcrypt($request->password);

        $nuevo->save();
    }
}