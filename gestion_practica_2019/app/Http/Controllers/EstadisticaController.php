<?php

namespace SGPP\Http\Controllers;

use Illuminate\Http\Request;

use SGPP\Practica;
use SGPP\Alumno;
use SGPP\Supervisor;
use SGPP\Empresa;

use SGPP\Autoevaluacion;
use SGPP\Desempenno;
use SGPP\Tarea;
use SGPP\Habilidad;
use SGPP\Conocimiento;
use SGPP\HerramientaPractica;
use SGPP\AreaAutoeval;
use SGPP\EvalActPractica;
use SGPP\EvalConPractica;
use SGPP\EvalActitudinal;
use SGPP\EvalConocimiento;
use SGPP\Area;
use SGPP\Herramienta;
use SGPP\EvalActEmpPractica;
use SGPP\EvalConEmpPractica;

class EstadisticaController extends Controller
{

/////////////////////////////////////////////////////////////////// Estadistica Promedio Autoevaluacion ///////////////////////////////////////////////////////////////
    public function mostrarEstadisticasAlumno($id){
        $alumno = Alumno::find($id);
        $practicas = Practica::where('id_alumno',$id)->paginate(12);

        //Lista de supervisores
        $supervisores = new Supervisor();
        $supervisores = collect([]);

        foreach($practicas as $practica){
            $resultadoSupervisor = Supervisor::where('id_supervisor', $practica->id_supervisor)->first();
            $supervisores->push($resultadoSupervisor);
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
                    ->with('empresas', $empresas);                      
    }

    public function buscarAlumno(Request $request){
        $lista= Alumno::filtrarYPaginar($request->get('buscador'),
                                        $request->get('nombre'), 
                                        $request->get('apellido_paterno'),
                                        $request->get('apellido_materno'),
                                        $request->get('email'),
                                        $request->get('anno_ingreso'),
                                        $request->get('carrera'),
                                        $request->get('direccion')
                                    );
        return view('Estadisticas/alumnosDetalles')->with("lista", $lista);
    }
    // --------------------------------------------------------------------------------------------------------------
    public function mostrarComparativaEvaluaciones($id){
        $autoevaluacion = Autoevaluacion::where('id_practica',$id)->first();
        
        if($autoevaluacion != null){
            $evalActPractica = EvalActPractica::orderby('valor_act_practica', 'DESC')->where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
            $evalConPractica = EvalConPractica::orderby('valor_con_practica', 'DESC')->where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);

            $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
            $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);

            $evalActitudinales->toArray();
            $evalActPractica->toArray();

            $evalConocimientos->toArray();
            $evalConPractica->toArray();
            
            return view('Estadisticas/mostrarComparativaEvaluaciones')->with("autoevaluacion", $autoevaluacion)
                    ->with("evalActPractica", $evalActPractica)->with("evalConPractica", $evalConPractica)
                    ->with("evalActitudinales", $evalActitudinales)->with("evalConocimientos", $evalConocimientos);
        }
        else{
            return view('Estadisticas/mostrarComparativaEvaluaciones')->with("autoevaluacion", $autoevaluacion);
        }
    }
    public function mostrarAutoevaluacionAlumno($id){
        $autoevaluacion = Autoevaluacion::where('id_practica',$id)->first();
        
        if($autoevaluacion != null){
            $desempeño = Desempenno::where('id_autoeval',$autoevaluacion->id_autoeval)->first();
            $tareas = Tarea::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
            $habilidades = Habilidad::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
            $conocimientos = Conocimiento::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
            
            $herramientaPracticas = HerramientaPractica::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
            $areaAutoevals = AreaAutoeval::where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);

            $herramientas = Herramienta::orderby('id_herramienta', 'DESC')->paginate(12);
            $areas = Area::orderby('id_area', 'DESC')->paginate(12);

            $evalActPractica = EvalActPractica::orderby('valor_act_practica', 'DESC')->where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);
            $evalConPractica = EvalConPractica::orderby('valor_con_practica', 'DESC')->where('id_autoeval',$autoevaluacion->id_autoeval)->paginate(12);

            $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
            $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);

            $evalActitudinales->toArray();
            $evalActPractica->toArray();

            $evalConocimientos->toArray();
            $evalConPractica->toArray();

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
        $alumno = Alumno::find($id);

        return view('Estadisticas/mostrarEvaluacionSupervisor')->with("alumno", $alumno);
    }
