<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\Autoevalucion;

class AutoEvaluacionController extends Controller
{
     //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= Autoevalucion::all();
        return view('lista_auto_evaluaciones',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('crear_auto_evaluacion');
    }

    public function editar($id_elemento)
    {
        $elemento= Autoevalucion::find($id_elemento);
        return view('editar_auto_evaluacion',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearAutoEvalucion (Request $request)
    {
        $data = $request->all();

        $nuevo = new Autoevalucion;
        $nuevo->f_entrega = $data['f_entrega'];
		$nuevo->id_practica = $data['id_practica'];

        $nuevo->save();

        return redirect()->route('lista_auto_evaluaciones');
    }

    public function editarAutoEvalucion(Request $request, $id_elemento)
    {
        $elemento_editar=Autoevalucion::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->f_entrega=$request->f_entrega;
			$elemento_editar->id_practica=$request->id_practica;
            $elemento_editar->save();

            return redirect()->route('lista_auto_evaluaciones');
        }
    }
    public function borrarAutoEvalucion($id_elemento){
        $elemento_eliminar =  Autoevalucion::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_auto_evaluaciones');
    }
}
