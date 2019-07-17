<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\EvaluacionSupervisor;

class EvaluacionController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= EvaluacionSupervisor::all();
        return view('lista_evaluaciones_sup',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('crear_evaluacion_sup');
    }

    public function editar($id_elemento)
    {
        $elemento= EvaluacionSupervisor::find($id_elemento);
        return view('editar_evaluacion_sup',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearEvaluacionSupervisor (Request $request)
    {
        $data = $request->all();

        $nuevo = new EvaluacionSupervisor;
        $nuevo->id_eval_supervisor = $data['id_eval_supervisor'];
        $nuevo->save();

        return redirect()->route('lista_evaluaciones_sup');
    }

    public function editarEvaluacionSupervisor(Request $request, $id_elemento)
    {
        $elemento_editar=EvaluacionSupervisor::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->id_eval_supervisor=$request->id_eval_supervisor;
            $elemento_editar->save();

            return redirect()->route('lista_evaluaciones_sup');
        }
    }
    public function borrarAlumno($id_elemento){
        $elemento_eliminar =  EvaluacionSupervisor::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_evaluaciones_sup');
    }
}
