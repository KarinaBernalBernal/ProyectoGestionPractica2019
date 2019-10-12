<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use SGPP\AreaEvaluacion;
use SGPP\Area;
use SGPP\EvaluacionSupervisor;
use SGPP\Supervisor;
use SGPP\Fortaleza;
use SGPP\Debilidad;
use SGPP\EvalActEmpPractica;
use SGPP\EvalConEmpPractica;
use SGPP\Practica;
use SGPP\EvalActitudinal;
use SGPP\EvalConocimiento;
use Auth;
class EvaluacionSupervisorController extends Controller
{

    public function index()
    {
        return view('3 Evaluacion/formularioEvaluacionEmpresa');
    }
    public function verDescripcionEvaluacionEmpresa(){
        return view('3 Evaluacion/evaluacionEmpresa');
    }
    //vista principal de un elemento en especifico
    public function lista()
    {
        $lista= EvaluacionSupervisor::all();
        return view('Mantenedores/Evaluaciones/Supervisor/lista_evaluaciones_supervisor',[
                'lista'=>$lista,
            ]);
    }
    public function crear()
    {
        return view('Mantenedores/Evaluaciones/Supervisor/crear_evaluacion_supervisor');
    }

    public function editar($id_elemento)
    {
        $elemento= EvaluacionSupervisor::find($id_elemento);
        return view('Mantenedores/Evaluaciones/Supervisor/editar_evaluacion_supervisor',[
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

    public function store(Request $request)
    {
        $fecha= date("Y-m-d H:i:s");
        $id = auth()->user()->id_user;
        $supervisores = Supervisor::where('id_user', $id)->first();
        $practicas = Practica::where('id_supervisor', $supervisores->id_supervisor)->first();

        $evaluacionesSupervisor = EvaluacionSupervisor::create([
            'id_practica' => $practicas->id_practica,
            'f_entrega_eval' => $fecha,
            'porcent_tareas_realizadas' => $request->porcentaje,
            'resultado_eval' => $request->recomendacion

        ]);

        for($i = 0; $i<count($request->fortaleza,1); $i++)
        {
            Fortaleza::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'n_fortaleza' => $request->fortaleza[$i],
                'dp_fortaleza' => "sin descripcion"
            ]);
        }
        for($i = 0; $i<count($request->debilidad,1); $i++)
        {
            Debilidad::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'n_debilidad' => $request->debilidad[$i],
                'dp_debilidad' => "sin descripcion"
            ]);
        }

        for($i = 0; $i<count($request->criterio,1); $i++)
        {
            $criterios = EvalActitudinal::create([
                'n_act' => $request->criterio[$i],
                'dp_act' => "sin descripcion"
            ]);

            EvalActEmpPractica::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'id_actitudinal' => $criterios->id_actitudinal,
                'valor_act_emp_practica' => 1
            ]);
        }

        for($i = 0; $i<count($request->criterio2,1); $i++)
        {
            $criterios2 = EvalConocimiento::create([
                'n_con' => $request->criterio2[$i],
                'dp_con' => "sin descripcion"
            ]);

            EvalConEmpPractica::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'id_conocimiento' => $criterios2->id_conocimiento,
                'valor_con_emp_practica' => 1

            ]);
        }

        for($i = 0; $i<count($request->area,1); $i++)
        {
            $areas = Area::create([
                'n_area' => $request->area[$i]
            ]);

            AreaEvaluacion::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'id_area' => $areas->id_area
            ]);
        }


        return redirect()->route('descripcionAutoEvaluacion');
    }
}
