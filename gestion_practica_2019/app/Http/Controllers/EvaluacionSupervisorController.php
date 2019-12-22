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
        $area = Area::all()->where('vigencia',"1");
        $actitud = EvalActitudinal::all()->where('vigencia',"1");
        $conocimiento = EvalConocimiento::all()->where('vigencia',"1");

        return view('3 Evaluacion/formularioEvaluacionEmpresa',[
            'area'=>$area,
            'actitud'=>$actitud,
            'conocimiento'=>$conocimiento,
        ]);
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
        return view('Mantenedores/Evaluaciones/Supervisor/editar_evaluacion_sup',[
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
                'dp_fortaleza' => $request->dpFortaleza[$i]
            ]);
        }
        for($i = 0; $i<count($request->debilidad,1); $i++)
        {
            Debilidad::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'n_debilidad' => $request->debilidad[$i],
                'dp_debilidad' => $request->dpDebilidad[$i]
            ]);
        }

        for($i = 0; $i<count($request->criterio,1); $i++)
        {
            $actitud = EvalActitudinal::all()->where("id_actitudinal",$request->actitud[$i])->first();

            EvalActEmpPractica::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'id_actitudinal' => $actitud->id_actitudinal,
                'valor_act_emp_practica' => $request->criterio[$i]
            ]);
        }

        for($i = 0; $i<count($request->criterio2,1); $i++)
        {
            $conocimiento = EvalConocimiento::all()->where("id_conocimiento",$request->criterioConocimiento[$i])->first();

            EvalConEmpPractica::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'id_conocimiento' => $conocimiento->id_conocimiento,
                'valor_con_emp_practica' => $request->criterio2[$i]
            ]);
        }

        for($i = 0; $i<count($request->area,1); $i++)
        {
            $areas = Area::all()->where("n_area",$request->area[$i])->first();

            AreaEvaluacion::create([
                'id_eval_supervisor' => $evaluacionesSupervisor->id_eval_supervisor,
                'id_area' => $areas->id_area
            ]);
        }

        if (!isset($request->areasOtros))
        {
            for($i = 0; $i<count($request->areasOtros,1); $i++)
            {
                OtrosAreas::create([
                    'n_area' => $request->areasOtros
                ]);
            }
        }

        return redirect()->route('descripcionAutoEvaluacion');
    }
}
