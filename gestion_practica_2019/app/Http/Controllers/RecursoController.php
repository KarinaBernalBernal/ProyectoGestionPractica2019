<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Recurso;
use SGPP\Perfil;

class RecursoController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Recurso::all();
        return view('lista_recursos',[
                'lista'=>$lista,
            ]);
    }
     public function crear()
    {
        $perfiles= Perfil::all()->pluck('id_perfil','n_perfil');
        return view('crear_recurso')->with('perfiles', $perfiles);
    }

    public function editar($id_elemento)
    {
        $elemento= Recurso::find($id_elemento);
        return view('editar_recurso',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearRecurso (Request $request)
    {
        $data = $request->all();

        $nuevo = new Recurso;
        $nuevo->n_recurso = $data['n_recurso'];
        $nuevo->url = $data['url'];
        $perfil = $data['perfil'];
        $nuevo->save();
        $nueva_instancia = new PerfilRecurso;
        $nueva_instancia->id_perfil;
        $nueva_instancia->id_recurso;
        $nueva_instancia->save();

        return redirect()->route('lista_recursos');
    }

    public function editarRecurso(Request $request, $id_elemento)
    {
        $elemento_editar=Recurso::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->n_recurso=$request->n_recurso;
            $elemento_editar->url=$request->url;
            $elemento_editar->url=$request->url;


            $elemento_editar->save();

            return redirect()->route('lista_recursos');
        }
    }
    public function borrarRecurso($id_elemento){
        $elemento_eliminar =  Recurso::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_recursos');
    }

}