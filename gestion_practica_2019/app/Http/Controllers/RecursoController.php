<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Recurso;
use SGPP\Perfil;
use SGPP\PerfilRecurso;

class RecursoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Recurso::all();
        return view('Mantenedores/Recursos/lista_recursos',[
                'lista'=>$lista,
            ]);
    }
     public function crear()
    {
        $perfiles= Perfil::all();
        return view('Mantenedores/Recursos/crear_recurso')->with('perfiles', $perfiles);
    }

    public function editar($id_elemento)
    {
        $elemento= Recurso::find($id_elemento);
        $perfiles= Perfil::all();

        return view('Mantenedores/Recursos/editar_recurso',[
                'elemento'=>$elemento,
                'perfiles' => $perfiles,

            ]);
    }

    public function crearRecurso (Request $request)
    {
        $data = $request->all();
        $nuevo = new Recurso;
        $nuevo->n_recurso = $data['n_recurso'];
        $nuevo->url = $data['url'];
        $nuevo->modulo = $data['modulo'];


        $perfil = $data['perfil'];
        $nuevo->save();

        $nueva_instancia = new PerfilRecurso;
        $nueva_instancia->id_perfil = $perfil;
        $nueva_instancia->id_recurso = $nuevo->id_recurso;
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
            $elemento_editar->modulo = $request->modulo;

            $perfil = $request->perfil;
            $elemento_editar->save();

            $nueva_instancia = new PerfilRecurso;
            $nueva_instancia->id_perfil = $perfil;
            $nueva_instancia->id_recurso = $elemento_editar->id_recurso;
            $nueva_instancia->save();



            return redirect()->route('lista_recursos');
        }
    }
    public function borrarRecurso($id_elemento){
        $elemento_eliminar =  Recurso::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_recursos');
    }

}