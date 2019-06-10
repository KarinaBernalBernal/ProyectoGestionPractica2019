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
}