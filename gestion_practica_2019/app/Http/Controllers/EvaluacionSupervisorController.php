<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\EvaluacionSupervisor;

class EvaluacionSupervisorController extends Controller
{
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= EvaluacionSupervisor::all();
        return view('lista_evaluaciones_supervisor',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('crear_evaluacion_supervisor');
    }

    public function editar($id_elemento)
    {
        $elemento= EvaluacionSupervisor::find($id_elemento);
        return view('editar_evaluacion_supervisor',[
                'elemento'=>$elemento,
            ]);
    }

    public function crearEvaluacionSupervisor (Request $request)
    {
        $data = $request->all();
        $nuevo = new EvaluacionSupervisor;
        $nuevo->porcent_tareas_realizadas = $data['porcent_tareas_realizadas'];
        $nuevo->resultado_eval = $data['resultado_eval'];
        $nuevo->f_entrega_eval = $data['f_entrega_eval'];
        $nuevo->id_practica = $data['id_practica'];

        $nuevo->save();

        return redirect()->route('lista_evaluaciones_supervisor');
    }

    public function editarEvaluacionSupervisor(Request $request, $id_elemento)
    {
        $elemento_editar=EvaluacionSupervisor::find($id_elemento);
        if(isset($elemento_editar))
        {
            $elemento_editar->id_eval_supervisor=$request->id_eval_supervisor;
            $elemento_editar->porcent_tareas_realizadas=$request->porcent_tareas_realizadas;
            $elemento_editar->resultado_eval=$request->resultado_eval;
            $elemento_editar->f_entrega_eval=$request->f_entrega_eval;
            $elemento_editar->id_practica=$request->id_practica;

            $elemento_editar->save();

            return redirect()->route('lista_evaluaciones_supervisor');
        }
    }
    public function borrarEvaluacionSupervisor($id_elemento){
        $elemento_eliminar =  EvaluacionSupervisor::find($id_elemento);
        $elemento_eliminar->delete();
        return redirect()->route('lista_evaluaciones_supervisor');
    }
}