/////////////////////////////////////////////// Estadisticas Generales ////////////////////////////////////////////////////
    public function verEstadisticaCriteriosAutoeval(){
        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();
        
        $evalActCivilPromG = $this->calcularActAutoevalPromG($evalActitudinales, 'Ingeniería Civil Informática' );
        $evalConCivilPromG = $this->calcularConAutoevalPromG($evalConocimientos, 'Ingeniería Civil Informática' );

        $evalActEjecPromG = $this->calcularActAutoevalPromG($evalActitudinales, 'Ingeniería de Ejecución Informática');
        $evalConEjecPromG = $this->calcularConAutoevalPromG($evalConocimientos, 'Ingeniería de Ejecución Informática' );
        
        return view('Estadisticas/estadisticaCriteriosAutoeval')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG);

    }

    public function verEstadisticaCriteriosEvalSupervisor(){

        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();
        
        $evalActCivilPromG = $this->calcularActEvalSupPromG($evalActitudinales, 'Ingeniería Civil Informática' );
        $evalConCivilPromG = $this->calcularConEvalSupPromG($evalConocimientos, 'Ingeniería Civil Informática' );

        $evalActEjecPromG = $this->calcularActEvalSupPromG($evalActitudinales, 'Ingeniería de Ejecución Informática' );
        $evalConEjecPromG = $this->calcularConEvalSupPromG($evalConocimientos, 'Ingeniería de Ejecución Informática' );
        
        return view('Estadisticas/estadisticaCriteriosEvaluacionSupervisor')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG);

    }

    //-------------------------------------------- Busquedas -------------------------------------//

    public function busquedaAutoeval(Request $request){
        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();

        $hasta = $request->busquedaHasta;
        $desde = $request->busquedaDesde;

        $tipoEval = 'Autoevaluación del alumno';
        
        if($request->tipoBusqueda == 1){ // 1: Busqueda por rango. 2: Busqueda por año especifico
            $evalActCivilPromG = $this->calcularActAutoevalPromGRangoAño($evalActitudinales, 'Ingeniería Civil Informática', $request->busquedaDesde, $request->busquedaHasta);
            $evalConCivilPromG = $this->calcularConAutoevalPromGRangoAño($evalConocimientos, 'Ingeniería Civil Informática', $request->busquedaDesde, $request->busquedaHasta);

            $evalActEjecPromG = $this->calcularActAutoevalPromGRangoAño($evalActitudinales, 'Ingeniería de Ejecución Informática', $request->busquedaDesde, $request->busquedaHasta);
            $evalConEjecPromG = $this->calcularConAutoevalPromGRangoAño($evalConocimientos, 'Ingeniería de Ejecución Informática', $request->busquedaDesde, $request->busquedaHasta);
        
            return view('Estadisticas/busquedaPorAño')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with('evalActCivilPromG', $evalActCivilPromG)->with('evalConCivilPromG', $evalConCivilPromG)
                ->with('evalActEjecPromG', $evalActEjecPromG)->with('evalConEjecPromG', $evalConEjecPromG)
                ->with('tipoEval', $tipoEval)->with("desde", $desde)->with("hasta", $hasta);
        }
        else{
            $evalActCivilPromG = $this->calcularActAutoevalAñoEspecifico($evalActitudinales, 'Ingeniería Civil Informática', $request->busquedaDesde );
            $evalConCivilPromG = $this->calcularConAutoevalAñoEspecifico($evalConocimientos, 'Ingeniería Civil Informática', $request->busquedaDesde);

            $evalActEjecPromG = $this->calcularActAutoevalAñoEspecifico($evalActitudinales, 'Ingeniería de Ejecución Informática', $request->busquedaDesde );
            $evalConEjecPromG = $this->calcularConAutoevalAñoEspecifico($evalConocimientos, 'Ingeniería de Ejecución Informática', $request->busquedaDesde );

            return view('Estadisticas/busquedaPorAñoEspecifico')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('tipoEval', $tipoEval)->with("desde", $desde);
        }
    }

    public function busquedaEvalSup(Request $request){
        $evalActitudinales = EvalActitudinal::orderby('id_actitudinal', 'ASC')->paginate(12);
        $evalConocimientos = EvalConocimiento::orderby('id_conocimiento', 'ASC')->paginate(12);
        
        $evalActitudinales->toArray();
        $evalConocimientos->toArray();

        $hasta = $request->busquedaHasta;
        $desde = $request->busquedaDesde;

        $tipoEval = 'Evaluación del supervisor';
        
        if($request->tipoBusqueda == 1){ // 1: Busqueda por rango. 2: Busqueda por año especifico
            $evalActCivilPromG = $this->calcularActEvalSupPromGRangoAño($evalActitudinales, 'Ingeniería Civil Informática', $request->busquedaDesde, $request->busquedaHasta);
            $evalConCivilPromG = $this->calcularConEvalSupPromGRangoAño($evalConocimientos, 'Ingeniería Civil Informática', $request->busquedaDesde, $request->busquedaHasta);

            $evalActEjecPromG = $this->calcularActEvalSupPromGRangoAño($evalActitudinales, 'Ingeniería de Ejecución Informática', $request->busquedaDesde, $request->busquedaHasta);
            $evalConEjecPromG = $this->calcularConEvalSupPromGRangoAño($evalConocimientos, 'Ingeniería de Ejecución Informática', $request->busquedaDesde, $request->busquedaHasta);
        
            return view('Estadisticas/busquedaPorAño')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('tipoEval', $tipoEval)->with("desde", $desde)->with("hasta", $hasta);
        }
        else{
            $evalActCivilPromG = $this->calcularActEvalSupAñoEspecifico($evalActitudinales, 'Ingeniería Civil Informática', $request->busquedaDesde );
            $evalConCivilPromG = $this->calcularConEvalSupAñoEspecifico($evalConocimientos, 'Ingeniería Civil Informática', $request->busquedaDesde);

            $evalActEjecPromG = $this->calcularActEvalSupAñoEspecifico($evalActitudinales, 'Ingeniería de Ejecución Informática', $request->busquedaDesde );
            $evalConEjecPromG = $this->calcularConEvalSupAñoEspecifico($evalConocimientos, 'Ingeniería de Ejecución Informática', $request->busquedaDesde );

            return view('Estadisticas/busquedaPorAñoEspecifico')
                ->with('evalActitudinales', $evalActitudinales)->with('evalConocimientos',$evalConocimientos)
                ->with("evalActCivilPromG", $evalActCivilPromG)->with("evalConCivilPromG", $evalConCivilPromG)
                ->with("evalActEjecPromG", $evalActEjecPromG)->with("evalConEjecPromG", $evalConEjecPromG)
                ->with('tipoEval', $tipoEval)->with("desde", $desde);
        }
    }
