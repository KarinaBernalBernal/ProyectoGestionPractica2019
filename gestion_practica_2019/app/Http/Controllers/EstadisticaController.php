<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use SGPP\Alumno;
use SGPP\Area;
use SGPP\AreaAutoeval;
use SGPP\AreaEvaluacion;
use SGPP\Autoevaluacion;
use SGPP\Conocimiento;
use SGPP\Debilidad;
use SGPP\Desempenno;
use SGPP\Empresa;
use SGPP\Fortaleza;
use SGPP\EvalActEmpPractica;
use SGPP\EvalActitudinal;
use SGPP\EvalActPractica;
use SGPP\EvalConEmpPractica;
use SGPP\EvalConocimiento;
use SGPP\EvalConPractica;
use SGPP\EvaluacionSupervisor;
use SGPP\Habilidad;
use SGPP\Herramienta;
use SGPP\HerramientaPractica;
use SGPP\Practica;
use SGPP\Resolucion;
use SGPP\Supervisor;
use SGPP\Tarea;

class EstadisticaController extends Controller
{

/////////////////////////////////////////////// Estadisticas del alumno ///////////////////////////////
    public function mostrarEstadisticasAlumno($id){
        $alumno = Alumno::find($id);
        $practicas = Practica::where('id_alumno',$id)->paginate(12);
        $auto = 0;
        $evalSup = 0;
        $carrera = 1;
        $flag = 1;
        $pracAuto = null;
        $pracSup = null;

        $practicasA = Practica::join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                    ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                    ->where('resoluciones.resolucion_practica',1)
                    ->where('practicas.id_alumno',$id)
                    ->get();

        $cantPracticas = 0;

        if(strtoupper($alumno->carrera) == strtoupper('Ingeniería Civil Informática')){
            $carrera = 0;
        }
        //dd($carrera);

        //Cantidad de practicas aprobadas del alumno
        foreach($practicasA as $practica){
            $autoevaluacion = Autoevaluacion::where('id_practica',$practica->id_practica)->first();
            $evaluacionSuper = Autoevaluacion::where('id_practica',$practica->id_practica)->first();
            
            if($autoevaluacion != null){
                $auto = $auto + 1;
            }
            else{
                $pracAuto = $practica->id_practica;
            }

            if($evaluacionSuper != null){
                $evalSup = $evalSup +1;
            }
            else{
                $pracSup = $practica->id_practica;
            }

            if($practica->resolucion_practica == 1){
                $cantPracticas = $cantPracticas + 1;
            }
            //dd($practica->resolucion_practica);
        }
        //dd($cantPracticas); 
        if($cantPracticas == 2){
            $flag = 0;
        }

        //Lista de supervisores
        $supervisores = new Supervisor();
        $supervisores = collect([]);

        $resoluciones = new Resolucion();
        $resoluciones = collect([]);

        foreach($practicas as $practica){
            $resultadoSupervisor = Supervisor::where('id_supervisor', $practica->id_supervisor)->first();
            $resultadosResolucion = Resolucion::where('id_practica', $practica->id_practica)->first();

            $supervisores->push($resultadoSupervisor);
            $resoluciones->push($resultadosResolucion);
        }

        //Lista de empresas del alumno
        $empresas = new Empresa();
        $empresas = collect([]);

        foreach($supervisores as $supervisor){
            $resultadoEmpresa= Empresa::where('id_empresa', $supervisor->id_empresa)->first();
            $empresas->push($resultadoEmpresa);
        }

        return view('Estadisticas/datosAlumno')
                    ->with("alumno", $alumno)
                    ->with("practicas", $practicas)
                    ->with('supervisores', $supervisores)
                    ->with('empresas', $empresas)
                    ->with('resoluciones', $resoluciones)
                    ->with('flag1', $carrera)
                    ->with('flag2', $flag)
                    ->with('auto', $auto)
                    ->with('evalSup', $evalSup)
                    ->with('pracAuto', $pracAuto)
                    ->with('pracSup', $pracSup);                      
    }

    public function buscarAlumno(Request $request){
        $lista= Alumno::filtrarYPaginar($request->get('nombre'), 
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera'),
                                        $request->get('rut')                                        
                                        );
        
        return view('Estadisticas/alumnosDetalles')->with("lista", $lista);
    }

