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
    public function crear()
    {
        return view('crear_perfil');
    }

    public function editar($id_elemento)
    {
        $elemento= Perfil::find($id_elemento);
        return view('editar_perfil',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearPerfil (Request $request)
    {
        $data = $request->all();

        $nuevo = new Perfil;
        $nuevo->n_perfil = $data['n_perfil'];
        // tengo problemas para realizar migraciones asi eliminar este campo y crear la tabla de la instancia
        $nuevo->id_user = 1;

        $nuevo->save();

        return redirect()->route('lista_perfiles');
    }

    public function editarPerfil(Request $request, $id_elemento)
    {
        $elemento_editar=Perfil::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->n_perfil=$request->n_perfil;
            $elemento_editar->save();

            return redirect()->route('lista_perfiles');
        }
    }
    public function borrarPerfil($id_elemento){
        $elemento_eliminar =  Perfil::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_perfiles');
    }

}