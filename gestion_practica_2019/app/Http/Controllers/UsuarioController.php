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
        return view('home');
        return view('lista_usuarios',[
                'lista'=>$lista,
            ]);
    }
}