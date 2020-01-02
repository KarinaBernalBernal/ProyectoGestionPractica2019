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
use Illuminate\Support\Facades\DB;

class EvaluacionSupervisorController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_administrador')->except('index', 'verDescripcionEvaluacionEmpresa', 'store');
        $this->middleware('is_supervisor')->only('store');
    }
    
    public function index($id)
    {
  		$area = Area::all()->where('vigencia',"1");
        $actitud = EvalActitudinal::all()->where('vigencia',"1");
        $conocimiento = EvalConocimiento::all()->where('vigencia',"1");

        return view('3 Evaluacion/formularioEvaluacionEmpresa',[
            'area'=>$area,
            'actitud'=>$actitud,
            'conocimiento'=>$conocimiento,
            'idPractica'=>$id
        ]);
    }

    public function verDescripcionEvaluacionEmpresa()
    {
        $id = auth()->user()->id_user;
        $supervisores = Supervisor::where('id_user', $id)->first();

        //-----Alumnos bajo el cargo del supervisor-----//
        $alumnos = DB::table('alumnos')
            ->join('practicas', 'practicas.id_alumno', '=','alumnos.id_alumno')
            ->join('supervisores', 'supervisores.id_supervisor', '=', 'practicas.id_supervisor')
            ->leftJoin('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('practicas.id_supervisor', '=', $supervisores->id_supervisor)
            ->select('alumnos.*', 'evaluaciones_supervisor.f_entrega_eval', 'practicas.id_practica', 'practicas.f_desde', 'practicas.f_hasta','resoluciones.resolucion_practica' )
            ->get();

        $alumnos = $alumnos->paginate(10);
        /*Se envian a todos los alumnos que corresponden al supervisor*/
        return view('3 Evaluacion/evaluacionEmpresa')->with('lista',$alumnos);
    }

    //vista principal de un elemento en especifico
    public function lista(Request $request)
    {
        $lista = DB::table('evaluaciones_supervisor')
        ->join('practicas', 'practicas.id_practica', '=', 'evaluaciones_supervisor.id_practica')
        ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
        ->join('supervisores', 'supervisores.id_supervisor', '=', 'practicas.id_supervisor')
        ->select('evaluaciones_supervisor.*','supervisores.email', 'alumnos.rut')
        ->get();

        if ($request->email != null || $request->rut != null || $request->porcent_tareas_realizadas != null || $request->resultado_eval != null || $request->f_entrega_eval != null)
        {
            //-----Filtro-----//
            $listaFiltrada = EvaluacionSupervisor::filtrarEvaluacionesMantenedor(
                $request->get('email'),
                $request->get('rut'),
                $request->get('porcent_tareas_realizadas'),
                $request->get('resultado_eval'),
                $request->get('f_entrega_eval')
            );
            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginate(10);

            return view('Mantenedores/Evaluaciones/Supervisor/lista_evaluaciones_supervisor')
                ->with('lista', $listaFiltrada)
                ->with('contador', $contador);
        }
        $contador = $lista->count();
        $lista = $lista->paginate(10);
        return view('Mantenedores/Evaluaciones/Supervisor/lista_evaluaciones_supervisor',[
                'lista'=>$lista,
                'contador'=>$contador,
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

    public function store(Request $request, $idPractica)
    {
        $fecha= date("Y-m-d H:i:s");
        $id = auth()->user()->id_user;
        $supervisores = Supervisor::where('id_user', $id)->first();

        $practicas = DB::table('practicas')
            ->join('supervisores', 'supervisores.id_supervisor', '=', 'supervisores.id_supervisor')
            ->leftJoin('resoluciones', 'resoluciones.id_practica', 'practicas.id_practica')
            ->where('resoluciones.resolucion_practica', null)
            ->where('practicas.id_practica', $idPractica)
            ->where('supervisores.id_supervisor', $supervisores->id_supervisor)
            ->select('practicas.*')
            ->first();

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
        if($request->areasOtros != null)
        {
            for ($i = 0; $i < count($request->areasOtros, 1); $i++)
            {
                OtrosAreas::create([
                    'n_area' => $request->areasOtros[$i]
                ]);
            }
        }
        return redirect()->route('descripcionEvaluacionEmpresa');
    }
    
    public function mostrarEvaluacionModal($id)
    {
        $practicas = Practica::where('id_alumno', $id)->first();
        $evaluacion = EvaluacionSupervisor::where('id_practica', $practicas->id_practica)->first();

        return view('Practicas/modales/modalEvaluacion')->with('formulario',$evaluacion);
    }

    public function listaEvaluacionSupervisor(Request $request, $carrera)
    {
        //-----Supervisores de informatica-----//
        $supervisoresInformatica = DB::table('supervisores')
            ->join('practicas', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'practicas.id_alumno')
            ->join('evaluaciones_supervisor', 'evaluaciones_supervisor.id_practica', 'practicas.id_practica')
            ->where('alumnos.carrera', '=', $carrera)
            ->select('supervisores.*', 'evaluaciones_supervisor.*', 'evaluaciones_supervisor.f_entrega_eval', 'alumnos.nombre as nombre_alumno', 'alumnos.apellido_paterno as apellido_alumno')
            ->get();

        //-----Si no se seleccionaron filtros solo entregamos la consulta de la base-----//
        if ($request->nombre != null || $request->apellido_paterno != null || $request->email != null || $request->fono != null || $request->f_entrega_eval)
        {
            //-----Filtro-----//
            $listaFiltrada= EvaluacionSupervisor::filtrarEvaluaciones(
                $request->get('nombre'),
                $request->get('apellido_paterno'),
                $request->get('email'),
                $request->get('fono'),
                $request->get('f_entrega_eval'),
                $carrera
            );
            $contador = $listaFiltrada->count();  //mostrara la cantidad de resultados en la tabla filtrada
            $listaFiltrada = $listaFiltrada->paginate(10);
            return view('3 Evaluacion/listaEvaluacionSupervisor')->with('evaluacion',$listaFiltrada)
                ->with('contador', $contador)
                ->with('carrera', $carrera);
        }
        $contador = $supervisoresInformatica->count(); //mostrara la cantidad de resultados en la tabla
        $supervisoresInformatica = $supervisoresInformatica->paginate(10);
        return view('3 Evaluacion/listaEvaluacionSupervisor')->with('evaluacion',$supervisoresInformatica)
            ->with('contador', $contador)
            ->with('carrera', $carrera);
    }
}