/////////////////////////////////////////////// Funciones para calcular //////////////////////////////////////////////////////77
    public function calcularActAutoevalPromG($evalActitudinales, $carrera){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActPractica::join('autoevaluaciones', 'eval_act_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_practicas.*')
                                ->get();
    
        foreach($evalActPracticas as $evalActPractica){ 

                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalActPractica->valor_act_practica <> 'NA' || $evalActPractica->valor_act_practica <> 'NL'){
                            $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                            $count[($evalActPractica->id_actitudinal) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_practicas.*')
                                ->get();
        foreach($evalConPracticas as $evalConPractica){

                //foreach($evalConocimientos as $evalConocimiento){
                    //if ($evalConocimiento->id_conocimiento == $evalConPractica->id_conocimiento){

                        if($evalConPractica->valor_con_practica <> 'NA' || $evalConPractica->valor_con_practica <> 'NL'){
                            $EvalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                            $count[($evalConPractica->id_conocimiento) -1] += 1;
                        }
                    //}
                //}
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
                                                ->where('alumnos.carrera',$carrera)
                                                ->select('eval_act_emp_practica.*')
                                                ->get();

        foreach($evalActPracticas as $evalActPractica){ 
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalActPractica->valor_act_practica <> 'NA' || $evalActPractica->valor_act_practica <> 'NL'){
                            $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                            $count[($evalActPractica->id_actitudinal) -1] += 1;
                        }
                    //}
                //}
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
                                                ->where('alumnos.carrera',$carrera)
                                                ->select('eval_con_emp_practicas.*')
                                                ->get();

        foreach($evalConPracticas as $evalConPractica){
                //foreach($evalConocimientos as $evalConocimiento){
                    //if ($evalConocimiento->id_conocimiento == $evalConPractica->id_conocimiento){

                        if($evalConPractica->valor_con_practica <> 'NA' || $evalConPractica->valor_con_practica <> 'NL'){
                            $EvalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                            $count[($evalConPractica->id_conocimiento) -1] += 1;
                        }
                    //}
                //}
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $EvalConPromG[$i] = ceil($EvalConPromG[$i] / $count[$i]);
        }
        
        return $EvalConPromG;
    }
//--------------------------------------- Rango de año ------------------------------------------//
    public function calcularActAutoevalPromGRangoAño($evalActitudinales, $carrera, $fechaDesde, $fechaHasta){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActPractica::join('autoevaluaciones', 'eval_act_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_practicas.*','autoevaluaciones.f_entrega')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_entrega));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalActPractica->valor_act_practica <> 'NA' || $evalActPractica->valor_act_practica <> 'NL'){
                            $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                            $count[($evalActPractica->id_actitudinal) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_practicas.*','autoevaluaciones.f_entrega')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_entrega));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalConPractica->valor_con_practica <> 'NA' || $evalConPractica->valor_con_practica <> 'NL'){
                            $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                            $count[($evalConPractica->id_conocimiento) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_emp_practica.*','evaluaciones_supervisor.f_entrega_eval')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_entrega_eval));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalActPractica->valor_act_emp_practica <> 'NA' || $evalActPractica->valor_act_emp_practica <> 'NL'){
                            $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_emp_practica);
                            $count[($evalActPractica->id_actitudinal) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_emp_practicas.*','evaluaciones_supervisor.f_entrega_eval')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_entrega_eval));

            if($anio >= $fechaDesde && $anio <= $fechaHasta){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalConPractica->valor_con_emp_practica <> 'NA' || $evalConPractica->valor_con_emp_practica <> 'NL'){
                            $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_emp_practica);
                            $count[($evalConPractica->id_conocimiento) -1] += 1;
                        }
                    //}
                //}
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $evalConPromG[$i] = $evalConPromG[$i] / $count[$i];
        }
        return $evalConPromG;
    }


    //------------------------------------------ Año especifico ---------------------------------//
    public function calcularActAutoevalAñoEspecifico($evalActitudinales, $carrera, $fechaDesde){
        $evalActPromG = array_fill(0, sizeof($evalActitudinales), 0);
        $count = array_fill(0, sizeof($evalActitudinales), 0);

        $evalActPracticas = EvalActPractica::join('autoevaluaciones', 'eval_act_practicas.id_autoeval', '=', 'autoevaluaciones.id_autoeval')
                                ->join('practicas', 'autoevaluaciones.id_practica', '=', 'practicas.id_practica')
                                ->join('alumnos', 'practicas.id_alumno', '=', 'alumnos.id_alumno')
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_practicas.*','autoevaluaciones.f_entrega')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_entrega));

            if($anio == $fechaDesde){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalActPractica->valor_act_practica <> 'NA' || $evalActPractica->valor_act_practica <> 'NL'){
                            $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                            $count[($evalActPractica->id_actitudinal) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_practicas.*','autoevaluaciones.f_entrega')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_entrega));

            if($anio == $fechaDesde){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalConPractica->valor_con_practica <> 'NA' || $evalConPractica->valor_con_practica <> 'NL'){
                            $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                            $count[($evalConPractica->id_conocimiento) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_act_emp_practica.*','evaluaciones_supervisor.f_entrega_eval')
                                ->get();
        
        foreach($evalActPracticas as $evalActPractica){ 
            $anio = date("Y", strtotime($evalActPractica->f_entrega_eval));

            if($anio == $fechaDesde){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalActPractica->valor_act_practica <> 'NA' || $evalActPractica->valor_act_practica <> 'NL'){
                            $evalActPromG[($evalActPractica->id_actitudinal) -1] += intval($evalActPractica->valor_act_practica);
                            $count[($evalActPractica->id_actitudinal) -1] += 1;
                        }
                    //}
                //}
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
                                ->where('alumnos.carrera',$carrera)
                                ->select('eval_con_emp_practicas.*','evaluaciones_supervisor.f_entrega_eval')
                                ->get();
        
        foreach($evalConPracticas as $evalConPractica){ 
            $anio = date("Y", strtotime($evalConPractica->f_entrega_eval));

            if($anio == $fechaDesde){
                //foreach($evalActitudinales as $evalActitudinal){
                    //if ($evalActitudinal->id_actitudinal == $evalActPractica->id_actitudinal){

                        if($evalConPractica->valor_con_practica <> 'NA' || $evalConPractica->valor_con_practica <> 'NL'){
                            $evalConPromG[($evalConPractica->id_conocimiento) -1] += intval($evalConPractica->valor_con_practica);
                            $count[($evalConPractica->id_conocimiento) -1] += 1;
                        }
                    //}
                //}
            }
        }
        for($i=0 ; $i<sizeof($evalConocimientos) ; $i++){
            if($count[$i] <> 0)
                $evalConPromG[$i] = $evalConPromG[$i] / $count[$i];
        }
        
        return $evalConPromG;
    }
}
?>