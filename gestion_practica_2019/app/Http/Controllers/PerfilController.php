<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Perfil;

class PerfilController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Perfil::all();
        return view('lista_perfiles',[
                'lista'=>$lista,
            ]);
    }
    public function borrarPerfil($id_elemento){
        $elemento_eliminar =  Perfil::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_perfiles');

    }

}