    public function mostrarComparativaEvaluaciones($id){
        $autoevaluacion = Autoevaluacion::where('id_practica',$id)->first();
        $evaluacionSupervisor = EvaluacionSupervisor::where('id_practica',$id)->first();
        
        if($autoevaluacion != null && $evaluacionSupervisor != null ){
            $evalActPractica = EvalActPractica::orderby('id_actitudinal', 'ASC')->where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            $evalConPractica = EvalConPractica::orderby('id_conocimiento', 'ASC')->where('id_autoeval',$autoevaluacion->id_autoeval)->get();

            $evalActEmpPractica = EvalActEmpPractica::orderby('id_actitudinal', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();
            $evalConEmpPractica = EvalConEmpPractica::orderby('id_conocimiento', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();

            $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
            $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();
            
            $evalConPractica->toArray();
            $evalActPractica->toArray();
            
            $evalActEmpPractica->toArray();
            $evalConEmpPractica->toArray();
            
            $evalActitudinales->toArray();
            $evalConocimientos->toArray();
            
            return view('Estadisticas/mostrarComparativaEvaluaciones')->with("autoevaluacion", $autoevaluacion)
                    ->with("evalActPractica", $evalActPractica)->with("evalConPractica", $evalConPractica)
                    ->with("evalActEmpPractica", $evalActEmpPractica)->with("evalConEmpPractica", $evalConEmpPractica)
                    ->with("evalActitudinales", $evalActitudinales)->with("evalConocimientos", $evalConocimientos);
        }
        else{
            return view('Estadisticas/mostrarComparativaEvaluaciones')->with("autoevaluacion", $autoevaluacion)
                            ->with("evaluacionSupervisor", $evaluacionSupervisor);
        }
    }

    public function mostrarAutoevaluacionAlumno($id){
        $autoevaluacion = Autoevaluacion::where('id_practica',$id)->first();
        
        if($autoevaluacion != null){
            $desempeño = Desempenno::where('id_autoeval',$autoevaluacion->id_autoeval)->first();
            $tareas = Tarea::where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            $habilidades = Habilidad::where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            $conocimientos = Conocimiento::where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            
            $herramientaPracticas = HerramientaPractica::where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            $areaAutoevals = AreaAutoeval::where('id_autoeval',$autoevaluacion->id_autoeval)->get();

            $herramientas = Herramienta::orderby('id_herramienta', 'DESC')->get();
            $areas = Area::orderby('id_area', 'DESC')->get();

            $evalActPractica = EvalActPractica::orderby('id_actitudinal', 'ASC')->where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            $evalConPractica = EvalConPractica::orderby('id_conocimiento', 'ASC')->where('id_autoeval',$autoevaluacion->id_autoeval)->get();
            $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
            $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();

            $evalActitudinales->toArray();
            $evalConocimientos->toArray();
            
            $evalConPractica->toArray();
            $evalActPractica->toArray();

            $practica = Practica::find($id);
            $alumno = Alumno::find($practica->id_alumno);   

            $evalActPromG = $this->calcularActAutoevalPromG($evalActitudinales, $alumno->carrera);
            $evalConPromG = $this->calcularConAutoevalPromG($evalConocimientos, $alumno->carrera);
            
            return view('Estadisticas/mostrarAutoevaluacionAlumno')->with("autoevaluacion", $autoevaluacion)
                    ->with("desempeño", $desempeño)->with("tareas", $tareas)
                    ->with("habilidades", $habilidades)->with("conocimientos", $conocimientos)
                    ->with("herramientas", $herramientas)->with("areas", $areas)
                    ->with("herramientaPracticas", $herramientaPracticas)->with("areaAutoevals", $areaAutoevals)
                    ->with("evalActPractica", $evalActPractica)->with("evalConPractica", $evalConPractica)
                    ->with("evalActitudinales", $evalActitudinales)->with("evalConocimientos", $evalConocimientos)
                    ->with("evalActPromG", $evalActPromG)->with("evalConPromG", $evalConPromG);
        }
        else{
            return view('Estadisticas/mostrarAutoevaluacionAlumno')->with("autoevaluacion", $autoevaluacion);
        }
    }

    public function mostrarEvaluacionSupervisor($id){
        $evaluacionSupervisor = EvaluacionSupervisor::where('id_practica',$id)->first();
        
        if($evaluacionSupervisor != null){
            $fortalezas = Fortaleza::where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();
            $debilidades = Debilidad::where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();
            $areaEvals = AreaEvaluacion::where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();
            $areas = Area::orderby('id_area', 'DESC')->get();

            $evalActPractica = EvalActEmpPractica::orderby('id_actitudinal', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();
            $evalConPractica = EvalConEmpPractica::orderby('id_conocimiento', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor->id_eval_supervisor)->get();

            $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
            $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();

            $evalActitudinales->toArray();
            $evalActPractica->toArray();

            $evalConocimientos->toArray();
            $evalConPractica->toArray();

            $practica = Practica::find($id);
            $alumno = Alumno::find($practica->id_alumno);   

            $evalActPromG = $this->calcularActEvalSupPromG($evalActitudinales, $alumno->carrera);
            $evalConPromG = $this->calcularConEvalSupPromG($evalConocimientos, $alumno->carrera);
            
            return view('Estadisticas/mostrarEvaluacionSupervisor')->with("evaluacionSupervisor", $evaluacionSupervisor)
                    ->with("fortalezas", $fortalezas)->with("debilidades", $debilidades)
                    ->with("areaEvals", $areaEvals)->with("areas", $areas)
                    ->with("evalActPractica", $evalActPractica)->with("evalConPractica", $evalConPractica)
                    ->with("evalActitudinales", $evalActitudinales)->with("evalConocimientos", $evalConocimientos)
                    ->with("evalActPromG", $evalActPromG)->with("evalConPromG", $evalConPromG);
        }
        else{

            return view('Estadisticas/mostrarEvaluacionSupervisor')->with("evaluacionSupervisor", $evaluacionSupervisor);
        }
    }

    public function avance($id){
        $practica1 = Practica::join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                    ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                    ->where('resoluciones.resolucion_practica',1)
                    ->where('practicas.id_alumno',$id)
                    ->first();

        $practica2 = Practica::join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                    ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                    ->where('resoluciones.resolucion_practica',1)
                    ->where('practicas.id_practica','<>',$practica1->id_practica)
                    ->where('practicas.id_alumno',$id)
                    ->first();

        $autoevaluacion1 = Autoevaluacion::where('id_practica',$practica1->id_practica)->first();
        $evaluacionSupervisor1 = EvaluacionSupervisor::where('id_practica',$practica1->id_practica)->first();

        $autoevaluacion2 = Autoevaluacion::where('id_practica',$practica2->id_practica)->first();
        $evaluacionSupervisor2 = EvaluacionSupervisor::where('id_practica',$practica2->id_practica)->first();

        //dd($practica1->id_practica, $practica2->id_practica);
        
        if($autoevaluacion1 != null && $autoevaluacion2 != null ){
            $evalActPractica1 = EvalActPractica::orderby('id_actitudinal', 'ASC')->where('id_autoeval',$autoevaluacion1->id_autoeval)->paginate(12);
            $evalConPractica1 = EvalConPractica::orderby('id_conocimiento', 'ASC')->where('id_autoeval',$autoevaluacion1->id_autoeval)->paginate(12);

            $evalActPractica2 = EvalActPractica::orderby('id_actitudinal', 'ASC')->where('id_autoeval',$autoevaluacion2->id_autoeval)->paginate(12);
            $evalConPractica2 = EvalConPractica::orderby('id_conocimiento', 'ASC')->where('id_autoeval',$autoevaluacion2->id_autoeval)->paginate(12);

            //dd($evalActPractica1->valor_act_practica, $evalActPractica2->valor_act_practica);

            $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
            $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);
            
            $evalConPractica1->toArray();
            $evalActPractica1->toArray();
            
            $evalActPractica2->toArray();
            $evalConPractica2->toArray();
            
            $evalActitudinales->toArray();
            $evalConocimientos->toArray();

            $evalActEmpPractica1 = EvalActEmpPractica::orderby('id_actitudinal', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor1->id_eval_supervisor)->paginate(12);
            $evalConEmpPractica1 = EvalConEmpPractica::orderby('id_conocimiento', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor1->id_eval_supervisor)->paginate(12);

            $evalActEmpPractica1->toArray();
            $evalConEmpPractica1->toArray();

            $evalActEmpPractica2 = EvalActEmpPractica::orderby('id_actitudinal', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor2->id_eval_supervisor)->paginate(12);
            $evalConEmpPractica2 = EvalConEmpPractica::orderby('id_conocimiento', 'ASC')->where('id_eval_supervisor',$evaluacionSupervisor2->id_eval_supervisor)->paginate(12);

            $evalActEmpPractica2->toArray();
            $evalConEmpPractica2->toArray();
        
            return view('Estadisticas/AvanceCivil')->with("autoevaluacion1", $autoevaluacion1)
                                                    ->with("evalActPractica1", $evalActPractica1)
                                                    ->with("evalConPractica1", $evalConPractica1)
                                                    ->with("evalActPractica2", $evalActPractica2)
                                                    ->with("evalConPractica2", $evalConPractica2)
                                                    ->with("evalActEmpPractica1", $evalActEmpPractica1)
                                                    ->with("evalConEmpPractica1", $evalConEmpPractica1)
                                                    ->with("evalActEmpPractica2", $evalActEmpPractica2)
                                                    ->with("evalConEmpPractica2", $evalConEmpPractica2)
                                                    ->with("evalActitudinales", $evalActitudinales)
                                                    ->with("evalConocimientos", $evalConocimientos);
        }
        else{
            return view('Estadisticas/AvanceCivil')->with("autoevaluacion1", $autoevaluacion1)
                            ->with("evaluacion2", $autoevaluacion2)
                            ->with("evaluacionSupervisor1", $evaluacionSupervisor1)
                            ->with("evaluacionSupervisor2", $evaluacionSupervisor2);
        }        
    }
/////////////////////////////////////////////// Estadisticas Generales ////////////////////////////////////////////////////
    public function verEstadisticaGeneral(){
        $fechas = Practica::join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                    ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                    ->where('resoluciones.resolucion_practica',1)
                    ->select('resoluciones.f_resolucion')
                    ->get();
        
        $arrayFechas = array();

        $empresas = Empresa::orderby('id_empresa', 'ASC')->get();

        $empresasCivil = $this->calcularEmpresasProm($empresas ,'Ingeniería Civil Informática');
        $empresasEjec = $this->calcularEmpresasProm($empresas, 'Ingeniería de Ejecución Informática');

        foreach($fechas as $fecha){
            $anio = date("Y", strtotime($fecha->f_resolucion));

            if($arrayFechas == null){
                $arrayFechas = array($anio);
            }else{
                if(in_array($anio,$arrayFechas) == false){
                    array_push($arrayFechas,$anio);
                }
            }
        }

        $totalCivil = $this->totalPracticantes($arrayFechas ,'Ingeniería Civil Informática' );
        $totalEjec= $this->totalPracticantes($arrayFechas ,'Ingeniería de Ejecución Informática');

        return view('Estadisticas/estadisticaGeneral')->with('arrayFechas',$arrayFechas)
                                                        ->with('totalCivil',$totalCivil)->with('totalEjec',$totalEjec)
                                                        ->with('empresas',$empresas)
                                                        ->with('empresasCivil',$empresasCivil)
                                                        ->with('empresasEjec',$empresasEjec);
    }         

    public function verEstadisticaCriteriosAutoeval(){

        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();
        $areas = Area::orderby('id_area', 'ASC')->where('areas.vigencia', 1)->get();
        $herramientas = Herramienta::orderby('id_herramienta', 'ASC')->where('herramientas.vigencia', 1)->get();
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();
        $areas->toArray();
        $herramientas->toArray();
        
        $evalActCivilPromG = $this->calcularActAutoevalPromG($evalActitudinales, 'Ingeniería Civil Informática' );
        $evalConCivilPromG = $this->calcularConAutoevalPromG($evalConocimientos, 'Ingeniería Civil Informática' );
        $herramientasCivilPromG = $this->calcularHerramAutoevalPromG($herramientas,'Ingeniería Civil Informática');
        $areasCivilPromG = $this->calcularAreasAutoevalPromG($areas ,'Ingeniería Civil Informática');
        
        $evalActEjecPromG = $this->calcularActAutoevalPromG($evalActitudinales, 'Ingeniería de Ejecución Informática');
        $evalConEjecPromG = $this->calcularConAutoevalPromG($evalConocimientos, 'Ingeniería de Ejecución Informática' );
        $herramientasEjecPromG = $this->calcularHerramAutoevalPromG($herramientas, 'Ingeniería de Ejecución Informática');
        $areasEjecPromG = $this->calcularAreasAutoevalPromG($areas, 'Ingeniería de Ejecución Informática');

        return view('Estadisticas/estadisticaCriteriosAutoeval')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('herramientasCivilPromG',$herramientasCivilPromG)->with('herramientasEjecPromG',$herramientasEjecPromG)
                ->with('areasCivilPromG',$areasCivilPromG)->with('areasEjecPromG',$areasEjecPromG)
                ->with('herramientas',$herramientas)->with('areas',$areas);
    }

    public function verEstadisticaCriteriosEvalSupervisor(){

        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();
        $areas = Area::orderby('id_area', 'ASC')->where('areas.vigencia', 1)->get();

        $evalActitudinales->toArray();
        $evalConocimientos->toArray();
        $areas->toArray();
        
        $evalActCivilPromG = $this->calcularActEvalSupPromG($evalActitudinales, 'Ingeniería Civil Informática' );
        $evalConCivilPromG = $this->calcularConEvalSupPromG($evalConocimientos, 'Ingeniería Civil Informática' );
        $areasCivilPromG = $this->calcularAreasEvalSupPromG($areas ,'Ingeniería Civil Informática');
        
        $evalActEjecPromG = $this->calcularActEvalSupPromG($evalActitudinales, 'Ingeniería de Ejecución Informática' );
        $evalConEjecPromG = $this->calcularConEvalSupPromG($evalConocimientos, 'Ingeniería de Ejecución Informática' );
        $areasEjecPromG = $this->calcularAreasEvalSupPromG($areas, 'Ingeniería de Ejecución Informática');
        
        return view('Estadisticas/estadisticaCriteriosEvaluacionSupervisor')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('areasCivilPromG',$areasCivilPromG)->with('areasEjecPromG',$areasEjecPromG)
                ->with('areas',$areas);

    }

    //-------------------------------------------- Busquedas -------------------------------------//

    public function busquedaAutoeval(Request $request){
        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();
        $areas = Area::orderby('id_area', 'ASC')->where('areas.vigencia', 1)->get();
        $herramientas = Herramienta::orderby('id_herramienta', 'ASC')->where('herramientas.vigencia', 1)->get();
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();
        $areas->toArray();
        $herramientas->toArray();

        $hasta = $request->busquedaHasta;
        $desde = $request->busquedaDesde;
        
        if($request->tipoBusqueda == 1){ // 1: Busqueda por rango. 2: Busqueda por año especifico
            $evalActCivilPromG = $this->calcularActAutoevalPromGRangoAño($evalActitudinales, 'Ingeniería Civil Informática', $desde, $hasta);
            $evalConCivilPromG = $this->calcularConAutoevalPromGRangoAño($evalConocimientos, 'Ingeniería Civil Informática', $desde,$hasta);
            $herramientasCivilPromG = $this->calcularHerramAutoevalPromGRangoAño($herramientas,'Ingeniería Civil Informática',$desde, $hasta);
            $areasCivilPromG = $this->calcularAreasAutoevalPromGRangoAño($areas ,'Ingeniería Civil Informática',$desde, $hasta);

            $evalActEjecPromG = $this->calcularActAutoevalPromGRangoAño($evalActitudinales, 'Ingeniería de Ejecución Informática', $desde, $hasta);
            $evalConEjecPromG = $this->calcularConAutoevalPromGRangoAño($evalConocimientos, 'Ingeniería de Ejecución Informática', $desde, $hasta);
            $herramientasEjecPromG = $this->calcularHerramAutoevalPromGRangoAño($herramientas, 'Ingeniería de Ejecución Informática',$desde, $hasta);
            $areasEjecPromG = $this->calcularAreasAutoevalPromGRangoAño($areas, 'Ingeniería de Ejecución Informática',$desde, $hasta);
            
            return view('Estadisticas/busquedaPorRangoAñoAutoeval')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with('evalActCivilPromG', $evalActCivilPromG)->with('evalConCivilPromG', $evalConCivilPromG)
                ->with('evalActEjecPromG', $evalActEjecPromG)->with('evalConEjecPromG', $evalConEjecPromG)
                ->with('herramientasCivilPromG',$herramientasCivilPromG)->with('herramientasEjecPromG',$herramientasEjecPromG)
                ->with('areasCivilPromG',$areasCivilPromG)->with('areasEjecPromG',$areasEjecPromG)
                ->with('herramientas',$herramientas)->with('areas',$areas)
                ->with("desde", $desde)->with("hasta", $hasta);
        }
        else{
            $evalActCivilPromG = $this->calcularActAutoevalAñoEspecifico($evalActitudinales, 'Ingeniería Civil Informática',$desde );
            $evalConCivilPromG = $this->calcularConAutoevalAñoEspecifico($evalConocimientos, 'Ingeniería Civil Informática', $desde);
            $herramientasCivilPromG = $this->calcularHerramAutoevalAñoEspecifico($herramientas,'Ingeniería Civil Informática',$desde);
            $areasCivilPromG = $this->calcularAreasAutoevalAñoEspecifico($areas ,'Ingeniería Civil Informática',$desde);

            $evalActEjecPromG = $this->calcularActAutoevalAñoEspecifico($evalActitudinales, 'Ingeniería de Ejecución Informática', $desde );
            $evalConEjecPromG = $this->calcularConAutoevalAñoEspecifico($evalConocimientos, 'Ingeniería de Ejecución Informática', $desde );
            $herramientasEjecPromG = $this->calcularHerramAutoevalAñoEspecifico($herramientas, 'Ingeniería de Ejecución Informática',$desde);
            $areasEjecPromG = $this->calcularAreasAutoevalAñoEspecifico($areas, 'Ingeniería de Ejecución Informática',$desde);

            return view('Estadisticas/busquedaPorAñoEspecificoAutoeval')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('herramientasCivilPromG',$herramientasCivilPromG)->with('herramientasEjecPromG',$herramientasEjecPromG)
                ->with('areasCivilPromG',$areasCivilPromG)->with('areasEjecPromG',$areasEjecPromG)
                ->with('herramientas',$herramientas)->with('areas',$areas)
                ->with("desde", $desde);
        }
    }

    public function busquedaEvalSup(Request $request){
        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->get();
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->get();
        $areas = Area::orderby('id_area', 'ASC')->where('areas.vigencia', 1)->get();
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();
        $areas->toArray();

        $hasta = $request->busquedaHasta;
        $desde = $request->busquedaDesde;

        if($request->tipoBusqueda == 1){ // 1: Busqueda por rango. 2: Busqueda por año especifico
            $evalActCivilPromG = $this->calcularActEvalSupPromGRangoAño($evalActitudinales, 'Ingeniería Civil Informática', $desde, $hasta);
            $evalConCivilPromG = $this->calcularConEvalSupPromGRangoAño($evalConocimientos, 'Ingeniería Civil Informática', $desde, $hasta);
            $areasCivilPromG = $this->calcularAreasEvalSupPromGRangoAño($areas ,'Ingeniería Civil Informática',$desde, $hasta);
            
            $evalActEjecPromG = $this->calcularActEvalSupPromGRangoAño($evalActitudinales, 'Ingeniería de Ejecución Informática', $desde, $hasta);
            $evalConEjecPromG = $this->calcularConEvalSupPromGRangoAño($evalConocimientos, 'Ingeniería de Ejecución Informática', $desde, $hasta);
            $areasEjecPromG = $this->calcularAreasEvalSupPromGRangoAño($areas, 'Ingeniería de Ejecución Informática',$desde, $hasta);

            return view('Estadisticas/busquedaPorRangoAñoEvalSup')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('areasCivilPromG',$areasCivilPromG)->with('areasEjecPromG',$areasEjecPromG)
                ->with('areas',$areas)->with("desde", $desde)->with("hasta", $hasta);
        }
        else{
            $evalActCivilPromG = $this->calcularActEvalSupAñoEspecifico($evalActitudinales, 'Ingeniería Civil Informática', $desde);
            $evalConCivilPromG = $this->calcularConEvalSupAñoEspecifico($evalConocimientos, 'Ingeniería Civil Informática', $desde);
            $areasCivilPromG = $this->calcularAreasAutoevalAñoEspecifico($areas ,'Ingeniería Civil Informática',$desde);

            $evalActEjecPromG = $this->calcularActEvalSupAñoEspecifico($evalActitudinales, 'Ingeniería de Ejecución Informática', $desde );
            $evalConEjecPromG = $this->calcularConEvalSupAñoEspecifico($evalConocimientos, 'Ingeniería de Ejecución Informática', $desde );
            $areasEjecPromG = $this->calcularAreasAutoevalAñoEspecifico($areas, 'Ingeniería de Ejecución Informática',$desde);

            return view('Estadisticas/busquedaPorAñoEspecificoEvalSup')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('areasCivilPromG',$areasCivilPromG)->with('areasEjecPromG',$areasEjecPromG)
                ->with('areas',$areas)->with("desde", $desde);
        }
    }
/////////////////////////////////////////////// Funciones para calcular //////////////////////////////////////////////////////77
    
    public function totalPracticantes($arrayFechas ,$carrera){
        $fechas = Practica::join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('resoluciones.f_resolucion')
                                ->get();
        $arrayTotal = array_fill(0, sizeof($arrayFechas), 0);

        foreach($fechas as $fecha){
            $anio = date("Y", strtotime($fecha->f_resolucion));

            if(in_array($anio,$arrayFechas)==true){
                $key = array_search ($anio,$arrayFechas);
                $arrayTotal[$key] += 1;
            }
        }
        return $arrayTotal;
    }

    public function totalPracticantes2($arrayFechas ,$carrera){
        $fechas = Practica::join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('resoluciones.f_resolucion')
                                ->get();
        $arrayTotal = array_fill(0, sizeof($arrayFechas), 0);

        foreach($fechas as $fecha){
            $anio = date("Y", strtotime($fecha->f_resolucion));

            if(in_array($anio,$arrayFechas)==true){
                $key = array_search ($anio,$arrayFechas);
                $arrayTotal[$key] += 1;
            }
        }
        return $arrayTotal;
    }

    public function calcularEmpresasProm($empresas,$carrera){
        $empresasProm = array_fill(0, sizeof($empresas), 0);

        $Autoevalempresas = Practica::join('supervisores', 'practicas.id_supervisor', '=', 'supervisores.id_supervisor')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('empresas', 'supervisores.id_empresa', '=', 'empresas.id_empresa')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('empresas.*')
                                ->get();

        foreach($Autoevalempresas as $Autoevalempresa){
            $empresasProm[($Autoevalempresa->id_empresa) -1] += 1;
        }
        
        return $empresasProm;
    }

    public function calcularActAutoevalPromG($evalActitudinales, $carrera){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActPractica::join('autoevaluaciones', 'eval_act_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_practicas.*')
                                ->get();
    
        foreach($evalActPracticas as $evalActPractica){ 
            if($evalActPractica->valor_act_practica <> 'NA'){
                if($evalActPractica->valor_act_practica == 'NL'){  //NL = 0 puntos
                    $count[($evalActPractica->id_actitudinal) -1] += 1;
                            
                }else{
                    $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                    $count[($evalActPractica->id_actitudinal) -1] += 1;
                }
            }
        }
        for($i=0 ; $i<sizeof($evalActitudinales) ; $i++){
            if($count[$i] <> 0)
                $evalActPromG[$i] = $evalActPromG[$i] / $count[$i];
        }
        return $evalActPromG;
    }

    public function calcularConAutoevalPromG($evalConocimientos, $carrera){
        $EvalConPromG = array_fill(0, sizeof($evalConocimientos), 0);
        $count = array_fill(0, sizeof($evalConocimientos), 0);

        $evalConPracticas = EvalConPractica::join('autoevaluaciones', 'eval_con_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_practicas.*')
                                ->get();

        foreach($evalConPracticas as $evalConPractica){
            if($evalConPractica->valor_con_practica <> 'NA'){
                if($evalConPractica->valor_con_practica == 'NL'){ //NL = 0 puntos
                    $count[($evalConPractica->id_conocimiento) -1] += 1;
                }else{
                    $EvalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                    $count[($evalConPractica->id_conocimiento) -1] += 1;
                }
            }
        }
        
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $EvalConPromG[$i] = $EvalConPromG[$i] / $count[$i];
        }
        return $EvalConPromG;
    }   
    public function calcularActEvalSupPromG($evalActitudinales, $carrera){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActEmpPractica::join('evaluaciones_supervisor', 'eval_act_emp_practica.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                                ->where('resoluciones.resolucion_practica',1)
                                                ->where('alumnos.carrera',$carrera)
                                                ->select('eval_act_emp_practica.*')
                                                ->get();

        foreach($evalActPracticas as $evalActPractica){ 
            if($evalActPractica->valor_act_emp_practica <> 'NA'){
                if($evalActPractica->valor_act_emp_practica == 'NL'){ //NL: 0 puntos
                    $count[($evalActPractica->id_actitudinal) -1] += 1;
                }else{
                    $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_emp_practica);
                    $count[($evalActPractica->id_actitudinal) -1] += 1;
                }
            }
        }
        for($i=0 ; $i<sizeof($evalActitudinales) ; $i++){
            if($count[$i] <> 0)
                $evalActPromG[$i] = ceil($evalActPromG[$i] / $count[$i]);
        }
        return $evalActPromG;
    }

    public function calcularConEvalSupPromG($evalConocimientos, $carrera){
        $EvalConPromG = array_fill(0, sizeof($evalConocimientos), 0);
        $count = array_fill(0, sizeof($evalConocimientos), 0);
        
        $evalConPracticas = EvalConEmpPractica::join('evaluaciones_supervisor', 'eval_con_emp_practicas.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                                ->where('resoluciones.resolucion_practica',1)
                                                ->where('alumnos.carrera',$carrera)
                                                ->select('eval_con_emp_practicas.*')
                                                ->get();

        foreach($evalConPracticas as $evalConPractica){
            if($evalConPractica->valor_con_emp_practica <> 'NA'){ 
                if($evalConPractica->valor_con_emp_practica == 'NL'){ //NL: 0 puntos
                    $count[($evalConPractica->id_conocimiento) -1] += 1;
                }else{
                    $EvalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_emp_practica);
                    $count[($evalConPractica->id_conocimiento) -1] += 1;
                }
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $EvalConPromG[$i] = ceil($EvalConPromG[$i] / $count[$i]);
        }
        
        return $EvalConPromG;
    }

    public function calcularHerramAutoevalPromG($herramientas, $carrera){
        $herramientasPromG = array_fill(0, sizeof($herramientas), 0);

        $herramientasPracticas = HerramientaPractica::join('autoevaluaciones', 'herramientas_practica.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('herramientas','herramientas_practica.id_herramienta', '=', 'herramientas.id_herramienta')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('herramientas.vigencia', 1)
                                ->select('herramientas_practica.*')
                                ->get();

        foreach($herramientasPracticas as $herramientasPractica){
            $herramientasPromG[($herramientasPractica->id_herramienta) -1] += 1;
        }
        return $herramientasPromG;
    }

    public function calcularAreasAutoevalPromG($areas, $carrera){
        $areasPromG = array_fill(0, sizeof($areas), 0);

        $areasAutoevals = AreaAutoeval::join('autoevaluaciones', 'areas_autoeval.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('areas','areas_autoeval.id_area', '=', 'areas.id_area')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('areas.vigencia', 1)
                                ->select('areas_autoeval.*')
                                ->get();

        foreach($areasAutoevals as $areasAutoeval){
            $areasPromG[($areasAutoeval->id_area) -1] += 1;
        }
        
        return $areasPromG;
    }

    public function calcularAreasEvalSupPromG($areas, $carrera){
        $areasPromG = array_fill(0, sizeof($areas), 0);
        
        $areasEvaluacions = AreaEvaluacion::join('evaluaciones_supervisor', 'area_evaluacion.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('areas','area_evaluacion.id_area', '=', 'areas.id_area')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('areas.vigencia', 1)
                                ->select('area_evaluacion.*')
                                ->get();

        foreach($areasEvaluacions as $areasEvaluacion){
            $areasPromG[($areasEvaluacion->id_area) -1] += 1;
        }
        return $areasPromG;
    }

//--------------------------------------- Rango de año ------------------------------------------//
    public function calcularActAutoevalPromGRangoAño($evalActitudinales, $carrera, $fechaDesde, $fechaHasta){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActPractica::join('autoevaluaciones', 'eval_act_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_practicas.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                if($evalActPractica->valor_act_practica <> 'NA'){ 
                    if($evalActPractica->valor_act_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }else{
                        $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }
                }
            }
        }
        for($i=0 ; $i<sizeof($evalActitudinales) ; $i++){
            if($count[$i] <> 0)
                $evalActPromG[$i] = $evalActPromG[$i] / $count[$i];
        }
        return $evalActPromG;
    }

    public function calcularConAutoevalPromGRangoAño($evalConocimientos, $carrera, $fechaDesde, $fechaHasta){
        $evalConPromG = array_fill(0, sizeof($evalConocimientos), 0);
        $count = array_fill(0, sizeof($evalConocimientos), 0);

        $evalConPracticas = EvalConPractica::join('autoevaluaciones', 'eval_con_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_practicas.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                if($evalConPractica->valor_con_practica <> 'NA' ){
                    if($evalConPractica->valor_con_practica == 'NL'){ //NL: puntos
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }else{
                        $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }
                }
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $evalConPromG[$i] = $evalConPromG[$i] / $count[$i];
        }
        return $evalConPromG;
    }

    public function calcularActEvalSupPromGRangoAño($evalActitudinales, $carrera, $fechaDesde, $fechaHasta){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActEmpPractica::join('evaluaciones_supervisor', 'eval_act_emp_practica.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_emp_practica.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                if($evalActPractica->valor_act_emp_practica <> 'NA'){
                    if($evalActPractica->valor_act_emp_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }else{
                        $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_emp_practica);
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }
                }
            }
        }
        for($i=0 ; $i<sizeof($evalActitudinales) ; $i++){
            if($count[$i] <> 0)
                $evalActPromG[$i] = $evalActPromG[$i] / $count[$i];
        }
        return $evalActPromG;
    }

    public function calcularConEvalSupPromGRangoAño($evalConocimientos, $carrera, $fechaDesde, $fechaHasta){
        $evalConPromG = array_fill(0, sizeof($evalConocimientos), 0);
        $count = array_fill(0, sizeof($evalConocimientos), 0);

        $evalConPracticas = EvalConEmpPractica::join('evaluaciones_supervisor', 'eval_con_emp_practicas.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_emp_practicas.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                if($evalConPractica->valor_con_emp_practica <> 'NA'){
                    if($evalConPractica->valor_con_emp_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }else{
                        $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_emp_practica);
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }
                }
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $evalConPromG[$i] = $evalConPromG[$i] / $count[$i];
        }
        return $evalConPromG;
    }

    public function calcularHerramAutoevalPromGRangoAño($herramientas, $carrera, $fechaDesde, $fechaHasta){
        $herramientasPromG = array_fill(0, sizeof($herramientas), 0);
        
        $herramientasPracticas = HerramientaPractica::join('autoevaluaciones', 'herramientas_practica.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('herramientas','herramientas_practica.id_herramienta', '=', 'herramientas.id_herramienta')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('herramientas.vigencia', 1)
                                ->select('herramientas_practica.*','resoluciones.f_resolucion')
                                ->get();

        foreach($herramientasPracticas as $herramientasPractica){
            $anio = date("Y", strtotime($herramientasPractica->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                $herramientasPromG[($herramientasPractica->id_herramienta) -1] += 1;
            }
        }
        return $herramientasPromG;
    }
    public function calcularAreasAutoevalPromGRangoAño($areas, $carrera, $fechaDesde, $fechaHasta){
        $areasPromG = array_fill(0, sizeof($areas), 0);
        
        $areasAutoevals = AreaAutoeval::join('autoevaluaciones', 'areas_autoeval.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('areas','areas_autoeval.id_area', '=', 'areas.id_area')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('areas.vigencia', 1)
                                ->select('areas_autoeval.*','resoluciones.f_resolucion')
                                ->get();

        foreach($areasAutoevals as $areasAutoeval){
            $anio = date("Y", strtotime($areasAutoeval->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                $areasPromG[($areasAutoeval->id_area) -1] += 1;
            }
        }
        return $areasPromG;
    }
    public function calcularAreasEvalSupPromGRangoAño($areas, $carrera, $fechaDesde, $fechaHasta){
        $areasPromG = array_fill(0, sizeof($areas), 0);
        
        $areasEvaluacions = AreaEvaluacion::join('evaluaciones_supervisor', 'area_evaluacion.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('areas','area_evaluacion.id_area', '=', 'areas.id_area')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('areas.vigencia', 1)
                                ->select('area_evaluacion.*','resoluciones.f_resolucion')
                                ->get();

        foreach($areasEvaluacions as $areasEvaluacion){
            $anio = date("Y", strtotime($areasEvaluacion->f_resolucion));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                $areasPromG[($areasEvaluacion->id_area) -1] += 1;
            }
        }
        return $areasPromG;
    }

    //------------------------------------------ Año especifico ---------------------------------//
    public function calcularActAutoevalAñoEspecifico($evalActitudinales, $carrera, $fechaDesde){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActPractica::join('autoevaluaciones', 'eval_act_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_practicas.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_resolucion));

            if($anio == $fechaDesde){
                if($evalActPractica->valor_act_practica <> 'NA'){
                    if($evalActPractica->valor_act_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }else{
                        $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }
                }
            }
        }

        for($i=0 ; $i<sizeof($evalActitudinales) ; $i++){
            if($count[$i] <> 0)
                $evalActPromG[$i] = $evalActPromG[$i] / $count[$i];
        }
        
        return $evalActPromG;
    }

    public function calcularConAutoevalAñoEspecifico($evalConocimientos, $carrera, $fechaDesde){
        $evalConPromG = array_fill(0, sizeof($evalConocimientos), 0);
        $count = array_fill(0, sizeof($evalConocimientos), 0);

        $evalConPracticas = EvalConPractica::join('autoevaluaciones', 'eval_con_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_practicas.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_resolucion));

            if($anio == $fechaDesde){
                if($evalConPractica->valor_con_practica <> 'NA' ){
                    if($evalConPractica->valor_con_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }else{
                        $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }
                }
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $evalConPromG[$i] = $evalConPromG[$i] / $count[$i];
        }
        
        return $evalConPromG;
    }
    public function calcularActEvalSupAñoEspecifico($evalActitudinales, $carrera, $fechaDesde){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActEmpPractica::join('evaluaciones_supervisor', 'eval_act_emp_practica.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_emp_practica.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_resolucion));

            if($anio == $fechaDesde){
                if($evalActPractica->valor_act_emp_practica <> 'NA'){
                    if($evalActPractica->valor_act_emp_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }else{
                        $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_emp_practica);
                        $count[($evalActPractica->id_actitudinal) -1] += 1;
                    }
                }
            }
        }

        for($i=0 ; $i<sizeof($evalActitudinales) ; $i++){
            if($count[$i] <> 0)
                $evalActPromG[$i] = $evalActPromG[$i] / $count[$i];
        }
        
        return $evalActPromG;
    }

    public function calcularConEvalSupAñoEspecifico($evalConocimientos, $carrera, $fechaDesde){
        $evalConPromG = array_fill(0, sizeof($evalConocimientos), 0);
        $count = array_fill(0, sizeof($evalConocimientos), 0);

        $evalConPracticas = EvalConEmpPractica::join('evaluaciones_supervisor', 'eval_con_emp_practicas.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_emp_practicas.*','resoluciones.f_resolucion')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_resolucion));

            if($anio == $fechaDesde){
                if($evalConPractica->valor_con_emp_practica <> 'NA' ){
                    if($evalConPractica->valor_con_emp_practica == 'NL'){ //NL: 0 puntos
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }else{
                        $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_emp_practica);
                        $count[($evalConPractica->id_conocimiento) -1] += 1;
                    }
                }
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $evalConPromG[$i] = $evalConPromG[$i] / $count[$i];
        }
        
        return $evalConPromG;
    }
    public function calcularHerramAutoevalAñoEspecifico($herramientas, $carrera, $fechaDesde){
        $herramientasPromG = array_fill(0, sizeof($herramientas), 0);
        
        $herramientasPracticas = HerramientaPractica::join('autoevaluaciones', 'herramientas_practica.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('herramientas','herramientas_practica.id_herramienta', '=', 'herramientas.id_herramienta')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('herramientas.vigencia', 1)
                                ->select('herramientas_practica.*','resoluciones.f_resolucion')
                                ->get();

        foreach($herramientasPracticas as $herramientasPractica){
            $anio = date("Y", strtotime($herramientasPractica->f_resolucion));

            if($anio == $fechaDesde){
                $herramientasPromG[($herramientasPractica->id_herramienta) -1] += 1;
            }
        }
        return $herramientasPromG;
    }

    public function calcularAreasAutoevalAñoEspecifico($areas, $carrera, $fechaDesde){
        $areasPromG = array_fill(0, sizeof($areas), 0);
        
        $areasAutoevals = AreaAutoeval::join('autoevaluaciones', 'areas_autoeval.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('areas','areas_autoeval.id_area', '=', 'areas.id_area')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('areas.vigencia', 1)
                                ->select('areas_autoeval.*','resoluciones.f_resolucion')
                                ->get();

        foreach($areasAutoevals as $areasAutoeval){
            $anio = date("Y", strtotime($areasAutoeval->f_resolucion));

            if($anio == $fechaDesde){
                $areasPromG[($areasAutoeval->id_area) -1] += 1;
            }
        }
        return $areasPromG;
    }

    public function calcularAreasEvalSupAñoEspecifico($areas, $carrera, $fechaDesde){
        $areasPromG = array_fill(0, sizeof($areas), 0);
        
        $areasEvaluacions = AreaEvaluacion::join('evaluaciones_supervisor', 'area_evaluacion.id_eval_supervisor', '=', 'evaluaciones_supervisor.id_eval_supervisor')
                                ->join('practicas', 'evaluaciones_supervisor.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->join('areas','area_evaluacion.id_area', '=', 'areas.id_area')
                                ->join('resoluciones','practicas.id_practica','=','resoluciones.id_practica')
                                ->where('resoluciones.resolucion_practica',1)
                                ->where('alumnos.carrera',$carrera)
                                ->where('areas.vigencia', 1)
                                ->select('area_evaluacion.*','resoluciones.f_resolucion')
                                ->get();

        foreach($areasEvaluacions as $areasEvaluacion){
            $anio = date("Y", strtotime($areasEvaluacion->f_resolucion));

            if($anio == $fechaDesde){
                $areasPromG[($areasEvaluacion->id_area) -1] += 1;
            }
        }
        return $areasPromG;
    }
      
}
?>